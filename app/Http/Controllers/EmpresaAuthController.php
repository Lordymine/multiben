<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Empresa;


class EmpresaAuthController extends Controller
{
   
    public function acesso(){
        return view('admin.company_area');
    }

    public function autentica(Request $request)
    {
        $cnpj = $request->cnpj;
        $password = $request->password;
        

        $empresa = Empresa::where('cnpj', '=', $cnpj )->first();

        if(!$empresa)
        {

            return redirect()->back()->withInput()->withErrors(['Empresa não cadastrada.']);
        }
        
        $usuario = User::where('id' , '=', $empresa->user_id )->first();

        if(!$usuario)
        {
            // usuario nao encontrado
            return redirect()->back()->withInput()->withErrors(['Usuario não vinculado']);
        }
    
        if(Hash::check($password, $usuario->password))
        {
            Auth::login($usuario);
            return view('companies_admin.index', ['usuario' => $usuario, 'empresa' => $empresa]);
            
        }
        
        return redirect()->back()->withInput()->withErrors(['Senha inválida']);
        
        
    }
}
