@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-success text-white fw-bold">Tambah Ground Station Baru</div>
        <div class="card-body">
            <form action="{{ route('ground-stations.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Stasiun</label>
                    <input type="text" name="name" class="form-control" required placeholder="Contoh: GS-Jakarta-01">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Lokasi (Kota/Wilayah)</label>
                        <input type="text" name="location" class="form-control" required placeholder="Contoh: Jakarta">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Negara</label>
                        <input type="text" name="country" class="form-control" required placeholder="Contoh: Indonesia">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Latitude</label>
                        <input type="number" step="any" name="latitude" class="form-control" required placeholder="-6.123456">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Longitude</label>
                        <input type="number" step="any" name="longitude" class="form-control" required placeholder="106.123456">
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('ground-stations.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
