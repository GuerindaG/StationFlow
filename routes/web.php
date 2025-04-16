<?php

use App\Http\Controllers\ApprovisionnementController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\VenteController;
use App\Models\Approvisionnement;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('connexion');
})->name("connexion");

Route::get('/inscription', function () {
    return view('inscription');
})->name("inscription");

Route::get('/motdepasseoublie', function () {
    return view('forgotpassword');
})->name("password");

Route::get('/error404', function () {
    return view('error404');
})->middleware(['auth']);

Route::prefix('/gerant')->group(function () {

    Route::get('/', function () {
        return view('Gerant.addRapport');
    })->name("addRapport");
    Route::resource('/produit', ProduitController::class);
    Route::resource('/vente', VenteController::class);
    Route::resource('/approvisionnement', ApprovisionnementController::class);
    Route::resource('/rapport', StationController::class);

});

Route::prefix('/admin')->group(function () {

    Route::get('/', function () {
        return view('Admin.rapport');
    })->name("rapport");
    Route::get('/parametre', function () {
        return view('Admin.parametre');
    })->name("parametre");
    Route::resource('/station', StationController::class);
    Route::resource('/categorie', CategorieController::class);

});

require __DIR__.'/auth.php';