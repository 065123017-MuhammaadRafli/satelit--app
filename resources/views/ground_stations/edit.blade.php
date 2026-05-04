@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-warning text-dark fw-bold">
                    Edit Data Stasiun Bumi: {{ $station->name }}
                </div>
                <div class="card-body">
                    <form action="{{ route('ground-stations.update', $station->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nama Stasiun</label>
                            <input type="text" name="name" class="form-control" value="{{ $station->name }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Lokasi</label>
                                <input type="text" name="location" class="form-control" value="{{ $station->location }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Negara</label>
                                <input type="text" name="country" class="form-control" value="{{ $station->country }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Latitude</label>
                                <input type="number" step="any" name="latitude" class="form-control" value="{{ $station->latitude }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Longitude</label>
                                <input type="number" step="any" name="longitude" class="form-control" value="{{ $station->longitude }}" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('ground-stations.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
