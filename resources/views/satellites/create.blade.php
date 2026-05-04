@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-success text-white fw-bold">Tambah Satelit Baru & Data TLE</div>
                <div class="card-body">
                    <form action="{{ route('satellites.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Ground Station Monitoring</label>
                            <select name="ground_station_id" class="form-select" required>
                                <option value="">-- Pilih Stasiun Bumi --</option>
                                @foreach($ground_stations as $gs)
                                    <option value="{{ $gs->id }}">{{ $gs->name }} ({{ $gs->location }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Satelit</label>
                                <input type="text" name="name" class="form-control" required placeholder="Contoh: Palapa-D">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Negara Pemilik</label>
                                <input type="text" name="owner_country" class="form-control" required placeholder="Contoh: Indonesia">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Peluncuran</label>
                                <input type="date" name="launch_date" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tipe Orbit</label>
                                <select name="orbit_type" class="form-select" required>
                                    <option value="LEO">LEO (Low Earth Orbit)</option>
                                    <option value="MEO">MEO (Medium Earth Orbit)</option>
                                    <option value="GEO">GEO (Geostationary Orbit)</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status Satelit</label>
                            <select name="is_active" class="form-select" required>
                                <option value="1">Aktif</option>
                                <option value="0">Nonaktif</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Data TLE (Two-Line Element)</label>
                            <textarea name="tle" class="form-control font-monospace" rows="4" placeholder="1 25544U 98067A   26123.12345678  .00001234  00000-0  28374-4 0  9999&#10;2 25544  51.6432 123.4567 0005678 123.4567 286.1234 15.54321098123456" required></textarea>
                            <div class="form-text">Masukkan format TLE 2 baris sesuai dengan standar data satelit.</div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('satellites.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-success">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
