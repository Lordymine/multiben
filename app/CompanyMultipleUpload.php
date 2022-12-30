<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyMultipleUpload extends Model
{
    protected $table = 'company_multiple_upload';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'filename','main'
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'empresa_id'
    ];
}
