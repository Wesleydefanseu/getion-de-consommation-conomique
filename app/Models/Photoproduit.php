<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photoproduit extends Model
{
    use HasFactory;
    protected $fillable = [
        'imageV',
    ];
    public function product()
    {
        return $this->hasOne('App\Models\Product','id','product_id');
    }

   
}
