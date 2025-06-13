<?php

namespace App\Http\Controllers;

use App\Models\Approvisionnement;
use App\Models\Categorie;
use App\Models\Paiement;
use App\Models\Produit;
use App\Models\Station; 
use App\Models\Vente;   
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf; 

class RapportJournalierController extends Controller
{
    /**
     * Affiche le formulaire de sélection de la date pour le rapport.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('reports.daily_selection');
    }

    /**
     * Génère le rapport journalier pour une station et une date données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function generate(Request $request)
    {
        // Récupérer la station de l'utilisateur authentifié
        $station = Auth::user()->station;

        if (!$station) {
            return redirect()->route('gestionnaire.no-station')->with('error', 'Aucune station n\'est associée à votre compte.');
        }

        // Valider la date
        $request->validate([
            'date' => 'required|date_format:Y-m-d',
        ]);

        $reportDate = Carbon::parse($request->input('date'));

        // --- SECTION 1: État des stocks ---
        $stockData = [];
        $categories = Categorie::all();
        $produits = Produit::all(); // Récupérer tous les produits pour s'assurer que même ceux sans mouvements apparaissent

        foreach ($categories as $categorie) {
            foreach ($produits->where('categorie_id', $categorie->id) as $produit) {
                // Calcul du Stock Initial (SI) : Stock restant de la veille
                // C'est la partie la plus complexe sans table de stock dédiée.
                // Pour une solution robuste, vous auriez une table 'stocks'
                // qui enregistre le stock final de chaque jour (ou le stock actuel).
                // Ici, nous allons simuler le SI en calculant le cumul des approvisionnements
                // moins le cumul des ventes jusqu'à la veille du rapport.
                $si = 0;
                $previousDay = $reportDate->copy()->subDay();

                $totalApproBeforeDay = Approvisionnement::where('station_id', $station->id)
                    ->where('produit_id', $produit->id)
                    ->whereDate('date_approvisionnement', '<=', $previousDay)
                    ->sum('qte_appro');

                $totalSalesBeforeDay = Vente::where('station_id', $station->id)
                    ->where('produit_id', $produit->id)
                    ->whereDate('date_vente', '<=', $previousDay)
                    ->sum('qte_vendue');

                // Si le produit n'a jamais été approvisionné ou vendu, SI est 0
                $si = max(0, $totalApproBeforeDay - $totalSalesBeforeDay);

                // Réceptions du jour
                $receptionsDuJour = Approvisionnement::where('station_id', $station->id)
                    ->where('produit_id', $produit->id)
                    ->whereDate('date_approvisionnement', $reportDate)
                    ->sum('qte_appro');

                // Sorties (Ventes) du jour
                $sortiesDuJour = Vente::where('station_id', $station->id)
                    ->where('produit_id', $produit->id)
                    ->whereDate('date_vente', $reportDate)
                    ->sum('qte_vendue');

                // Calcul du Stock Final (SF) et Stock Restant (SR)
                $sf = $si + $receptionsDuJour;
                $sr = max(0, $sf - $sortiesDuJour); // Le stock restant ne peut pas être négatif

                $stockData[] = [
                    'categorie_id' => $categorie->id, // Pour regrouper par catégorie dans la vue
                    'categorie_nom' => $categorie->nom,
                    'produit_nom' => $produit->nom,
                    'si' => $si,
                    'receptions' => $receptionsDuJour,
                    'sf' => $sf,
                    'sorties' => $sortiesDuJour,
                    'sr' => $sr,
                ];
            }
        }

        // Regrouper les données de stock par catégorie pour l'affichage
        $groupedStockData = collect($stockData)->groupBy('categorie_nom');


        // --- SECTION 2: Ventes par mode de paiement ---
        $salesByPaymentAndProduct = [];
        $totalSalesByPayment = []; // Pour les sous-totaux par mode de paiement

        $paiements = Paiement::all();
        $ventesJournalieres = Vente::where('station_id', $station->id)
            ->whereDate('date_vente', $reportDate)
            ->with(['produit', 'paiement'])
            ->get();

        foreach ($paiements as $paiement) {
            $currentPaymentSales = $ventesJournalieres->where('paiement_id', $paiement->id);
            $salesByPaymentAndProduct[$paiement->nom] = [];
            $subTotalPayment = 0;

            foreach ($produits as $produit) {
                $montant = $currentPaymentSales->where('produit_id', $produit->id)->sum('montant_total');
                if ($montant > 0) { // N'afficher que les produits qui ont eu des ventes pour ce mode de paiement
                    $salesByPaymentAndProduct[$paiement->nom][] = [
                        'produit_nom' => $produit->nom,
                        'montant' => $montant,
                    ];
                    $subTotalPayment += $montant;
                }
            }
            $totalSalesByPayment[$paiement->nom] = $subTotalPayment;
        }


        // --- SECTION 3: Ventes par produit ---
        $salesByProductAndPayment = [];
        $totalGeneralSales = 0;
        $totalSalesByProduct = [];

        foreach ($produits as $produit) {
            $salesByProductAndPayment[$produit->nom] = [
                'produit_nom' => $produit->nom,
                'total_product_sales' => 0,
            ];
            foreach ($paiements as $paiement) {
                $montant = $ventesJournalieres->where('produit_id', $produit->id)
                                             ->where('paiement_id', $paiement->id)
                                             ->sum('montant_total');
                $salesByProductAndPayment[$produit->nom][str_replace(' ', '_', $paiement->nom)] = $montant; // Remplace les espaces pour les clés
                $salesByProductAndPayment[$produit->nom]['total_product_sales'] += $montant;
            }
            $totalGeneralSales += $salesByProductAndPayment[$produit->nom]['total_product_sales'];
            $totalSalesByProduct[$produit->nom] = $salesByProductAndPayment[$produit->nom]['total_product_sales'];
        }


        // --- SECTION 4: Résumé Financier ---
        $cashPaiement = Paiement::where('nom', 'Comptant')->first();
        $totalSalesToBank = $cashPaiement ? $ventesJournalieres->where('paiement_id', $cashPaiement->id)->sum('montant_total') : 0;

        // La valeur du "Ticket de vente (TV)" est un exemple, ajustez-la si elle est dynamique
        $ticketDeVente = 1000;
        $resteAVerser = $totalSalesToBank - $ticketDeVente;

        // --- Générer le PDF ---
        $data = [
            'station' => $station,
            'reportDate' => $reportDate,
            'groupedStockData' => $groupedStockData,
            'salesByPaymentAndProduct' => $salesByPaymentAndProduct,
            'totalSalesByPayment' => $totalSalesByPayment,
            'salesByProductAndPayment' => $salesByProductAndPayment,
            'totalGeneralSales' => $totalGeneralSales,
            'totalSalesToBank' => $totalSalesToBank,
            'ticketDeVente' => $ticketDeVente,
            'resteAVerser' => $resteAVerser,
            'paiement_names' => $paiements->pluck('nom')->toArray(), // Pour les en-têtes dynamiques
        ];

        // Charger la vue Blade avec les données et générer le PDF
        $pdf = Pdf::loadView('reports.rapport_journalier', $data);

        // Optionnel: Définir le nom du fichier PDF
        $fileName = 'rapport_journalier_' . $station->nom . '_' . $reportDate->format('Y-m-d') . '.pdf';

        // Retourner le PDF pour téléchargement
        return $pdf->download($fileName);
    }
}
