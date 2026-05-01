@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark fw-bold">
                    Edit Data Satelit: {{ $satellite->name }}
                </div>
                <div class="card-body">
                    <form action="{{ route('satellites.update', $satellite->id) }}" method="POST">
                        @csrf
                        @method('PUT') {{-- PENTING: Untuk proses Update di Laravel --}}

                        <div class="mb-3">
                            <label class="form-label">Pilih Ground Station Monitoring</label>
                            <select name="ground_station_id" class="form-select @error('ground_station_id') is-invalid @enderror" required>
                                @foreach($ground_stations as $gs)
                                    <option value="{{ $gs->id }}" {{ $satellite->ground_station_id == $gs->id ? 'selected' : '' }}>
                                        {{ $gs->name }} ({{ $gs->location }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Satelit</label>
                                <input type="text" name="name" class="form-control" value="{{ $satellite->name }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Negara Pemilik</label>
                                <input type="text" name="owner_country" class="form-control" value="{{ $satellite->owner_country }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Peluncuran</label>
                                <input type="date" name="launch_date" class="form-control" value="{{ $satellite->launch_date }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tipe Orbit</label>
                                <select name="orbit_type" class="form-select">
                                    <option value="LEO" {{ $satellite->orbit_type == 'LEO' ? 'selected' : '' }}>LEO (Low Earth Orbit)</option>
                                    <option value="MEO" {{ $satellite->orbit_type == 'MEO' ? 'selected' : '' }}>MEO (Medium Earth Orbit)</option>
                                    <option value="GEO" {{ $satellite->orbit_type == 'GEO' ? 'selected' : '' }}>GEO (Geostationary Orbit)</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status Satelit</label>
                            <select name="is_active" class="form-select">
                                <option value="1" {{ $satellite->is_active ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ !$satellite->is_active ? 'selected' : '' }}>Nonaktif / De-orbited</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Data TLE (Two-Line Element)</label>
                            <textarea name="tle" class="form-control" rows="3" required>{{ $satellite->tle }}</textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('satellites.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
