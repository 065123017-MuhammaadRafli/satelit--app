<?php

namespace App\Http\Controllers;

use App\Models\Satellite;
use App\Models\GroundStation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;
use Barryvdh\DomPDF\Facade\Pdf;

class SatelliteController extends Controller
{
    public function index()
    {
        $satellites = Satellite::with('groundStation')->get();
        return view('satellites.index', compact('satellites'));
    }

    public function create()
    {
        $groundStations = GroundStation::all();
        return view('satellites.create', compact('groundStations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ground_station_id' => 'required|exists:ground_stations,id',
            'name'              => 'required|string|max:255',
            'country'           => 'required|string',
            'orbit_type'        => 'required|in:LEO,MEO,GEO,HEO',
            'altitude'          => 'required|numeric',
            'tle'               => 'required|string',
        ]);

        Satellite::create($request->all());

        return redirect()->route('satellites.index')
                         ->with('success', 'Satelit baru berhasil didaftarkan ke armada!');
    }

    public function show($id)
    {
        $satellite = Satellite::with('groundStation')->findOrFail($id);
        return view('satellites.show', compact('satellite'));
    }

    public function edit($id)
    {
        $satellite = Satellite::findOrFail($id);
        $groundStations = GroundStation::all();
        return view('satellites.edit', compact('satellite', 'groundStations'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ground_station_id' => 'required|exists:ground_stations,id',
            'name'              => 'required|string|max:255',
            'country'           => 'required|string',
            'orbit_type'        => 'required',
            'altitude'          => 'required|numeric',
            'tle'               => 'required',
        ]);

        $satellite = Satellite::findOrFail($id);
        $satellite->update($request->all());

        return redirect()->route('satellites.index')
                         ->with('success', 'Data telemetri satelit berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $satellite = Satellite::findOrFail($id);
        $satellite->delete();

        return redirect()->route('satellites.index')
                         ->with('success', 'Satelit telah dinonaktifkan dan dihapus dari daftar.');
    }

    public function exportPdf()
    {
        $satellites = Satellite::with('groundStation')->get();
        $pdf = Pdf::loadView('satellites.pdf', compact('satellites'));

        return $pdf->download('laporan-armada-satelit-' . date('Ymd') . '.pdf');
    }

    // FUNGSI SAKTI: Live Tracking via Python
    public function getLiveTracking($id)
    {
        $satellite = Satellite::findOrFail($id);

        // Bersihkan TLE dari karakter enter Windows
        $tleLines = explode("\n", str_replace("\r", "", $satellite->tle));

        if (count($tleLines) < 2) {
            return response()->json(['status' => 'error', 'message' => 'Format TLE tidak valid.'], 400);
        }

        $line1 = trim($tleLines[0]);
        $line2 = trim($tleLines[1]);

        // Path ke file Python sesuai screenshot kamu
        $scriptPath = public_path('python.engine/app.py');

        // Menjalankan Python
        $command = "python3 \"{$scriptPath}\" \"{$line1}\" \"{$line2}\"";
        $result = Process::run($command);

        if ($result->successful()) {
            return response()->json(json_decode($result->output(), true));
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Gagal komputasi Python.',
            'debug' => $result->errorOutput()
        ], 500);
    }

        public function globalTracking()
    {
        // Mengambil semua satelit untuk ditampilkan di satu peta
        $satellites = Satellite::all();
        return view('satellites.global', compact('satellites'));
    }
}
