<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categorie extends Model
{
    protected $fillable = [
        'nom',
        'description',
    ];
    public function produits(): HasMany
    {
        return $this->hasMany(Produit::class);
    }

    protected static function booted()
    {
        static::addGlobalScope('notArchived', function ($query) {
            $query->where('archiver', false);
        });
    }
}
