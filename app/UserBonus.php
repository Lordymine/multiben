<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class  UserBonus extends Model
{
    protected $table = "user_bonus";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'valor','status','tipo', 'user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id'
    ];

}
