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
    protected $fillable = [
        'nom',
        'rccm',
        'ifu',
        'adresse',
        'contact',
        'statut',
        'gerant_id',
    ];
    // Relation avec les ventes
    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }

    public function gerant()
    {
        return $this->belongsTo(User::class, 'gerant_id');
    }
}
