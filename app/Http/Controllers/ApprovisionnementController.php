<?php

namespace App\Http\Controllers;

use App\Models\Approvisionnement;
use App\Models\Categorie;
use App\Models\Produit;
use Illuminate\Http\Request;

class ApprovisionnementController extends Controller
{
    public function getProduits($categorie_id)
    {
        $produits = Produit::where('categorie_id', $categorie_id)->get();
        return response()->json($produits);
    }

    public function index()
    {
        $derniers_approvisionnements = Approvisionnement::with('produit')
            ->select('produit_id', \DB::raw('MAX(date_approvisionnement) as date_appro'))
            ->groupBy('produit_id')
            ->get()
            ->map(function ($item) {
                return Approvisionnement::with('produit')
                    ->where('produit_id', $item->produit_id)
                    ->where('date_approvisionnement', $item->date_appro)
                    ->latest('id') // au cas où plusieurs le même jour
                    ->first();
            });

        $produits = Produit::all();
        $categories = Categorie::all();
        return view("approvisionnement.index", [
            'derniers_approvisionnements' => $derniers_approvisionnements,
            'produits' => $produits,
            'categories' => $categories
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
            'categorie_id' => 'required|exists:categories,id',
            'produit_id' => 'required|exists:produits,id',
            'qte_appro' => 'required|numeric|min:0',
            'date_approvisionnement' => 'required|date',
        ]);

        $approvisionnement = Approvisionnement::findOrFail($id);

        $produit = Produit::findOrFail($request->produit_id);
        $prix_unitaire = $produit->prix_unitaire ?? 0;
        $montant_total = $request->qte_appro * $prix_unitaire;

        $approvisionnement->update([
            'produit_id' => $request->produit_id,
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
