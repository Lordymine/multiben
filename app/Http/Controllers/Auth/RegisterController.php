<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\SubscriptionGroup;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/users/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $data['cpf'] = str_replace("-","",str_replace(".", "", $data['cpf']));
        $data['cnpj'] = str_replace("-","",str_replace("/","",str_replace(".","", $data['cnpj'])));
        
        if($data['cnpj'] == null && $data['cpf'] != null){
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'cpf' => ['required', 'string', 'min:11', 'unique:users'],
            ]);
        }else{
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'cnpj' => ['required', 'min:14', 'unique:users'],
                'responsavel' => ['required', 'string', 'max:255']
            ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        $matricula = mt_rand(10000000,99999999);
        $vericador_matricula = User::where('matricula', $matricula)->count();

        while ($vericador_matricula >= 1) {
            $matricula = mt_rand(10000000,99999999);
            $vericador_matricula = User::where('matricula', $matricula)->count();
        }

        if (isset($data['matricula_user_convite']) && $data['matricula_user_convite']!="") {
            $matricula_user_convite = $data['matricula_user_convite'];
        } else {
            $matricula_user_convite = null;
        }
        

        $telefone =  str_replace("(", "", $data['telefone'] );
        $telefone =  str_replace(")", "", $telefone );
        $telefone =  str_replace("-", "", $telefone );
        $telefone =  str_replace(" ", "", $telefone );

        if($data['cnpj'] == null){
            $user = User::create([
                'name' => $data['name'],
                'sobrenome'=> $data['sobrenome'],
                'email' => $data['email'],
                'telefone' => $telefone,
                'password' => Hash::make($data['password']),
                'matricula' => $matricula,
                'matricula_user_convite' => $matricula_user_convite,
                'cpf' => str_replace("-","",str_replace(".", "", $data['cpf'])),
            ]);
            
            //validação de usuário se cadastrando por plano FAM ou PRO (convite)
            $data['user_id'] = $user->id;
            $member = new SubscriptionGroup();
            $member->create($data);
            
            return $user;
        }else{
            return(User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'telefone' => $telefone,
                'password' => Hash::make($data['password']),
                'matricula' => $matricula,
                'cnpj' => str_replace("-","",str_replace("/","",str_replace(".","", $data['cnpj']))),
                'responsavel_empresa'=>  $data['responsavel']
            ]));
        }
    }
}
