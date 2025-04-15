<?php

use App\Http\Controllers\ApprovisionnementController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\VenteController;
use App\Models\Approvisionnement;
use Illuminate\Support\Facades\Route;


//Page d'inscription
Route::get('/', function () {
    return view('inscription');
})->name("inscription");

//Routes pour page de connexion 
Route::get('/connexion', function () {
    return view('connexion');
})->name("connexion");

//Page forgot password
Route::get('/motdepasseoublie', function () {
    return view('forgotpassword');
})->name("password");

//Page d'erreur
Route::get('/error404', function () {
    return view('error404');
})->middleware(['auth']);

// Utilisation des middlewares pour restreindre l'accès au gérant
Route::prefix('/gerant')->group(function () {
    
    Route::resource('/produit', ProduitController::class);
    Route::resource('/vente', VenteController::class);
    Route::resource('/approvisionnement', ApprovisionnementController::class);
    Route::resource('/rapport', StationController::class);
    Route::get('/rapport', function () {
        return view('Gerant.addRapport');
    })->name("addRapport");

})->middleware(['gerant'])->name('gerant');

// Utilisation d'un middleware pour restreindre l'accès à l'admin
Route::prefix('/admin')->group(function () {

    Route::get('/', function () {
        return view('Admin.rapport');
    })->name("rapport");
    Route::get('/parametre', function () {
        return view('Admin.parametre');
    })->name("parametre");
    Route::resource('/station', StationController::class);
    Route::resource('/categorie', CategorieController::class);

})->middleware(['admin'])->name('admin');

require __DIR__ . '/auth.php';
