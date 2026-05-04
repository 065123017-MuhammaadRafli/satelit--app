<?php

namespace App\Http\Controllers;

use App\Models\Satellite;
use App\Models\GroundStation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil total dan mengelompokkan berdasarkan tipe orbit
        $orbitData = Satellite::select('orbit_type', DB::raw('count(*) as total'))
            ->groupBy('orbit_type')
            ->pluck('total', 'orbit_type');

        $data = [
            'total_satellites'  => Satellite::count(),
            'active_satellites' => Satellite::where('is_active', 1)->count(),
            'total_gs'          => GroundStation::count(),
            'leo_count'         => $orbitData['LEO'] ?? 0,
            'meo_count'         => $orbitData['MEO'] ?? 0,
            'geo_count'         => $orbitData['GEO'] ?? 0,
        ];

        return view('dashboard', $data);
    }
}
