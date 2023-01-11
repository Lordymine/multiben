<?php

namespace App\Http\Controllers;

use App\UserBonus;
use App\UserSolicitacaoBonus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Empresa;
use App\Pagamentos;
use App\Socio;
use App\Servico;
use App\Repositories\Contracts\CompanySolicitationPaymentRepositoryInterface;
use Auth;
use Illuminate\Support\Facades\Storage;
use App\Notifications\MarketingNotification;
use Notification;
use Mail;
use App\Mail\ContactMail;
use Log;
use App\Jobs\SendMarketingEmailJob;
use App\Convites;

class AdminController extends Controller
{
    public function users()
    {
        $users = User::paginate(15);
        return view('admin.index')->with(['users' => $users, 'admin' => Auth::user()]);
    }

    public function companies()
    {
        $companies = Empresa::paginate(15);

        return view('admin.companies')->with(['companies' => $companies, 'admin' => Auth::user()]);
    }


    public function payments()
    {
        $payments = Pagamentos::all();
        return view('admin.payments_received')->with(['payments' => $payments, 'admin' => Auth::user()]);
    }

    public function bonus()
    {
        $solicitacoes = UserSolicitacaoBonus::with(['user','empresa','solicitationPayment'])->paginate(10);

        return view('admin.bonus')->with([ 'solicitacoes' => $solicitacoes, 'admin' => Auth::user()]);
    }

    public function dashboard()
    {
        // verificar de onde serão colhidos esses dados
        // $dados = dados::all();
        return view('admin.dashboard')->with([ /* 'dados' => $dados,*/ 'admin' => Auth::user()]);
    }

    public function services()
    {
        // verificar de onde serão colhido esses dados
        $servicos = Servico::all();
        return view('admin.services')->with([  'servicos' => $servicos, 'admin' => Auth::user()]);
    }

    public function partner()
    {
        $socios = Socio::all();
        return view('admin.business_partner')->with([ 'socios' => $socios, 'admin' => Auth::user()]);
    }

    public function financial()
    {
        // verificar de onde serão colhidos esses dados
        // $dados = dados::all();
        return view('admin.financial')->with([ /* 'dados' => $dados,*/ 'admin' => Auth::user()]);
    }

    public function referrals()
    {
        $dados = Convites::paginate(10);
        return view('admin.referrals')->with([ 'dados' => $dados, 'admin' => Auth::user()]);
    }

    public function marketing()
    {
        // verificar de onde serão colhidos esses dados
        // $dados = dados::all();
        return view('admin.marketing')->with([ /* 'dados' => $dados,*/ 'admin' => Auth::user()]);
    }


    //  ADMINISTRAÇÃO DE USUÁRIOS

    public function listUsers()
    {
        // aqui o administrador lista os usuario
    }

    public function createUser()
    {
        // aqui retorna a tela onde o administrador cria o usuario
    }

    public function storeUser(Request $request)
    {
        // aqui o usuario novo é armazenado no banco
         $user = new User([
            'name' => $request->get('first_name'),
            'sobrenome' => $request->get('last_name'),
            'email' => $request->get('email'),
            'telefone' => $request->get('telefone'),
            'rg' => $request->get('rg'),
            'cpf' => $request->get('cpf'),
            'password' => Hash::make($request->get('password'))
         ]);
        $user->save();
        return redirect(route('admin'))->with('success', 'Novo usuario cadastrado sucesso!');
    }


    public function showUser(User $user)
    {
        // aqui o administrador exive um usuario
    }

    public function editUser(User $user)
    {
        // aqui retorna a tela para o administrador editar um usuario
    }

    public function updateUser(Request $request, User $user)
    {
        // aqui a edição do usuario é armazenada no banco
        $register = User::find($user->id);
        $register->name = $request->get('name');
        $register->sobrenome = $request->get('sobrenome');
        ;
        $register->email = $request->get('email');
        ;
        $register->rg = $request->get('rg');
        ;
        $register->cpf = $request->get('cpf');
        ;
        $register->telefone = $request->get('telefone');
        ;
        if (!$request->get('password')) {
             $register->password = Hash::make($request->get('password'));
        }

        $register->save();
        return redirect(route('admin'))->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroyUser(User $user)
    {
        // aqui o administrador deleta um usuario
        $contact = Contact::find($user->id);
        $contact->delete();

        return redirect(route('admin'))->with('success', 'Usuário deletado com sucesso!');
    }
    public function companyArea()
    {
        return view('admin.company_area');
    }

    public function sendMarketingMail(Request $request)
    {
        $nameFile = null;
        $sendTo = [];

        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $name = uniqid(date('HisYmd') . Auth::user()->matricula);

            $extension = $request->logo->extension();

            $nameFile = "{$name}.{$extension}";


            $upload = $request->logo->move('storage/images', $nameFile, 'public');
        }

        $data = [
            'titulo' => $request->get('titulo'),
            'corpo' => $request->get('corpo'),
            'filename' => $nameFile,
            'users' => User::get(),
            'enviar_para' => $request->get('enviar_para'),
        ];

        SendMarketingEmailJob::dispatch($data);

        return redirect(route('admin.marketing.index'))->with('success', 'Emails enviados com sucesso!');
    }
}
