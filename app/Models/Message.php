<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'message',
        'statut',
    ];

    public function recepteur()
    {
        return $this->hasOne('App\Models\User','id','id_recepteur');
    }
    public function chat()
    {
        return $this->hasOne('App\Models\Chat','id','id_chat');
    }
    public function emeteur()
    {
        return $this->hasOne('App\Models\User','id','id_emeteur');
    }
    
}
