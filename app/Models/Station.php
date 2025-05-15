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
        'longitude',
        'latitude',
        'contact',
        'statut',
        'gerant_id',
    ];
    protected $casts = [
        'archiver' => 'boolean',
    ];
    protected static function booted()
    {
        static::addGlobalScope('notArchived', function ($query) {
            $query->where('archiver', false);
        });
    }
    // Relation avec les ventes
    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }

    public function gerant()
    {
        return $this->belongsTo(User::class, 'gerant_id');
    }
    // Station.php
    public function rapports()
    {
        return $this->hasMany(Rapport::class);
    }

}
