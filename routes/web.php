<?php

use App\Http\Controllers\ApprovisionnementController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\VenteController;
use Illuminate\Support\Facades\Route;

Route::get('/get-produits/{id}', [ApprovisionnementController::class, 'getByCategorie']);


Route::get('/', fn() => view('connexion'))->name("connexion");

Route::get('/gestionnaire/no-station', function () {
    return 'Aucune station assignée à votre compte.';
})->name('gestionnaire.no-station');

Route::prefix('/gerant')->middleware(['auth', 'CheckGerant'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();
        $station = $user->station; 

        if (!$station) {
            return redirect()->route('gestionnaire.no-station');
        }

        return view('Gerant.dashboard', compact('station'));
    })->name('gestionnaire.dashboard');
    
    Route::get('/rapport', fn() => view('rapportpdf'))->name("rapport");
    Route::resource('/vente', VenteController::class);
    Route::resource('/approvisionnement', ApprovisionnementController::class);
});

Route::get('generate-report', 'ReportController@generateReport');
Route::get('/api/produits', [ProduitController::class, 'getProduits'])->name('api.produits');

Route::prefix('/admin')->middleware(['auth', 'CheckAdmin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('Admin.rapport'); })->name('admin.dashboard');
    Route::get('/parametre', fn() => view('Admin.parametre'))->name("parametre");
    Route::resource('/station', StationController::class);
    Route::resource('/categorie', CategorieController::class);
    Route::resource('/produit', ProduitController::class);

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});


Route::get('/redirect-by-role', function () {
    $user = Auth::user();

    if (!$user)
        return redirect()->route('login');

    switch ($user->role) {
        case 'admin':
            return redirect()->route('admin.dashboard');
        case 'gestionnaire':
            return redirect()->route('gestionnaire.dashboard');
        default:
            return redirect('/');
    }
});

require __DIR__ . '/auth.php';
