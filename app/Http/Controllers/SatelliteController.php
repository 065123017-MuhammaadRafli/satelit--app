<?php

namespace App\Http\Controllers;

use App\Models\Satellite;
use App\Models\GroundStation;
use Illuminate\Http\Request;

class SatelliteController extends Controller
{
    /**
     * Menampilkan daftar satelit dengan fitur Search.
     */
    public function index(Request $request)
    {
        $query = Satellite::query()->with('groundStation');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $satellites = $query->latest()->paginate(10);

        return view('satellites.index', compact('satellites'));
    }

    /**
     * Menampilkan form tambah satelit.
     */
    public function create()
    {
        $ground_stations = \App\Models\GroundStation::all();
        return view('satellites.create', compact('ground_stations'));
    }

    /**
     * Menyimpan data satelit baru.
     */
   public function store(Request $request)
    {
        $validated = $request->validate([
            'ground_station_id' => 'required|exists:ground_stations,id',
            'name'              => 'required|string|max:255',
            'owner_country'     => 'required|string|max:255',
            'launch_date'       => 'required|date',
            'orbit_type'        => 'required|in:LEO,MEO,GEO',
            'is_active'         => 'required|boolean',
            'tle'               => 'required|string', // Validasi TLE
        ]);

        \App\Models\Satellite::create($validated);

        return redirect()->route('satellites.index')
                         ->with('success', 'Satelit berhasil didaftarkan dengan data TLE.');
    }

    public function update(Request $request, \App\Models\Satellite $satellite)
    {
        $validated = $request->validate([
            'ground_station_id' => 'required|exists:ground_stations,id',
            'name'              => 'required|string|max:255',
            'owner_country'     => 'required|string|max:255',
            'launch_date'       => 'required|date',
            'orbit_type'        => 'required|in:LEO,MEO,GEO',
            'is_active'         => 'required|boolean',
            'tle'               => 'required|string', // Validasi TLE
        ]);

        $satellite->update($validated);

        return redirect()->route('satellites.index')
                         ->with('success', 'Data satelit dan TLE berhasil diperbarui.');
    }
}


