<?php

namespace App\Http\Controllers;

use App\Models\Approvisionnement;
use App\Models\Categorie;
use App\Models\Produit;
use Illuminate\Http\Request;
use Schema;

class ApprovisionnementController extends Controller
{
    public function getByCategorie($id)
    {
        $produits = Produit::where('categorie_id', $id)->get();
        return response()->json($produits);
    }


    public function index(Request $request)
    {
        $searchTerm = $request->input('search');

        $query = Approvisionnement::with('produit');

        if ($searchTerm) {
            $columns = array_diff(Schema::getColumnListing('approvisionnements'), ['id', 'created_at', 'updated_at']);
            $query->where(function ($q) use ($columns, $searchTerm) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'like', '%' . $searchTerm . '%');
                }
            });
        }

        $approvisionnements_pagines = $query->orderByDesc('date_approvisionnement')->paginate(5);

        // Récupérer les derniers approvisionnements pour chaque produit
        $derniers_approvisionnements = Approvisionnement::with('produit')
            ->select('produit_id', \DB::raw('MAX(date_approvisionnement) as date_appro'))
            ->groupBy('produit_id')
            ->get()
            ->map(function ($item) {
                return Approvisionnement::with('produit')
                    ->where('produit_id', $item->produit_id)
                    ->where('date_approvisionnement', $item->date_appro)
                    ->latest('id')
                    ->first();
            });

        $produits = Produit::select('id', 'nom')->get();
        $categories = Categorie::all();

        return view("approvisionnement.index", [
            'approvisionnements_pagines' => $approvisionnements_pagines,
            'derniers_approvisionnements' => $derniers_approvisionnements,
            'produits' => $produits,
            'categories' => $categories,
            'searchTerm' => $searchTerm
        ]);
    }


    public function create()
    {
        return view("approvisionnement.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'categorie_id' => 'required|exists:categories,id',
            'produit_id' => 'required|exists:produits,id',
            'qte_appro' => 'required|numeric|min:0',
            'date_approvisionnement' => 'required|date',
        ]);

        $produit = Produit::findOrFail($request->produit_id);
        $prix_unitaire = $produit->prix_unitaire ?? 1;
        $montant_total = $request->qte_appro * $prix_unitaire;

        Approvisionnement::create([
            'station_id' => auth()->user()->station_id ?? 1,
            'produit_id' => $request->produit_id,
            'qte_appro' => $request->qte_appro,
            'montant_total' => $montant_total,
            'date_approvisionnement' => $request->date_approvisionnement,
        ]);

        return redirect()->back()->with('success', 'Approvisionnement créé avec succès !');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $approvisionnement = Approvisionnement::findOrFail($id);
        $categories = Categorie::all();
        $produits = Produit::where('categorie_id', $approvisionnement->produit->categorie_id)->get();

        return view('approvisionnement.edit', compact('approvisionnement', 'categories', 'produits'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'qte_appro' => 'required|numeric|min:0',
            'date_approvisionnement' => 'required|date',
        ]);

        $approvisionnement = Approvisionnement::findOrFail($id);
        $produit = $approvisionnement->produit;

        $prix_unitaire = $produit->prix_unitaire ?? 0;
        $montant_total = $request->qte_appro * $prix_unitaire;

        $approvisionnement->update([
            'qte_appro' => $request->qte_appro,
            'montant_total' => $montant_total,
            'date_approvisionnement' => $request->date_approvisionnement,
        ]);

        return redirect()->route('approvisionnement.index')->with('success', 'Approvisionnement mis à jour avec succès.');
    }

    public function destroy(string $id)
    {
        $approvisionnement = Approvisionnement::findOrFail($id);
        $approvisionnement->delete();

        return redirect()->back()->with('success', 'Approvisionnement supprimé avec succès.');
    }
}
