<?php
namespace App\Http\Controllers;

use App\User;
use App\UserSolicitacaoPlano;
use App\Repositories\UsersRepository;
use App\Repositories\Contracts\UsersRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class PlanoController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
        return view('subscriber.become');
    }
    
    /**
     * Após processo do IUGU para geração do boleto, executa este passo
     * TODO Ainda pendente de validação de como será concluido este item em relação ao dados do plano
     * @param $request
     * @param UsersRepository $userRepository
     */
    public function planoSolicitation(UsersRepositoryInterface $user_repository) {
        $user = Auth::user();
        $userConvite = $user_repository->getByMatricula($user->matricula_user_convite);
        
        $solicitacao = new UserSolicitacaoPlano();
        $solicitacao->status = "Pendente";
        $solicitacao->user_id = $user->id;
        if($userConvite != null){
            $solicitacao->matricula_direta = $userConvite->matricula;
            $solicitacao->matricula_indireta = $userConvite->matricula_user_convite;
        }
        //Adicionar dados do plano
        
        $solicitacao->save();
        
        return $solicitacao;
    }
    
}

