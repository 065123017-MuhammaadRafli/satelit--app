<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroundStationController;
use App\Http\Controllers\SatelliteController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Rute yang memerlukan login
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Daftarkan kembali rute-rute resource Anda di sini
    Route::resource('ground-stations', GroundStationController::class);
    Route::resource('satellites', SatelliteController::class);

});

require __DIR__.'/auth.php';
