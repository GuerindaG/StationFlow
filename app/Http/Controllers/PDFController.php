<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Produit;
use App\Models\Station;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View; // N'oubliez pas d'importer la façade View

class PDFController extends Controller
{
    /**
     * Configure les options communes pour DomPDF et inclut le pied de page.
     * @param \Barryvdh\DomPDF\PDF $pdf
     * @return void
     */
    private function setCommonPdfOptions($pdf)
    {
        // Charger le contenu du pied de page depuis la vue partielle et le rendre en HTML
        $footerHtml = View::make('piedPage')->render();

        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'enable_css_float' => true,
            'enable_html5_parser' => true,
            'enable_remote' => true,
            'defaultFont' => 'dejavu sans', // Assurez-vous que cette police est configurée ou installée pour DomPDF
            'dpi' => 120,
            'isPhpEnabled' => true,
            'isFontSubsettingEnabled' => true,
            'footer-html' => $footerHtml, // C'est ici que le pied de page est injecté
            'margin-bottom' => 20, // Assurez-vous d'avoir suffisamment de marge en bas pour le pied de page
        ]);
    }

    /**
     * Génère et télécharge la liste des produits en PDF.
     * @return \Illuminate\Http\Response
     */
    public function afficherPDF()
    {
        $produits = Produit::with('categorie')->get();

        $pdf = Pdf::loadView('produit-pdf', compact('produits')); // La vue principale ne contient plus le footer

        $this->setCommonPdfOptions($pdf); // Applique les options communes et le pied de page

        return $pdf->download('liste_produits.pdf'); // Force le téléchargement du PDF
    }

    /**
     * Génère et télécharge la liste des stations en PDF.
     * @return \Illuminate\Http\Response
     */
    public function afficherSPDF()
    {
        $stationInfo = Station::all();

        $pdf = Pdf::loadView('station-pdf', compact('stationInfo')); // La vue principale ne contient plus le footer

        $this->setCommonPdfOptions($pdf); // Applique les options communes et le pied de page

        return $pdf->download('liste_stations.pdf');
    }

    /**
     * Génère et télécharge la liste des catégories en PDF.
     * @return \Illuminate\Http\Response
     */
    public function afficherCPDF()
    {
        $categories = Categorie::all();

        $pdf = Pdf::loadView('categorie-pdf', compact('categories')); // La vue principale ne contient plus le footer

        $this->setCommonPdfOptions($pdf); // Applique les options communes et le pied de page

        return $pdf->download('liste_categories.pdf');
    }
}
