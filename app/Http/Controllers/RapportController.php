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
use Mail;
use Storage;
use Str;
use ZipArchive;

class RapportController extends Controller
{
    private function preparerDonneesRapport($station)
    {
        $date = Carbon::today();

        return [
            'station' => $station,
            'date' => $date->format('d F Y'),
            'ventes' => Vente::with(['produit', 'paiement'])
                ->where('station_id', $station->id)
                ->whereDate('created_at', $date)
                ->get(),
            'approvisionnements' => Approvisionnement::with('produit')
                ->where('station_id', $station->id)
                ->whereDate('date_approvisionnement', $date)
                ->get(),
            'stocks' => Stock::with('produit')
                ->where('station_id', $station->id)
                ->get(),
            'stocks_journaliers' => StockJournalier::with('produit')
                ->where('station_id', $station->id)
                ->whereDate('date', $date)
                ->get(),
            'categories' => Categorie::with('produits')->get(),
            'date_objet' => $date // on le garde aussi au format Carbon si besoin plus tard
        ];
    }
    private function getFichiersRapports($stationId, $mois = null, $dateFilter = null)
    {
        $chemin = storage_path("app/public/rapports/station_{$stationId}");

        if (!File::exists($chemin)) {
            return collect();
        }

        return collect(File::files($chemin))
            ->filter(function ($file) use ($mois, $dateFilter) {
                $filename = $file->getFilename();
                if ($mois && !Str::contains($filename, $mois))
                    return false;
                if ($dateFilter && !Str::contains($filename, $dateFilter))
                    return false;
                return true;
            })
            ->map(function ($file) use ($stationId) {
                return [
                    'nom' => $file->getFilename(),
                    'lien' => asset("storage/rapports/station_{$stationId}/" . $file->getFilename()),
                ];
            });
    }
    private function extraireMoisDisponibles($stationId)
    {
        $chemin = storage_path("app/public/rapports/station_{$stationId}");

        if (!File::exists($chemin)) {
            return collect();
        }

        $mois = [];

        foreach (File::files($chemin) as $file) {
            if (preg_match('/\d{4}-\d{2}/', $file->getFilename(), $match)) {
                $mois[] = $match[0];
            }
        }

        return collect(array_unique($mois))->sort()->values();
    }
    private function extraireAnneesDisponibles($moisDisponibles)
    {
        return collect($moisDisponibles)
            ->map(fn($mois) => substr($mois, 0, 4))
            ->unique()
            ->sort()
            ->values();
    }
    private function afficherFichiersMoisView($station, $mois, $view)
    {
        $fichiers = $this->getFichiersRapports($station->id, $mois, request('date_filter'));
        return view($view, compact('station', 'mois', 'fichiers'));
    }

    //GERANT
    public function genererPDF()
    {
        $station = Auth::user()->station;

        if (!$station) {
            return redirect()->route('gestionnaire.no-station');
        }

        $data = $this->preparerDonneesRapport($station);

        $pdf = Pdf::loadView('Rapports.rapportpdf', $data)->setPaper('a4');

        return $pdf->stream("rapport_journalier_{$data['date_objet']->format('Y_m_d')}.pdf");
    }

    public function enregistrerRapportJournalier($stationId)
    {
        $station = Station::findOrFail($stationId);
        $data = $this->preparerDonneesRapport($station);

        $pdf = Pdf::loadView('Rapports.rapportpdf', $data);

        $dateFormat = $data['date_objet']->format('Y-m-d');
        $nomFichier = "{$dateFormat}.pdf";
        $chemin = "rapports/station_{$station->id}/";

        Storage::disk('public')->put($chemin . $nomFichier, $pdf->output());

        $admin = User::where('role', 'admin')->first();

        $admin->notify(new RapportSoumisNotification("Rapport du " . now()->format('d/m/Y'), $station));

        return redirect()->route('rapports.index')->with('success', 'Rapport journalier sauvegardé et envoyé avec succès.');
    }

    public function testEmail()
    {
        Mail::raw('Ceci est un test.', function ($message) {
            $message->to('gohoueguerinda@example.com')
                ->subject('Test Email');
        });

        return 'Email envoyé !';
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

        $moisDisponibles = $this->extraireMoisDisponibles($station->id);
        $anneesDisponibles = $this->extraireAnneesDisponibles($moisDisponibles);

        return view('Rapports.index', compact('station', 'moisDisponibles', 'anneesDisponibles'));

    }
    public function voirFichiersMois($mois)
    {
        $station = Auth::user()->station;
        if (!$station) {
            return redirect()->route('gestionnaire.no-station');
        }
        return $this->afficherFichiersMoisView($station, $mois, 'Rapports.show');
    }

    //ADMIN
    public function voirRapportJournalier($station, $date)
    {
        $stationId = intval($station); // sécuriser si reçu en string

        $chemin = storage_path("app/public/rapports/station_{$stationId}/{$date}.pdf");

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
        $moisDisponibles = $this->extraireMoisDisponibles($station->id);

        $anneesDisponibles = $this->extraireAnneesDisponibles($moisDisponibles);

        return view('Rapports.stationRapport', compact('station', 'moisDisponibles', 'anneesDisponibles'));
    }
    public function adminVoirFichiersMois(Station $station, $mois)
    {
        return $this->afficherFichiersMoisView($station, $mois, 'Rapports.stationRapportFichier');
    }


}