<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Paiement;
use App\Models\Produit;
use App\Models\Vente;
use App\Models\Approvisionnement;
use App\Models\Stock;
use App\Models\Station;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RapportController extends Controller
{
    public function showDailyReport(Request $request)
    {
        $user = Auth::user();
        $station = $user->station;

        if (!$station) {
            abort(403, 'Vous n\'êtes pas associé à une station.');
        }

        // Date du rapport (par défaut aujourd'hui)
        $reportDate = $request->has('date')
            ? Carbon::parse($request->date)
            : Carbon::today();

        // Récupération des données
        $categories = Categorie::with([
            'produits' => function ($query) use ($station) {
                $query->where('station_id', $station->id);
            }
        ])->get();

        $stocks = $this->calculateStocks($station->id, $reportDate);
        $ventesParMode = $this->getVentesParModePaiement($station->id, $reportDate);
        $ventesParProduit = $this->getVentesParProduit($station->id, $reportDate);
        $resumeFinancier = $this->calculateResumeFinancier($ventesParMode);

        return view('rapports.daily', [
            'station' => $station,
            'date' => $reportDate->format('d/m/Y'),
            'categories' => $categories,
            'stocks' => $stocks,
            'modesPaiement' => Paiement::all(),
            'ventesParMode' => $ventesParMode,
            'ventesParProduit' => $ventesParProduit,
            'resumeFinancier' => $resumeFinancier,
            'generated_at' => Carbon::now()->format('d/m/Y à H:i')
        ]);
    }

    private function calculateStocks($stationId, $date)
    {
        $stocks = [];
        $produits = Produit::where('station_id', $stationId)->get();

        foreach ($produits as $produit) {
            // Stock initial = quantité restante du jour précédent
            $stockInitial = $this->getStockFinal($stationId, $produit->id, $date->copy()->subDay());

            // Réceptions du jour
            $receptions = Approvisionnement::where('station_id', $stationId)
                ->where('produit_id', $produit->id)
                ->whereDate('date_approvisionnement', $date)
                ->sum('quantite');

            // Sorties du jour
            $sorties = Vente::where('station_id', $stationId)
                ->where('produit_id', $produit->id)
                ->whereDate('created_at', $date)
                ->sum('quantite');

            // Calculs
            $stockFinal = $stockInitial + $receptions;
            $stockRestant = $stockFinal - $sorties;

            $stocks[] = [
                'produit_id' => $produit->id,
                'nom' => $produit->nom,
                'categorie' => $produit->categorie->nom,
                'stock_initial' => $stockInitial,
                'receptions' => $receptions,
                'stock_final' => $stockFinal,
                'sorties' => $sorties,
                'stock_restant' => $stockRestant,
            ];
        }

        return $stocks;
    }

    private function getStockFinal($stationId, $produitId, $date)
    {
        // 1. Stock initial de référence (si disponible)
        $stockReference = Vente::where('station_id', $stationId)
            ->where('produit_id', $produitId)
            ->value('quantite_initiale') ?? 0;

        // 2. Réceptions jusqu'à cette date (inclusive)
        $receptions = Approvisionnement::where('station_id', $stationId)
            ->where('produit_id', $produitId)
            ->whereDate('date_approvisionnement', '<=', $date)
            ->sum('quantite');

        // 3. Sorties jusqu'à cette date (inclusive)
        $sorties = Vente::where('station_id', $stationId)
            ->where('produit_id', $produitId)
            ->whereDate('created_at', '<=', $date)
            ->sum('quantite');

        // Stock final = stock initial + réceptions - sorties
        return $stockReference + $receptions - $sorties;
    }

    private function getVentesParModePaiement($stationId, $date)
    {
        $ventes = [];
        $modesPaiement = Paiement::all();
        $produits = Produit::where('station_id', $stationId)->get();

        foreach ($modesPaiement as $mode) {
            $ventesParMode = [
                'mode' => $mode->nom,
                'produits' => [],
                'total' => 0
            ];

            foreach ($produits as $produit) {
                $montant = Vente::where('station_id', $stationId)
                    ->where('produit_id', $produit->id)
                    ->where('paiement_id', $mode->id)
                    ->whereDate('created_at', $date)
                    ->sum('montant_total');

                $ventesParMode['produits'][] = [
                    'produit' => $produit->nom,
                    'montant' => $montant
                ];

                $ventesParMode['total'] += $montant;
            }

            $ventes[] = $ventesParMode;
        }

        return $ventes;
    }

    private function getVentesParProduit($stationId, $date)
    {
        $ventes = [];
        $produits = Produit::with('categorie')->where('station_id', $stationId)->get();
        $modesPaiement = Paiement::all();

        foreach ($produits as $produit) {
            $ventesParProduit = [
                'produit' => $produit->nom,
                'categorie' => $produit->categorie->nom,
                'modes' => [],
                'total' => 0
            ];

            foreach ($modesPaiement as $mode) {
                $montant = Vente::where('station_id', $stationId)
                    ->where('produit_id', $produit->id)
                    ->where('paiement_id', $mode->id)
                    ->whereDate('created_at', $date)
                    ->sum('montant_total');

                $ventesParProduit['modes'][$mode->nom] = $montant;
                $ventesParProduit['total'] += $montant;
            }

            $ventes[] = $ventesParProduit;
        }

        return $ventes;
    }

    private function calculateResumeFinancier($ventesParMode)
    {
        $totalComptant = 0;
        $ticketVente = 1000; // Montant fixe pour le ticket de vente

        foreach ($ventesParMode as $venteMode) {
            if ($venteMode['mode'] === 'COMPTANT') {
                $totalComptant = $venteMode['total'];
                break;
            }
        }

        return [
            'total_a_verser' => $totalComptant,
            'ticket_vente' => $ticketVente,
            'reste_a_verser' => $totalComptant - $ticketVente
        ];
    }
}