<?php

namespace App\Http\Controllers;

use App\Models\Satellite;
use App\Models\GroundStation;
use Illuminate\Http\Request;

class SatelliteController extends Controller
{
    // 1. Menampilkan daftar satelit
    public function index()
    {
        $satellites = Satellite::with('groundStation')->get();
        return view('satellites.index', compact('satellites'));
    }

    // 2. Menampilkan form tambah
    public function create()
    {
        $groundStations = GroundStation::all();
        return view('satellites.create', compact('groundStations'));
    }

    // 3. Menyimpan data ke database
    public function store(Request $request)
    {
        $request->validate([
            'ground_station_id' => 'required',
            'name'              => 'required',
            'country'           => 'required',
            'orbit_type'        => 'required',
            'altitude'          => 'required|numeric',
            'tle'               => 'required',
        ]);

        Satellite::create($request->all());

        return redirect()->route('satellites.index')
                         ->with('success', 'Satelit berhasil ditambahkan!');
    }

    // 4. MENAMPILKAN DETAIL (PENTING untuk Leaflet Maps)
    public function show($id)
    {
        // Mengambil data satelit beserta data ground station-nya (Eager Loading)
        $satellite = Satellite::with('groundStation')->findOrFail($id);

        return view('satellites.show', compact('satellite'));
    }

    // 5. Menampilkan form edit
    public function edit($id)
    {
        $satellite = Satellite::findOrFail($id);
        $groundStations = GroundStation::all();
        return view('satellites.edit', compact('satellite', 'groundStations'));
    }

    // 6. Mengupdate data
    public function update(Request $request, $id)
    {
        $request->validate([
            'ground_station_id' => 'required',
            'name'              => 'required',
            'country'           => 'required',
            'orbit_type'        => 'required',
            'altitude'          => 'required|numeric',
            'tle'               => 'required',
        ]);

        $satellite = Satellite::findOrFail($id);
        $satellite->update($request->all());

        return redirect()->route('satellites.index')
                         ->with('success', 'Data satelit berhasil diperbarui!');
    }

    // 7. Menghapus data
    public function destroy($id)
    {
        $satellite = Satellite::findOrFail($id);
        $satellite->delete();

        return redirect()->route('satellites.index')
                         ->with('success', 'Satelit berhasil dihapus!');
    }
}
