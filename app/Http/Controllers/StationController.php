<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class StationController extends Controller
{
    public function index()
    {
        $stations = Station::with('gerant')->get();
        return view('Station.index', compact('stations'));
    }
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
            'name' => $request->nom_station,
            'email' => $request->email_gerant,
            'password' =>  Hash::make($request->password_gerant),
            'telephone' => $request->contact,
            'role' => User::ROLE_GESTIONNAIRE,
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
        return redirect()->route('station.index')->with('success', 'Station et gérant créés avec succès !');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Station $station)
    {
        return view('Station.edit', compact('station'));
    }

    public function update(Request $request, Station $station)
    {
        $request->validate([
            'nom_station' => 'required|string',
            'rccm' => 'nullable|string',
            'ifu' => 'nullable|string',
            'adresse' => 'required|string',
            'contact' => 'nullable|string',
            'statut' => 'required|in:active,inactive',
        ]);

        $station->update([
            'nom' => $request->nom_station,
            'rccm' => $request->rccm,
            'ifu' => $request->ifu,
            'adresse' => $request->adresse,
            'contact' => $request->contact,
            'statut' => $request->statut,
        ]);

        return redirect()->route('station.index')->with('success', 'Station mise à jour avec succès.');
    }
    public function destroy($id)
    {
        $station = Station::findOrFail($id);
        $station->archiver = true;
        $station->save();

        return redirect()->route('station.index')->with('success', 'Station archivée avec succès.');
    }

    public function archiver()
    {
        $station = Station::withoutGlobalScope('notArchived')
            ->where('archiver', true)
            ->get();

        return view('station.archiver', compact('station'));

    }
    public function restore($id)
    {
        $station = Station::withoutGlobalScope('notArchived')->findOrFail($id);
        $station->archiver = false;
        $station->save();

        return redirect()->route('station.index')->with('success', 'Station restaurée avec succès.');
    }
}
