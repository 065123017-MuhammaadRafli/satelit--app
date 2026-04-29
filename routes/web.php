<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroundStationController;
use App\Http\Controllers\SatelliteController;
use App\Http\Controllers\DashboardController; // Pastikan ini di-import!

// 1. Redirect Halaman Utama ke Dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// 2. Rute Dashboard dengan NAMA 'dashboard' (PENTING!)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// 3. Resource Routes
Route::resource('ground-stations', GroundStationController::class);
Route::resource('satellites', SatelliteController::class);
