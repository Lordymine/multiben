<?php


namespace App\Http\Controllers;

use App\Cidade;
use Illuminate\Http\Request;

use App\Repositories\Contracts\LocalityRepositoryInterface;

class LocalityController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }


    public function getCidadesHtml(Request $request, LocalityRepositoryInterface $locality_repository)
    {
        $cidades = $locality_repository->getCidade($request);
        $html = '<option value="">Selectione uma cidade</option>';
        foreach ($cidades as $cidade){
           $html .= '<option value="'.$cidade->id.'">'.$cidade->nome.'</option>';
        }
        return $html;
    }

    public function getCidadeByUf($uf)
    {
        $cidades =  Cidade::where('uf', $uf)->pluck("nome", "codigo");
        return json_encode($cidades);
    }
}
