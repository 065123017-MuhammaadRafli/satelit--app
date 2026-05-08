@extends('layouts.stisla')

@section('content')
<div class="section-header">
    <div class="section-header-back">
        <a href="{{ route('ground-stations.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Edit Stasiun Bumi</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('ground-stations.index') }}">Stasiun Bumi</a></div>
        <div class="breadcrumb-item">Edit</div>
    </div>
</div>

<div class="section-body">
    <div class="row justify-content-center">
        <div class="col-12 col-md-9 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header border-bottom">
                    <h4 class="text-warning"><i class="fas fa-edit mr-2"></i> Edit Data: {{ $ground_station->name }}</h4>
                </div>

                <form action="{{ route('ground-stations.update', $ground_station->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <p class="text-muted mb-4">Perbarui informasi teknis stasiun bumi. Pastikan data koordinat sudah divalidasi kembali.</p>

                        <div class="form-group">
                            <label class="font-weight-600">Nama Stasiun</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-broadcast-tower"></i></div>
                                </div>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $ground_station->name) }}" required>
                            </div>
                            @error('name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="font-weight-600">Lokasi (Kota)</label>
                                <input type="text" name="location" class="form-control @error('location') is-invalid @enderror"
                                    value="{{ old('location', $ground_station->location) }}" required>
                                @error('location') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-600">Negara</label>
                                <input type="text" name="country" class="form-control @error('country') is-invalid @enderror"
                                    value="{{ old('country', $ground_station->country) }}" required>
                                @error('country') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="font-weight-600">Latitude</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-map-marker-alt"></i></div>
                                    </div>
                                    <input type="text" name="latitude" class="form-control @error('latitude') is-invalid @enderror"
                                        value="{{ old('latitude', $ground_station->latitude) }}" required>
                                </div>
                                @error('latitude') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-600">Longitude</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-map-pin"></i></div>
                                    </div>
                                    <input type="text" name="longitude" class="form-control @error('longitude') is-invalid @enderror"
                                        value="{{ old('longitude', $ground_station->longitude) }}" required>
                                </div>
                                @error('longitude') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-whitesmoke text-right">
                        <a href="{{ route('ground-stations.index') }}" class="btn btn-secondary mr-2 px-4">Batal</a>
                        <button type="submit" class="btn btn-warning px-4 font-weight-bold shadow-sm">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
