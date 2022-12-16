<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'socios';
    protected $fillable = [
        'user_id','socio_matricula','aceito'
    ];
}
