@extends('layouts.stisla')

@section('content')
<div class="section-header">
    <div class="section-header-back">
        <a href="{{ route('ground_stations.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Tambah Stasiun Bumi</h1>
</div>

<div class="section-body">
    <div class="card shadow-sm">
        <form action="{{ route('ground_stations.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Nama Stasiun</label>
                        <input type="text" name="name" class="form-control" placeholder="Contoh: GS-Cibinong-01" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Lokasi (Kota/Negara)</label>
                        <input type="text" name="location" class="form-control" placeholder="Contoh: Jawa Barat, Indonesia" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Latitude</label>
                        <input type="text" name="latitude" class="form-control" placeholder="-6.12345" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Longitude</label>
                        <input type="text" name="longitude" class="form-control" placeholder="106.12345" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Elevasi (Meter dpl)</label>
                        <div class="input-group">
                            <input type="number" name="elevation" class="form-control" placeholder="150">
                            <div class="input-group-append">
                                <span class="input-group-text">m</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Status Operasional</label>
                        <select name="status" class="form-control">
                            <option value="active">Aktif (Online)</option>
                            <option value="maintenance">Perawatan (Maintenance)</option>
                            <option value="inactive">Non-Aktif (Offline)</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-whitesmoke text-right">
                <a href="{{ route('ground_stations.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Stasiun</button>
            </div>
        </form>
    </div>
</div>
@endsection
