<?php

namespace App\Http\Controllers;

use App\Models\Rapport;
use App\Models\Vente;
use App\Models\Approvisionnement;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RapportController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $station = $user->station;

        if (!$station) {
            return redirect()->route('gestionnaire.no-station');
        }

        // Filtres
        $year = $request->input('year', Carbon::now()->year);
        $month = $request->input('month');

        // Requête de base
        $query = Rapport::with(['vente', 'approvisionnement'])
            ->where('station_id', $station->id);

        // Filtrage par année/mois
        if ($year) {
            $query->whereYear('created_at', $year);
        }

        if ($month) {
            $query->whereMonth('created_at', $month);
        }

        // Groupement par mois pour l'affichage initial
        $groupedReports = $query->get()
            ->groupBy(function ($item) {
                return Carbon::parse($item->created_at)->format('F Y');
            })
            ->sortByDesc(function ($group, $key) {
                return Carbon::parse($key);
            });

        return view('Rapport.index', [
            'groupedReports' => $groupedReports,
            'selectedYear' => $year,
            'selectedMonth' => $month
        ]);
    }

    public function byMonth(Request $request, $monthYear)
    {
        $user = Auth::user();
        $station = $user->station;

        $date = Carbon::createFromFormat('F Y', $monthYear);

        $rapports = Rapport::with(['vente', 'approvisionnement'])
            ->where('station_id', $station->id)
            ->whereYear('created_at', $date->year)
            ->whereMonth('created_at', $date->month)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Rapport.month', [
            'rapports' => $rapports,
            'monthYear' => $monthYear
        ]);
    }

    public function show(Rapport $rapport)
    {
        $this->authorize('view', $rapport);

        $rapport->load(['vente', 'approvisionnement', 'station']);

        return view('Rapport.show', compact('rapport'));
    }

    public function generateDailyReport()
    {
        $user = Auth::user();
        $station = $user->station;

        // Logique de génération du rapport journalier
        $ventes = Vente::where('station_id', $station->id)
            ->whereDate('created_at', Carbon::today())
            ->get();

        $approvisionnements = Approvisionnement::where('station_id', $station->id)
            ->whereDate('created_at', Carbon::today())
            ->get();

        $rapport = Rapport::create([
            'station_id' => $station->id,
            'date' => Carbon::today(),
            'type' => 'quotidien'
        ]);

        // Associer les ventes et approvisionnements au rapport
        $rapport->vente()->saveMany($ventes);
        $rapport->approvisionnement()->saveMany($approvisionnements);

        return redirect()->route('rapports.show', $rapport)
            ->with('success', 'Rapport journalier généré avec succès');
    }
}