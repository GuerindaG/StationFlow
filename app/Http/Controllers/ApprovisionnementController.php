<?php

namespace App\Http\Controllers;

use App\Models\Approvisionnement;
use App\Models\Categorie;
use App\Models\Paiement;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $station = Auth::user()->station;
        if (!$station) {
            return redirect()->route('gestionnaire.no-station');
        }
        $searchTerm = $request->input('search');

        $query = Approvisionnement::with('produit')
            ->where('station_id', $station->id);

        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->orWhere('qte_appro', 'like', '%' . $searchTerm . '%')
                    ->orWhere('montant_total', 'like', '%' . $searchTerm . '%')
                    ->orWhere('date_approvisionnement', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('produit', function ($q2) use ($searchTerm) {
                        $q2->where('nom', 'like', '%' . $searchTerm . '%');
                    });
            });
        }
        // Derniers approvisionnements par produit, toujours pour la station connectée
        $derniers_approvisionnements = Approvisionnement::with('produit')
            ->select('produit_id', \DB::raw('MAX(date_approvisionnement) as date_appro'))
            ->where('station_id', $station->id)
            ->groupBy('produit_id')
            ->get()
            ->map(function ($item) use ($station) {
                return Approvisionnement::with('produit')
                    ->where('produit_id', $item->produit_id)
                    ->where('date_approvisionnement', $item->date_appro)
                    ->where('station_id', $station->id)
                    ->latest('id')
                    ->first();
            });
        $derniers_approvisionnements = $query->orderByDesc('date_approvisionnement')->paginate(5);

        $produits = Produit::select('id', 'nom')->get();
        $categories = Categorie::all();
        $paiements = Paiement::all();

        return view("approvisionnement.index", [
            'derniers_approvisionnements' => $derniers_approvisionnements,
            'produits' => $produits,
            'categories' => $categories,
            'paiements' => $paiements,
            'searchTerm' => $searchTerm
        ]);
    }

    public function create()
    {
        $station = Auth::user()->station;
        if (!$station) {
            return redirect()->route('gestionnaire.no-station');
        }
        $categories = Categorie::all();
        $produits = Produit::all();
        $paiements = Paiement::all();
        return view("approvisionnement.create", compact('categories', 'produits','paiements'));
    }

    public function store(Request $request)
    {
        $station = Auth::user()->station;
        if (!$station) {
            return redirect()->route('gestionnaire.no-station');
        }

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
            'station_id' => $station->id,
            'produit_id' => $request->produit_id,
            'qte_appro' => $request->qte_appro,
            'montant_total' => $montant_total,
            'date_approvisionnement' => $request->date_approvisionnement,
        ]);
        return redirect()->route('approvisionnement.index')->with('success', 'Approvisionnement créé avec succès !');
    }
    public function show(Request $request, $id)
    {
        $station = Auth::user()->station;
        if (!$station) {
            return redirect()->route('gestionnaire.no-station');
        }

        // Dates de filtrage (optionnelles)
        $date_debut = $request->input('date_debut');
        $date_fin = $request->input('date_fin');

        $query = Approvisionnement::with('produit')
            ->where('station_id', $station->id)
            ->where('produit_id', $id);

        // Filtrage par dates si les deux sont présents
        if ($date_debut && $date_fin) {
            $query->whereBetween('date_approvisionnement', [$date_debut, $date_fin]);
        }

        $approvisionnements = $query->orderByDesc('date_approvisionnement')->paginate(5);

        $produit = Produit::findOrFail($id);

        return view('approvisionnement.show', [
            'approvisionnements' => $approvisionnements,
            'produit' => $produit,
            'date_debut' => $date_debut,
            'date_fin' => $date_fin
        ]);
    }
    public function edit(string $id)
    {
        $station = Auth::user()->station;

        $approvisionnement = Approvisionnement::where('id', $id)
            ->where('station_id', Auth::user()->$station->id)
            ->firstOrFail();

        $categories = Categorie::all();
        $produits = Produit::where('categorie_id', $approvisionnement->produit->categorie_id)->get();

        return view('approvisionnement.edit', compact('approvisionnement', 'categories', 'produits'));
    }
    public function update(Request $request, string $id)
    {
        $station = Auth::user()->station;

        $request->validate([
            'qte_appro' => 'required|numeric|min:0',
            'date_approvisionnement' => 'required|date',
        ]);

        $approvisionnement = Approvisionnement::where('id', $id)
            ->where('station_id', $station->id)
            ->firstOrFail();

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
        $station = Auth::user()->station;
        $approvisionnement = Approvisionnement::where('id', $id)
            ->where('station_id', Auth::user()->$station->id)
            ->firstOrFail();

        $approvisionnement->delete();

        return redirect()->back()->with('success', 'Approvisionnement supprimé avec succès.');
    }
}
