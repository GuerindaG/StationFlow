<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Paiement;
use App\Models\Produit;
use App\Models\Vente;
use Illuminate\Http\Request;

class VenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paiement = Paiement::all();
        $produits = Produit::all();
        $categories = Categorie::all();
        $ventes = Vente::all();
        return view("vente.index", compact('produits', 'categories', 'paiement', 'ventes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("vente.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'paiement_id' => 'required|exists:paiements,id',
            'quantite' => 'required|numeric|min:0',
        ]);

        // Création 
        Vente::create([
            'produit_id' => $request->produit_id,
            'paiement_id' => $request->paiement_id,
            'quantite' => $request->quantite,
        ]);

        return redirect()->route('vente.index')->with('success', 'Vente ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
