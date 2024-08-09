<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tranfert extends Model
{
    use HasFactory;
    protected $fillable = [
        'montant',
        'type',
        'auteur_id',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User','id','auteur_id');
    }
}
