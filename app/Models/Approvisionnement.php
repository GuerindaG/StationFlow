<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $station_id
 * @property integer $produit_id
 * @property float $qte_appro
 * @property float $prix_unitaire
 * @property float $montant_total
 * @property string $date_approvisionnement
 * @property string $created_at
 * @property string $updated_at
 */
class Approvisionnement extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['station_id', 'produit_id', 'qte_appro', 'prix_unitaire', 'montant_total', 'date_approvisionnement', 'created_at', 'updated_at'];

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
