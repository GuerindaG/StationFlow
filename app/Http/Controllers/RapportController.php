<?php

namespace App\Http\Controllers;

use App\Models\Approvisionnement;
use App\Models\Produit;
use App\Models\Rapport;
use App\Models\Vente;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    public function genererRapport(Request $request)
    {
        $date = $request->input('date'); // ou Carbon::today()
        $station = $request->input('station');

        $rapport = Rapport::create([
            'date' => $date,
            'station' => $station,
        ]);

        // Récupérer les données de la journée
        $stocks = Approvisionnement::whereDate('created_at', $date)->get();
        $ventes = Vente::whereDate('created_at', $date)->get();
        $lubrifiants = Produit::whereDate('created_at', $date)->get();

        return view('Gerant.addRapport', compact('rapport', 'stocks', 'ventes', 'produits'));
    }

}
