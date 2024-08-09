<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande_Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'quantite',
        'prixunit',
    
    ];
    public function commande()
    {
        return $this->hasOne('App\Models\Commande','id','commande_id');
    } 
    public function product()
    {
        return $this->hasOne('App\Models\Product','id','product_id');
    }

}
