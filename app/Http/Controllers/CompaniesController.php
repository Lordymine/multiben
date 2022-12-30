<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Repositories\Contracts\EmpresasRepositoryInterface;
use App\Repositories\Contracts\CategoriesRepositoryInterface;
use App\Repositories\Contracts\LocalityRepositoryInterface;
use App\CompanyMultipleUpload;
use App\Favorite;
use Auth;
use App\EmpresaRating;
use App\Empresa;

class CompaniesController extends Controller
{

    public function index(Int $id,EmpresasRepositoryInterface $empresa_repository,CategoriesRepositoryInterface $categories_repository)
    { 
        $category = $categories_repository->getCategoryById($id);
        return view('companies.index', [
            'empresas' => $empresa_repository->getCompaniesbyCategoryRatings($id),
            'categories' => $categories_repository->getCategories(),
            'cidades' => $categories_repository->getCidadesByCategory($id),
            'category' => $category == null ? "" : $category->nome
        ]);
    }
    
    public function companyInfoAll(EmpresasRepositoryInterface $empresa_repository,CategoriesRepositoryInterface $categories_repository, LocalityRepositoryInterface $locality_repository)
    {
        return view('companies.index', [
            'empresas' => $empresa_repository->getCompaniesPaginatedRatings(),
            'categories' => $categories_repository->getCategories(),
            'cidades' => $locality_repository->getAllCyties(),
            'category' => 'Todas'
        ]);
    }

    public function companyInfo($id,EmpresasRepositoryInterface $empresa_repository)
    {
        $idUpld = preg_replace('/[^0-9]/', '', decrypt($id));
        $favorite = false;
        
        $empresa = Empresa::where('id', $idUpld)->first();
        
        $empresaRating = $empresa->getEmpresaRatings();
        $ratingScore = $empresa->calculateRatingScore();
        $stars = $empresa->calculateStarRatingScore($ratingScore);
        $halfStars = $empresa->calculateHalfStarRatingScore($ratingScore);
        $video = $empresa->video;
        $videoEmbed = null;
        
        if (($pos = strpos($video, "=")) !== FALSE) {
            $videoEmbed = substr($video, $pos+1);
            if (($pos = strpos($video, "&")) !== FALSE) {
                $videoEmbed = substr($videoEmbed, 0, strpos($videoEmbed, "&"));
            }
        }
        
        if(Auth::user() != null){
            $userId = Auth::user()->id;
            $favorite = Favorite::where('empresa_id', $idUpld)->where('user_id', $userId)->first();
        }
        
        return view('companies.company_info',[
            'uploads' => CompanyMultipleUpload::where('empresa_id', $idUpld)->orderBy('main','DESC')->get(),
            'empresa' => $empresa_repository->getCompany($id),
            'categorias' => $empresa_repository->getListCategories($id),
            'favorite' => $favorite != null ? true : false,
            'halfStars' => $halfStars,
            'stars' => $stars,
            'ratingScore' => $ratingScore ,
            'ratingReviews' => $empresaRating != null ? $empresaRating->count() : 0,
            'videoEmbed' => $videoEmbed
        ]);
    }

    public function companyByCity(Request $request,EmpresasRepositoryInterface $empresa_repository)
    {
        return view('companies.by-filter', [
            'empresas' => $empresa_repository->getCompaniesbyCity($request)
        ]);
    }

    public function companyByDeduction(Request $request,EmpresasRepositoryInterface $empresa_repository)
    {
        return view('companies.by-filter', [
            'empresas' => $empresa_repository->companyByDeduction($request)
        ]);
    }
    
    public function indexPartner(EmpresasRepositoryInterface $empresa_repository,CategoriesRepositoryInterface $categories_repository)
    {
        return view('companies.index_conveniados', [
            'empresas' => $empresa_repository->getAllCompaniesConveniadasRatings(),
        ]);
    }
    
    public function calculateRatingScore($empresaRating){
        $score = 0 ;
        $rating = 0;
        
        if($empresaRating != null && !$empresaRating->isEmpty()){
            foreach ($empresaRating as $er){
                $score = $score + $er->rating;
            }
            $rating = $score / $empresaRating->count() ;
        }
        
        return $rating;
    }
    
}
