<?php
namespace App\Repositories;

use App\Repositories\Contracts\UserSolicitacaoPlanoRepositoryInterface;
use Auth;
use App\UserSolicitacaoPlano;

class UserSolicitacaoPlanoRepository implements UserSolicitacaoPlanoRepositoryInterface
{

    public function getByUser(){
        return UserSolicitacaoPlano::where('user_id', Auth::user()->id)->get();
    }
}
