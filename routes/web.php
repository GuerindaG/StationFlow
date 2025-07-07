<?php

use App\Http\Controllers\AdminDashboardControlleur;
use App\Http\Controllers\ApprovisionnementController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\GerantDashboardController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\StationDashboardController;
use App\Http\Controllers\VenteController;
use Illuminate\Support\Facades\Route;


Route::get('/', fn() => view('accueil'))->name("accueil");
Route::get('/api/produits', [ProduitController::class, 'getProduits'])->name('api.produits');
Route::get('/get-produits/{id}', [ApprovisionnementController::class, 'getByCategorie']);


Route::get('/gestionnaire/no-station', fn() => view('Gerant.no-station'))->name("accueil")->name('gestionnaire.no-station');

Route::prefix('/gerant')->middleware(['auth', 'CheckGerant'])->group(function () {
    Route::get('/dashboard', [GerantDashboardController::class, 'index'])->name('gestionnaire.dashboard');
    Route::get('/approvisionnements/download/{format}', [ApprovisionnementController::class, 'download'])
        ->name('approvisionnement.download');
    Route::resource('/vente', VenteController::class);
    Route::resource('/approvisionnement', ApprovisionnementController::class);

    Route::get('/rapport-journalier/pdf', [RapportController::class, 'genererPDF'])->name('generer.pdf');
    Route::post('/rapport-journalier/{station}/sauvegarder', [RapportController::class, 'enregistrerRapportJournalier'])
        ->name('rapport.journalier.sauvegarder');
    Route::get('/rapports', [RapportController::class, 'indexMensuel'])->name('rapports.index');
    Route::get('/rapports/{mois}', [RapportController::class, 'voirFichiersMois'])->name('fichier.pdf');
    Route::get('/rapports/{stationId}/mois/{mois}/zip', [RapportController::class, 'telechargerRapportsMensuels'])->name('rapports.mensuel.zip');

});

Route::prefix('/admin')->middleware(['auth', 'CheckAdmin'])->group(function () {

    Route::get('/dashboard', [RapportController::class, 'rapportsDuJour'])
        ->name('dashboard');
    Route::get('/rapport/{station}/{date}', [RapportController::class, 'voirRapportJournalier'])
        ->name('rapports.journalier.voir');
    Route::get('/station/{station}/rapports', [RapportController::class, 'adminRapportsParStation'])
        ->name('station.rapports');
    Route::get('/station/{station}/rapports/{mois}', [RapportController::class, 'adminVoirFichiersMois'])
        ->name('station.rapports.mois');

    Route::post('/notifications/read-all', [AdminDashboardControlleur::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [AdminDashboardControlleur::class, 'read'])->name('notifications.read');
    Route::post('/notifications/{id}/unread', [AdminDashboardControlleur::class, 'unread'])->name('notifications.unread');
    Route::post('/notifications/read-all', [AdminDashboardControlleur::class, 'readAll'])->name('notifications.read-all');
    Route::delete('/notifications/{id}', [AdminDashboardControlleur::class, 'destroy'])->name('notifications.destroy');
    Route::delete('/notifications/bulk-delete', [AdminDashboardControlleur::class, 'bulkDelete'])->name('notifications.bulkDelete');
    Route::get('/notifications/unread-count', [AdminDashboardControlleur::class, 'unreadCount']);
    Route::post('/notifications/{id}/unread', [AdminDashboardControlleur::class, 'unread']);

    Route::get('/parametre', fn() => view('parametre'))->name("parametre");
    Route::resource('/station', StationController::class);
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
            return redirect()->route('dashboard');
        case 'gestionnaire':
            return redirect()->route('gestionnaire.dashboard');
        default:
            return redirect('/');
    }
});

Route::get('/voirC-pdf', [PDFController::class, 'afficherCPDF'])->name('voirC.pdf');
Route::get('/voirS-pdf', [PDFController::class, 'afficherSPDF'])->name('voirS.pdf');
Route::get('/voir-pdf', [PDFController::class, 'afficherPDF'])->name('voir.pdf');
Route::get('/newpassword', fn() => view('auth.nouveau-password'))->name("reset.password");

require __DIR__ . '/auth.php';
