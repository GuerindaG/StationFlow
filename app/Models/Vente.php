<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $station_id
 * @property integer $produit_id
 * @property float $quantite
 * @property float $montant_total
 * @property string $date_vente
 * @property string $created_at
 * @property string $updated_at
 */
class Vente extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['station_id', 'produit_id', 'quantite', 'montant_total', 'date_vente', 'created_at', 'updated_at'];
     // Relation avec la station
     public function station()
     {
         return $this->belongsTo(Station::class);
     }

     // Relation avec le produit
     public function produit()
     {
         return $this->belongsTo(Produit::class);
     }
}
