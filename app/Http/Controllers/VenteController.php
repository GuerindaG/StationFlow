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
        $categories = Categorie::all();
        $paiements = Paiement::all();
        $produits = Produit::all(); 

        return view('Gerant.Vente.create', compact('categories', 'paiements', 'produits'));
    }


    public function store(Request $request)
    {
        $station = Auth::user()->station;

        $validated = $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'quantite' => 'required|integer|min:1',
            'date_vente' => 'required|date',
            'moyen_paiement_id' => 'required|exists:paiements,id',
        ]);

        $produit = Produit::findOrFail($validated['produit_id']);
        $prix_unitaire = $produit->prix_unitaire;
        $montant_total = $prix_unitaire * $validated['quantite'];

        Vente::create([
            'station_id' => $station->id,
            'produit_id' => $validated['produit_id'],
            'quantite' => $validated['quantite'],
            'prix_unitaire' => $prix_unitaire,
            'montant_total' => $montant_total,
            'date_vente' => $validated['date_vente'],
            'moyen_paiement_id' => $validated['moyen_paiement_id'],
        ]);

        return redirect()->route('vente.index')->with('success', 'Vente enregistrée.');
    }


    public function show(Vente $vente)
    {
        return view('vente.show', compact('vente'));
    }
    public function edit(Vente $vente)
    {
        $stations = Station::all();
        $produits = Produit::all();
        return view('vente.edit', compact('vente', 'stations', 'produits'));
    }

    public function update(Request $request, Vente $vente)
    {
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
        return redirect()->route('ventes.index')->with('success', 'Vente supprimée avec succès.');
    }

}
