<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Tranfert;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        'usertype',
        'localisation',
        'categorie',
        'telephone',
        'solde',
        'creator_id',
    ];
   

    public function tranfert()
    {
        return $this->hasMany('App\Models\Tranfert','auteur_id','id');
    }
    public function products()
    {
        return $this->hasMany('App\Models\Product','seller_id','id');
    }

    public function forfait()
    {
        return $this->hasOne('App\Models\Forfait','seller_id','id');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function economies()
    {
        return $this->hasMany('App\Models\Economie','user_id','id');
    }
    public function commandes()
    {
        return $this->hasMany('App\Models\Commande','user_id','id');
    }
    public function tranferts()
    {
        return $this->hasMany('App\Models\Tranfert','auteur_id','id');
    }
    public function categorieProduits()
    {
        return $this->hasMany('App\Models\categorieProduit','seller_id','id');
    }
    public function childs()
    {
        return $this->hasMany('App\Models\User','creator_id','id');
    }
}
