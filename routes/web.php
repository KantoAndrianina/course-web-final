<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\dashController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\ClassementController;
use App\Http\Controllers\ImportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
// Route::redirect('/', '/loginClients');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/afficherListeEtapes', [dashController::class, 'afficherListeEtapes'])->name('afficherListeEtapes');
    Route::get('/afficherformTemps/{id}', [dashController::class, 'afficherformTemps'])->name('afficherformTemps.dash');
    Route::get('/afficherResultatEtape/{id}', [dashController::class, 'afficherResultatEtape'])->name('afficherResultatEtape.dash');


    Route::post('/insertTemps', [dashController::class, 'insertTemps'])->name('insertTemps.dash');

    Route::get('/classementGEtapeDash', [dashController::class, 'classementGEtape'])->name('afficherClassementGEtape.dash');
    Route::get('/classementGEquipeDash', [dashController::class, 'classementGEquipe'])->name('afficherClassementGEquipe.dash');
    Route::get('/classementCategorie', [dashController::class, 'classementCategorie'])->name('afficherClassementCat.dash');
    Route::get('/classementEtapeCategorie', [dashController::class, 'classementEtapeCategorie'])->name('afficherClassementEtapeCat.dash');
    Route::get('/classementDetailEquipe/{id_equipe}', [dashController::class, 'classementDetailEquipe'])->name('classementDetailEquipe.dash');
    Route::get('/classementDetailEquipeEtape/{id_equipe}', [dashController::class, 'classementDetailEquipeEtape'])->name('classementDetailEquipeEtape.dash');



    Route::get('/form-import-etape-resultat', [dashController::class, 'formImportEtapeResultat'])->name('form.import.etape');
    Route::get('/form-import-points', [dashController::class, 'formImportPoint'])->name('form.import.point');
    Route::post('/import-etape-resultat', [ImportController::class, 'importCSVEtape'])->name('import.etape');
    Route::post('/import-points', [ImportController::class, 'importCSVPoint'])->name('import.point');
    Route::get('/reinitialisation', [dashController::class, 'reinitialisationDB'])->name('delete.page');
    Route::get('/reinitialisation-confirm', [dashController::class, 'reinitialisationConfirm'])->name('delete.base');
    Route::get('/confirm_categorie', function () { return view('dash.confirm_categorie'); })->name('confirm.categorie');

    Route::get('/genererCategorie', [dashController::class, 'genererCategorie'])->name('genererCategorie.dash');
    Route::get('/afficherListePenalite', [dashController::class, 'afficherListePenalite'])->name('afficherListePenalite.dash');
    Route::get('/afficherValidSuppPenal/{id}', [dashController::class, 'afficherValidSuppPenal'])->name('afficherValidSuppPenal.dash');
    Route::get('/afficherAjoutPenal', [dashController::class, 'afficherAjoutPenal'])->name('afficherAjoutPenal.dash');

    Route::post('/insertPenalite', [dashController::class, 'insertPenalite'])->name('insertPenalite.dash');
    Route::get('/deletePenal/{id}', [dashController::class, 'deletePenal'])->name('deletePenal.dash');

    



});

    Route::post('/login-equipe', [EquipeController::class, 'loginEquipe'])->name('login.equipe');
    
    Route::get('/etapes-details', [EquipeController::class, 'listeEtapeDetails'])->name('details.liste_etape');

    Route::get('/etapes-equipe', [EquipeController::class, 'listeEtapeEquipe'])->name('equipe.liste_etape');
    Route::post('/logout-equipe', [EquipeController::class, 'logoutEquipe'])->name('logout.equipe');

    Route::get('/formCoureur/{id_etapes}', [EquipeController::class, 'formCoureur'])->name('formCoureur.front');

    Route::get('/insertCoureur', [EquipeController::class, 'insertCoureur'])->name('insertCoureur.front');

    Route::get('/classementGEtape', [ClassementController::class, 'classementGEtape'])->name('classementGEtape.front');
    Route::get('/classementGEquipe', [ClassementController::class, 'classementGEquipe'])->name('classementGEquipe.front');
    Route::post('/confirmer-classement', [ClassementController::class, 'confirmerClassement'])->name('confirmer.classement');
    Route::post('/confirmer-classement-categorie', [ClassementController::class, 'confirmerClassementCat'])->name('confirmer.classement.categorie');

    Route::get('/certificat-equipe', [EquipeController::class, 'afficherCertificat'])->name('equipe.certificat');
    Route::get('/certificat-equipe-categorie/{id_cat}', [EquipeController::class, 'afficherCertificatCategorie'])->name('equipe.certificat.categorie');


    require __DIR__.'/auth.php';
