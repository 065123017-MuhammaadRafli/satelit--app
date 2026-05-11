@extends('layouts.stisla')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

<style>
    body { font-family: 'Inter', sans-serif; }

    /* Hero Card - Optimized */
    .hero-card-gs {
        background: linear-gradient(135deg, #6777ef 0%, #394eea 100%);
        color: white;
        border-radius: 20px;
        padding: 40px;
        margin-bottom: 25px;
        position: relative;
        overflow: hidden;
        min-height: 220px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        box-shadow: 0 10px 25px rgba(103, 119, 239, 0.2);
    }

    /* Ikon tower di latar belakang */
    .hero-card-gs .icon-bg {
        position: absolute;
        right: -10px;
        bottom: -30px;
        font-size: 200px;
        opacity: 0.1;
        transform: rotate(-10deg);
        z-index: 1;
    }

    /* KUNCI PERBAIKAN: Kontainer teks dengan pembatasan lebar */
    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 75%; /* Menjamin teks tidak menabrak badge status */
    }

    /* KUNCI PERBAIKAN: Ukuran teks yang Anda tandai */
    .hero-card-gs h2 {
        font-size: 26px; /* Ukuran proposional */
        font-weight: 800;
        margin-bottom: 8px;
        line-height: 1.2;
        letter-spacing: -0.5px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    /* Status Badge Floating */
    .status-badge {
        position: absolute;
        top: 30px;
        right: 30px;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        z-index: 3;
        display: flex;
        align-items: center;
    }

    /* Info Box Card */
    .info-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    .info-label {
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #94a3b8;
        font-weight: 800;
        margin-bottom: 4px;
    }
    .info-value {
        font-size: 18px;
        color: #1e293b;
        font-weight: 700;
    }

    /* Map Box */
    #map-gs {
        height: 500px;
        width: 100%;
        border-radius: 20px;
        border: 5px solid white;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }
</style>

<div class="section-header">
    <div class="section-header-back">
        <a href="{{ route('ground_stations.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Detail Stasiun Bumi</h1>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-lg-5">
            <div class="hero-card-gs shadow-lg">
                <i class="fas fa-broadcast-tower icon-bg"></i>

                <div class="status-badge">
                    @php $isActive = strtolower($ground_station->status ?? 'active') == 'active'; @endphp
                    <i class="fas fa-circle mr-2" style="color: {{ $isActive ? '#2ecc71' : '#e74c3c' }}"></i>
                    {{ $ground_station->status ?? 'Inactive' }}
                </div>

                <div class="hero-content">
                    <h2 class="text-white">{{ $ground_station->name }}</h2>
                    <p class="mb-4 opacity-8 font-weight-600">
                        <i class="fas fa-map-marker-alt mr-2"></i>{{ $ground_station->location }}
                    </p>

                    <div class="row">
                        <div class="col-6 border-right" style="border-color: rgba(255,255,255,0.2) !important;">
                            <small class="d-block opacity-7 text-uppercase font-weight-bold" style="font-size: 9px; letter-spacing: 1px;">Negara</small>
                            <span class="h6 font-weight-800 text-white">Indonesia</span>
                        </div>
                        <div class="col-6">
                            <small class="d-block opacity-7 text-uppercase font-weight-bold" style="font-size: 9px; letter-spacing: 1px;">Ketinggian</small>
                            <span class="h6 font-weight-800 text-white">{{ $ground_station->elevation ?? '0' }} Mdpl</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card info-card mb-4 text-center">
                <div class="card-body py-4">
                    <div class="row">
                        <div class="col-6 border-right">
                            <div class="info-label">Latitude</div>
                            <div class="info-value text-primary">{{ $ground_station->latitude }}</div>
                        </div>
                        <div class="col-6">
                            <div class="info-label">Longitude</div>
                            <div class="info-value text-primary">{{ $ground_station->longitude }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('ground_stations.edit', $ground_station->id) }}" class="btn btn-warning btn-lg btn-block font-weight-bold shadow-sm py-3">
                <i class="fas fa-edit mr-2"></i> Edit Konfigurasi
            </a>
        </div>

        <div class="col-lg-7">
            <div id="map-gs"></div>
            <p class="mt-3 text-muted small text-center">
                <i class="fas fa-info-circle mr-1"></i> Titik koordinat presisi stasiun bumi untuk perhitungan telemetri satelit.
            </p>
        </div>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var lat = {{ $ground_station->latitude }};
        var lon = {{ $ground_station->longitude }};

        var map = L.map('map-gs', {
            center: [lat, lon],
            zoom: 13,
            scrollWheelZoom: false,
            zoomControl: false
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
        L.control.zoom({ position: 'bottomright' }).addTo(map);

        var customIcon = L.divIcon({
            className: 'gs-marker',
            html: "<div style='background-color:#6777ef; width:22px; height:22px; border-radius:50%; border:4px solid white; box-shadow:0 0 15px rgba(103,119,239,0.6);'></div>",
            iconSize: [22, 22],
            iconAnchor: [11, 11]
        });

        L.marker([lat, lon], {icon: customIcon}).addTo(map)
            .bindPopup("<b>{{ $ground_station->name }}</b>").openPopup();

        setTimeout(function(){ map.invalidateSize(); }, 600);
    });
</script>
@endsection
