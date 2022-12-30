<?php
namespace app\Http\Controllers;

use Potelo\GuPayment\Http\Controllers\WebhookController;
use Potelo\GuPayment\SubscriptionBuilder;
use Potelo\GuPayment\Subscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\UserSolicitacaoPlano;
use App\Http\Controllers\BonusController;
use App\Repositories\Contracts\UsersRepositoryInterface;
use App\UserBonus;
use App\User;
use App\UserSubscriptionToken;
use Notification;
use App\Notifications\UserSubscriptionConfirmation;
use App\Notifications\DiretoSubscriptionConfirmation;

class IuguWebHookController extends WebhookController
{
    protected $iuguSubscriptionModelColumn;
    
    public function __construct()
    {
        $this->iuguSubscriptionModelColumn = getenv('IUGU_SUBSCRIPTION_MODEL_ID_COLUMN') ?: config('services.iugu.subscription_model_id_column', 'iugu_id');
    }
    
    public function cancelSubscription(Request $request)
    {
        $payload = $request->all();
        
        $subscription = Subscription::where($this->iuguSubscriptionModelColumn, $payload['data']['subscription_id'])->first();
        
        if($subscription != null){
            $subscription->fill(['ends_at' => Carbon::now()])->save();
            return new Response( 'Subscription canceled', 200);
        }
        return new Response( 'Something is wrong', 500);
    }
    
    public function changeSubscriptionStatus(Request $request, BonusController $bonus_controller, UsersRepositoryInterface $user_repository)
    {
        $payload = $request->all();
        $status = $payload['data']['status'];
        $planoSolicitation = null;
        $token_acesso = null;
        
        if($status != null && $status == 'paid'){
            $subscription = Subscription::where($this->iuguSubscriptionModelColumn, $payload['data']['subscription_id'])->first();
            
            if($subscription != null){
                $user = User::where('id', $subscription->user_id)->first();

                if($subscription->iugu_plan != null && ($subscription->iugu_plan == 'FAM' || $subscription->iugu_plan == 'PRO')){
                    $userSubscriptionToken = new UserSubscriptionToken();
                    $created = $userSubscriptionToken->create($subscription->id);
                    $token_acesso = $created->token_acesso;
                }
                $userId = $subscription['user_id'];
                $planoSolicitation = UserSolicitacaoPlano::where('user_id', $userId)->where('status', 'Pendente')->first();
              
                if($planoSolicitation != null && !empty($planoSolicitation)){
                    $planoSolicitation->status = "Pagamento Aprovado";
                    $planoSolicitation->save();
                    $this->bonusCreation($user,$planoSolicitation, $user_repository);
                }
                
                $details = [
                    'token_acesso' => $token_acesso,
                    'plano' => $subscription->iugu_plan,
                ];
                
                //enviar email para usuario principal com link
                Notification::send($user, new UserSubscriptionConfirmation($details));
            }
        }
        
        return new Response( 'Subscription Status Updated', 200);
    }
    
    /*
     * Cria o bônus direto e indireto
     */
    public function bonusCreation($user, $planoSolicitation, $user_repository) {
        $matDireta = $planoSolicitation->matricula_direta;
        $matIndireta = $planoSolicitation->matricula_indireta;
        
        if($matDireta != null){
            $this->createBonusCredit($user_repository, $this->toFloat("3,00"), $matDireta);
            
            //envia email para usuario da mat. direta dele
            Notification::send(User::where('matricula', $matDireta)->first(), new DiretoSubscriptionConfirmation(['convidado' => $user->name.' '.$user->sobrenome]));
        }
        if($matIndireta != null){
            $this->createBonusCredit($user_repository, $this->toFloat("1,00"), $matIndireta);
        }
    }
    
    /**
     * Calcula o valor do bonus tanto para direto quanto para segundo nivel (superior)
     * @param $user_repository
     * @param $valor
     * @param $matricula
     */
    public function createBonusCredit($user_repository, $valor, $matricula)
    {
        //verifica se ja existe bonus para usuario desta matricula direta
        $user = $user_repository->getByMatricula($matricula);
        $userBonus = UserBonus::where('user_id', $user->id)->first();
        
        if($userBonus != null && !empty($userBonus)){
            $userBonus->valor = $this->toFloat($userBonus->valor) + $valor;
        }else{
            $userBonus = new UserBonus();
            $userBonus->valor = $valor;
            $userBonus->status = "Ativo";
            $userBonus->tipo = 1;// fixo - Não sei se será realmente usado
            $userBonus->user_id = $user->id;
        }
        $userBonus->save();
    }
    
    public function tofloat($num) {
        $dotPos = strrpos($num, '.');
        $commaPos = strrpos($num, ',');
        $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos :
        ((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);
        
        if (!$sep) {
            return floatval(preg_replace("/[^0-9]/", "", $num));
        }
        
        return floatval(
            preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
            preg_replace("/[^0-9]/", "", substr($num, $sep+1, strlen($num)))
            );
    }
}

