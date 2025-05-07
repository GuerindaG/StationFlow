<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    protected $fillable = [
        'station_id',
        'vente_id',
        'approvisionnement_id',
    ];
    
    use HasFactory;

    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    public function vente()
    {
        return $this->belongsTo(Vente::class);
    }

    public function approvisionnement()
    {
        return $this->belongsTo(Approvisionnement::class);
    }
}
