@extends('layouts.stisla')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&family=Inter:wght@400;700;800&display=swap" rel="stylesheet">

<style>
    /* Global Typography */
    body { font-family: 'Inter', sans-serif; }
    .section-header h1 { font-weight: 800; color: #2c3e50; letter-spacing: -1px; }

    /* Hero Card - Satellite Identity */
    .hero-card {
        background: linear-gradient(135deg, #6777ef 0%, #394eea 100%);
        color: white;
        border-radius: 20px;
        padding: 35px;
        position: relative;
        overflow: hidden;
        margin-bottom: 25px;
        box-shadow: 0 15px 30px rgba(103, 119, 239, 0.3);
    }
    .hero-card .hero-bg {
        position: absolute;
        right: -40px;
        top: -40px;
        font-size: 220px;
        opacity: 0.1;
        transform: rotate(-15deg);
    }

    /* Stats Grid */
    .stats-container { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 25px; }
    .stat-box {
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(8px);
        border-radius: 15px;
        padding: 18px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .stat-label { font-size: 9px; text-transform: uppercase; letter-spacing: 2px; opacity: 0.9; font-weight: 800; margin-bottom: 5px; }
    .stat-value { font-size: 20px; font-weight: 800; }

    /* TLE Terminal - Split View */
    .tle-card { background: #0f172a; border-radius: 18px; border: 1px solid #1e293b; overflow: hidden; }
    .tle-card-header {
        background: #1e293b;
        padding: 12px 20px;
        display: flex;
        align-items: center;
        border-bottom: 1px solid #334155;
    }
    .dot { width: 10px; height: 10px; border-radius: 50%; margin-right: 8px; }
    .tle-body { padding: 25px; }

    .tle-line-wrapper { margin-bottom: 20px; }
    .tle-line-wrapper:last-child { margin-bottom: 0; }
    .tle-label { font-size: 9px; color: #94a3b8; font-weight: 800; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 8px; }

    .tle-box {
        background: rgba(0, 0, 0, 0.4);
        padding: 15px;
        border-radius: 10px;
        border: 1px solid #334155;
        transition: all 0.3s ease;
    }
    .tle-box:hover { border-color: #38bdf8; background: rgba(56, 189, 248, 0.05); }
    .tle-box.active { border-left: 4px solid #34d399; }

    .tle-box code {
        font-family: 'JetBrains Mono', monospace;
        color: #34d399;
        font-size: 13px;
        letter-spacing: 0.5px;
        display: block;
        white-space: pre-wrap;
    }

    /* Tracking Station Card */
    .gs-card {
        background: white;
        border-radius: 18px;
        padding: 22px;
        display: flex;
        align-items: center;
        border: 1px solid #f1f5f9;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    .gs-icon {
        width: 55px; height: 55px;
        background: #eef2ff;
        color: #6366f1;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 18px;
        font-size: 22px;
    }

    /* Leaflet Map */
    #map {
        height: 640px;
        width: 100%;
        border-radius: 20px;
        border: 5px solid white;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }
    .coords-floating {
        background: white;
        padding: 12px 20px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        margin-top: 15px;
    }
</style>

<div class="section-header">
    <div class="section-header-back">
        <a href="{{ route('satellites.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Telemetry Center</h1>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-lg-5">
            <div class="hero-card shadow-lg">
                <i class="fas fa-satellite hero-bg"></i>
                <div style="position: relative; z-index: 2;">
                    <div class="badge badge-pill badge-warning mb-3 px-3 py-1 shadow-sm" style="font-weight: 800; font-size: 10px;">LIVE MONITORING</div>
                    <h2 class="mb-1">{{ $satellite->name }}</h2>
                    <p class="mb-0 text-white-50"><i class="fas fa-globe-asia mr-2"></i>Operator: {{ $satellite->country }}</p>

                    <div class="stats-container">
                        <div class="stat-box">
                            <div class="stat-label">Orbit Class</div>
                            <div class="stat-value">{{ $satellite->orbit_type }}</div>
                        </div>
                        <div class="stat-box">
                            <div class="stat-label">Alt (Perigee)</div>
                            <div class="stat-value">{{ $satellite->altitude }} <small>KM</small></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tle-card mb-4 shadow-lg">
                <div class="tle-card-header">
                    <div class="dot" style="background: #ff5f56;"></div>
                    <div class="dot" style="background: #ffbd2e;"></div>
                    <div class="dot" style="background: #27c93f;"></div>
                    <span class="ml-2 text-white-50 font-weight-bold small text-uppercase" style="letter-spacing: 1px;">Satellite Orbital Elements</span>
                </div>
                <div class="tle-body">
                    @php
                        // Memecah TLE menjadi Baris 1 dan Baris 2
                        $tle_data = explode("\n", trim($satellite->tle));
                    @endphp

                    <div class="tle-line-wrapper">
                        <div class="tle-label">Primary Identity (Line 1)</div>
                        <div class="tle-box">
                            <code>{{ $tle_data[0] ?? 'N/A' }}</code>
                        </div>
                    </div>

                    <div class="tle-line-wrapper">
                        <div class="tle-label">Orbital Parameters (Line 2)</div>
                        <div class="tle-box active">
                            <code>{{ $tle_data[1] ?? 'N/A' }}</code>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gs-card shadow-sm mb-4">
                <div class="gs-icon">
                    <i class="fas fa-broadcast-tower"></i>
                </div>
                <div>
                    <div class="text-small text-muted font-weight-bold text-uppercase" style="letter-spacing: 1px;">Command Station</div>
                    <h6 class="mb-0 text-dark">{{ $satellite->groundStation->name }}</h6>
                    <small class="text-muted"><i class="fas fa-map-marker-alt mr-1"></i>{{ $satellite->groundStation->location }}</small>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div id="map"></div>

            <div class="coords-floating d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small text-uppercase font-weight-bold" style="letter-spacing: 1px;">Latitude</span>
                    <div class="text-primary font-weight-bold h5 mb-0">{{ $satellite->groundStation->latitude }}</div>
                </div>
                <div class="text-right">
                    <span class="text-muted small text-uppercase font-weight-bold" style="letter-spacing: 1px;">Longitude</span>
                    <div class="text-primary font-weight-bold h5 mb-0">{{ $satellite->groundStation->longitude }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var lat = {{ $satellite->groundStation->latitude }};
        var lon = {{ $satellite->groundStation->longitude }};

        // Init Map
        var map = L.map('map', {
            center: [lat, lon],
            zoom: 12,
            zoomControl: false,
            attributionControl: false
        });

        // Layer Peta
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        // Control Zoom ke Kanan Bawah
        L.control.zoom({ position: 'bottomright' }).addTo(map);

        // Custom Glowing Pulse Marker
        var customIcon = L.divIcon({
            className: 'custom-marker',
            html: "<div style='background-color:#6777ef; width:18px; height:18px; border-radius:50%; border:3px solid white; box-shadow:0 0 20px rgba(103,119,239,0.8);'></div>",
            iconSize: [18, 18],
            iconAnchor: [9, 9]
        });

        L.marker([lat, lon], {icon: customIcon}).addTo(map)
            .bindPopup("<b style='font-family:Inter;'>{{ $satellite->groundStation->name }}</b>").openPopup();

        // Fix render delay
        setTimeout(function(){ map.invalidateSize(); }, 600);
    });
</script>
@endsection
