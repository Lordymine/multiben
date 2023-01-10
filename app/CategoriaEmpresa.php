<?php

// Correções de convenções (PSR-12)

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaEmpresa extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'categoria'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
    ];
}
