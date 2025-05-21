<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ProduitController extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');
        $query = Produit::with('categorie');

        // Filtrage par catégorie
        if ($request->filled('categorie_id')) {
            $query->where('categorie_id', $request->categorie_id);
        }

        // Recherche globale
        if ($searchTerm) {
            $columns = array_diff(Schema::getColumnListing('produits'), ['id', 'created_at', 'updated_at']);
            $query->where(function ($q) use ($columns, $searchTerm) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'like', '%' . $searchTerm . '%');
                }
            });
        }

        $produits = $query->paginate(5);
        $categories = Categorie::all();

        return view('produit.index', compact('produits', 'categories', 'searchTerm'));
    }

    public function create()
    {
        $categories = Categorie::all();
        return view('produit.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
            'prix_achat' => 'required|numeric|min:0',
            'prix_vente' => 'required|numeric|min:0',
            'viscosite' => 'nullable|string',
        ]);

        Produit::create([
            'nom' => $request->nom,
            'categorie_id' => $request->categorie_id,
            'prix_achat' => $request->prix_achat,
            'prix_vente' => $request->prix_vente,
            'viscosite' => $request->viscosite,
        ]);

        return redirect()->route('produit.index')->with('success', 'Produit ajouté avec succès');
    }

    public function show(string $id)
    {
        // Implémentez cette méthode si nécessaire
    }

    public function edit(string $id)
    {
        $produit = Produit::findOrFail($id);
        $categories = Categorie::all();
        return view('produit.edit', compact('produit', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
            'prix_achat' => 'required|numeric|min:0',
            'prix_vente' => 'required|numeric|min:0',
            'viscosite' => 'nullable|string',
        ]);

        $produit = Produit::findOrFail($id);
        $produit->update($request->all());

        return redirect()->route('produit.index')->with('success', 'Produit mis à jour avec succès');
    }

    public function destroy(string $id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();

        return redirect()->route('produit.index')->with('success', 'Produit supprimé avec succès');
    }

    public function restore($id)
    {
        $produit = Produit::withTrashed()->findOrFail($id);
        $produit->restore();

        return redirect()->route('produit.index')->with('success', 'Produit restauré avec succès');
    }

    public function getProduits(Request $request)
    {
        $query = Produit::query();

        if ($request->has('categorie_id') && $request->categorie_id) {
            $query->where('categorie_id', $request->categorie_id);
        }

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                    ->orWhere('prix_achat', 'like', "%{$search}%")
                    ->orWhere('prix_vente', 'like', "%{$search}%");
            });
        }

        $produits = $query->with('categorie')->paginate(10);

        return response()->json([
            'produits' => $produits,
            'pagination' => $produits->toArray()
        ]);
    }
}