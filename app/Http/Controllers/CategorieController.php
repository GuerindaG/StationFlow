<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();
        return view('categorie.index', compact('categories'));
    }

    public function create()
    {
        return view("categorie.create");
    }
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'description' => 'required|string',
        ]);
        Categorie::create([
            'nom' => $request->nom,
            'description' => $request->description,
        ]);
        return redirect()->route('categorie.index')->with('success', 'categorie et gérant créés avec succès !');
    }

    public function show(string $id)
    {
        //
    }
    public function edit(Categorie $categorie)
    {
        return view('categorie.edit', compact('categorie'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
    
        $categorie = Categorie::findOrFail($id);
    
        $categorie->update([
            'nom' => $request->nom,
            'description' => $request->description,
        ]);
    
        return redirect()->route('categorie.index')->with('success', 'Catégorie modifiée avec succès.');
    }
    

    public function archiver()
    {
        $categorie =Categorie::withoutGlobalScope('notArchived')
            ->where('archiver', true)
            ->get();

        return view('categorie.archiver', compact('categorie'));

    }
    public function restore($id)
    {
        $categorie =Categorie::withoutGlobalScope('notArchived')->findOrFail($id);
        $categorie->archiver = false;
        $categorie->save();

        return redirect()->route('categorie.index')->with('success', 'categorie restaurée avec succès.');
    }
}
