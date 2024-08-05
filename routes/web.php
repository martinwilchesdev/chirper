<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * Todas las rutas se pueden definir utilizando un controlador de recursos, siguiendo una estructura condicional 
 * - index :: La ruta se utiliza para mostrar el formulario y una lista
 * - store :: La ruta se utiliza para guardar nuevos recursos
*/
Route::resource('chirps', ChirpController::class)
    ->only(['index', 'store'])
    /**
     * Las rutas anteriores utilizan 2 middleware 
     * - auth :: Garantiza que solo los usuarios registrados puedan acceder a la ruta
     * - verified :: Se utiliza para habilitar la verificacion de correo electronico
    */
    ->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
