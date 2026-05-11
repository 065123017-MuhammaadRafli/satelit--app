@extends('layouts.stisla')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body { font-family: 'Inter', sans-serif; }

    /* Header Styling - Selaras Blue */
    .card-header-custom {
        display: flex;
        align-items: center;
        padding: 20px 25px;
        border-bottom: 1px solid #f2f2f2;
    }
    .icon-box-header {
        width: 40px;
        height: 40px;
        background: rgba(103, 119, 239, 0.1);
        color: #6777ef;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
    }

    /* Form Label Styling */
    label.font-weight-bold {
        color: #34395e;
        font-size: 13px;
        margin-bottom: 8px;
        display: block;
    }

    /* TLE Section Styling - Selaras dengan Gambar Referensi */
    .tle-input-group {
        background: #ffffff;
        padding: 25px;
        border-radius: 15px;
        border: 1px solid #e4e6fc;
        border-top: 4px solid #6777ef;
        box-shadow: 0 4px 6px rgba(0,0,0,0.02);
    }
    .tle-field-wrapper {
        margin-bottom: 20px;
    }
    .tle-field-wrapper:last-child {
        margin-bottom: 0;
    }
    .tle-label-mini {
        font-size: 10px;
        color: #6777ef;
        text-transform: uppercase;
        font-weight: 800;
        letter-spacing: 1.5px;
    }
    .input-tle {
        background: #ffffff !important;
        border: 1px solid #e4e6fc !important;
        color: #2d3436 !important;
        font-family: 'JetBrains Mono', monospace !important;
        font-size: 13px !important;
        font-weight: 600;
        letter-spacing: 0.5px;
        height: 50px !important;
        border-radius: 10px !important;
        transition: all 0.3s ease;
    }
    .input-tle:focus {
        border-color: #6777ef !important;
        box-shadow: 0 4px 12px rgba(103, 119, 239, 0.1) !important;
    }

    /* Info Badge Blue */
    .info-badge-blue {
        background: #eef2ff;
        color: #6366f1;
        padding: 12px 15px;
        border-radius: 10px;
        font-size: 12px;
        border: 1px solid #e0e7ff;
    }
</style>

<div class="section-header">
    <div class="section-header-back">
        <a href="{{ route('satellites.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Edit Konfigurasi Satelit</h1>
</div>

<div class="section-body">
    <div class="card shadow-sm border-0">
        <div class="card-header-custom">
            <div class="icon-box-header shadow-sm">
                <i class="fas fa-pencil-alt"></i>
            </div>
            <div>
                <h4 class="mb-0 text-dark">Update Telemetry Data</h4>
                <p class="text-muted small mb-0">ID Satelit: #{{ $satellite->id }}</p>
            </div>
        </div>

        <form action="{{ route('satellites.update', $satellite->id) }}" method="POST" id="satelliteForm">
            @csrf
            @method('PUT')
            <div class="card-body px-4">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="font-weight-bold">Stasiun Bumi Monitoring</label>
                        <select name="ground_station_id" class="form-control selectric" required>
                            @foreach($groundStations as $gs)
                                <option value="{{ $gs->id }}" {{ $satellite->ground_station_id == $gs->id ? 'selected' : '' }}>
                                    {{ $gs->name }} ({{ $gs->location }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Nama Satelit</label>
                        <input type="text" name="name" class="form-control" value="{{ $satellite->name }}" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Negara Pemilik</label>
                        <input type="text" name="country" class="form-control" value="{{ $satellite->country }}" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Klasifikasi Orbit</label>
                        <select name="orbit_type" class="form-control selectric" required>
                            <option value="LEO" {{ $satellite->orbit_type == 'LEO' ? 'selected' : '' }}>LEO</option>
                            <option value="MEO" {{ $satellite->orbit_type == 'MEO' ? 'selected' : '' }}>MEO</option>
                            <option value="GEO" {{ $satellite->orbit_type == 'GEO' ? 'selected' : '' }}>GEO</option>
                            <option value="HEO" {{ $satellite->orbit_type == 'HEO' ? 'selected' : '' }}>HEO</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Ketinggian Altitude (Km)</label>
                        <input type="number" name="altitude" class="form-control" value="{{ $satellite->altitude }}" required>
                    </div>

                    <div class="form-group col-md-12 mt-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="badge badge-primary badge-pill mr-2 shadow-sm" style="padding: 8px;">
                                <i class="fas fa-microchip text-white"></i>
                            </div>
                            <label class="font-weight-bold mb-0 text-dark" style="font-size: 14px;">Two-Line Element (TLE) Configuration</label>
                        </div>

                        <div class="tle-input-group shadow-sm">
                            @php
                                $tle_lines = explode("\n", trim($satellite->tle));
                            @endphp

                            <div class="tle-field-wrapper">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-terminal mr-2 text-primary" style="font-size: 10px;"></i>
                                    <span class="tle-label-mini">Line 1 Data Stream</span>
                                </div>
                                <input type="text" id="tle_line_1" class="form-control input-tle" value="{{ $tle_lines[0] ?? '' }}" required>
                            </div>

                            <div class="tle-field-wrapper">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-terminal mr-2 text-primary" style="font-size: 10px;"></i>
                                    <span class="tle-label-mini">Line 2 Data Stream</span>
                                </div>
                                <input type="text" id="tle_line_2" class="form-control input-tle" value="{{ $tle_lines[1] ?? '' }}" required>
                            </div>
                        </div>

                        <input type="hidden" name="tle" id="final_tle">

                        <div class="info-badge-blue mt-3 d-flex align-items-center">
                            <i class="fas fa-info-circle mr-3 fa-lg"></i>
                            <div>
                                <strong>Sinkronisasi Otomatis:</strong> Data TLE akan digabungkan menjadi format standar multiline secara otomatis sebelum dikirim ke pusat data.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-whitesmoke text-right px-4">
                <a href="{{ route('satellites.index') }}" class="btn btn-secondary mr-2">Batal</a>
                <button type="submit" class="btn btn-primary shadow-primary px-4 font-weight-bold">Update Satelit</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('satelliteForm').addEventListener('submit', function(e) {
        var line1 = document.getElementById('tle_line_1').value.trim();
        var line2 = document.getElementById('tle_line_2').value.trim();
        document.getElementById('final_tle').value = line1 + "\n" + line2;
    });
</script>
@endsection
