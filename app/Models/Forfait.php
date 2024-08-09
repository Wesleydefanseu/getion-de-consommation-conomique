<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forfait extends Model
{
    use HasFactory;
    protected $fillable = [
        'dette',
        'type',
        'statut',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User','id','seller_id');
    }
}
