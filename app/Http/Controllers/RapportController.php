<?php

namespace App\Http\Controllers;
use App\Models\Categorie;
use App\Models\Station;
use Carbon\Carbon;
use App\Models\Vente;
use App\Models\Approvisionnement;
use App\Models\Stock;
use App\Models\StockJournalier;
use File;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Storage;
use ZipArchive;

class RapportController extends Controller
{

    public function index()
    {
        $station = Auth::user()->station;
        if (!$station) {
            return redirect()->route('gestionnaire.no-station');
        }

        return view('Rapports.index', compact('station'));
    }

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

        Storage::disk('public')->put($chemin . $nomFichier, $pdf->output());

        return view('Rapports.index', [
            'station' => $station,
            'ventes' => $ventes,
            'approvisionnements' => $approvisionnements,
            'stocks' => $stocks,
            'stocks_journaliers' => $stocks_journaliers,
            'categories' => $categories,
            'message' => 'Rapport journalier du jour sauvegardé avec succès.',
            'fichier' => asset("storage/{$chemin}{$nomFichier}")
        ]);

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

}