<?php

namespace App\Services;

use App\Models\Stock;
use Illuminate\Support\Facades\DB;

class StockService
{
    public function updateStock(int $stationId, int $productId, float $quantity): void
    {
        Stock::updateOrCreate(
            ['station_id' => $stationId, 'produit_id' => $productId],
            ['qte_actuelle' => DB::raw('qte_actuelle + ' . $quantity)]
        );
    }

    public function reduceStock(int $stationId, int $productId, float $quantity): void
    {
        Stock::where('station_id', $stationId)
            ->where('produit_id', $productId)
            ->update(['qte_actuelle' => DB::raw('GREATEST(qte_actuelle - ' . $quantity . ', 0)')]);
    }
}