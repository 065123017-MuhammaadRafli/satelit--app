<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Satellite;
use App\Models\GroundStation;

class SatelliteController extends Controller
{
    /**
     * Tampilkan daftar satelit.
     */
    public function index()
    {
        // Ubah dari ->get() menjadi ->paginate(10)
        $satellites = Satellite::with('groundStation')->paginate(10);

        return view('satellites.index', compact('satellites'));
    }

    /**
     * Tampilkan form tambah satelit.
     */
    public function create()
    {
        $ground_stations = GroundStation::all();
        return view('satellites.create', compact('ground_stations'));
    }

    /**
     * Simpan data satelit baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'ground_station_id' => 'required|exists:ground_stations,id',
            'owner_country'     => 'required|string|max:255',
            'launch_date'       => 'nullable|date',
            'orbit_type'        => 'required|string|max:100',
            'is_active'         => 'boolean',
            'tle_data'          => 'nullable|string',
        ]);

        // Pastikan nilai boolean diatur jika checkbox tidak tercentang
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        Satellite::create($validated);

        return redirect()->route('satellites.index')
            ->with('success', 'Satelit berhasil didaftarkan dengan data TLE.');
    }

    /**
     * Tampilkan detail satelit tertentu.
     */
    public function show(string $id)
    {
        $satellite = Satellite::with('groundStation')->findOrFail($id);

        return view('satellites.show', compact('satellite'));
    }

    /**
     * Tampilkan form edit satelit tertentu.
     */
    public function edit(string $id)
    {
        $satellite = Satellite::with('groundStation')->findOrFail($id);
        $groundStations = GroundStation::all();

        return view('satellites.edit', compact('satellite', 'groundStations'));
    }

    /**
     * Perbarui data satelit di database.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'ground_station_id' => 'required|exists:ground_stations,id',
            'owner_country'     => 'required|string|max:255',
            'launch_date'       => 'nullable|date',
            'orbit_type'        => 'required|string|max:100',
            'is_active'         => 'boolean',
            'tle_data'          => 'nullable|string',
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        $satellite = Satellite::findOrFail($id);
        $satellite->update($validated);

        return redirect()->route('satellites.index')
            ->with('success', 'Satelit berhasil diperbarui.');
    }

    /**
     * Hapus data satelit dari database.
     */
    public function destroy(string $id)
    {
        $satellite = Satellite::findOrFail($id);
        $satellite->delete();

        return redirect()->route('satellites.index')
            ->with('success', 'Satelit berhasil dihapus.');
    }
}
