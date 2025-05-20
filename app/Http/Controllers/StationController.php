<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Schema;

class StationController extends Controller
{
    public function index(Request $request)
    {
        $stations = Station::with('gerant')->get();
        $searchTerm = $request->input('search');

        $query = Station::query();

        if ($searchTerm) {
            $columns = Schema::getColumnListing('stations');
            $columns = array_diff(Schema::getColumnListing('stations'), ['id', 'created_at', 'updated_at']);
            $query->where(function ($q) use ($columns, $searchTerm) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'like', '%' . $searchTerm . '%');
                }
            });
        }

        $stations = $query->paginate(5);
        return view('Station.index', compact('stations', 'searchTerm'));
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
            'longitude' => 'required|string',
            'latitude' => 'required|string',
            'contact' => 'nullable|string',
            'email_gerant' => 'required|email|unique:users,email',
            'password_gerant' => 'required|min:6',
        ]);
       
        $gerant = User::create([
            'name' => $request->nom_station,
            'email' => $request->email_gerant,
            'password' => Hash::make($request->password_gerant),
            'telephone' => $request->contact,
            'role' => User::ROLE_GESTIONNAIRE,
        ]);
        Station::create([
            'nom' => $request->nom_station,
            'rccm' => $request->rccm,
            'ifu' => $request->ifu,
            'adresse' => $request->adresse,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'contact' => $request->contact,
            'gerant_id' => $gerant->id,
        ]);
        return redirect()->route('station.index')->with('success', 'Votre station a été enregistré avec succès.');
    }

    public function show(string $id)
    {
        $station = Station::findOrFail($id);
        $rapports = $station->rapports()->latest()->get();

        return view('station.show', compact('station', 'rapports'));
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
            'longitude' => 'required|string',
            'latitude' => 'required|string',
            'contact' => 'nullable|string',
        ]);
       
        $station->update([
            'nom' => $request->nom_station,
            'rccm' => $request->rccm,
            'ifu' => $request->ifu,
            'adresse' => $request->adresse,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'contact' => $request->contact,
        ]);

        return redirect()->route('station.index')->with('success', 'Station mise à jour avec succès.');
    }
    public function destroy($id)
    {
        $station = Station::findOrFail($id);
        $station->archiver = true;
        $station->save();

        return redirect()->route('station.index')->with('success', 'Station supprimée avec succès.');
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
