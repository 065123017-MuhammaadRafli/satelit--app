@extends('layouts.app') {{-- Pastikan kamu punya layout utama, atau gunakan boilerplate bootstrap biasa --}}

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">Tambah Ground Station Baru</div>
        <div class="card-body">
            <form action="{{ route('ground-stations.store') }}" method="POST">
                @csrf {{-- WAJIB: Keamanan Laravel untuk mencegah serangan CSRF --}}

                <div class="mb-3">
                    <label>Nama Stasiun</label>
                    <input type="text" name="name" class="form-control" required placeholder="Contoh: GS-Jakarta-01">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Lokasi (Kota/Wilayah)</label>
                        <input type="text" name="location" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Negara</label>
                        <input type="text" name="country" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Latitude</label>
                        <input type="text" name="latitude" class="form-control" required placeholder="-6.123456">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Longitude</label>
                        <input type="text" name="longitude" class="form-control" required placeholder="106.123456">
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Simpan Data</button>
                <a href="{{ route('ground-stations.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
