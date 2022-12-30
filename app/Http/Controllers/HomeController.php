<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\Contracts\EmpresasRepositoryInterface;
use App\Repositories\Contracts\CategoriesRepositoryInterface;
use App\UserSubscriptionToken;
use App\SubscriptionGroup;
use Auth;
use App\Empresa;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(CategoriesRepositoryInterface $categories_repository,EmpresasRepositoryInterface $empresa_repository)
    {
        $matricula = '';
        if(Auth::user() != null){
            $matricula = Auth::user()->matricula;
        }        

        return view('beginning.index', [
            'matricula' => $matricula,
            'categories' => $categories_repository->getCategories(),
            'empresas' => $empresa_repository->getCompaniesHomeRatings(),
            'conveniados' => $empresa_repository->getAllCompaniesConveniadasRatings()
        ]);
    }

    public function searchCategories(Request $request, CategoriesRepositoryInterface $categories_repository,EmpresasRepositoryInterface $empresa_repository)
    {
        $categories = $categories_repository->searchCategories($request);
        $empresas = $empresa_repository->searchEmpresas($request);


        $html = "<ul>";
        foreach ($categories as $category){
            $html .= '<li><a href="/companies/'.$category->id.'">'.$category->nome.'</a></li>';
        }

        foreach ($empresas as $empresa){
            $html .= '<li><a href="/companies/info/'.encrypt($empresa->id).'">'.$empresa->razao_social.'</a></li>';
        }
        $html .= "</ul>";

        return $html;
    }

    public function sortingEmpresas(Request $request, EmpresasRepositoryInterface $empresa_repository)
    {

        $empresas = $empresa_repository->getCompaniesSorting($request);

        $html = '<table class="table table-borderless">';

        $i = 1;

//         $html .= "<tr>";
        $html .= "<div class='row'>";
        foreach ($empresas as $empresa) {
            $image = $empresa->logo == 'teste' ? 'img/logo/logo.jpeg' : $empresa->capa();

            $html .= '
                <div class="col-md-4 col-sm-6">
					<div class="gallery-item">
                    <div class="card margin-bottom-1x" style="box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.05);">
                    <a href ="'.route('companies_info',encrypt($empresa->id)).'" style="text-decoration: none">
                    <div class="card-body" style="padding: 20px; height: auto; flex: 1 1 auto;">
                        <div class="row" >
                            <div class="col-5 my-auto" >
                                <span class="product-thumb" ><img src = "'.asset($image).'" alt = "Product" ></span >
                            </div >
                            <div class="col-7 my-auto" >
                                <p class="card-text" >
                                    <span class="card-text" style="color:#404040;font-size: 1rem;font-weight: bold;white-space: nowrap;width: 10em;overflow: hidden;text-overflow: ellipsis;display: inline-block;text-transform:capitalize;">'.$empresa->nome_fantasia.'</span ><br >
                                    <span class="card-text" style="color:#606975;"> Bairro: '.$empresa->bairro.'</span ><br >
                                    <span class="text-muted" > Atualizada em '.\Carbon\Carbon::parse($empresa->updated_at)->format('d  M').' </span >
                                </p >
                               <div class="rating-stars">
                					<i class="icon-star '.$empresa->stars[0]. ' '.$empresa->halfStars[0].'" > </i>
                					<i class="icon-star '.$empresa->stars[1]. ' '.$empresa->halfStars[1].'"></i>
                					<i class="icon-star '.$empresa->stars[2]. ' '.$empresa->halfStars[2].'"></i>
                					<i class="icon-star '.$empresa->stars[3]. ' '.$empresa->halfStars[3].'"></i>
                					<i class="icon-star '.$empresa->stars[4]. ' '.$empresa->halfStars[4].'"></i>
                				</div>
                				<span class="text-muted align-middle">&nbsp;&nbsp; '.$empresa->rating.'</span>
                            </div >
                        </div>
                    </div>
                    </a>
                </div>
                </div>
                </div>
            ';


            if($i%3==0) {
//                 $html .= "</tr>
//                           <tr>";
            }

            $i = $i + 1;
        }
        $html .= "</div>";

//         $html .= "</table>";

        return $html;
    }
    
    public function invitation($tokenAcess)
    {
        $invitationToken = UserSubscriptionToken::where('token_acesso', $tokenAcess)->where('status', 'Ativo')->first();

        //só redireciona para cadastro tendo até 2 subscrições já feitas
        if($invitationToken != null){
            $userSubscriptionGroupCount = SubscriptionGroup::where('user_subscription_token_id', $invitationToken->id)->count();
            if($userSubscriptionGroupCount == null || ($userSubscriptionGroupCount != null && $userSubscriptionGroupCount <= 2)){
                return view('auth.invitation_register', [
                    'invitation_token' => $tokenAcess
                ]);
            }
            
        }else{
            $message = 'Token de acesso '.$tokenAcess.' expirado!';
        }
        
        return view('alerts.invitation_messages',[
            'message' => $message,
        ]);
    }
    
    public function convite($tokenAcess = "")
    {
        return view('beginning.convite', ['matricula' => $tokenAcess]);
    }

}
