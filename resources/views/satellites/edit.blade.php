@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0 rounded-4">

                <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center py-3 px-4 rounded-top-4">
                    <h4 class="mb-0 fw-bold">✏️ Edit Data Satelit: {{ $satellite->name }}</h4>
                    <a href="{{ route('satellites.index') }}" class="btn btn-secondary btn-sm fw-bold px-3">Kembali</a>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('satellites.update', $satellite->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nama Satelit</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $satellite->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="ground_station_id" class="form-label fw-semibold">Stasiun Bumi</label>
                            <select class="form-select" id="ground_station_id" name="ground_station_id" required>
                                <option value="" disabled>Pilih Stasiun Bumi</option>
                                @foreach($groundStations as $gs)
                                    <option value="{{ $gs->id }}" {{ $satellite->ground_station_id == $gs->id ? 'selected' : '' }}>
                                        {{ $gs->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="owner_country" class="form-label fw-semibold">Negara Pemilik</label>
                            <input type="text" class="form-control" id="owner_country" name="owner_country" value="{{ old('owner_country', $satellite->owner_country) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="launch_date" class="form-label fw-semibold">Tanggal Peluncuran</label>
                            <input type="date" class="form-control" id="launch_date" name="launch_date" value="{{ old('launch_date', $satellite->launch_date) }}">
                        </div>

                        <div class="mb-3">
                            <label for="orbit_type" class="form-label fw-semibold">Tipe Orbit</label>
                            <input type="text" class="form-control" id="orbit_type" name="orbit_type" value="{{ old('orbit_type', $satellite->orbit_type) }}" required>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ $satellite->is_active ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="is_active">Satelit Aktif</label>
                        </div>

                        <div class="mb-3">
                            <label for="tle_data" class="form-label fw-semibold">Data TLE</label>
                            <textarea class="form-control" id="tle_data" name="tle_data" rows="4" placeholder="Masukkan data TLE">{{ old('tle_data', $satellite->tle_data) }}</textarea>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="submit" class="btn btn-success fw-bold px-4">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
