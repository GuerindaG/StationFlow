<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyStockHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'station_id',
        'produit_id',
        'date',
        'stock_finale',
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
