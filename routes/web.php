<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SatelliteController;
use App\Http\Controllers\GroundStationController;
use App\Models\Satellite;
use App\Models\GroundStation;

Route::get('/', function () {
    return redirect()->route('login');
    });

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard dengan Data Statistik
    Route::get('/dashboard', function () {
        $total_satellites = Satellite::count();
        $total_gs = GroundStation::count();
        $active_satellites = Satellite::where('is_active', 1)->count();

        return view('dashboard', compact('total_satellites', 'total_gs', 'active_satellites'));
    })->name('dashboard');

    // Resource Routes (WAJIB pakai underscore _)
    Route::resource('satellites', SatelliteController::class);
    Route::resource('ground_stations', GroundStationController::class);
});

require __DIR__.'/auth.php';
