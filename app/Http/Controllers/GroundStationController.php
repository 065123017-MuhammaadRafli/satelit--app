<?php

namespace App\Http\Controllers;

use App\Models\GroundStation;
use Illuminate\Http\Request;

class GroundStationController extends Controller
{
    /**
     * Menampilkan daftar stasiun bumi.
     */
    public function index()
    {
        // Mengambil semua data ground stations dengan paginasi (10 data per halaman)
        $ground_stations = GroundStation::latest()->paginate(10);

        return view('ground_stations.index', compact('ground_stations'));
    }

    /**
     * Menampilkan form untuk membuat stasiun bumi baru.
     */
    public function create()
    {
        return view('ground_stations.create');
    }

    /**
     * Menyimpan data stasiun bumi ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        GroundStation::create($request->all());

        return redirect()->route('ground_stations.index')
            ->with('success', 'Stasiun Bumi berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail stasiun bumi tertentu.
     */
    public function show(string $id)
    {
        $ground_station = GroundStation::findOrFail($id);
        return view('ground_stations.show', compact('ground_station'));
    }

    /**
     * Menampilkan form untuk mengedit stasiun bumi.
     */
    public function edit(string $id)
    {
        // Mencari data berdasarkan ID
        $ground_station = GroundStation::findOrFail($id);

        return view('ground_stations.edit', compact('ground_station'));
    }

    /**
     * Memperbarui data stasiun bumi di database.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $ground_station = GroundStation::findOrFail($id);
        $ground_station->update($request->all());

        return redirect()->route('ground_stations.index')
            ->with('success', 'Data Stasiun Bumi berhasil diperbarui.');
    }

    /**
     * Menghapus stasiun bumi dari database.
     */
    public function destroy(string $id)
    {
        $ground_station = GroundStation::findOrFail($id);
        $ground_station->delete();

        return redirect()->route('ground_stations.index')
            ->with('success', 'Stasiun Bumi berhasil dihapus.');
    }
}
