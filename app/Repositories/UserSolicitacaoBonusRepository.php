<?php


namespace App\Repositories;

use App\Repositories\Contracts\UserSolicitacaoBonusRepositoryInterface;
use App\UserSolicitacaoBonus;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserSolicitacaoBonusRepository implements UserSolicitacaoBonusRepositoryInterface
{

    public function getByUser(){
        return UserSolicitacaoBonus::where('user_id', Auth::user()->id)->paginate(10);
    }
    public function getAllByUser(){
        $empresas = DB::table('user_solicitacao_bonus')
        ->join('empresas', 'user_solicitacao_bonus.empresa_id', '=', 'empresas.id')
        ->select('empresas.*', 'user_solicitacao_bonus.*')
        ->where('user_solicitacao_bonus.user_id', Auth::user()->id)
        ->paginate(10);
        
        return $empresas;
    }
    public function getByUserCompany($idEmpresa){
        return UserSolicitacaoBonus::where('empresa_id', $idEmpresa)->paginate(10);
    }
}
