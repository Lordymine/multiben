<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id','empresa_id',
    ];
    
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
    
    public function company()
    {
        return $this->belongsTo(\App\Empresa::class);
    }
}
