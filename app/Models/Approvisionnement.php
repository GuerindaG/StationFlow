<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Approvisionnement extends Model
{
    /**
     * @var array
     */
    use SoftDeletes;

    protected $fillable = [
        'station_id',
        'produit_id',
        'qte_appro',
        'montant_total',
        'date_approvisionnement',
    ];
    protected $casts = [
        'date_approvisionnement' => 'datetime',
    ];

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
