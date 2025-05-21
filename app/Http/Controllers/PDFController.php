<?php

namespace App\Http\Controllers;
use App\Models\Categorie;
use App\Models\Produit;
use App\Models\Station;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PDFController extends Controller
{

    public function afficherPDF()
    {
        $produits = Produit::all(); // par exemple
        $dateGeneration = Carbon::now()->locale('fr_FR')->isoFormat('D MMMM YYYY');
        $stationInfo = Station::all();
        return view('produit-pdf', compact('produits', 'dateGeneration', 'stationInfo'));


    }
}
