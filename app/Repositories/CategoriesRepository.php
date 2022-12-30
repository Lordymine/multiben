<?php
namespace App\Repositories;

use App\Repositories\Contracts\CategoriesRepositoryInterface;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Categories;

use Auth;

class CategoriesRepository implements CategoriesRepositoryInterface
{

    public function getCategories()
    {
        $categories = Categories::all();
        return $categories;
    }

    public function getCidadesByCategory($id)
    {
        $cidades = DB::table('cidades')
            ->join('empresas', 'empresas.cidade', '=', 'cidades.id')
            ->join('empresa_category', 'empresa_category.empresas_id', '=', 'empresas.id')
            ->select('cidades.*')
            ->where('empresa_category.categories_id','=',$id)
            ->get();

        return $cidades;
    }

    public static function getCategoriesQtdEmpresas($id)
    {
        $qtd = DB::table('empresa_category')->where('categories_id','=',$id)->count();
        return $qtd;
    }

    public function searchCategories($request)
    {
        $categories = DB::table('categories')->where('nome','like','%'.strtoupper($request->texto).'%')->get();
        return $categories;
    }
    
    public function getCategoryById($id)
    {
        $categories = DB::table('categories')->where('id','=',$id)->first();
        return $categories;
    }

}
