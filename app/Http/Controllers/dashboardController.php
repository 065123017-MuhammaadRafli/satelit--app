<?php

namespace App\Http\Controllers;

use App\Models\Satellite;
use App\Models\GroundStation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_satellites'  => Satellite::count(),
            'active_satellites' => Satellite::where('is_active', 1)->count(),
            'total_gs'          => GroundStation::count(),
        ];

        return view('dashboard', $data);
    }
}
