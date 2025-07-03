<?php

namespace App\Services;

use App\Models\Produit;

class CalculService
{
    public function calculateTotalAmount(int $productId, float $quantity): float
    {
        $product = Produit::findOrFail($productId);
        return $quantity * $product->prix_achat;
    }
}