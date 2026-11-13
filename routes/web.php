<?php

use App\Http\Controllers\BikeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|---------------------------------------------------------------------
| Rutas públicas (sin autenticación)
|---------------------------------------------------------------------
*/
// Página principal: catálogo con todas las bicicletas
Route::get('/', [BikeController::class, 'index'])->name('bikes.index');

// Detalle de una bicicleta
Route::get('/bikes/{bike}', [BikeController::class, 'show'])->name('bikes.show');

/*
|---------------------------------------------------------------------
| Rutas autenticadas (middleware 'auth')
|---------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // 1. Proceso de reserva
    Route::get('/bikes/{bike}/book', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

    // 2. Historial de reservas del usuario
    Route::get('/my-bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/my-bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::patch('/my-bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');

    // 3. Perfil (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Breeze redirige aquí tras login/registro: lo mandamos al catálogo
    Route::get('/dashboard', fn () => redirect()->route('bikes.index'))->name('dashboard');
});

// Rutas de autenticación de Breeze (login, registro, logout...)
require __DIR__.'/auth.php';