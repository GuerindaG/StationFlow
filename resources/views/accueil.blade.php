
```php
namespace App\Http\Controllers;

use App\Models\Station;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StationController extends Controller
{
    public function index()
    {
        $stations = Station::with('gerant')->get();
        return view('stations.index', compact('stations'));
    }

    public function create()
    {
        return view('stations.create');
    }

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
            'password' => Hash::make($request->password_gerant),
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

        return redirect()->route('stations.index')->with('success', 'Station créée avec succès.');
    }

    public function edit(Station $station)
    {
        return view('stations.edit', compact('station'));
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

        return redirect()->route('stations.index')->with('success', 'Station mise à jour avec succès.');
    }

    public function destroy(Station $station)
    {
        $station->delete();
        return redirect()->route('stations.index')->with('success', 'Station supprimée avec succès.');
    }
}
```

---

## ✅ **2. Fichier de routes `web.php`**

```php
use App\Http\Controllers\StationController;

Route::middleware(['auth'])->group(function () {
    Route::resource('stations', StationController::class);
});
```

---

## ✅ **3. Vue Blade `stations/index.blade.php`**

```blade
@extends('layouts.app')

@section('content')
<h2>Liste des stations</h2>

<a href="{{ route('stations.create') }}">➕ Ajouter une station</a>

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Adresse</th>
            <th>Contact</th>
            <th>Statut</th>
            <th>Gérant</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($stations as $station)
        <tr>
            <td>{{ $station->nom }}</td>
            <td>{{ $station->adresse }}</td>
            <td>{{ $station->contact }}</td>
            <td>{{ ucfirst($station->statut) }}</td>
            <td>{{ $station->gerant->name }}</td>
            <td>
                <a href="{{ route('stations.edit', $station) }}">Modifier</a>
                <form action="{{ route('stations.destroy', $station) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Supprimer cette station ?')">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
```

---

## ✅ **4. Vue Blade `stations/create.blade.php`** (déjà partiellement donné mais version complète)

```blade
@extends('layouts.app')

@section('content')
<h2>Créer une nouvelle station</h2>

<form action="{{ route('stations.store') }}" method="POST">
    @csrf
    <input type="text" name="nom_station" placeholder="Nom de la station" required>
    <input type="text" name="rccm" placeholder="RCCM">
    <input type="text" name="ifu" placeholder="IFU">
    <input type="text" name="adresse" placeholder="Adresse" required>
    <input type="text" name="contact" placeholder="Contact">
    <select name="statut" required>
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
    </select>

    <h4>Infos du gérant</h4>
    <input type="email" name="email_gerant" placeholder="Email du gérant" required>
    <input type="password" name="password_gerant" placeholder="Mot de passe du gérant" required>

    <button type="submit">Créer la station</button>
</form>
@endsection
```

---

## ✅ **5. Vue Blade `stations/edit.blade.php`**

```blade
@extends('layouts.app')

@section('content')
<h2>Modifier la station</h2>

<form action="{{ route('stations.update', $station) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="nom_station" value="{{ $station->nom }}" placeholder="Nom de la station" required>
    <input type="text" name="rccm" value="{{ $station->rccm }}" placeholder="RCCM">
    <input type="text" name="ifu" value="{{ $station->ifu }}" placeholder="IFU">
    <input type="text" name="adresse" value="{{ $station->adresse }}" placeholder="Adresse" required>
    <input type="text" name="contact" value="{{ $station->contact }}" placeholder="Contact">
    <select name="statut" required>
        <option value="active" {{ $station->statut === 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ $station->statut === 'inactive' ? 'selected' : '' }}>Inactive</option>
    </select>

    <button type="submit">Mettre à jour</button>
</form>
@endsection
```

---

Tu veux que je te prépare aussi un **seeder** pour ajouter des stations de test ? Ou une gestion plus fine des rôles et des autorisations ?