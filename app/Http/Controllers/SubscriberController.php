<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\UsersRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Subscriptions;

class SubscriberController extends Controller
{
    public function become()
    {
        $plano = null;
        $message = "";
        
        if(Auth::check())
        {
            $user = Auth::user();
            $subscription = Subscriptions::where('user_id',$user->id)->orderBy('created_at','DESC')->first();
            
            if($subscription != null){
                if ($user->hasIuguId()) {
                    $fatura = $user->getInvoiceStatus();

                    if($fatura == null){
                        //TODO
                    }else if($fatura == 'pending'){
                        $plano = $subscription->iugu_plan;
                        $message = 'Você possuiu uma fatura pendente conosco.';
                    }else if($fatura == 'paid'){
                        $plano = $subscription->iugu_plan;
                        $message = 'Este é seu plano atual';
                    }else if($fatura == 'expired'){
                        
                    }
                }
            }            
        }
        return view('subscriber.become', ['activePlan' => $plano, 'message' => $message]);
    }
	public function personalData()
    {
		if(Auth::check())
        {
            return view('subscriber.personal_data');
        }
		return view('auth.login', ['aviso' => 'Para assinar é necessário ter efetuado o login, se você não tem uma conta crie agora mesmo.']);
	}
	public function addressData()
    {
		if(Auth::check())
        {
            return view('subscriber.address_data');
        }
        return view('auth.login', ['aviso' => 'Para assinar é necessário ter efetuado o login, se você não tem uma conta crie agora mesmo.']);
	}
	public function payment()
    {
		if(Auth::check())
        {
            return view('subscriber.payment');
        }
        return view('auth.login', ['aviso' => 'Para assinar é necessário ter efetuado o login, se você não tem uma conta crie agora mesmo.']);
	}
	
	public function review()
	{
	    if(Auth::check())
	    {
	        return view('subscriber.review');
	    }
	    return view('auth.login', ['aviso' => 'Para assinar é necessário ter efetuado o login, se você não tem uma conta crie agora mesmo.']);
	}
	
	public function reviewBecome($price, $description)
    {
		if(Auth::check())
        {
            $user = auth::user();
            $subcription = $this->validateSubscription($user);
            
            if($subcription != null){
                $url = $user->mudarPlano($description, $subcription, true);
                
                return view('subscriber.checkout_complete', ['iugu_url' => $url]);
            }
            
            return view('subscriber.review', ['price' => $price, 'description' => $description, 'user' => $user, 'error' => null]);
        }
        return view('auth.login', ['aviso' => 'Para assinar é necessário ter efetuado o login, se você não tem uma conta crie agora mesmo.']);
	}
	
	public function subscribe(Request $request, PlanoController $plano_controller, UsersRepositoryInterface $user_repository) {
	    if(Auth::check()){
    	    $user = auth::user();
    	    $url = $user->assinarPrimeiroPlano($request);
	        $data = $request->all();

    	    if($url != null){
    	        if($url != null && (isset($url['zip_code']) || isset($url['cpf_cnpj']))){
    	            $message = 'Não foi possível completar a solicitação ';
    	            if(isset($url['zip_code'])){
    	                $message = 'CEP informado não é válido !';
    	            }
    	            if(isset($url['cpf_cnpj'])){
    	                $message = $message.'CPF/CNPJ informado não é válido !';
    	            }
        	        return view('subscriber.review', ['error' =>  $message, 
        	            'description' => $data['description'], 'user' => $user, 'price' => $data['price']]);
    	        }else{
        	        $plano_controller->planoSolicitation($user_repository);
        	        return view('subscriber.checkout_complete', ['iugu_url' => $url]);
    	        }
    	    }else{
    	        return view('subscriber.review', ['error' => 'Não foi possível completar a solicitação. Dados informados não são válidos !', 
    	            'description' => $data['description'], 'user' => $user, 'price' => $data['price']]);
    	        
    	    }
	    }
        return view('auth.login', ['aviso' => 'Para assinar é necessário ter efetuado o login, se você não tem uma conta crie agora mesmo.']);
	}
	
	public function validateSubscription($user){
	    if ($user->subscribed('IND') || $user->subscribed('FAM') || $user->subscribed('PRO')) {
    	    if($user->subscribed('IND')){
    	        return 'IND';
    	    }else if($user->subscribed('FAM')){
    	        return 'FAM';
    	    }else if($user->subscribed('FAM')){
    	        return 'PRO';
    	    }
	    }
	}
	
	public function downloadInvoice($invoice){
	    return Auth::user()->downloadInvoice($invoice, [
	        'vendor'  => 'Sua Empresa',
	        'product' => 'Seu Produto',
	        'header' => 'Seu Produto',
	    ]);
	}
}
