<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Produit;
use App\Models\Station;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function exportPDF($type)
    {
        switch ($type) {
            case 'stations':
                $data = Station::all();
                $columns = [
                    'nom',
                    'rccm',
                    'ifu',
                    'adresse',
                    'longitude',
                    'latitude',
                    'contact',
                ];
                break;
            case 'produits':
                $data = Produit::all();
                $columns = ['nom', 'description', 'prix'];
                break;
            default:
                abort(404, 'Type non reconnu');
        }
        $date = now()->format('d/m/Y');
        $heure = now()->format('H:i:s');
        $pdf = Pdf::loadView('pdf', compact('type', 'data', 'columns', 'date', 'heure'));
        return $pdf->stream("$type.pdf");

        
    }
}
