<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property string $nom
 * @property integer $categorie_id
 * @property float $prix_unitaire
 * @property string $created_at
 * @property string $updated_at
 */
class Produit extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['nom', 'viscosite','categorie_id', 'prix_achat', 'prix_vente','created_at', 'updated_at'];
    // Relation avec les ventes
    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }

    // Relation avec la catégorie
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    use SoftDeletes;

}
