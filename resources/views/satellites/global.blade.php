@extends('layouts.stisla')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    /* Card & UI Styling */
    .sat-card-wrapper { transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    .sat-card {
        border-radius: 15px; border: none;
        border-top: 5px solid #6777ef;
        background: #fff;
        cursor: pointer;
    }
    .sat-card:hover { transform: translateY(-8px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }
    .stat-label { font-size: 10px; color: #999; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; }
    .stat-value { font-size: 15px; font-weight: 700; color: #2d3436; }

    #global-map { height: 580px; border-radius: 0 0 15px 15px; z-index: 1; background: #191d21; }

    .map-header {
        background: #191d21; color: white; padding: 15px 25px;
        border-radius: 15px 15px 0 0; display: flex;
        justify-content: space-between; align-items: center;
    }

    /* Button "Establish Connection" Style */
    .btn-connection {
        background: linear-gradient(45deg, #ffa426, #ff8c00);
        color: white; border: none; font-weight: 800;
        padding: 10px 25px; border-radius: 30px;
        text-transform: uppercase; font-size: 11px; letter-spacing: 1.5px;
        box-shadow: 0 4px 15px rgba(255, 164, 38, 0.4);
        transition: all 0.3s;
    }
    .btn-connection:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(255, 164, 38, 0.6); color: white; }

    /* Dropdown Panel */
    .filter-dropdown {
        position: absolute; top: 75px; right: 25px; z-index: 1050;
        background: #ffffff; padding: 22px; border-radius: 15px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.25); width: 300px; display: none;
        border: 1px solid rgba(0,0,0,0.05);
    }
    .filter-dropdown.show { display: block; animation: slideDown 0.4s ease; }

    @keyframes slideDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }

    .sat-label-map {
        background: #191d21 !important; color: #00ff00 !important;
        border: 1px solid #444 !important; border-radius: 5px !important;
        padding: 3px 10px !important; font-size: 10px !important; font-weight: bold;
    }
</style>

<div class="section-header">
    <h1>Strategic Orbital Command</h1>
</div>

<div class="section-body">
    <!-- 1. SATELLITE CARDS AREA -->
    <div class="row" id="card-container">
        @foreach($satellites as $sat)
        <div class="col-lg-4 col-md-6 sat-card-wrapper" id="wrapper-{{ $sat->id }}" style="display: none;">
            <div class="card sat-card shadow-sm mb-4" onclick="focusSatellite('{{ $sat->id }}')">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-satellite-dish mr-2"></i> {{ $sat->name }}</h6>
                        <div class="d-flex align-items-center">
                            <span class="badge badge-success shadow-sm" style="font-size: 9px; border-radius: 10px;">SYNCED</span>
                        </div>
                    </div>
                    <div class="row no-gutters text-center">
                        <div class="col-3 border-right">
                            <div class="stat-label">Lat</div>
                            <div class="stat-value" id="lat-{{ $sat->id }}">-</div>
                        </div>
                        <div class="col-3 border-right">
                            <div class="stat-label">Lng</div>
                            <div class="stat-value" id="lng-{{ $sat->id }}">-</div>
                        </div>
                        <div class="col-3 border-right">
                            <div class="stat-label">Alt</div>
                            <div class="stat-value text-success" id="alt-{{ $sat->id }}">-</div>
                        </div>
                        <div class="col-3">
                            <div class="stat-label">Speed</div>
                            <div class="stat-value text-info">7.6</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- 2. MAP AREA WITH COMMAND HEADER -->
    <div class="position-relative">
        <div class="map-header shadow">
            <h6 class="m-0 font-weight-bold text-white"><i class="fas fa-microchip text-warning mr-2"></i> Global Fleet Tracking System</h6>
            <div>
                <button class="btn btn-connection" onclick="toggleFilter(event)">
                    <i class="fas fa-network-wired mr-2"></i> Launch Interface
                </button>
            </div>
        </div>

        <!-- Dropdown Filter with "Show All" Feature -->
        <div class="filter-dropdown" id="filterMenu">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                <span class="font-weight-bold text-dark small text-uppercase">System Control</span>
                <button class="btn btn-primary btn-sm" style="font-size: 9px; border-radius: 20px;" onclick="toggleAllSatellites(true)">
                    ACTIVATE ALL
                </button>
            </div>

            @foreach($satellites as $sat)
            <div class="custom-control custom-switch mb-3">
                <input type="checkbox" class="custom-control-input sat-toggle"
                       id="switch-{{ $sat->id }}" data-id="{{ $sat->id }}">
                <label class="custom-control-label small font-weight-bold text-dark" for="switch-{{ $sat->id }}" style="cursor: pointer;">
                    Engage {{ $sat->name }}
                </label>
            </div>
            @endforeach

            <div class="mt-3 pt-2 text-center border-top">
                <a href="javascript:void(0)" class="text-danger small font-weight-bold" onclick="toggleAllSatellites(false)">
                    <i class="fas fa-power-off mr-1"></i> Emergency Shutdown
                </a>
            </div>
        </div>

        <div id="global-map" class="shadow-lg"></div>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/satellite.js/4.0.0/satellite.min.js"></script>

<script>
    var map = L.map('global-map', { center: [0, 0], zoom: 2.5, worldCopyJump: true });
    L.tileLayer('https://mt1.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', { attribution: '&copy; Google Maps' }).addTo(map);

    var satLayers = {};
    var satellitesData = @json($satellites);
    var orbitColors = ['#00ff00', '#ff3b30', '#00e5ff', '#f1c40f'];

    function initSystem() {
        satellitesData.forEach((sat, index) => {
            var color = orbitColors[index % orbitColors.length];
            var group = L.layerGroup();

            var icon = L.divIcon({
                className: 'sat-icon',
                html: `<div style="background:${color}; width:14px; height:14px; border:2px solid #fff; border-radius:50%; box-shadow: 0 0 15px ${color};"></div>`,
                iconSize: [14, 14], iconAnchor: [7, 7]
            });

            var marker = L.marker([0, 0], {icon: icon})
                .bindTooltip(sat.name, { permanent: true, direction: 'bottom', className: 'sat-label-map', offset: [0, 10] });

            group.addLayer(marker);
            satLayers[sat.id] = { group: group, marker: marker, color: color, tle: sat.tle };
            drawOrbit(sat.id);
        });
    }

    function drawOrbit(satId) {
        var sat = satLayers[satId];
        var lines = sat.tle.split('\n');
        var satrec = satellite.twoline2satrec(lines[0].trim(), lines[1].trim());
        var now = new Date();
        var segments = [[]];
        var currentSegment = 0;

        for (var i = -50; i <= 50; i++) {
            var time = new Date(now.getTime() + i * 60000);
            var posVel = satellite.propagate(satrec, time);
            var gmst = satellite.gstime(time);
            if (posVel.position) {
                var gd = satellite.eciToGeodetic(posVel.position, gmst);
                var lat = satellite.degreesLat(gd.latitude);
                var lng = satellite.degreesLong(gd.longitude);
                if (segments[currentSegment].length > 0) {
                    var lastLng = segments[currentSegment][segments[currentSegment].length - 1][1];
                    if (Math.abs(lng - lastLng) > 180) { currentSegment++; segments[currentSegment] = []; }
                }
                segments[currentSegment].push([lat, lng]);
            }
        }
        segments.forEach(points => {
            if (points.length > 1) {
                L.polyline(points, {color: sat.color, weight: 1.5, opacity: 0.5, dashArray: '5, 8'}).addTo(sat.group);
            }
        });
    }

    // New Feature: Toggle All Satellites
    function toggleAllSatellites(status) {
        document.querySelectorAll('.sat-toggle').forEach(checkbox => {
            if (checkbox.checked !== status) {
                checkbox.checked = status;
                checkbox.dispatchEvent(new Event('change'));
            }
        });
    }

    document.querySelectorAll('.sat-toggle').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            var id = this.getAttribute('data-id');
            var cardWrapper = document.getElementById('wrapper-' + id);

            if (this.checked) {
                cardWrapper.style.display = 'block';
                map.addLayer(satLayers[id].group);
            } else {
                cardWrapper.style.display = 'none';
                map.removeLayer(satLayers[id].group);
            }
        });
    });

    function updateLive() {
        satellitesData.forEach(sat => {
            fetch(`/api/satellites/${sat.id}/track`)
                .then(res => res.json())
                .then(data => {
                    if(data.status !== 'error') {
                        satLayers[sat.id].marker.setLatLng([data.latitude, data.longitude]);
                        document.getElementById(`lat-${sat.id}`).innerText = data.latitude.toFixed(2);
                        document.getElementById(`lng-${sat.id}`).innerText = data.longitude.toFixed(2);
                        document.getElementById(`alt-${sat.id}`).innerText = data.altitude.toFixed(0) + ' km';
                    }
                });
        });
    }

    function focusSatellite(satId) {
        var pos = satLayers[satId].marker.getLatLng();
        map.flyTo([pos.lat, pos.lng], 5, { animate: true });
    }

    function toggleFilter(e) { e.stopPropagation(); document.getElementById('filterMenu').classList.toggle('show'); }
    window.onclick = function() { document.getElementById('filterMenu').classList.remove('show'); }

    initSystem();
    updateLive();
    setInterval(updateLive, 5000);
</script>
@endsection
