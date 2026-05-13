<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SatelliteController;
use App\Http\Controllers\GroundStationController;
use App\Models\Satellite;
use App\Models\GroundStation;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Pengalihan Halaman Utama
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// 2. Dashboard Monitoring
Route::get('/dashboard', function () {
    // Mengambil statistik untuk widget dashboard
    $totalSatelit = Satellite::count();
    $totalGS      = GroundStation::count();
    $satelitAktif = Satellite::count(); // Sesuaikan logika jika ada kolom status aktif

    return view('dashboard', compact('totalSatelit', 'totalGS', 'satelitAktif'));
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. Grup Rute yang memerlukan Login
Route::middleware('auth')->group(function () {

    /**
     * Rute BARU: Global Fleet Tracking
     * Menampilkan semua satelit dalam satu peta besar.
     * Diletakkan di atas agar tidak bentrok dengan rute resource.
     */
    Route::get('satellites/global/track', [SatelliteController::class, 'globalTracking'])
        ->name('satellites.global');

    /**
     * Rute Khusus Ekspor PDF
     */
    Route::get('satellites/export/pdf', [SatelliteController::class, 'exportPdf'])
        ->name('satellites.pdf');

    /**
     * Rute API Internal untuk Komputasi Orbit Python (Live Tracking)
     */
    Route::get('api/satellites/{id}/track', [SatelliteController::class, 'getLiveTracking'])
        ->name('satellites.track');

    // Rute Resource untuk Manajemen Data CRUD
    Route::resource('satellites', SatelliteController::class);
    Route::resource('ground_stations', GroundStationController::class);

    // Rute Profil Pengguna (Bawaan Laravel Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
