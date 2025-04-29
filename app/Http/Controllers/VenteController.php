<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Paiement;
use App\Models\Produit;
use App\Models\Station;
use App\Models\Vente;
use Illuminate\Http\Request;

class VenteController extends Controller
{

    public function index()
    {
        $station = auth()->user()->station;
        $categories = Categorie::all();
        $paiements = Paiement::all();
        $ventes = $station->ventes()->latest()->get();
        return view('vente.index', compact('ventes', 'categories', 'paiements'));
    }

    public function create()
    {
        $stations = Station::all();
        $produits = Produit::all();
        return view('vente.create', compact('stations', 'produits'));
    }

    public function store(Request $request)
    {
        $station = auth()->user()->station;
        $station->ventes()->create($request->validate([
            'produit_id' => 'required|exists:produits,id',
            'quantite' => 'required|numeric|min:0',
            'montant_total' => 'required|numeric|min:0',
            'date_vente' => 'required|date',
        ]));

        Vente::create($request->all());

        return redirect()->route('vente.index')->with('success', 'Vente enregistrée avec succès.');
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
