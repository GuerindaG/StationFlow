<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Produit;
use App\Models\Station;
use Barryvdh\DomPDF\Facade\Pdf;


class PDFController extends Controller
{
    public function afficherPDF()
    {
        $produits = Produit::with('categorie')->get();

        $pdf = Pdf::loadView('Rapports.produit-pdf', compact('produits')); 
        return $pdf->stream('liste_produits.pdf'); 
    }

    public function afficherSPDF()
    {
        $stationInfo = Station::all();

        $pdf = Pdf::loadView('Rapports.station-pdf', compact('stationInfo')); 
 
        return $pdf->stream('liste_stations.pdf');
    }

    public function afficherCPDF()
    {
        $categories = Categorie::all();

        $pdf = Pdf::loadView('Rapports.categorie-pdf', compact('categories')); 

        return $pdf->stream('liste_categories.pdf');
    }
}
