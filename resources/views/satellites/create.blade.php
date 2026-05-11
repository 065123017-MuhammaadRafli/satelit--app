@extends('layouts.stisla')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body { font-family: 'Inter', sans-serif; }

    /* Header & Icon Styling */
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
        letter-spacing: -0.2px;
    }

    /* Input Standar */
    .form-control:not(.input-tle) {
        border-radius: 8px;
        height: 42px;
        border-color: #e4e6fc;
    }
    .form-control:focus {
        border-color: #6777ef;
        box-shadow: 0 0 10px rgba(103, 119, 239, 0.1);
    }

    /* TLE Section Styling */
    .tle-input-group {
        background: #fdfdfe;
        padding: 25px;
        border-radius: 15px;
        border: 1px solid #e3eaef;
        border-top: 4px solid #6777ef;
        box-shadow: 0 4px 6px rgba(0,0,0,0.02);
    }
    .tle-field-wrapper {
        margin-bottom: 18px;
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
        margin-bottom: 8px;
        display: block;
    }
    .input-tle {
        background: #ffffff !important;
        border: 1px solid #dce1e6 !important;
        color: #2d3436 !important;
        font-family: 'JetBrains Mono', monospace !important;
        font-size: 13px !important;
        font-weight: 600;
        letter-spacing: 0.5px;
        height: 45px !important;
        border-radius: 8px !important;
    }
    .input-tle:focus {
        border-color: #6777ef !important;
        box-shadow: 0 0 8px rgba(103, 119, 239, 0.15) !important;
    }

    .info-badge-tle {
        background: #eef2ff;
        color: #6366f1;
        padding: 10px 15px;
        border-radius: 8px;
        font-size: 12px;
        border: 1px solid #e0e7ff;
    }
</style>

<div class="section-header">
    <div class="section-header-back">
        <a href="{{ route('satellites.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Registrasi Satelit</h1>
</div>

<div class="section-body">
    <div class="card shadow-sm border-0">
        <div class="card-header-custom">
            <div class="icon-box-header shadow-sm">
                <i class="fas fa-satellite-dish"></i>
            </div>
            <h4 class="mb-0 text-dark">Formulir Registrasi Satelit Baru</h4>
        </div>

        <form action="{{ route('satellites.store') }}" method="POST" id="satelliteForm">
            @csrf
            <div class="card-body px-4">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="font-weight-bold">Stasiun Bumi Monitoring</label>
                        <select name="ground_station_id" class="form-control selectric" required>
                            <option value="">-- Pilih Stasiun Bumi Terdekat --</option>
                            @foreach($groundStations as $gs)
                                <option value="{{ $gs->id }}">{{ $gs->name }} ({{ $gs->location }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Nama Satelit</label>
                        <input type="text" name="name" class="form-control" placeholder="Contoh: Telkom-4" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Negara Pemilik</label>
                        <input type="text" name="country" class="form-control" placeholder="Contoh: Indonesia" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Klasifikasi Orbit</label>
                        <select name="orbit_type" class="form-control selectric" required>
                            <option value="LEO">LEO (Low Earth Orbit)</option>
                            <option value="MEO">MEO (Medium Earth Orbit)</option>
                            <option value="GEO">GEO (Geostationary Orbit)</option>
                            <option value="HEO">HEO (High Earth Orbit)</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Ketinggian Altitude</label>
                        <div class="input-group">
                            <input type="number" name="altitude" class="form-control" placeholder="35786" required>
                            <div class="input-group-append">
                                <span class="input-group-text font-weight-bold">Km</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-12 mt-2">
                        <div class="d-flex align-items-center mb-3">
                            <div class="badge badge-primary badge-pill mr-2 shadow-sm" style="padding: 8px;">
                                <i class="fas fa-microchip"></i>
                            </div>
                            <label class="font-weight-bold mb-0 text-dark" style="font-size: 14px;">Two-Line Element (TLE) Configuration</label>
                        </div>

                        <div class="tle-input-group shadow-sm">
                            <div class="tle-field-wrapper">
                                <span class="tle-label-mini"><i class="fas fa-terminal mr-1"></i> Data Stream Line 1</span>
                                <input type="text" id="tle_line_1" class="form-control input-tle" placeholder="1 00000U 00000A ..." required>
                            </div>
                            <div class="tle-field-wrapper">
                                <span class="tle-label-mini"><i class="fas fa-terminal mr-1"></i> Data Stream Line 2</span>
                                <input type="text" id="tle_line_2" class="form-control input-tle" placeholder="2 00000  00.0000 ..." required>
                            </div>
                        </div>

                        <input type="hidden" name="tle" id="final_tle">

                        <div class="info-badge-tle mt-3 d-flex align-items-center">
                            <i class="fas fa-info-circle fa-lg mr-3"></i>
                            <div>
                                <strong>Sinkronisasi Otomatis:</strong> Data TLE akan digabungkan menjadi format standar multiline secara otomatis sebelum dikirim ke pusat data.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-whitesmoke text-right px-4">
                <a href="{{ route('satellites.index') }}" class="btn btn-secondary font-weight-bold mr-2">Batal</a>
                <button type="submit" class="btn btn-primary shadow-primary px-4 font-weight-bold">Simpan Satelit</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('satelliteForm').addEventListener('submit', function(e) {
        var line1 = document.getElementById('tle_line_1').value.trim();
        var line2 = document.getElementById('tle_line_2').value.trim();
        // Menggabungkan dengan karakter newline agar tersimpan sebagai format TLE standar
        document.getElementById('final_tle').value = line1 + "\n" + line2;
    });
</script>
@endsection
