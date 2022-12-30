<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Eloquent;

class  UserSolicitacaoBonus extends Eloquent
{
    protected $table = "user_solicitacao_bonus";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'voucher','status', 'user_id','empresa_id','valor'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id','empresa_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function empresa(){
        return $this->belongsTo('App\Empresa');
    }

    public function solicitationPayment(){
        return $this->hasOne('App\CompanySolicitationPayment','solicitacao_id');
    }
}
