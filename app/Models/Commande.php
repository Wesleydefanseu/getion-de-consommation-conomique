<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->hasOne('App\Models\User','id','user_id');
    }
    public function economies()
    {
        return $this->hasMany('App\Models\Economie','commande_id','id');
    }
}
