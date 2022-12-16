<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convites extends Model
{
    protected $fillable = [
        'nome', 'email_convidado', 'texto_convite',
    ];
    
    protected $hidden = [
    ];
    
    public function user(){
        return $this->belongsTo('App\User');
    }
}
