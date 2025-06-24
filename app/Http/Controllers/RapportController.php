<?php

namespace App\Http\Controllers;
use App\Models\Categorie;
use App\Models\Station;
use App\Models\User;
use App\Notifications\RapportSoumisNotification;
use Carbon\Carbon;
use App\Models\Vente;
use App\Models\Approvisionnement;
use App\Models\Stock;
use App\Models\StockJournalier;
use File;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Storage;
use Str;
use ZipArchive;

class RapportController extends Controller
{
    //GERANT
    public function genererPDF()
    {
        $station = Auth::user()->station;

        if (!$station) {
            return redirect()->route('gestionnaire.no-station');
        }

        $date = Carbon::today();

        // Données nécessaires pour le rapport
        $ventes = Vente::with(['produit', 'paiement'])
            ->where('station_id', $station->id)
            ->whereDate('created_at', $date)
            ->get();

        $approvisionnements = Approvisionnement::with('produit')
            ->where('station_id', $station->id)
            ->whereDate('date_approvisionnement', $date)
            ->get();

        $stocks = Stock::with('produit')
            ->where('station_id', $station->id)
            ->get();

        $stocks_journaliers = StockJournalier::with('produit')
            ->where('station_id', $station->id)
            ->whereDate('date', $date)
            ->get();

        $categories = Categorie::with('produits')->get();

        $data = [
            'station' => $station,
            'date' => $date->format('d F Y'),
            'ventes' => $ventes,
            'approvisionnements' => $approvisionnements,
            'stocks' => $stocks,
            'stocks_journaliers' => $stocks_journaliers,
            'categories' => $categories,
        ];

        $pdf = Pdf::loadView('Rapports.rapportpdf', $data)->setPaper('a4');

        return $pdf->stream("rapport_journalier_{$date->format('Y_m_d')}.pdf");
    }
    public function enregistrerRapportJournalier($stationId)
    {
        $station = Station::findOrFail($stationId);
        $date = Carbon::today(); // → date du jour
        $dateFormat = $date->format('Y-m-d');

        // Données à injecter dans le PDF
        $ventes = Vente::with(['produit', 'paiement'])
            ->where('station_id', $station->id)
            ->whereDate('created_at', $date)
            ->get();

        $approvisionnements = Approvisionnement::with('produit')
            ->where('station_id', $station->id)
            ->whereDate('date_approvisionnement', $date)
            ->get();

        $stocks = Stock::with('produit')
            ->where('station_id', $station->id)
            ->get();

        $stocks_journaliers = StockJournalier::with('produit')
            ->where('station_id', $station->id)
            ->whereDate('date', $date)
            ->get();

        $categories = Categorie::with('produits')->get();

        $data = [
            'station' => $station,
            'date' => $date->format('d F Y'),
            'ventes' => $ventes,
            'approvisionnements' => $approvisionnements,
            'stocks' => $stocks,
            'stocks_journaliers' => $stocks_journaliers,
            'categories' => $categories,
        ];

        $pdf = Pdf::loadView('Rapports.rapportpdf', $data);

        $nomFichier = "{$dateFormat}.pdf";
        $chemin = "rapports/station_{$station->id}/";

        /*$admin = User::where('role', 'admin')->first();

        if ($admin) {
            $admin->notify(new RapportSoumisNotification('Rapport du ' . now()->format('d/m/Y'), $station));
        }*/

        Storage::disk('public')->put($chemin . $nomFichier, $pdf->output());

        return redirect()->route('rapports.index')->with('success', 'Rapport journalier sauvegardé et envoyé avec succès.');

    }
    public function telechargerRapportsMensuels($stationId, $mois)
    {
        $station = Station::findOrFail($stationId);
        $cheminDossier = public_path("storage/rapports/station_{$station->id}");

        // Filtrer les fichiers par mois (ex : 2025-06)
        $fichiers = collect(File::files($cheminDossier))
            ->filter(function ($file) use ($mois) {
                return str_contains($file->getFilename(), $mois);
            });

        if ($fichiers->isEmpty()) {
            return back()->with('error', 'Aucun rapport trouvé pour ce mois.');
        }

        $nomZip = "station_{$station->id}_rapports_{$mois}.zip";
        $cheminZip = public_path("storage/rapports/zips/{$nomZip}");

        // Créer dossier zip s’il n’existe pas
        File::ensureDirectoryExists(dirname($cheminZip));

        $zip = new ZipArchive;
        if ($zip->open($cheminZip, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            foreach ($fichiers as $file) {
                $zip->addFile($file->getRealPath(), $file->getFilename());
            }
            $zip->close();
        }

        return response()->download($cheminZip);
    }
    public function indexMensuel()
    {
        $station = Auth::user()->station;
        if (!$station) {
            return redirect()->route('gestionnaire.no-station');
        }

        $chemin = storage_path("app/public/rapports/station_{$station->id}");

        $moisDisponibles = [];

        if (File::exists($chemin)) {
            $fichiers = File::files($chemin);

            foreach ($fichiers as $file) {
                if (preg_match('/\d{4}-\d{2}/', $file->getFilename(), $match)) {
                    $moisDisponibles[] = $match[0];
                }
            }

            $moisDisponibles = array_unique($moisDisponibles);
            sort($moisDisponibles);
        }

        //Récupérer les années uniques
        $anneesDisponibles = collect($moisDisponibles)
            ->map(fn($mois) => substr($mois, 0, 4))
            ->unique()
            ->sort()
            ->values();

        //Appliquer le filtre si une année est sélectionnée
        if (request()->filled('annee')) {
            $moisDisponibles = array_filter($moisDisponibles, function ($mois) {
                return str_starts_with($mois, request('annee'));
            });
        }

        return view('Rapports.index', compact('station', 'moisDisponibles', 'anneesDisponibles'));

    }
    public function voirFichiersMois($mois)
    {
        $station = Auth::user()->station;
        if (!$station) {
            return redirect()->route('gestionnaire.no-station');
        }

        $chemin = storage_path("app/public/rapports/station_{$station->id}");
        $fichiers = [];

        if (File::exists($chemin)) {
            $fichiers = collect(File::files($chemin))
                ->filter(function ($file) use ($mois) {
                    return str_contains($file->getFilename(), $mois);
                })
                ->map(function ($file) use ($station) {
                    return [
                        'nom' => $file->getFilename(),
                        'lien' => asset("storage/rapports/station_{$station->id}/" . $file->getFilename()),
                    ];
                });
        }
        $dateFilter = request('date_filter');

        $fichiers = collect(File::files($chemin))
            ->filter(function ($file) use ($mois, $dateFilter) {
                $nomFichier = $file->getFilename();
                if (!str_contains($nomFichier, $mois)) {
                    return false;
                }
                if ($dateFilter) {
                    return str_contains($nomFichier, $dateFilter); // ex : 2024-06-01
                }
                return true;
            })
            ->map(function ($file) use ($station) {
                return [
                    'nom' => $file->getFilename(),
                    'lien' => asset("storage/rapports/station_{$station->id}/" . $file->getFilename()),
                ];
            });
        return view('Rapports.show', compact('station', 'mois', 'fichiers'));
    }

    //ADMIN
    public function voirRapportJournalier($station, $date)
    {
        $chemin = storage_path("app/public/rapports/station_{$station}/{$date}.pdf");

        if (!File::exists($chemin)) {
            abort(404, 'Rapport introuvable.');
        }

        return response()->file($chemin);
    }
    public function rapportsDuJour()
    {
        $date = now()->toDateString();

        $stations = Station::all();
        $rapports = [];

        foreach ($stations as $station) {
            $chemin = storage_path("app/public/rapports/station_{$station->id}/{$date}.pdf");

            if (File::exists($chemin)) {
                $rapports[] = (object) [
                    'station_id' => $station->id,
                    'station' => $station,
                    'date' => $date,
                    'fichier' => "storage/rapports/station_{$station->id}/{$date}.pdf"
                ];
            }
        }

        return view('Admin.dashboard', compact('rapports'));
    }

    public function adminRapportsParStation(Station $station)
    {
        $chemin = storage_path("app/public/rapports/station_{$station->id}");

        $moisDisponibles = [];

        if (File::exists($chemin)) {
            $fichiers = File::files($chemin);

            foreach ($fichiers as $file) {
                if (preg_match('/\d{4}-\d{2}/', $file->getFilename(), $match)) {
                    $moisDisponibles[] = $match[0];
                }
            }

            $moisDisponibles = array_unique($moisDisponibles);
            sort($moisDisponibles);
        }

        //Récupérer les années uniques
        $anneesDisponibles = collect($moisDisponibles)
            ->map(fn($mois) => substr($mois, 0, 4))
            ->unique()
            ->sort()
            ->values();

        //Appliquer le filtre si une année est sélectionnée
        if (request()->filled('annee')) {
            $moisDisponibles = array_filter($moisDisponibles, function ($mois) {
                return str_starts_with($mois, request('annee'));
            });
        }

        return view('Rapports.stationRapport', compact('station', 'moisDisponibles', 'anneesDisponibles'));
    }
   public function adminVoirFichiersMois(\App\Models\Station $station, $mois)
{
    $chemin = storage_path("app/public/rapports/station_{$station->id}");
    $fichiers = collect();

    if (File::exists($chemin)) {
        $dateFilter = request('date_filter');

        $fichiers = collect(File::files($chemin))
            ->filter(function ($file) use ($mois, $dateFilter) {
                $nomFichier = $file->getFilename();

                // Vérifie que le mois est présent
                if (!Str::contains($nomFichier, $mois)) {
                    return false;
                }

                // Si un filtre de date est présent, vérifier aussi ce critère
                if ($dateFilter) {
                    return Str::contains($nomFichier, $dateFilter);
                }

                return true;
            })
            ->map(function ($file) use ($station) {
                return [
                    'nom' => $file->getFilename(),
                    'lien' => asset("storage/rapports/station_{$station->id}/" . $file->getFilename()),
                ];
            });
    }

    return view('Rapports.stationRapportFichier', compact('station', 'mois', 'fichiers'));
}


}