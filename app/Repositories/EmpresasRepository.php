<?php
namespace App\Repositories;

use App\CompanyMultipleUpload;
use App\Empresa;
use App\Favorite;
use App\Repositories\Contracts\EmpresasRepositoryInterface;
use Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class EmpresasRepository implements EmpresasRepositoryInterface
{

    public function getCompanies()
    {
        $empresas = Empresa::where('user_id',Auth::user()->id)->get();

        return $empresas;
    }

    public function getCompaniesbyCategory($id)
    {

        $empresas = DB::table('empresas')
        ->join('empresa_category', 'empresa_category.empresas_id', '=', 'empresas.id')
        ->select('empresas.*', 'empresa_category.*')
        ->where('empresa_category.categories_id','=',$id)
        ->paginate();

        return $empresas;
    }

    /* Possivel código a ser usado.*/
    
    /*public function getCompaniesbyEmail($id)
    {
        $empresas = DB::table('empresas')
        ->join('users', 'users.id', '=', 'empresas.user_id')
        ->select('empresas.*', 'users.email')
        ->where('users.users_id','=',$id)
        ->get();

        return $empresas;
    }*/

    public function getCompaniesbyCategoryRatings($id)
    {

        $empresas = DB::table('empresas')
        ->join('empresa_category', 'empresa_category.empresas_id', '=', 'empresas.id')
        ->select('empresas.*', 'empresa_category.*')
        ->where('empresa_category.categories_id','=',$id)
        ->paginate();

        foreach ($empresas as $empresa) {
            $original = Empresa::where('id',$empresa->empresas_id)->first();
            $empresa->rating = $original->calculateRatingScore();
            $empresa->stars = $original->calculateStarRatingScore($empresa->rating);
            $empresa->halfStars = $original->calculateHalfStarRatingScore($empresa->rating);
            $empresa->capa = $original->capa();
        }

        return $empresas;
    }

    public function getCompaniesHomeRatings()
    {
        $empresas = Empresa::orderBy('created_at','desc')
        ->take(30)
        ->get();

        foreach ($empresas as $empresa) {
            $empresa->rating = $empresa->calculateRatingScore();
            $empresa->stars = $empresa->calculateStarRatingScore($empresa->rating);
            $empresa->halfStars = $empresa->calculateHalfStarRatingScore($empresa->rating);
        }

        return $empresas;
    }

    public function getCompaniesHome()
    {
        $empresas = Empresa::orderBy('created_at','desc')
        ->take(30)
        ->get();
        return $empresas;
    }

    public function getCompaniesSorting($request)
    {
        $filtro = $request->sorting;
        $user = Auth::user();

        if($user == null && $filtro != 'Descontos'){
            $filtro = '';
        }

        switch ($filtro){
            case 'Descontos':
                $empresas = Empresa::orderByRaw('-desconto asc')
                ->take(30)
                ->get();
                break;
            case 'Bairros':
                $empresas = Empresa::orderBy('bairro', 'desc')
                ->take(30)
                ->get();
                break;
            case 'Favoritos':
                $var = '';
                $favorites = Favorite::where('user_id', $user->id)->get();
                for($i=0; $i< $favorites->count(); $i++){
                    $var .=$favorites[$i]->empresa_id;
                    if($favorites->count() != $i+1){
                        $var .=',';
                    }
                }
                $empresasQuery = DB::select('select id from empresas ORDER BY ID IN ('.$var.') desc LIMIT 30');
                $empresas = [];
                foreach ($empresasQuery as $empresa) {
                    array_push($empresas, Empresa::where('id',$empresa->id)->first());
                }
                break;
            default:
                $empresas = Empresa::orderBy('created_at', 'desc')
                ->take(30)
                ->get();
                break;
        }

        if($empresas !=null){
            foreach ($empresas as $empresa) {
                $original = Empresa::where('id',$empresa->id)->first();
                $empresa->rating = $original->calculateRatingScore();
                $empresa->stars = $original->calculateStarRatingScore($empresa->rating);
                $empresa->halfStars = $original->calculateHalfStarRatingScore($empresa->rating);
                $empresa->capa = $original->capa();
            }
        }

        return $empresas;
    }

    public function getCompany($id)
    {
        if($id!='0'){
            $id = preg_replace('/[^0-9]/', '', decrypt($id));

            $empresa = DB::table('empresas')
            ->leftJoin('empresa_category', 'empresas.id', '=', 'empresa_category.empresas_id')
            ->leftJoin('categories', 'empresa_category.categories_id', '=', 'categories.id')
            ->leftJoin('cidades', 'empresas.cidade', '=', 'cidades.codigo')
            ->select('empresas.*', 'cidades.id as id_cidade', 'cidades.nome as nome_cidade', 'categories.nome as category_nome')
            ->where('empresas.id','=',$id)
            ->get();;

            return $empresa[0];
        }
        return null;

    }

    public function getCompanyCategories($id)
    {

        if($id!='0'){
            //             $id = preg_replace('/[^0-9]/', '', decrypt($id));
            $categories = DB::table('empresa_category')->select('categories_id')->where('empresas_id', $id)->get()->toArray();

            $result = array_map(function($categories){
                return $categories->categories_id;
            }, $categories);


                return $result;
        }
        return null;

    }

    public function getListCategories($id)
    {

        if($id!='0'){
            $id = preg_replace('/[^0-9]/', '', decrypt($id));
            $categories = DB::table('empresa_category')
            ->join('categories','empresa_category.categories_id','=','categories.id')
            ->select('empresa_category.categories_id','categories.nome','categories.id')
            ->where('empresas_id', $id)->get();


            return $categories;
        }
        return null;

    }

    public function validateStoreCompany($request){
        $data = $request->all();
        $data['cnpj'] = str_replace("-","",str_replace("/","",str_replace(".","", $data['cnpj'])));

        return $this->validate($data);
    }

    public function validateUpdateCompany($request){
        $data = $request->all();
        $data['cnpj'] = str_replace("-","",str_replace("/","",str_replace(".","", $data['cnpj'])));

        return Validator::make($request->all(), [
            'razao_social' => 'required',
            'cnpj' => 'required|unique:empresas,cnpj,'.$data['id'],
            'nome_fantasia' => 'required',
            'cep' => ['required'],
            'logo' => 'mimes:jpg,png,jpeg,gif|max:2048',
            'filename.*' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);
    }

    public function validate($data){
        $validator = Validator::make($data, [
            'razao_social' => ['required'],
            'cep' => ['required'],
            'cnpj' => ['required', 'unique:empresas'],
            'nome_fantasia' => ['required'],
            'logo' => ['mimes:jpg,png,jpeg,gif,max:2048']
        ]);

        if ($validator->fails())
        {
            return $validator;
        }

        return false;
    }

    public function storeCompany($request)
    {

        $data = $request->all();
        $data['cnpj'] = str_replace("-","",str_replace("/","",str_replace(".","", $data['cnpj'])));

        $cidade = DB::table('cidades')
        ->select('codigo', 'uf')
        ->where(DB::raw('UPPER(cidades.nome)') ,'=', strtoupper($data['cidade']))
        ->first();

        //TODO Validação tem que ser feita para regioes que não estiverem no BD
        if($cidade == null){
            return false;
        }

        $data['cidade'] = $cidade->codigo;

        $uf = $this->getEstadoByUf($cidade->uf);
        $data['uf'] = $uf->codigo_uf;

        $category = null;
        if(isset($data['category'])) {
            $category = $data['category'];
        }

        $data['password'] = isset($data['password']) ? Crypt::encrypt($data['password']) : null ;
        $data['desconto'] = (isset($data['id_categoria_empresas']) && $data['id_categoria_empresas'] == "1") ? $data['desconto'] : null ;

        $dias_funcionamento = array('seg'=>((isset($data['seg']))?1:0),
            'ter'=>((isset($data['ter']))?1:0),
            'qua'=>((isset($data['qua']))?1:0),
            'qui'=>((isset($data['qui']))?1:0),
            'sex'=>((isset($data['sex']))?1:0),
            'sab'=>((isset($data['sab']))?1:0),
            'dom'=>((isset($data['dom']))?1:0));

        unset($data["_token"]);
        unset($data["subscribe_me"]);
        unset($data['seg']);
        unset($data['ter']);
        unset($data['qua']);
        unset($data['qui']);
        unset($data['sex']);
        unset($data['sab']);
        unset($data['dom']);

        $nameFile = null;

        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {

            $name = uniqid(date('HisYmd').Auth::user()->matricula);

            $extension = $request->logo->extension();

            $nameFile = "{$name}.{$extension}";


            $upload = $request->logo->move('storage/logos', $nameFile,'public');

        }

        $data['user_id'] = auth()->user()->id;
        $data['dias_funcionamento'] = json_encode($dias_funcionamento);
        $data['dias_funcionamento'] = json_encode($dias_funcionamento);
        $data['logo'] = $nameFile;

        $empresaSalved = Empresa::create($data);

        if($category != null && $empresa = $empresaSalved->id){
            foreach ($category as $key => $value){
                DB::table('empresa_category')->insert(
                    ['empresas_id' => $empresa, 'categories_id' => $value]
                );
            }
        }

        return true;
    }

    public function updateCompany($request)
    {

        $data = $request->all();

        $id = $data['id'];
        $data['cnpj'] = str_replace("-","",str_replace("/","",str_replace(".","", $data['cnpj'])));

        $cidade = DB::table('cidades')
        ->select('codigo', 'uf')
        ->where(DB::raw('UPPER(cidades.nome)') ,'=', strtoupper($data['cidade']))
        ->first();

        //TODO Validação tem que ser feita para regioes que não estiverem no BD
        if($cidade == null){
            return null;
        }

        $data['cidade'] = $cidade->codigo;

        $uf = $this->getEstadoByUf($cidade->uf);
        $data['uf'] = $uf->codigo_uf;

        $logo_antiga = $data['logo_antiga'];
        $category = (empty($data['category'])) ? [] : $data['category'];
        $data['password'] = isset($data['password']) ? Crypt::encrypt($data['password']) : null ;
        $data['desconto'] = (isset($data['id_categoria_empresas']) && $data['id_categoria_empresas'] == "1") ? $data['desconto'] : null ;

        $dias_funcionamento = array('seg'=>((isset($data['seg']))?1:0),
            'ter'=>((isset($data['ter']))?1:0),
            'qua'=>((isset($data['qua']))?1:0),
            'qui'=>((isset($data['qui']))?1:0),
            'sex'=>((isset($data['sex']))?1:0),
            'sab'=>((isset($data['sab']))?1:0),
            'dom'=>((isset($data['dom']))?1:0));

        unset($data["_token"]);
        unset($data["subscribe_me"]);
        unset($data["id"]);
        unset($data['seg']);
        unset($data['ter']);
        unset($data['qua']);
        unset($data['qui']);
        unset($data['sex']);
        unset($data['sab']);
        unset($data['dom']);
        unset($data['logo_antiga']);
        unset($data['category']);
        unset($data['email']);
        unset($data['password_confirmation']);

        $nameFile = null;

        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {

            $name = uniqid(date('HisYmd').Auth::user()->matricula);

            $extension = $request->logo->extension();

            $nameFile = "{$name}.{$extension}";

            Storage::delete('storage/logos/'.$logo_antiga);
            $upload = $request->logo->move('storage/logos', $nameFile,'public');

        }else{
            $nameFile = Empresa::where('id', $id)->first()->logo;
        }

        $data['dias_funcionamento'] = json_encode($dias_funcionamento);
        $data['logo'] = $nameFile;

        $this->removeUploads($request,$id);
        unset($data['image']);

        if($request->hasfile('filename') || $request->hasfile('main-filename'))
        {
            $this->storeUploads($request,$id);
            if(isset($data['filename'])){
                unset($data['filename']);
            }
            if(isset($data['main-filename'])){
                unset($data['main-filename']);
            }
        }

        if(Empresa::query()->where('id', $id)->update($data)){
            DB::table('empresa_category')->where('empresas_id', '=', $id)->delete();
            foreach ($category as $key => $value){
                DB::table('empresa_category')->insert(
                    ['empresas_id' => $id, 'categories_id' => $value]
                );
            }
        }

        return Empresa::query()->where('id', $id)->first();
    }
    public function removeUploads($request,$id){
        $data = $request->all();
        if(isset($data['image']))
        {
            $images = $data['image'];
        }else{
            $images = [];
        }
        $allUploads = CompanyMultipleUpload::where('empresa_id', $id)->get();
        $empresas = Empresa::find($id);

        foreach ($allUploads as $upl)
        {
            if(!in_array($upl->id,$images)){
                $fileStore = 'images/'.$upl->filename;
                Storage::delete($fileStore);
                CompanyMultipleUpload::find($upl->id)->delete();
            }
        }
    }

    public function storeUploads($request,$id) {
        if($request->hasfile('main-filename'))
        {
            $upload_model = $this->buildUploadFiles($request->file('main-filename'), $id);
            $upload_model->main = true;
            $upload_model->save();
        }
        if($request->hasfile('filename'))
        {
//             $empresas = Empresa::find($id);
//             foreach ($request->file('filename') as $image)
//             {
//                 $name = uniqid(date('HisYmd').$empresas->cnpj);
//                 $extension = $image->extension();
//                 $nameFile = "{$name}.{$extension}";

//                 $image->move('storage/images', $nameFile);
//                 $upload_model = new CompanyMultipleUpload;
//                 $upload_model->filename = $nameFile;
//                 $upload_model->empresa_id = $id;
                $upload_model = $this->buildUploadFiles($request->file('filename'), $id);
                $upload_model->main = false;
                $upload_model->save();
//             }
        }
        return true;
    }

    private function buildUploadFiles($files, $id){
        $empresas = Empresa::find($id);
        foreach ($files as $image)
        {
            $name = uniqid(date('HisYmd').$empresas->cnpj);
            $extension = $image->extension();
            $nameFile = "{$name}.{$extension}";

            $image->move('storage/images', $nameFile, 'public');
            $upload_model = new CompanyMultipleUpload;
            $upload_model->filename = $nameFile;
            $upload_model->empresa_id = $id;

            return $upload_model;
        }
    }

    public function getCountCompanies()
    {
        $empresas = Empresa::where('user_id',Auth::user()->id)->count();

        return $empresas;
    }

    public function getCompaniesbyCity($request)
    {
        $data = $request->all();

        if (isset($data['cidades'])){
            $empresas = DB::table('empresas')
            ->join('empresa_category', 'empresa_category.empresas_id', '=', 'empresas.id')
            ->select('empresas.*')
            ->where('empresa_category.categories_id','=',$data['id'])
            ->whereIn('empresas.cidade',$data['cidades'])
            ->paginate();
        }else{
            $empresas = DB::table('empresas')
            ->join('empresa_category', 'empresa_category.empresas_id', '=', 'empresas.id')
            ->select('empresas.*')
            ->where('empresa_category.categories_id','=',$data['id'])
            ->paginate();
        }


        return $empresas;
    }

    public function companyByDeduction($request)
    {
        $data = $request->all();
        $empresas = DB::table('empresas')
        ->join('empresa_category', 'empresa_category.empresas_id', '=', 'empresas.id')
        ->select('empresas.*')
        ->where('empresa_category.categories_id','=',$data['id'])
        ->where('empresas.desconto','>=',$data['deduction_min'])
        ->where('empresas.desconto','<=',$data['deduction_max'])
        ->paginate();

        return $empresas;
    }

    public function storeCustomersCode($request)
    {
        $data = $request->all();

        if($result = DB::table('clientes_empresas')->insert(['codigo_cliente' => $data['codigo'], 'user_id' => Auth::user()->id])){
            return true;
        }

        return false;
    }

    public function searchEmpresas($request)
    {
        $empresas = DB::table('empresas')
        ->where('razao_social','like','%'.strtoupper($request->texto).'%')
        ->orWhere('nome_fantasia','like','%'.strtoupper($request->texto).'%')
        ->get();
        return $empresas;
    }

    public function getAllCompanies()
    {
        $empresas = DB::table('empresas')
        ->select('empresas.*')
        ->get();
        return $empresas;
    }

    public function getCompaniesByFilters($request)
    {
        $this->getCompaniesbyCity();

    }

    public function getCompaniesbyUfCityAndCategory($request)
    {

        $data = $request->all();
        $query = DB::table('empresas');

        //se estiver selecionado a cidade e a categoria filtra por ambas
        if (isset($data['cidade']) && isset($data['categoria'])){
            $query->join('empresa_category', 'empresa_category.empresas_id', '=', 'empresas.id')
            ->join('cidades', 'cidades.codigo', '=', 'empresas.cidade')
            ->select('empresas.*', 'cidades.codigo as id_cidade', 'cidades.nome as nome_cidade')
            ->whereIn('empresa_category.categories_id', $data['categoria'])
            ->where('empresas.cidade',$data['cidade']);
        }else if(isset($data['categoria'])){
            //se só estiver setado a categoria, busca por ela e pelo estado que é obrigatorio
            $query->join('empresa_category', 'empresa_category.empresas_id', '=', 'empresas.id')
            ->join('estados', 'estados.codigo_uf', '=', 'empresas.uf')
            ->join('cidades', 'cidades.codigo', '=', 'empresas.cidade')
            ->select('empresas.*', 'cidades.codigo as id_cidade', 'cidades.nome as nome_cidade')
            ->whereIn('empresa_category.categories_id', $data['categoria'])
            ->where('estados.uf',$data['estado']);
        }else if(isset($data['cidade'])){
            //se só estiver a cidade, filtra só por ela
            $query->join('empresa_category', 'empresa_category.empresas_id', '=', 'empresas.id')
            ->join('cidades', 'cidades.codigo', '=', 'empresas.cidade')
            ->select('empresas.*', 'cidades.codigo as id_cidade', 'cidades.nome as nome_cidade')
            ->where('empresas.cidade',$data['cidade']);
        }else{
            //filtra só por estado
            $query->join('estados', 'estados.codigo_uf', '=', 'empresas.uf')
            ->join('cidades', 'cidades.codigo', '=', 'empresas.cidade')
            ->select('empresas.*', 'cidades.codigo as id_cidade', 'cidades.nome as nome_cidade')
            ->where('estados.uf',$data['estado']);
        }

        if(isset($data['search'])){
            $query->where('empresas.nome_fantasia','iLIKE','%'.$data['search'].'%');
        }

        $empresas = $query->distinct('empresas.id')->paginate();

        foreach ($empresas as $empresa) {
            $original = Empresa::where('id',$empresa->id)->first();
            $empresa->rating = $original->calculateRatingScore();
            $empresa->stars = $original->calculateStarRatingScore($empresa->rating);
            $empresa->halfStars = $original->calculateHalfStarRatingScore($empresa->rating);
            $empresa->capa = $original->capa();
        }

        return $empresas;
    }

    public function getCompanyByCnpj($cnpj)
    {
        if($cnpj!='0'){
            $empresa = DB::table('empresas')
            ->leftJoin('empresa_category', 'empresas.id', '=', 'empresa_category.empresas_id')
            ->leftJoin('categories', 'empresa_category.categories_id', '=', 'categories.id')
            ->leftJoin('cidades', 'empresas.cidade', '=', 'cidades.codigo')
            ->leftJoin('estados', 'cidades.uf', '=', 'estados.uf')
            ->select('empresas.*', 'cidades.id as id_cidade', 'cidades.nome as nome_cidade', 'categories.nome as category_nome', 'estados.nome as estado_nome')
            ->where('empresas.cnpj','=', $cnpj)
            ->get();;

            return $empresa[0];
        }
        return null;

    }

    public function getEstadoByUf($codigo)
    {
        $estado = DB::table('cidades')
        ->join('estados', 'estados.uf', '=', 'cidades.uf')
        ->select('estados.nome', 'estados.codigo_uf')
        ->where('estados.uf','=',$codigo)
        ->first();
        return $estado;
    }

    public function getAllCompaniesConveniadas()
    {
        $empresas = DB::table('empresas')
        ->where('id_categoria_empresas', '=' , '2')
        ->select('empresas.*')
        ->paginate();

        return $empresas;
    }

    public function getAllCompaniesConveniadasRatings()
    {
        $empresas = DB::table('empresas')->where('id_categoria_empresas', '=', '2')
            ->select('empresas.*')
            ->paginate();

        foreach ($empresas as $empresa) {
            $original = Empresa::where('id', $empresa->id)->first();
            $empresa->rating = $original->calculateRatingScore();
            $empresa->stars = $original->calculateStarRatingScore($empresa->rating);
            $empresa->halfStars = $original->calculateHalfStarRatingScore($empresa->rating);
            $empresa->capa = $original->capa();
        }

        return $empresas;
    }

    public function getCompaniesPaginated()
    {
        $empresas = DB::table('empresas')
        ->join('empresa_category', 'empresa_category.empresas_id', '=', 'empresas.id')
        ->select('empresas.*', 'empresa_category.empresas_id')
        ->distinct('empresas.cnpj')
        ->paginate();

        return $empresas;
    }

    public function getCompaniesPaginatedRatings()
    {
        $empresas = DB::table('empresas')
        ->join('empresa_category', 'empresa_category.empresas_id', '=', 'empresas.id')
        ->select('empresas.*', 'empresa_category.empresas_id')
        ->distinct('empresas.cnpj')
        ->paginate();

        foreach ($empresas as $empresa) {
            $original = Empresa::where('id',$empresa->id)->first();
            $empresa->rating = $original->calculateRatingScore();
            $empresa->stars = $original->calculateStarRatingScore($empresa->rating);
            $empresa->halfStars = $original->calculateHalfStarRatingScore($empresa->rating);
            $empresa->capa = $original->capa();
        }
        return $empresas;
    }
}
