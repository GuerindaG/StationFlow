<?php

namespace App\Http\Controllers;
use App\Models\Categorie;
use App\Models\Stock_journalier;
use Carbon\Carbon;
use App\Models\Vente;
use App\Models\Produit;
use App\Models\Approvisionnement;
use App\Models\Stock;
use App\Models\StockJournalier;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class RapportController extends Controller
{


    public function genererPDF()
    {
        $station = Auth::user()->station;

        if (!$station) {
            return redirect()->route('gestionnaire.no-station');
        }

        $date = Carbon::today();

        // Données nécessaires pour le rapport
        $ventes = Vente::with(['produit', 'paiement'])
            ->where('station_id', $station->id)
            ->whereDate('created_at', $date)
            ->get();

        $approvisionnements = Approvisionnement::with('produit')
            ->where('station_id', $station->id)
            ->whereDate('date_approvisionnement', $date)
            ->get();

        $stocks = Stock::with('produit')
            ->where('station_id', $station->id)
            ->get();

        $stocks_journaliers = StockJournalier::with('produit')
            ->where('station_id', $station->id)
            ->whereDate('date', $date)
            ->get();

        $categories = Categorie::with('produits')->get();

        $data = [
            'station' => $station,
            'date' => $date->format('d F Y'),
            'ventes' => $ventes,
            'approvisionnements' => $approvisionnements,
            'stocks' => $stocks,
            'stocks_journaliers' => $stocks_journaliers,
            'categories' => $categories,
        ];

        $pdf = Pdf::loadView('rapportpdf', $data)->setPaper('a4');

        return $pdf->stream("rapport_journalier_{$date->format('Y_m_d')}.pdf");
    }

}