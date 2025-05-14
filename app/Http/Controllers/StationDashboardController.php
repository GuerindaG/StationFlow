<?php

namespace App\Http\Controllers;

use App\Models\Approvisionnement;
use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StationDashboardController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        // Exemple : approvisionnements du gérant connecté
        $approvisionnements = Approvisionnement::where('user_id', $user->id)->get();

        return view('dashboard.gerant', compact('approvisionnements'));
    }

}
