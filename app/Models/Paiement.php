<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paiement extends Model
{
    protected $fillable = [
        'nom',
        'description',
    ];
    use SoftDeletes;
    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }
}
