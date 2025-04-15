<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $nom
 * @property string $adresse
 * @property string $type
 * @property float $latitude
 * @property float $longitude
 * @property string $statut
 * @property string $dateCreation
 * @property string $created_at
 * @property string $updated_at
 */
class Station extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['nom', 'adresse', 'type', 'latitude', 'longitude', 'statut', 'dateCreation', 'created_at', 'updated_at'];
    // Relation avec les ventes
    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }
}
