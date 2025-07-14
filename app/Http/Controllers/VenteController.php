<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Paiement;
use App\Models\Produit;
use App\Models\Vente;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VenteController extends Controller
{
    public function getByCategorie($id)
    {
        $produits = Produit::where('categorie_id', $id)->get();
        return response()->json($produits);
    }

    public function index(Request $request)
    {
        $station = Auth::user()->station;

        if (!$station) {
            return redirect()->route('gestionnaire.no-station');
        }

        $date_filter = $request->input('date_filter', Carbon::today()->toDateString());
        $categorie_filter = $request->input('categorie_filter');
        $perPage = $request->input('per_page', 10);

        $query = Vente::with(['produit.categorie', 'paiement'])
            ->where('station_id', $station->id)
            ->when($date_filter, function ($query) use ($date_filter) {
                $query->whereDate('created_at', $date_filter);
            })
            ->when($categorie_filter, function ($query) use ($categorie_filter) {
                $query->whereHas('produit.categorie', function ($q) use ($categorie_filter) {
                    $q->where('id', $categorie_filter);
                });
            });

        $ventes = $query->latest()
            ->paginate($perPage)
            ->appends($request->query());

        $categories = Categorie::all();

        return view('vente.index', [
            'ventes' => $ventes,
            'categories' => $categories,
            'date_filter' => $date_filter,
            'perPage' => $perPage
        ]);
    }

    public function create()
    {
        $station = Auth::user()->station;
        if (!$station) {
            return redirect()->route('gestionnaire.no-station');
        }
        $categories = Categorie::all();
        $paiements = Paiement::all();
        $produits = Produit::all();

        return view('vente.create', compact('categories', 'paiements', 'produits'));
    }

    public function store(Request $request)
    {
        $station = Auth::user()->station;

        $request->validate([
            'ventes' => 'required|array|min:1',
            'ventes.*.categorie_id' => 'required|exists:categories,id',
            'ventes.*.produit_id' => 'required|exists:produits,id',
            'ventes.*.paiement_id' => 'required|exists:paiements,id',
            'ventes.*.quantite' => 'required|numeric|min:1',
        ]);

        DB::transaction(function () use ($request, $station) {
            foreach ($request->ventes as $venteData) {
                $produit = Produit::findOrFail($venteData['produit_id']);
                $montant_total = $venteData['quantite'] * ($produit->prix_vente ?? 0);

                Vente::create([
                    'station_id' => $station->id,
                    'categorie_id' => $venteData['categorie_id'],
                    'produit_id' => $venteData['produit_id'],
                    'paiement_id' => $venteData['paiement_id'],
                    'quantite' => $venteData['quantite'],
                    'montant_total' => $montant_total,
                ]);
            }
        });

        return redirect()->route('vente.index')->with('success', 'Vente(s) enregistrée(s) avec succès.');
    }

    public function show(Request $request, $id)
    {
        $station = Auth::user()->station;
        if (!$station) {
            return redirect()->route('gestionnaire.no-station');
        }

        $date_debut = $request->input('date_debut');
        $date_fin = $request->input('date_fin');

        $query = Vente::with(['paiement', 'produit'])
            ->where('station_id', $station->id)
            ->where('produit_id', $id);

        if ($date_debut && $date_fin) {
            $query->whereBetween('created_at', [$date_debut, $date_fin]);
        }

        $ventes = $query->orderByDesc('created_at')
            ->paginate(10);

        // Préparer les données pour l'affichage par jour
        $ventesParJour = $ventes->groupBy(function ($item) {
            return Carbon::parse($item->created_at)->format('Y-m-d');
        });

        $produit = Produit::findOrFail($id);
        $paiements = Paiement::all();
        $categories = Categorie::all();

        return view('vente.show', [
            'ventes' => $ventes,
            'ventesParJour' => $ventesParJour,
            'produit' => $produit,
            'categories' => $categories,
            'paiements' => $paiements,
            'date_debut' => $date_debut,
            'date_fin' => $date_fin
        ]);
    }

    public function edit(Vente $vente)
    {
        $station = Auth::user()->station;
        if ($vente->station_id !== $station->id) {
            abort(403, "Accès interdit");
        }

        $produits = Produit::all();
        $paiements = Paiement::all();

        return view('vente.edit', compact('vente', 'produits', 'paiements'));
    }

    public function update(Request $request, Vente $vente)
    {
        $station = Auth::user()->station;
        if ($vente->station_id !== $station->id) {
            abort(403, "Accès interdit");
        }

        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'paiement_id' => 'required|exists:paiements,id',
            'quantite' => 'required|numeric|min:0',
        ]);

        $produit = Produit::findOrFail($request->produit_id);
        $montant_total = $request->quantite * ($produit->prix_vente ?? 0);

        $vente->update([
            'produit_id' => $request->produit_id,
            'paiement_id' => $request->paiement_id,
            'quantite' => $request->quantite,
            'montant_total' => $montant_total,
        ]);

        return redirect()->route('vente.index')->with('success', 'Vente mise à jour avec succès.');
    }
    private function calculateTotals($ventes)
    {
        return [
            'tv' => $ventes->where('paiement.nom', 'Ticket Valeur')->sum('montant_total'),
            'jnp' => $ventes->where('paiement.nom', 'JNP Pass')->sum('montant_total'),
            'especes' => $ventes->where('paiement.nom', 'Espèce')->sum('montant_total'),
            'total' => $ventes->sum('montant_total')
        ];
    }
    public function download($format, Request $request)
    {
        $date_filter = $request->input('date_filter', Carbon::today()->toDateString());
        $categorie_filter = $request->input('categorie_filter');

        $ventes = Vente::with(['produit.categorie', 'paiement'])
            ->where('station_id', auth()->user()->station->id)
            ->when($date_filter, function ($query) use ($date_filter) {
                $query->whereDate('created_at', $date_filter);
            })
            ->when($categorie_filter, function ($query) use ($categorie_filter) {
                $query->whereHas('produit.categorie', function ($q) use ($categorie_filter) {
                    $q->where('id', $categorie_filter);
                });
            })
            ->orderByDesc('created_at')
            ->get();

        // Grouper les ventes par produit pour le PDF
        $ventesGrouped = $ventes->groupBy('produit_id');

        $filename = "ventes_" . $date_filter . ($categorie_filter ? "_categorie_$categorie_filter" : "");

        switch ($format) {
            case 'pdf':
                $pdf = Pdf::loadView('vente.pdf', [
                    'ventesGrouped' => $ventesGrouped,
                    'date_filter' => $date_filter,
                    'station' => auth()->user()->station,
                    'categorie_filter' => $categorie_filter
                ]);
                return $pdf->stream("$filename.pdf");

            case 'csv':
                $headers = [
                    "Content-type" => "text/csv",
                    "Content-Disposition" => "attachment; filename=$filename.csv",
                    "Pragma" => "no-cache",
                    "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                    "Expires" => "0"
                ];

                $callback = function () use ($ventes, $date_filter, $categorie_filter) {
                    $handle = fopen('php://output', 'w');

                    // Ajout d'une ligne d'en-tête descriptive
                    fputcsv($handle, ["Rapport des Ventes - Station: " . auth()->user()->station->nom], ',');
                    fputcsv($handle, ["Date: " . $date_filter], ',');
                    if ($categorie_filter) {
                        $categorie = \App\Models\Categorie::find($categorie_filter);
                        fputcsv($handle, ["Catégorie: " . $categorie->nom], ',');
                    }
                    fputcsv($handle, [""], ','); // Ligne vide

                    // En-têtes des colonnes avec style
                    fputcsv($handle, [
                        'ID',
                        'Produit',
                        'Catégorie',
                        'Quantité',
                        'Prix Unitaire',
                        'Moyen de Paiement',
                        'Montant Total',
                        'Date et Heure'
                    ], ',');

                    // Données formatées
                    foreach ($ventes as $vente) {
                        fputcsv($handle, [
                            $vente->id,
                            $vente->produit->nom ?? 'N/A',
                            $vente->produit->categorie->nom ?? 'N/A',
                            number_format($vente->quantite, 0, ',', ' '),
                            number_format($vente->prix_unitaire, 0, ',', ' ') . ' XOF',
                            strtoupper($vente->paiement->nom ?? 'N/A'),
                            number_format($vente->montant_total, 0, ',', ' ') . ' XOF',
                            $vente->created_at->format('d/m/Y H:i')
                        ], ',');
                    }

                    // Ajout des totaux
                    $totals = $this->calculateTotals($ventes);
                    fputcsv($handle, [""], ',');
                    fputcsv($handle, ["TOTAUX", "", "", "", "", "", ""], ',');
                    fputcsv($handle, [
                        "",
                        "",
                        "",
                        "Total TV: " . number_format($totals['tv'], 0, ',', ' ') . ' XOF',
                        "Total JNP: " . number_format($totals['jnp'], 0, ',', ' ') . ' XOF',
                        "Total Espèces: " . number_format($totals['especes'], 0, ',', ' ') . ' XOF',
                        "GRAND TOTAL: " . number_format($totals['total'], 0, ',', ' ') . ' XOF',
                        ""
                    ], ',');

                    fclose($handle);
                };

                return \Response::stream($callback, 200, $headers);
            default:
                return back()->with('error', 'Format non supporté');
        }
    }
    public function destroy(Vente $vente)
    {
        $vente->delete();
        return redirect()->route('vente.index')->with('success', 'Vente supprimée avec succès.');
    }
}