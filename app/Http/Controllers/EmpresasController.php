<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\EmpresasRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class EmpresasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }   
}
