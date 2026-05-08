<?php

namespace App\Http\Controllers;

use App\Models\GroundStation;
use Illuminate\Http\Request;

class GroundStationController extends Controller
{
    public function index()
    {
        $ground_stations = GroundStation::query()->paginate(10);

        return view('ground_stations.index', compact('ground_stations'));
    }

    public function create()
    {
        return view('ground_stations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        GroundStation::create($validated);

        return redirect()->route('ground-stations.index')
                         ->with('success', 'Ground Station berhasil ditambahkan!');
    }

    public function show(GroundStation $ground_station)
    {

        return view('ground_stations.show', compact('ground_station'));
    }

        public function edit(GroundStation $ground_station)
    {
        // Pastikan namanya tunggal: 'ground_station'
        return view('ground_stations.edit', compact('ground_station'));
    }

    public function update(Request $request, string $id)
    {
        $station = GroundStation::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $station->update($validated);

        return redirect()->route('ground-stations.index')
                         ->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $station = GroundStation::findOrFail($id);
        $station->delete();

        return redirect()->route('ground-stations.index')
                         ->with('success', 'Ground Station berhasil dihapus.');
    }
}
