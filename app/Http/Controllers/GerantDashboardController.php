<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vente;
use Carbon\Carbon;

class GerantDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $station = $user->station;

        if (!$station) {
            return redirect()->route('gestionnaire.no-station');
        }

        // Récupération des paramètres de filtre
        $filter = $request->input('filter', 'today');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Requête de base filtrée par station
        $query = Vente::where('station_id', $station->id);

        // Application des filtres temporels
        switch ($filter) {
            case 'today':
                $query->whereDate('created_at', Carbon::today());
                break;

            case 'week':
                $query->whereBetween('created_at', [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek()
                ]);
                break;

            case 'month':
                $query->whereBetween('created_at', [
                    Carbon::now()->startOfMonth(),
                    Carbon::now()->endOfMonth()
                ]);
                break;

            case 'custom':
                if ($startDate && $endDate) {
                    $query->whereBetween('created_at', [
                        Carbon::parse($startDate)->startOfDay(),
                        Carbon::parse($endDate)->endOfDay()
                    ]);
                }
                break;
        }

        // Calcul des totaux par type de paiement
        $totals = $query->selectRaw('
            SUM(CASE WHEN paiement_id = 1 THEN montant_total ELSE 0 END) as total_tv,
            SUM(CASE WHEN paiement_id = 2 THEN montant_total ELSE 0 END) as total_jnp,
            SUM(CASE WHEN paiement_id = 3 THEN montant_total ELSE 0 END) as total_comptant,
            SUM(montant_total) as total_general
        ')->first();

        // Calcul des totaux par catégorie
        $categoriesTotals = Vente::where('station_id', $station->id)
            ->join('produits', 'ventes.produit_id', '=', 'produits.id')
            ->join('categories', 'produits.categorie_id', '=', 'categories.id')
            ->selectRaw('
            categories.nom as category_name,
            SUM(ventes.montant_total) as total_amount,
            COUNT(ventes.id) as sales_count
        ')
            ->groupBy('categories.nom')
            ->get();

        // Récupération de l'année sélectionnée (par défaut: année courante)
        $selectedYear = $request->input('year', Carbon::now()->year);

        return view('Gerant.dashboard', [
            'station' => $station,
            'totalTv' => $totals->total_tv ?? 0,
            'totalJnp' => $totals->total_jnp ?? 0,
            'totalComptant' => $totals->total_comptant ?? 0,
            'totalGeneral' => $totals->total_general ?? 0,
            'filter' => $filter,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'categoriesTotals' => $categoriesTotals,
            'categoriesChartData' => $this->prepareChartData($categoriesTotals),
            'revenueChartData' => $this->prepareRevenueChartData($station, $selectedYear),
            'selectedYear' => $selectedYear
        ]);

    }
    private function prepareChartData($categoriesTotals)
    {
        $labels = [];
        $series = [];
        $colors = [];

        // Couleurs personnalisées pour chaque catégorie
        $categoryColors = [
            'Produits blancs' => '#0aad0a',
            'Gaz et accessoires' => '#ffc107',
            'Lubrifiants' => '#016bf8'
        ];

        foreach ($categoriesTotals as $category) {
            $labels[] = $category->category_name;
            $series[] = (float) $category->total_amount;
            $colors[] = $categoryColors[$category->category_name] ?? '#cccccc';
            $category->color = $categoryColors[$category->category_name] ?? '#cccccc';
        }

        return [
            'labels' => $labels,
            'series' => $series,
            'colors' => $colors
        ];
    }

    private function prepareRevenueChartData($station, $year = null)
    {
        $year = $year ?? Carbon::now()->year;

        // Récupération des ventes groupées par mois et par moyen de paiement
        $monthlyRevenueByPayment = Vente::where('station_id', $station->id)
            ->whereYear('created_at', $year)
            ->selectRaw('
            MONTH(created_at) as month,
            paiement_id,
            SUM(montant_total) as total_amount
        ')
            ->groupBy('month', 'paiement_id')
            ->orderBy('month')
            ->get();

        // Récupération des libellés des moyens de paiement (à adapter selon votre modèle)
        $paymentMethods = [
            1 => 'T.V.',
            2 => 'JNP',
            3 => 'Comptant'
        ];

        // Préparation des données pour ApexCharts
        $months = [
            'Jan',
            'Fév',
            'Mar',
            'Avr',
            'Mai',
            'Juin',
            'Juil',
            'Août',
            'Sep',
            'Oct',
            'Nov',
            'Déc'
        ];

        // Initialisation des séries pour chaque moyen de paiement
        $series = [];
        $paymentSeriesData = [];

        foreach ($paymentMethods as $id => $name) {
            $paymentSeriesData[$id] = array_fill(0, 12, 0);
        }

        // Remplissage des données
        foreach ($monthlyRevenueByPayment as $revenue) {
            if (isset($paymentSeriesData[$revenue->paiement_id])) {
                $paymentSeriesData[$revenue->paiement_id][$revenue->month - 1] = (float) $revenue->total_amount;
            }
        }

        // Préparation des séries pour le graphique
        foreach ($paymentMethods as $id => $name) {
            $series[] = [
                'name' => $name,
                'data' => $paymentSeriesData[$id]
            ];
        }

        // Couleurs pour chaque moyen de paiement
        $paymentColors = [
            1 => '#0aad0a', // T.V. - Vert
            2 => '#016bf8', // JNP - Bleu
            3 => '#ffc107'  // Comptant - Jaune
        ];

        // Calcul de l'évolution par moyen de paiement
        $evolutionByPayment = [];

        foreach ($paymentMethods as $id => $name) {
            $currentYearTotal = array_sum($paymentSeriesData[$id]);

            $previousYearTotal = Vente::where('station_id', $station->id)
                ->where('paiement_id', $id)
                ->whereYear('created_at', $year - 1)
                ->sum('montant_total');

            $evolutionPercentage = $previousYearTotal > 0
                ? round(($currentYearTotal - $previousYearTotal) / $previousYearTotal * 100, 2)
                : ($currentYearTotal > 0 ? 100 : 0);

            $evolutionByPayment[$id] = [
                'name' => $name,
                'evolution' => $evolutionPercentage,
                'currentYear' => $currentYearTotal,
                'previousYear' => $previousYearTotal,
                'color' => $paymentColors[$id] ?? '#cccccc'
            ];
        }

        return [
            'series' => $series,
            'labels' => $months,
            'evolutionByPayment' => $evolutionByPayment,
            'currentYear' => $year,
            'previousYear' => $year - 1,
            'colors' => array_values($paymentColors)
        ];
    }
}
