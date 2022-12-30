<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Eloquent;

class  UserSolicitacaoPlano extends Eloquent
{
    protected $table = "user_solicitacao_plano";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'matricula_direta','status', 'user_id','matricula_indireta'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

}
