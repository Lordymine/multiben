<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    public function state(){
        return $this->belongsTo('App\Estado');
    }
}
