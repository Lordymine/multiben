<?php


namespace App\Repositories;

use App\Repositories\Contracts\UserBonusRepositoryInterface;

use App\UserBonus;
use Illuminate\Support\Facades\Auth;

class UserBonusRepository implements UserBonusRepositoryInterface
{

    public function getByUser(){
        return UserBonus::where('user_id', Auth::user()->id)->first();
    }
}
