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
        $ground_stations = GroundStation::all();
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
            'tle'               => 'required|string',
        ]);

        Satellite::create($validated);

        return redirect()->route('satellites.index')
                         ->with('success', 'Satelit berhasil didaftarkan.');
    }

    /**
     * Menampilkan form edit satelit.
     */
    public function edit(Satellite $satellite)
    {
        $ground_stations = GroundStation::all();
        return view('satellites.edit', compact('satellite', 'ground_stations'));
    }

    /**
     * Memperbarui data satelit.
     */
    public function update(Request $request, Satellite $satellite)
    {
        $validated = $request->validate([
            'ground_station_id' => 'required|exists:ground_stations,id',
            'name'              => 'required|string|max:255',
            'owner_country'     => 'required|string|max:255',
            'launch_date'       => 'required|date',
            'orbit_type'        => 'required|in:LEO,MEO,GEO',
            'is_active'         => 'required|boolean',
            'tle'               => 'required|string',
        ]);

        $satellite->update($validated);

        return redirect()->route('satellites.index')
                         ->with('success', 'Data satelit berhasil diperbarui.');
    }

    /**
     * Menghapus data satelit.
     */
   public function destroy(Satellite $satellite)
    {
        \App\Models\Satellite::destroy($satellite->id);

        return redirect()->route('satellites.index')
                         ->with('success', 'Satelit telah dihapus dari sistem.');
    }
}
