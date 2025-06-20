<?php

namespace App\Http\Controllers;

use App\Models\StockJournalier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockJournalierController extends Controller
{
    public function index(Request $request)
    {
        $query = StockJournalier::with(['produit', 'station']);

        if ($request->filled('date')) {
            $query->where('date', $request->date);
        }

        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $station = Auth::user()->station;

        if (!$station) {
            return response()->json(['message' => 'Aucune station associée à l’utilisateur.'], 403);
        }

        $data = $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'date' => 'required|date',
            'stock_finale' => 'required|numeric|min:0',
        ]);

        $stock = StockJournalier::updateOrCreate(
            [
                'station_id' => $station->id,
                'produit_id' => $data['produit_id'],
                'date' => $data['date'],
            ],
            ['stock_finale' => $data['stock_finale']]
        );

        return response()->json([
            'message' => 'Stock journalier enregistré avec succès.',
            'data' => $stock,
        ]);
    }

}
