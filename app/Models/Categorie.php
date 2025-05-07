<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable = [
        'nom',
        'description',
    ];

    protected static function booted()
    {
        static::addGlobalScope('notArchived', function ($query) {
            $query->where('archiver', false);
        });
    }
}
