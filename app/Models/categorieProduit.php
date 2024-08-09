<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categorieProduit extends Model
{
    use HasFactory;
    protected $fillable = [

        'nom',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User','id','seller_id');
    }
    
    public function products()
    {
        return $this->hasMany('App\Models\Product','categorieprod_id','id');
    }
}
