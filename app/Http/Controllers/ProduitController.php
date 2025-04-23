<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Produit::with('categorie')->get();
        $categories = Categorie::all();
        return view('produit.index', compact('produits', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('produit.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
            'prix_unitaire' => 'required|numeric|min:0',
        ]);

        // Création du produit
        Produit::create([
            'nom' => $request->nom,
            'categorie_id' => $request->categorie_id,
            'prix_unitaire' => $request->prix_unitaire,
        ]);

        return redirect()->route('produit.index')->with('success', 'Produit ajouté avec succès');
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
        $produits = Produit::findOrFail($id);
        $categories = Categorie::all();
        return view('produit.edit', compact('produits', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
            'prix_unitaire' => 'required|numeric|min:0',
        ]);

        $produits = Produit::findOrFail($id);

        $produits->update([
            'nom' => $request->nom,
            'categorie_id' => $request->categorie_id,
            'prix_unitaire' => $request->prix_unitaire,
        ]);

        return redirect()->route('produit.index')->with('success', 'Produit mis à jour avec succès');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produits = Produit::findOrFail($id);
        $produits->delete();

        return redirect()->route('produit.index')->with('success', 'Produit supprimé avec succès');
    }

    public function restore($id)
    {
        $produit = Produit::withTrashed()->findOrFail($id);
        $produit->restore();

        return redirect()->route('produit.index')->with('success', 'Produit restauré avec succès');
    }

}
