@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="p-4 mb-4 bg-white rounded-3 shadow-sm border-0">
        <div class="container-fluid py-2">
            <h2 class="display-5 fw-bold">Pusat Kontrol Satelit</h2>
            <p class="col-md-8 fs-5 text-muted">Status pemantauan ruang angkasa saat ini. Kelola data satelit dan stasiun bumi secara mudah.</p>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-xl-4 col-md-6">
            <div class="card border-0 shadow-sm h-100 bg-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-muted small fw-bold">Total Satelit</h6>
                            <h2 class="h1 fw-bold mb-0 text-primary">{{ $total_satellites ?? 0 }}</h2>
                        </div>
                        <div>
                            <span class="fs-1 text-primary">🛰️</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card border-0 shadow-sm h-100 bg-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-muted small fw-bold">Satelit Aktif</h6>
                            <h2 class="h1 fw-bold mb-0 text-success">{{ $active_satellites ?? 0 }}</h2>
                        </div>
                        <div>
                            <span class="fs-1 text-success">🟢</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card border-0 shadow-sm h-100 bg-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-muted small fw-bold">Ground Stations</h6>
                            <h2 class="h1 fw-bold mb-0 text-info">{{ $total_gs ?? 0 }}</h2>
                        </div>
                        <div>
                            <span class="fs-1 text-info">🌍</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100 bg-white">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h5 class="fw-bold mb-0">Distribusi Satelit Berdasarkan Orbit</h5>
                </div>
                <div class="card-body">
                    <canvas id="orbitChart" height="120"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100 bg-white">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h5 class="fw-bold mb-0">Status Sistem Monitoring</h5>
                </div>
                <div class="card-body d-flex flex-column justify-content-center">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Akurasi Data TLE
                            <span class="badge bg-success rounded-pill">100% Valid</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Sistem Database
                            <span class="badge bg-info rounded-pill">Connected</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Versi Laravel
                            <span class="badge bg-dark rounded-pill">Laravel 13</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="alert alert-info border-0 shadow-sm mt-4" role="alert">
        <strong>Info:</strong> Gunakan menu navigasi di atas untuk menambah, melihat, atau mengelola data satelit dan stasiun bumi.
    </div>
</div>

<script>
    const ctx = document.getElementById('orbitChart').getContext('2d');
    const orbitChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['LEO (Low Earth Orbit)', 'MEO (Medium Earth Orbit)', 'GEO (Geostationary Orbit)'],
            datasets: [{
                label: 'Jumlah Satelit',
                data: [{{ $leo_count }}, {{ $meo_count }}, {{ $geo_count }}],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });
</script>
@endsection
