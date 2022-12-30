<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Repositories\Contracts\UsersRepositoryInterface;
use App\Repositories\Contracts\EmpresasRepositoryInterface;

class CompaniesAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('companies_admin.index');
    }

    public function checkCustomersCode()
    {
        return view('companies_admin.check_customers_code');
    }


    public function searchCustomersCode(Request $request, UsersRepositoryInterface $users_repository)
    {

        $result  = $users_repository->getByCode($request);
        if($result){
            return '<span class="text-lg text-success"><strong>USUÁRIO ATIVO</strong> '.strtoupper($result->name).' '.strtoupper($result->sobrenome).'</span>';
        }else{
            return '<span class="text-lg text-danger"><strong>USUÁRIO NÃO ENCONTRADO</strong></span>';
        }
    }

    public function storeCustomersCode(Request $request, EmpresasRepositoryInterface $empresa_repository)
    {
        if ($empresa_repository->storeCustomersCode($request)) {
            return redirect()->route('companies_admin_check_customers_code')
                ->with('success', 'Código confirmado!');
        } else {
            return back()->with('error', 'Não foi possivel confirmar o código!');
        }
    }
    public function customersList(UsersRepositoryInterface $users_repository)
    {
        return view('companies_admin.customers_list',['customers' => $users_repository->customersList()]);
    }

    public function multbenUsedPayments(UsersRepositoryInterface $users_repository)
    {
        return view('companies_admin.multben_used_payments',['payments' => $users_repository->usedPayments()]);
    }
}
