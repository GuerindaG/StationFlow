<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Paiement;
use App\Models\Produit;
use App\Models\Station;
use App\Models\Vente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VenteController extends Controller
{
    public function getByCategorie($id)
    {
        $produits = Produit::where('categorie_id', $id)->get();
        return response()->json($produits);
    }

    public function index()
    {
        $station = Auth::user()->station;

        if (!$station) {
            return redirect()->route('gestionnaire.no-station');
        }
        $ventes = Vente::where('station_id', $station->id)->latest()->get();

        $categories = Categorie::all();
        $paiements = Paiement::all();
        return view('vente.index', compact('ventes', 'categories', 'paiements'));
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

        foreach ($request->ventes as $venteData) {
            // Récupérer le produit
            $produit = Produit::findOrFail($venteData['produit_id']);
            $quantite = $venteData['quantite'];
            $prix_unitaire = $produit->prix_unitaire ?? 0;
            $montant_total = $quantite * $prix_unitaire;

            // Enregistrer la vente
            Vente::create([
                'station_id' => $station->id,
                'categorie_id' => $venteData['categorie_id'],
                'produit_id' => $venteData['produit_id'],
                'paiement_id' => $venteData['paiement_id'],
                'quantite' => $quantite,
                'montant_total' => $montant_total,
            ]);

        }

        return redirect()->route('vente.index')->with('success', 'Vente(s) enregistrée(s) avec succès.');
    }

    public function show(Produit $produit)
    {
        // Récupère toutes les ventes du produit triées de la plus récente à la plus ancienne
        $ventes = Vente::with('paiement', 'produit', 'station')
            ->where('produit_id', $produit->id)
            ->orderByDesc('created_at')
            ->get();
        $categories = Categorie::all();
        $paiements = Paiement::all();
        return view('vente.show', compact('produit', 'ventes', 'categories', 'paiements'));
    }


    public function edit(Vente $vente)
    {
        $station = Auth::user()->station;

        if ($vente->station_id !== $station->id) {
            abort(403, "Accès interdit");
        }
        $produits = Produit::all();
        return view('vente.edit', compact('vente', 'stations', 'produits'));
    }
    public function update(Request $request, Vente $vente)
    {
        $station = Auth::user()->station;
        if ($vente->station_id !== $station->id) {
            abort(403, "Accès interdit");
        }
        $request->validate([
            'station_id' => 'required|exists:stations,id',
            'produit_id' => 'required|exists:produits,id',
            'quantite' => 'required|numeric|min:0',
            'montant_total' => 'required|numeric|min:0',
            'date_vente' => 'required|date',
        ]);

        $vente->update($request->all());

        return redirect()->route('vente.index')->with('success', 'Vente mise à jour avec succès.');
    }
    public function destroy(Vente $vente)
    {
        $vente->delete();
        return redirect()->route('vente.index')->with('success', 'Vente supprimée avec succès.');
    }

}
