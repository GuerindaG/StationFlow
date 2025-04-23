<?php

use App\Http\Controllers\ApprovisionnementController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\VenteController;
use App\Models\Approvisionnement;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('connexion');
})->name("connexion");

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
    Route::resource('/vente', VenteController::class);
    Route::resource('/approvisionnement', ApprovisionnementController::class);
    Route::resource('/rapport', StationController::class);

});

Route::prefix('/admin')->middleware(['admin'])->group(function () {

    Route::get('/', function () {
        return view('Admin.rapport'); })->name("rapport");
    Route::get('/parametre', function () {
        return view('Admin.parametre'); })->name("parametre");
    Route::resource('/station', StationController::class);
    Route::resource('/categorie', CategorieController::class);
    Route::resource('/produit', ProduitController::class);
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');


});

Route::get('/rap', function () {
    return view('Gerant.rap');
})->name("rap");

require __DIR__ . '/auth.php';