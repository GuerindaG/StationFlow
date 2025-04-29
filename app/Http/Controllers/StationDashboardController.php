<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StationDashboardController extends Controller
{
    public function index(Station $station)
    {
        $user = Auth::user();

        // Vérifie que la station appartient bien au gérant connecté
        if (auth()->user()->station->id !== $station->id) {
            abort(403, 'Vous n\'avez pas accès à cette station.');
        }

        return view('station.dashboard', compact('station'));
    }

}
