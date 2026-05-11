<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SatelliteController;
use App\Http\Controllers\GroundStationController;
use App\Models\Satellite;
use App\Models\GroundStation;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Kode baru: Jika akses '/', langsung lempar ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// Route Dashboard dengan pengiriman variabel statistik
Route::get('/dashboard', function () {
    // Menghitung data untuk widget dashboard
    $totalSatelit = Satellite::count();
    $totalGS = GroundStation::count();

    // Asumsi: Anda memiliki kolom status atau is_active.
    // Jika belum ada, kita anggap semua satelit yang terdaftar adalah aktif.
    $satelitAktif = Satellite::count();

    return view('dashboard', compact('totalSatelit', 'totalGS', 'satelitAktif'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Group Route yang memerlukan Autentikasi
Route::middleware('auth')->group(function () {

    // Profile Routes (Bawaan Laravel Breeze/Starter Kit)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resource Route untuk Satelit
    // Mencakup: index, create, store, show, edit, update, destroy
    Route::resource('satellites', SatelliteController::class);

    // Resource Route untuk Stasiun Bumi
    Route::resource('ground_stations', GroundStationController::class);
});

require __DIR__.'/auth.php';
