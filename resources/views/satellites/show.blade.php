@extends('layouts.stisla')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<style>
    .tle-box { background-color: #1a1a2e; color: #00ffcc; font-family: monospace; padding: 15px; border-radius: 8px; font-size: 14px; }
    .telemetry-card { border-radius: 15px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    .val-box { font-size: 22px; font-weight: bold; color: #6777ef; margin-top: 5px; }

    /* TITIK RADAR MERAH GLOWING */
    .satellite-dot {
        width: 14px;
        height: 14px;
        background-color: #ff3b30;
        border: 2px solid #ffffff;
        border-radius: 50%;
        box-shadow: 0 0 10px rgba(255, 59, 48, 0.8), 0 0 20px rgba(255, 59, 48, 0.6);
    }

    /* LABEL NAMA SATELIT DI PETA */
    .sat-label {
        background-color: rgba(255, 255, 255, 0.95);
        border: 1px solid #ccc;
        border-radius: 4px;
        font-weight: bold;
        color: #333;
        font-size: 11px;
        padding: 4px 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.3);
        white-space: nowrap;
    }

    /* Tombol Recenter */
    .recenter-btn {
        position: absolute;
        top: 15px;
        right: 15px;
        z-index: 1000;
        background: rgba(255,255,255,0.9);
        border: 1px solid #ccc;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        color: #333;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }
    .recenter-btn:hover { background: #fff; color: #6777ef; }
</style>

<div class="section-header">
    <div class="section-header-back">
        <a href="{{ route('satellites.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Telemetry Center</h1>
</div>

<div class="section-body">

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card telemetry-card mb-0">
                <div class="card-body d-flex align-items-center py-3">
                    <div class="mr-3" style="font-size: 35px; color: #3abaf4;"><i class="fas fa-arrows-alt-v"></i></div>
                    <div>
                        <div class="text-muted small font-weight-bold">LATITUDE</div>
                        <div class="val-box" id="live-lat">Menghitung...</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card telemetry-card mb-0">
                <div class="card-body d-flex align-items-center py-3">
                    <div class="mr-3" style="font-size: 35px; color: #47c363;"><i class="fas fa-arrows-alt-h"></i></div>
                    <div>
                        <div class="text-muted small font-weight-bold">LONGITUDE</div>
                        <div class="val-box" id="live-lon">Menghitung...</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card telemetry-card mb-0">
                <div class="card-body d-flex align-items-center py-3">
                    <div class="mr-3" style="font-size: 35px; color: #ffa426;"><i class="fas fa-satellite"></i></div>
                    <div>
                        <div class="text-muted small font-weight-bold">ALTITUDE</div>
                        <div class="val-box" id="live-alt">Menghitung...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card telemetry-card bg-primary text-white">
                <div class="card-body py-4">
                    <span class="badge badge-warning mb-2">LIVE MONITORING</span>
                    <h2 class="font-weight-bold">{{ $satellite->name }}</h2>
                    <p><i class="fas fa-globe"></i> Operator: {{ $satellite->country }}</p>
                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="text-white-50 small font-weight-bold">ORBIT CLASS</div>
                            <h4>{{ $satellite->orbit_type }}</h4>
                        </div>
                        <div class="col-6">
                            <div class="text-white-50 small font-weight-bold">STATUS</div>
                            <h4><span class="badge badge-success">Active</span></h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card telemetry-card bg-dark text-white mt-4">
                <div class="card-header border-0 pb-1">
                    <h4 class="text-white"><i class="fas fa-code mr-2"></i> ORBITAL ELEMENTS (TLE)</h4>
                </div>
                <div class="card-body pt-0">
                    <div class="text-muted small mb-1 mt-2">LINE 1</div>
                    <div class="tle-box mb-3" style="word-break: break-all; white-space: pre-wrap;">{{ explode("\n", str_replace("\r", "", $satellite->tle))[0] ?? 'N/A' }}</div>

                    <div class="text-muted small mb-1">LINE 2</div>
                    <div class="tle-box" style="word-break: break-all; white-space: pre-wrap;">{{ explode("\n", str_replace("\r", "", $satellite->tle))[1] ?? 'N/A' }}</div>
                </div>
            </div>

            <div class="card telemetry-card mt-4">
                <div class="card-body d-flex align-items-center">
                    <div class="mr-3" style="font-size: 30px; color: #6777ef;"><i class="fas fa-broadcast-tower"></i></div>
                    <div>
                        <div class="text-muted small font-weight-bold">GROUND STATION</div>
                        <h6 class="mb-0 font-weight-bold">{{ $satellite->groundStation->name ?? 'N/A' }}</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-8">
            <div class="card telemetry-card">
                <div class="card-body p-0 position-relative">
                    <button class="recenter-btn" onclick="recenterMap()">
                        <i class="fas fa-crosshairs"></i> Recenter
                    </button>
                    <div id="map-gs" style="height: 600px; border-radius: 12px; z-index: 1;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/satellite.js/4.0.0/satellite.min.js"></script>

<script>
    var map, satMarker, currentPosLatLng;

    document.addEventListener("DOMContentLoaded", function() {
        // 1. Setup Map
        map = L.map('map-gs', { center: [0, 0], zoom: 3, worldCopyJump: true });

        // 2. Hybrid Satellite Layer (Google Satellite + Labels)
        L.tileLayer('https://mt1.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
            attribution: '&copy; Google Maps Satellite',
            maxZoom: 18
        }).addTo(map);

        // 3. Satellite Icon
        var satIcon = L.divIcon({ className: 'satellite-dot', iconSize: [14, 14], iconAnchor: [7, 7] });
        satMarker = L.marker([0, 0], {icon: satIcon, zIndexOffset: 1000})
            .bindTooltip("{{ $satellite->name }}", { permanent: true, direction: 'right', className: 'sat-label', offset: [10, 0] })
            .addTo(map);

        // 4. Draw Full Orbit Prediction
        var tleData = `{!! str_replace("\r", "", $satellite->tle) !!}`;
        var lines = tleData.split('\n');
        if (lines.length >= 2) {
            var satrec = satellite.twoline2satrec(lines[0].trim(), lines[1].trim());
            var orbitCoords = [];
            var now = new Date();
            for(var i = -45; i <= 45; i++) {
                var time = new Date(now.getTime() + i * 60000);
                var posVel = satellite.propagate(satrec, time);
                var gmst = satellite.gstime(time);
                if (posVel.position) {
                    var gd = satellite.eciToGeodetic(posVel.position, gmst);
                    var lng = satellite.degreesLong(gd.longitude);
                    var lat = satellite.degreesLat(gd.latitude);
                    if (orbitCoords.length > 0) {
                        if (Math.abs(lng - orbitCoords[orbitCoords.length - 1][1]) > 180) {
                            L.polyline(orbitCoords, {color: '#ff3b30', weight: 2, opacity: 0.6}).addTo(map);
                            orbitCoords = [];
                        }
                    }
                    orbitCoords.push([lat, lng]);
                }
            }
            L.polyline(orbitCoords, {color: '#ff3b30', weight: 2, opacity: 0.6}).addTo(map);
        }

        // 5. Live Tracking Update
        function updatePosition() {
            fetch(`/api/satellites/{{ $satellite->id }}/track`)
                .then(res => res.json())
                .then(data => {
                    if(data.status !== 'error') {
                        currentPosLatLng = [data.latitude, data.longitude];
                        satMarker.setLatLng(currentPosLatLng);
                        document.getElementById('live-lat').innerText = data.latitude + '°';
                        document.getElementById('live-lon').innerText = data.longitude + '°';
                        document.getElementById('live-alt').innerText = data.altitude + ' km';
                    }
                });
        }

        updatePosition();
        setInterval(updatePosition, 3000);
        setTimeout(recenterMap, 1500);
    });

    function recenterMap() {
        if(currentPosLatLng) map.setView(currentPosLatLng, 4, { animate: true });
    }
</script>
@endsection
