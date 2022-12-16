<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpresaRating extends Model
{
    protected $table = 'empresa_rating';
    
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
    
    public function company()
    {
        return $this->belongsTo(\App\Empresa::class);
    }
}
