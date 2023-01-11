<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\UserSubscription;
use App\Notifications\UserResetPassword;
use App\IuguGuPaymentTrait;
use App\UserBonus;
use App\SubscriptionGroup;
use App\UserSubscriptionToken;
use App\Subscriptions;
use Auth;

class User extends Authenticatable
{
    use Notifiable;
    use IuguGuPaymentTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','rg','cpf','cnpj','endereco','cep','telefone','matricula','matricula_user_convite','time_id',
        'subscribe_me','sobrenome','data_nascimento','responsavel_empresa'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserResetPassword($token));
    }

    public function solicitacao()
    {
        return $this->hasMany('App\UserSolicitacaoBonus');
    }

    public function favorites()
    {
        return $this->hasMany(\App\Favorite::class);
    }

    public function ratings()
    {
        return $this->hasMany(\App\EmpresaRating::class);
    }

    public function assinarPlano($data)
    {
        $subscriptionDescription = $data['description'];

        $subscriptionBuilder = $this->newSubscription($subscriptionDescription, $subscriptionDescription);
        $subscriptionBuilder->payWith('bank_slip');//BOLETO BANCARIO
        $cpf_cnpj = $this->cpf == null ? $this->cnpj : $this->cpf;

        $options = [
            'name' => $this->name,
            'cpf_cnpj' => $cpf_cnpj,
            'street' => $data['street'],
            'district' => $data['district'],
            'zip_code' => $data['zip_code'],
            'number' => $data['number'],
        ];
        $assinatura = $subscriptionBuilder->create(null, $options);

        $erros = $subscriptionBuilder->getLastError();
        if ($erros != null && (isset($erros['zip_code']) || isset($erros['cpf_cnpj']))) {
            return $erros;
        }

        $url = null;

        if ($assinatura && isset($assinatura['recent_invoices'])) {
            foreach ($assinatura->recent_invoices as $fatura) {
                $url = $fatura->secure_url;
            }
        }

        $details = [
            'url' => $url,
            'plano' => $subscriptionDescription,
        ];

        $this->subscriptionMail($details);

        return $url;
    }

    public function assinarPrimeiroPlano(Request $request)
    {
        $data = $request->all();

        $options = [
            'description' => $data['description'],
            'street' => $data['street'],
            'district' => $data['district'],
            'zip_code' => $data['zip_code'],
            'number' => $data['number'],
        ];

        return $this->assinarPlano($options);
    }

    public function mudarPlano($newSubscription, $currentSubscription, $skipCharges)
    {
        $id = $this->subscriptions()->first()['iugu_id'];
        $assinatura = $this->getIuguSubscription($id);
        $expired = true;

        if ($assinatura && isset($assinatura['recent_invoices'])) {
            foreach ($assinatura->recent_invoices as $fatura) {
                //TODO VALIDAR SE VEM ORDENADO SE PUDER MAIS DE UM
//                 if($fatura->status != null && ($fatura->status == 'expired' || $fatura->status == 'pending')){
                if ($fatura->status != null && $fatura->status == 'paid') {
                    $expired = false;
                    break;
                }
            }
        }

        if ($expired) {
            $data = $this->asIuguCustomer();
            $options = [
                'description' => $newSubscription,
                'street' => $data['street'],
                'district' => $data['district'],
                'zip_code' => $data['zip_code'],
                'number' => $data['number'],
            ];

            return $this->assinarPlano($options);
        } else {
            $this->subscription($currentSubscription)->swap($newSubscription, $skipCharges);

            return $this->processarAssinatura($assinatura, $newSubscription);
        }
    }

    public function getInvoiceStatus()
    {
        $id = $this->subscriptions()->first()['iugu_id'];
        $assinatura = $this->getIuguSubscription($id);
        $fatura = null;

        if ($assinatura && isset($assinatura['recent_invoices'])) {
            foreach ($assinatura->recent_invoices as $fatura) {
                $fatura = $fatura->status;
            }
        }

        return $fatura;
    }

    public function processarAssinatura($assinatura, $subscription)
    {
        $url = $this->getUrlPayment($assinatura);
        $details = [
            'url' => $url,
            'plano' => $subscription,
        ];

        $this->subscriptionMail($details);

        return $url;
    }

    public function getUrlPayment($assinatura)
    {
        $url = null;
        if ($assinatura && isset($assinatura['recent_invoices'])) {
            foreach ($assinatura->recent_invoices as $fatura) {
                $url = $fatura->secure_url;
            }
        }
        return $url;
    }

    public static function possuiCreditoBonus()
    {
        if (Auth::user()) {
            $saldoBonus = UserBonus::where('user_id', Auth::user()->id)->first();
            if ($saldoBonus == null || $saldoBonus->valor == 0) {
                return false;
            }
        } else {
            return false;
        }

        return true;
    }

    public function subscriptionMail($details)
    {
        $this->notify(new UserSubscription($details));
    }

    public function processUrlPayment()
    {
        $subscription = $this->subscriptions()->first();
        if ($subscription != null && !empty($subscription)) {
            $id = $subscription['iugu_id'];
            if ($id != null) {
                $assinatura = $this->getIuguSubscription($id);

                return $this->getUrlPayment($assinatura);
            }
        }
        return null;
    }

    public function ativoEmAlgumPlano()
    {
        $subscription = Subscriptions::where('user_id', $this->id)->orderBy('created_at', 'DESC')->first();

        if ($subscription == null) {
            return false;
        }

        $fatura = $this->getInvoiceStatus();
        $token = UserSubscriptionToken::where('subscription_id', $subscription->id)->where('status', 'Ativo')->first();

        if ($fatura == null) {
            return false;
        } elseif ($fatura == 'paid') {
            return true;
        } else {
            return false;
        }
    }
}
