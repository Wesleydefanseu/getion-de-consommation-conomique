<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;



    protected $fillable = [
        'nom',
        'description',
        'photo',
        'prix',
        'quantite',
        'taux',
        'nomcat',
        'categorieprod_id',

    ];


    public function user()
    {
        return $this->hasOne('App\Models\User','id','seller_id');
    }
    public function categorieProduit()
    {
        return $this->hasOne('App\Models\categorieProduit','id','categorieprod_id');
    }
    public function photoproduits()
    {
        return $this->hasMany('App\Models\Photoproduit');
    }
}
