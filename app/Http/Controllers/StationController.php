<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
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
    public function store(Request $request)
    {
        $request->validate(
            [
                'nom_station' => 'required|string',
                'rccm' => ['required', 'regex:/^RB\/[A-Z]{3}\/\d{2}[A-Z] \d+$/'],
                'ifu' => ['required', 'regex:/^\d{13}$/'],
                'adresse' => [
                    'required',
                    Rule::in(['Cotonou', 'Abomey-Calavi', 'Porto-Novo', 'Parakou', 'Bohicon', 'Djougou', 'Natitingou', 'Abomey', 'Lokossa', 'Kandi']),
                ],
                'longitude' => 'nullable|string',
                'latitude' => 'nullable|string',
                'contact' => ['required', 'regex:/^01\d{8}$/'],
                'email_gerant' => 'required|email|unique:users,email',
                'password_gerant' => [
                    'required',
                    'string',
                    'min:8',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'
                ],
            ],
            [
                'contact.regex' => 'Le numéro doit être au format 01XXXXXXXX sans espace.',
                'adresse.in' => 'L\'adresse (ville) doit être parmi les villes autorisées.',
                'rccm.regex' => 'Le format du RCCM est invalide (ex: RB/ABC/23 B 7460).',
                'ifu.regex' => 'Le format de l\'IFU est invalide (13 chiffres).',
                'password_gerant.regex' => 'Le mot de passe doit contenir au moins 8 caractères (majuscule, minuscule, chiffre, caractère spécial).',
            ]
        );

        $numero = $request->contact;
        $numero_formate = '+229' . $numero;

        $longitude = $request->filled('longitude') ? $request->input('longitude') : null;
        $latitude = $request->filled('latitude') ? $request->input('latitude') : null;

        $gerant = User::create([
            'name' => $request->nom_station,
            'email' => $request->email_gerant,
            'password' => Hash::make($request->password_gerant),
            'telephone' => $numero_formate,
            'role' => User::ROLE_GESTIONNAIRE,
        ]);

        Station::create([
            'nom' => $request->nom_station,
            'rccm' => $request->rccm,
            'ifu' => $request->ifu,
            'adresse' => $request->adresse,
            'longitude' => $longitude,
            'latitude' => $latitude,
            'contact' => $numero_formate,
            'gerant_id' => $gerant->id,
        ]);

        return redirect()->route('station.index')->with('success', 'Votre station a été enregistrée avec succès.');
    }
    public function show(string $id)
    {
        $station = Station::findOrFail($id);
        $rapports = $station->rapports()->latest()->get();

        return view('station.show', compact('station', 'rapports'));
    }

    public function show2(string $id)
    {
        $station = Station::findOrFail($id);
        $rapports = $station->rapports()->latest()->get();

        return view('station.show2', compact('station', 'rapports'));
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
