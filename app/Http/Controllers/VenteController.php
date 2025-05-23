<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Paiement;
use App\Models\Produit;
use App\Models\Vente;
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
        $perPage = $request->input('per_page', 5);

        $query = Vente::with(['produit.categorie', 'paiement'])
            ->where('station_id', $station->id);

        if ($date_filter) {
            $query->whereDate('created_at', $date_filter);
        }

        $ventes = $query->latest()
            ->paginate($perPage)
            ->appends($request->query());
        $categories = Categorie::all();
        $paiements = Paiement::all();

        return view('vente.index', compact('ventes', 'categories', 'paiements', 'date_filter'));
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

    public function destroy(Vente $vente)
    {
        $vente->delete();
        return redirect()->route('vente.index')->with('success', 'Vente supprimée avec succès.');
    }
}