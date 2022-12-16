<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UserSubscriptionToken;

class SubscriptionGroup extends Model
{

    protected $table = "subscription_group";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'member_user_id',
        'user_subscription_token_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'member_user_id',
        'user_subscription_token_id'
    ];

    public function memberUser()
    {
        return $this->belongsTo('App\User');
    }
    
    public function userSubscriptionToken()
    {
        return $this->belongsTo('App\UserSubscriptionToken','user_subscription_token_id');
    }
    
    public function create(array $data){
        if(isset($data['invitation_token']) && $data['invitation_token'] != null){
            $userSubscriptionToken = UserSubscriptionToken::where('token_acesso', $data['invitation_token'])->where('status', 'Ativo')->first();
            
            if($userSubscriptionToken != null){
                $member = new SubscriptionGroup();
                $member->status = 'Ativo';
                $member->user_subscription_token_id = $userSubscriptionToken->id;
                $member->member_user_id = $data['user_id'];
                $member->save();
                
                //Inativa o token de recebr mais subscriptions no grupo
                $userSubscriptionGroupCount = SubscriptionGroup::where('user_subscription_token_id', $userSubscriptionToken->id)->count();
                if($userSubscriptionGroupCount == 3)
                {
                    $userSubscriptionToken->status = 'Inativo';
                    $userSubscriptionToken->save();
                }
            }
        }
    }
}
