<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\Contracts\CategoriesRepositoryInterface;
use App\Repositories\Contracts\EmpresasRepositoryInterface;

class CategoriesController extends Controller
{
    public function index(Int $id,EmpresasRepositoryInterface $empresa_repository)
    {
        return view('categories.index', ['empresas' => $empresa_repository->getCompaniesbyCategory($id)]);
    }
}
