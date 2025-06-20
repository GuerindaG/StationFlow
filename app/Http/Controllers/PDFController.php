<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Produit;
use App\Models\Station;
use Barryvdh\DomPDF\Facade\Pdf;


class PDFController extends Controller
{
    /**
     * Configure les options communes pour DomPDF et inclut le pied de page.
     * @param \Barryvdh\DomPDF\PDF $pdf
     * @return void
     */

    /**
     * Génère et télécharge la liste des produits en PDF.
     * @return \Illuminate\Http\Response
     */
    public function afficherPDF()
    {
        $produits = Produit::with('categorie')->get();

        $pdf = Pdf::loadView('produit-pdf', compact('produits')); 
        $this->setCommonPdfOptions($pdf);
        return $pdf->download('liste_produits.pdf'); 
    }

    public function afficherSPDF()
    {
        $stationInfo = Station::all();

        $pdf = Pdf::loadView('station-pdf', compact('stationInfo')); 

        $this->setCommonPdfOptions($pdf); 

        return $pdf->download('liste_stations.pdf');
    }

    public function afficherCPDF()
    {
        $categories = Categorie::all();

        $pdf = Pdf::loadView('categorie-pdf', compact('categories')); 

        $this->setCommonPdfOptions($pdf); 

        return $pdf->download('liste_categories.pdf');
    }
}
