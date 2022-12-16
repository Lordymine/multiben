<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriptions extends Model
{
    protected $table = "subscriptions";
    
    
    protected $fillable = [
        'name','iugu_plan', 'trial_end_at','ends_at','created_at'
    ];
    
    
    protected $hidden = [
        'user_id','iugu_id'
    ];
    
    public function userSubscriptionToken()
    {
        return $this->hasMany('App\UserSubscriptionToken', 'subscription_id');
    }
    
}
