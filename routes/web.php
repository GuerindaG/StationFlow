<?php

use App\Http\Controllers\ApprovisionnementController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\StationDashboardController;
use App\Http\Controllers\VenteController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('connexion'))->name("connexion");
Route::get('/api/produits', [ProduitController::class, 'getProduits'])->name('api.produits');
Route::get('/get-produits/{id}', [ApprovisionnementController::class, 'getByCategorie']);
Route::get('/acc', fn() => view('essai'))->name("acc");

Route::get('/gestionnaire/no-station', function () {
    return 'Aucune station assignée à votre compte.';
})->name('gestionnaire.no-station');

Route::prefix('/gerant')->middleware(['auth', 'CheckGerant'])->group(function () {
    Route::get('/dashboard', [StationDashboardController::class, 'index'])->name('gestionnaire.dashboard');
    Route::resource('/vente', VenteController::class);
    Route::resource('/approvisionnement', ApprovisionnementController::class);

    Route::get('/rapport', fn() => view('rapports.index'))->name("rapports.index");
});

Route::prefix('/admin')->middleware(['auth', 'CheckAdmin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('Admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/parametre', fn() => view('Admin.parametre'))->name("parametre");
    Route::resource('/station', StationController::class);
    //
    Route::get('/rapport-/{id}', [StationController::class, 'show2'])->name('voirRapport');
    //
    Route::resource('/categorie', CategorieController::class);
    Route::resource('/produit', ProduitController::class);

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
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

Route::get('/voirC-pdf', [PDFController::class, 'afficherCPDF'])->name('voirC.pdf');
Route::get('/voirS-pdf', [PDFController::class, 'afficherSPDF'])->name('voirS.pdf');
Route::get('/voir-pdf', [PDFController::class, 'afficherPDF'])->name('voir.pdf');
Route::get('/s', fn() => view('Gerant.showRapport'))->name("rapport.pdf");

require __DIR__ . '/auth.php';
