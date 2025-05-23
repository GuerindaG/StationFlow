<?php

namespace App\Http\Controllers;
use App\Models\Categorie;
use App\Models\Produit;
use App\Models\Station;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PDFController extends Controller
{

    public function afficherPDF ()
    {
        // 1. Charger les données
        $produits = Produit::with('categorie')->get();
        $dateGeneration = now()->format('d/m/Y H:i');

        // 2. Options spécifiques pour améliorer le rendu
        $pdf = Pdf::loadView('produit-pdf', [
            'produits' => $produits,
            'dateGeneration' => $dateGeneration
        ]);

        // 3. Configuration avancée
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOption([
            'enable_css_float' => true,
            'enable_html5_parser' => true,
            'enable_remote' => true,
            'defaultFont' => 'dejavu sans',
            'dpi' => 120,
            'isPhpEnabled' => true,
            'isFontSubsettingEnabled' => true
        ]);

        // 4. Génération avec options de débogage si nécessaire
        return $pdf->stream('produit-pdf');
    }
    public function afficherSPDF()
    {
        $dateGeneration = Carbon::now()->locale('fr_FR')->isoFormat('D MMMM YYYY');
        $stationInfo = Station::all();
        return view('station-pdf', compact('dateGeneration', 'stationInfo'));
    }

    public function afficherCPDF()
    {
        $dateGeneration = Carbon::now()->locale('fr_FR')->isoFormat('D MMMM YYYY');
        $categorie = Categorie::all();
        return view('categorie-pdf', compact('dateGeneration', 'categorie'));
    }
}
