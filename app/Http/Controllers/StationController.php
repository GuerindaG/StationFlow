<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Models\User;
use Illuminate\Http\Request;

class StationController extends Controller
{
    public function index()
    {
         $stations = Station::with('gerant')->get();
        return view('Station.index', compact('stations'));
    }

    /**
   
    public function create()
    {
        return view("Station.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_station' => 'required|string',
            'rccm' => 'nullable|string',
            'ifu' => 'nullable|string',
            'adresse' => 'required|string',
            'contact' => 'nullable|string',
            'statut' => 'required|in:active,inactive',
            'email_gerant' => 'required|email|unique:users,email',
            'password_gerant' => 'required|min:6',
        ]);
        $gerant = User::create([
            'name' => 'Gérant de ' . $request->nom_station,
            'email' => $request->email_gerant,
            'password' => bcrypt($request->password_gerant),
            'role' => 'gerant',
        ]);
        Station::create([
            'nom' => $request->nom_station,
            'rccm' => $request->rccm,
            'ifu' => $request->ifu,
            'adresse' => $request->adresse,
            'contact' => $request->contact,
            'statut' => $request->statut,
            'gerant_id' => $gerant->id,
        ]);
        return redirect()->route('Station.index')->with('success', 'Station et gérant créés avec succès !');    
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
