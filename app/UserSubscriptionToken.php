<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Keygen\Keygen;

class UserSubscriptionToken extends Model
{
    protected $table = "user_subscription_token";
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'token_acesso',
        'subscription_id',
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'subscription_id'
    ];
    
    public function memberUser()
    {
        return $this->hasMany('App\SubscriptionGroup', 'user_subscription_token_id');
    }
    
    public function subscription()
    {
        return $this->belongsTo('App\Subscriptions');
    }
    
    
    public function create($subscription_id){
        $this->token_acesso = Keygen::token(30)->generate();
        $this->status = 'Ativo';
        $this->subscription_id = $subscription_id;
        
        $this->save();
        
        return $this;
    }
}
