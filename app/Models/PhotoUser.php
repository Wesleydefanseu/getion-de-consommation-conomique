<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'imageV',
    ];
    public function user()
    {
        return $this->hasOne('App\Models\User','id','seller_id');
    }
}
