@extends('layouts.stisla')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

<style>
    body { font-family: 'Inter', sans-serif; }

    /* Header Styling Selaras */
    .card-header-custom {
        display: flex;
        align-items: center;
        padding: 25px;
        border-bottom: 1px solid #f2f2f2;
    }
    .icon-box-header {
        width: 45px;
        height: 45px;
        background: rgba(103, 119, 239, 0.1);
        color: #6777ef;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 18px;
    }

    /* Form Styling */
    label.font-weight-bold {
        color: #34395e;
        font-size: 13px;
        margin-bottom: 8px;
        display: block;
        letter-spacing: -0.2px;
    }
    .form-control {
        border-radius: 8px;
        height: 45px;
        border-color: #e4e6fc;
    }
    .form-control:focus {
        border-color: #6777ef;
        box-shadow: 0 0 10px rgba(103, 119, 239, 0.1);
    }

    /* Koordinat Group Styling */
    .coordinate-input-group {
        background: #fdfdfe;
        padding: 25px;
        border-radius: 15px;
        border: 1px solid #e3eaef;
        border-top: 4px solid #6777ef;
        box-shadow: 0 4px 6px rgba(0,0,0,0.02);
    }
</style>

<div class="section-header">
    <div class="section-header-back">
        <a href="{{ route('ground_stations.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Edit Stasiun Bumi</h1>
</div>

<div class="section-body">
    <div class="card shadow-sm border-0">
        <div class="card-header-custom">
            <div class="icon-box-header shadow-sm">
                <i class="fas fa-broadcast-tower"></i>
            </div>
            <div>
                <h4 class="mb-0 text-dark">Update Konfigurasi Stasiun</h4>
                <p class="text-muted small mb-0">Sesuaikan parameter geografis untuk akurasi pemantauan.</p>
            </div>
        </div>

        <form action="{{ route('ground_stations.update', $ground_station->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body px-4">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Nama Stasiun Bumi</label>
                        <input type="text" name="name" class="form-control" value="{{ $ground_station->name }}" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Lokasi (Kota/Negara)</label>
                        <input type="text" name="location" class="form-control" value="{{ $ground_station->location }}" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Status Operasional</label>
                        <select name="status" class="form-control selectric">
                            <option value="active" {{ $ground_station->status == 'active' ? 'selected' : '' }}>Active (Online)</option>
                            <option value="inactive" {{ $ground_station->status == 'inactive' ? 'selected' : '' }}>Inactive (Offline)</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Ketinggian (Elevation - Mdpl)</label>
                        <input type="number" name="elevation" class="form-control" value="{{ $ground_station->elevation ?? 0 }}">
                    </div>

                    <div class="form-group col-md-12 mt-3">
                        <div class="d-flex align-items-center mb-3">
                            <div class="badge badge-primary badge-pill mr-2 shadow-sm" style="padding: 8px;">
                                <i class="fas fa-map-marked-alt"></i>
                            </div>
                            <label class="font-weight-bold mb-0 text-dark" style="font-size: 14px;">Koordinat Geografis</label>
                        </div>

                        <div class="coordinate-input-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="small font-weight-bold text-muted text-uppercase">Latitude</label>
                                    <input type="text" name="latitude" class="form-control font-weight-bold" value="{{ $ground_station->latitude }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="small font-weight-bold text-muted text-uppercase">Longitude</label>
                                    <input type="text" name="longitude" class="form-control font-weight-bold" value="{{ $ground_station->longitude }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 p-3 bg-light rounded border d-flex align-items-center">
                            <i class="fas fa-info-circle text-primary mr-3 fa-lg"></i>
                            <small class="text-muted">Koordinat ini digunakan sebagai titik acuan nol (ground reference) untuk menghitung sudut azimuth dan elevasi satelit.</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-whitesmoke text-right px-4">
                <a href="{{ route('ground_stations.index') }}" class="btn btn-secondary font-weight-bold mr-2">Batal</a>
                <button type="submit" class="btn btn-primary shadow-primary px-4 font-weight-bold">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
