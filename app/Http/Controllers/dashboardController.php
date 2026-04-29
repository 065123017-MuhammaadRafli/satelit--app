<?php

namespace App\Http\Controllers;

use App\Models\Satellite;
use App\Models\GroundStation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_satellites'   => \App\Models\Satellite::count(),
            'active_satellites'  => \App\Models\Satellite::where('is_active', true)->count(),
            'inactive_satellites'=> \App\Models\Satellite::where('is_active', false)->count(),
            'total_gs'           => \App\Models\GroundStation::count(),
        ];

        return view('dashboard', $stats);
    }
}
