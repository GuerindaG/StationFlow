<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

     protected $fillable = [
        'station_id',
        'produit_id',
        'qte_actuelle',
    ];

    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
