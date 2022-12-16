<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanySolicitationPayment extends Model
{

    protected $table = 'company_solicitation_payment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'filename',
        'empresa_id',
        'solicitacao_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'empresa_id','solicitacao_id'
    ];
    
    public function solicitacoes()
    {
        return $this->belongsTo('App\UserSolicitacaoBonus','solicitacao_id');
    }
}
