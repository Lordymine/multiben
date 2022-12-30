<?php
namespace App\Repositories;

use App\Models\Address;
use App\Notifications\UserInvitePlataform;
use App\Repositories\Contracts\UsersRepositoryInterface;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Notification;

class UsersRepository implements UsersRepositoryInterface
{
    public function update($request)
    {
        /* All methods that need to update are gonna be using the code below */
        $data = $request->all();
        unset($data[1]);
        unset($data["_token"]);
        unset($data['/'.\Request::path()]);
        /* End of the necessary code */

        unset($data['password_confirmation']);

        $data['telefone'] = preg_replace('/[^0-9]/', '', $data['telefone']);
        $data['telefone'] = ($data['telefone'] !== '')?$data['telefone']:null;
        $data['cpf'] = preg_replace('/[^0-9]/', '', $data['cpf']);
        $data['cpf'] = ($data['cpf'] !== '')?$data['cpf']:null;
        $data['rg'] = preg_replace('/[^0-9]/', '', $data['rg']);
        $data['rg'] = ($data['cpf'] !== '')?$data['rg']:null;
        $data['subscribe_me'] = (isset($data['subscribe_me']))?true:false;

//         if(!is_null($data['password'])){
//             $validatedData = $request->validate([
//                 'password' => 'string|min:6|max:255|confirmed',
//                 //'body' => 'required',
//             ]);
//             $data['password'] = Hash::make($request->password);
//         } else {
//             $data['password'] = Auth::user()->password;
//         }

        $user = User::where('id', Auth::user()->id)->update($data);

        return $user;
    }


    public function StoreReferrals($request)
    {
        $data = $request->all();
        $dados = [];
        $user = auth()->user();

        $dados['user_id'] = $user->id;
        $dados['email_convidado'] = $data['email_convidado'];
        $dados['nome'] = $user->name;
        $dados['texto_convite'] = $user->email;
        $dados['created_at'] = date('Y-m-d');

        unset($data["name"]);
        unset($data["_token"]);
        unset($data["subscribe_me"]);

        $email = [];
        $email['from'] = $user->email;
        $email['matricula'] = $user->matricula;
        $email['convidado'] = $data['email_convidado'];
        $email['nome'] = $user->name;
        $email['sobrenome'] = $user->sobrenome;

        Notification::route('mail', $data['email_convidado'])->notify(new UserInvitePlataform($email));

        DB::table('convites')->insert($dados);

        return true;

    }

    public function Referrals()
    {
        $convidados = User::where('matricula_user_convite', Auth::user()->matricula)->get();

        return $convidados;
    }

    public function Payments()
    {
        $pagamentos =  DB::table('pagamentos')
                        ->join('status_pagamentos','status_pagamentos.id', '=', 'pagamentos.status_pagamentos_id')
                        ->where('pagamentos.user_id', Auth::user()->id)
                        ->select('pagamentos.*', 'status_pagamentos.nome', 'status_pagamentos.descricao')
                        ->get();

        return $pagamentos;
    }

    public function storeAvatar($request)
    {
        $data = $request->all();

        $request->validate([
            'avatar' => 'mimes:jpg,png,jpeg,gif|max:2048'
        ]);

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {

            $name = uniqid(date('HisYmd').Auth::user()->matricula);

            $extension = $request->avatar->extension();

            $nameFile = "{$name}.{$extension}";

            Storage::delete('storage/avatars/'.Auth::user()->avatar);
            $upload = $request->avatar->move('storage/avatars', $nameFile, 'public');

            if($user = User::where('id', Auth::user()->id)->update(['avatar' => $nameFile])){
                return true;
            }

            return false;
        }

        return true;
    }

    public function getByCode($request)
    {
        $data = $request->all();

        $user = User::where('matricula', $data['codigo'])->get();
        if(isset($user[0])){
            return $user[0];
        }else{
            return false;
        }


    }

    public function customersList()
    {
        $customersList = DB::table('transferred_money')
            ->where('usou_desconto','=','N')
            ->get();

        return $customersList;
    }

    public function usedPayments()
    {
        $customersList = DB::table('transferred_money')
            ->where('usou_desconto','=','S')
            ->get();

        return $customersList;
    }

    public static function mask($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; ++$i) {
            if ($mask[$i] == '#') {
                if (isset($val[$k])) {
                    $maskared .= $val[$k++];
                }
            } else {
                if (isset($mask[$i])) {
                    $maskared .= $mask[$i];
                }
            }
        }

        return $maskared;
    }

    public function getByMatricula($matricula)
    {
        $user = User::where('matricula', $matricula)->get();
        if(isset($user[0])){
            return $user[0];
        }else{
            return null;
        }


    }

    public function getUserFavorites()
    {
//         if(Auth::guest()){
//             return [];
//         }

        $user = Auth::user()->load('favorites');

        return $user->toArray();

    }

    public function updateLegalUser($cnpj, $id, $request): bool {
        $data = $request->all();

        $user = User::query()->where('id', $id)->first();
        if($user != null) {
            $user->cnpj = $cnpj;
            $user->email = $data['email'];
            $user->name = $data['razao_social'];

            $data['telefone'] = preg_replace('/[^0-9]/', '', $data['telefone']);
            $data['telefone'] = ($data['telefone'] !== '') ? $data['telefone'] : null;
            $user->telefone = $data['telefone'];

            $user->responsavel_empresa = $data['responsavel'];
            $user->update();

            return true;
        }

        return false;
    }

}
