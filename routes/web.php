<?php

use App\Http\Controllers\Admin\DashboardController; //controlla sempre che il controller sia importato correttamente
use App\Http\Controllers\Admin\ProjectController; //controlla sempre che il controller sia importato correttamente per riga 32
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
});


//Adesso devo andare a definire le middleware, che risponderanno tutte allo stesso nome iniziale, e che saranno accessibili solo se si è autenticati e validati
Route::middleware(['auth', 'verified'])
    ->name('admin.')    //questo mi permette di concatenare questo nome ad altri nomi delle rotte che verranno definite successivamente in group, ricordati del .
    ->prefix('admin')   //questo mi permette di utilizzare questo prefisso per le mie nuove rotte
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard'); //qui praticamente sto dicendo che quando c'è /dashboard nell'url il controller gestisce il metodo index e ritorna una pagina, ho tolto '/dashboard' e messo solo '/', perchè in questo modo quando sarò autenticato, con solo admin trovero questa rotta

        Route::resource('/projects', ProjectController::class); //adesso questo admin/projects verrà gestito dal controller di Project in index in questo caso
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';



//dopo aver modificato il nome delle rotte a riga 26 e riga 29, ricordati di andare nella cartella Providers in RouteService e modificare la pagina di atterraggio una volta loggato correttamente