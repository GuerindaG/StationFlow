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

Route::get('/get-produits/{categorie_id}', [ApprovisionnementController::class, 'getProduits']);

Route::get('/', fn() => view('connexion'))->name("connexion");


Route::get('/error404', fn() => view('error404'))->middleware(['auth']);
Route::get('/test', fn() => view('vente.version'));



Route::prefix('/gerant')->middleware(['auth', 'CheckGerant'])->group(function () {
    Route::get('/dashboard', function () {
        return view('Gerant.dashboard');
    })->name('gestionnaire.dashboard');
    Route::get('/rapport', fn() => view('Gerant.addRapport'))->name("addRapport");
    Route::resource('/vente', VenteController::class);
    Route::resource('/approvisionnement', ApprovisionnementController::class);
});



Route::prefix('/admin')->middleware(['auth', 'CheckAdmin'])->group(function () {
    Route::get('/dashboard', function () {return view('Admin.rapport');})->name('admin.dashboard');
    Route::get('/parametre', fn() => view('Admin.parametre'))->name("parametre");
    Route::resource('/station', StationController::class);
    Route::resource('/categorie', CategorieController::class);
    Route::resource('/produit', ProduitController::class);

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__ . '/auth.php';
