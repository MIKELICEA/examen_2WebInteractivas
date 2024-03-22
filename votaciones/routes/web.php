<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\VoteController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Redirige de la raíz (/) al dashboard adecuado si está autenticado, si no, al login
Route::get('/', function () {
    return Auth::check() ? redirect('/dashboard') : redirect('/login');
});

// Ruta del dashboard que utiliza el middleware 'role.redirect' para redirección basada en el rol
Route::get('/dashboard', function () {
    // La lógica de este controlador ahora es manejada por el Middleware
})->middleware(['auth', 'verified', 'role.redirect'])->name('dashboard');

// Rutas específicas para cada rol de usuario
Route::get('/dashboard/administrador', function () {
    return view('dashboard.administrador');
})->middleware(['auth', 'verified', 'role.admin'])->name('dashboard.administrador');

Route::get('/dashboard/votante', function () {
    return view('dashboard.votante');
})->middleware(['auth', 'verified','role.votante'])->name('dashboard.votante');

// Rutas de perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('polls', PollController::class);
Route::resource('candidates', CandidateController::class);
Route::resource('votes', VoteController::class);

Route::get('/get-candidates/{pollId}', [CandidateController::class, 'getCandidates']);


// Rutas de autenticación
require __DIR__.'/auth.php';




