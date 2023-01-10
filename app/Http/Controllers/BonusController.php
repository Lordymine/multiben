<?php

namespace App\Http\Controllers;

use App\Repositories\UserBonusRepository;
use App\Repositories\Contracts\UsersRepositoryInterface;
use App\Empresa;
use App\User;
use App\UserSolicitacaoBonus;
use App\UserSolicitacaoPlano;
use App\Http\Requests\BonusValidationRequest;
use Auth;
use App\UserBonus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Keygen\Keygen;
use App\Notifications\UserVoucher;
use App\Notifications\CompanyVoucher;
use App\Notifications\UserFinishVoucher;
use Session;
use Notification;

// Correções de convenções (PSR-12)

class BonusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function bonusSolicitationCompany(BonusValidationRequest $request, UserBonusRepository $repository)
    {
        $solicitacao = $this->createBonusSolicitation($request, $repository);

        return response()->json('Utilização do bônus feita com sucesso!');
    }

    public function createBonusSolicitation(BonusValidationRequest $request, UserBonusRepository $repository)
    {
        $data = $request->all();
        $empresaCnpj = Empresa::where('cnpj', $data['empresa_cnpj'])->first();
        $value = $this->tofloat($data['valor']);

        $userId = Auth::user()->id;

        //faz solicitacao
        $solicitacao = new UserSolicitacaoBonus();
        $solicitacao->status = "Pendente";
        $solicitacao->user_id = $userId;
        $solicitacao->empresa_id = $empresaCnpj->id;
        $solicitacao->valor = $value;

        $saved = $solicitacao->save();
        if ($saved) {
            $this->subtractValue($userId, $value);
            //envia email para empresa sobre a solicitação criada
        }

        return $solicitacao;
    }

    //valida se valor condiz com o permitido - se sim, realiza uma solicitação de bonus
    public function bonusSolicitation(BonusValidationRequest $request, UserBonusRepository $repository)
    {
        $solicitacao = $this->createBonusSolicitation($request, $repository);

        return view('users.checkout_complete');
    }

    public function subtractValue($user_id, $value)
    {

        $userBonus = UserBonus::where('user_id', $user_id)
                                ->where('status', 'Ativo')->first();
        $oldValue = $this->tofloat($userBonus->valor);
        $userBonus->valor = $oldValue - $value;

        $userBonus->save();
    }

    public function tofloat($num)
    {
        $dotPos = strrpos($num, '.');
        $commaPos = strrpos($num, ',');
        $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos :
        ((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);

        if (!$sep) {
            return floatval(preg_replace("/[^0-9]/", "", $num));
        }

        return floatval(
            preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
            preg_replace("/[^0-9]/", "", substr($num, $sep + 1, strlen($num)))
        );
    }

    public function bonusConfirmation($param)
    {
        $voucher = Keygen::numeric(20)->generate();
    }

    public function gerarVoucher(Request $request)
    {
        $id =  preg_replace('/[^0-9]/', '', decrypt($request->all()['data']));

        $solicitacao = UserSolicitacaoBonus::find(intval($id));
        $solicitacoes = UserSolicitacaoBonus::with(['user','empresa'])->paginate(5);

        if ($solicitacao != null && $solicitacao->voucher != null) {
            Session::flash('error', 'Já existe Voucher Gerado para essa solicitação: ' . $solicitacao->voucher);

            return redirect()->route('admin.bonus.index')
            ->with([ 'solicitacoes' => $solicitacoes, 'admin' => Auth::user()]);
        }

        $voucher = Keygen::token(30)->generate();

        $solicitacao->voucher = $voucher;
        $solicitacao->status = "Aprovado";
        $solicitacao->save();

        $this->sendVoucherMail($solicitacao, $voucher);
        $this->sendVoucherCompanyMail($solicitacao, $voucher);


        Session::flash('success', 'Voucher Gerado: ' . $voucher);
        return redirect()->route('admin.bonus.index')->with([ 'solicitacoes' => $solicitacoes, 'admin' => Auth::user()]);
    }

    public function concluirVoucher(Request $request)
    {
        $solicId = preg_replace('/[^0-9]/', '', decrypt($request->all()['data']));

        $solicitacao = UserSolicitacaoBonus::find(intval($solicId));
        $solicitacao->status = "Finalizado";
        $solicitacao->save();

        $this->sendConcluirVoucherMail($solicitacao, $solicitacao->voucher);

        $solicitacoes = UserSolicitacaoBonus::with(['user','empresa'])->paginate(5);

        Session::flash('success', 'Voucher Finalizado: ' . $solicitacao->voucher);
        return redirect()->route('user_bonus')->with([ 'solicitacoes' => $solicitacoes ]);
    }

    public function sendConcluirVoucherMail(UserSolicitacaoBonus $solicitacao, $voucher)
    {
        $user = User::find($solicitacao->user_id);

        $fields = [
            'voucher' => $voucher
        ];

        Notification::send($user, new UserFinishVoucher($fields));
    }

    /*
     * Envio de email para o usuário após confirmação do bônus e voucher gerado
     * TODO Adicionar envio de email para empresa caso necessario seja - tem que alterar a tabela e add o campo
     */
    public function sendVoucherMail(UserSolicitacaoBonus $solicitacao, $voucher)
    {
        $user = User::find($solicitacao->user_id);

        $fields = [
            'voucher' => $voucher
        ];

        Notification::send($user, new UserVoucher($fields));
    }

    public function sendVoucherCompanyMail(UserSolicitacaoBonus $solicitacao, $voucher)
    {
        $empresa = Empresa::find($solicitacao->empresa_id);
        $user = User::find($empresa->user_id);

        $fields = [
            'voucher' => $voucher
        ];

        Notification::send($user, new CompanyVoucher($fields));
    }

    public function findSolicitationDetail($solicitacaoId)
    {
        $solicId = preg_replace('/[^0-9]/', '', decrypt($solicitacaoId));
        $solicitacao = UserSolicitacaoBonus::where('id', $solicId)->first();

        return view('users.bonus_solicitation_detail', compact('solicitacao'));
    }
}
