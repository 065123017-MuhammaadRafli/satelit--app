@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="p-4 mb-4 bg-white rounded-4 shadow-sm border-0">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h2 class="fw-bold text-dark mb-1">Pusat Kontrol Satelit</h2>
                <p class="text-muted fs-6 mb-0">Status pemantauan ruang angkasa saat ini. Kelola data satelit dan stasiun bumi secara mudah.</p>
            </div>
            <div class="text-muted small mt-2 mt-md-0">
                <i class="bi bi-clock"></i> {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-xl-4 col-md-6">
            <div class="card border-0 shadow-sm h-100 rounded-4" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); color: white;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-white-50 small fw-bold mb-1">Total Satelit</h6>
                            <h2 class="fw-bold mb-0">{{ $total_satellites ?? 0 }}</h2>
                        </div>
                        <div>
                            <span class="fs-1 opacity-75">🛰️</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card border-0 shadow-sm h-100 rounded-4" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-white-50 small fw-bold mb-1">Satelit Aktif</h6>
                            <h2 class="fw-bold mb-0">{{ $active_satellites ?? 0 }}</h2>
                        </div>
                        <div>
                            <span class="fs-1 opacity-75">🟢</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card border-0 shadow-sm h-100 rounded-4" style="background: linear-gradient(135deg, #8e2de2 0%, #4a00e0 100%); color: white;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-white-50 small fw-bold mb-1">Ground Stations</h6>
                            <h2 class="fw-bold mb-0">{{ $total_gs ?? 1 }}</h2>
                        </div>
                        <div>
                            <span class="fs-1 opacity-75">🌍</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-white rounded-4">
                <div class="card-body p-4 d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <h5 class="fw-bold text-dark mb-0">Akses Cepat</h5>
                        <p class="text-muted small mb-0">Kelola data ruang angkasa dengan cepat menggunakan pintasan di bawah ini.</p>
                    </div>
                    <div class="mt-3 mt-md-0 d-flex gap-2">
                        <a href="{{ route('satellites.create') }}" class="btn btn-primary rounded-3 px-4 py-2 fw-bold shadow-sm">
                            + Tambah Satelit
                        </a>
                        <a href="{{ route('satellites.index') }}" class="btn btn-outline-secondary rounded-3 px-4 py-2 fw-bold">
                            Kelola Data
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm bg-white rounded-4 h-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold text-dark mb-4">📊 Grafik Analitik Sistem</h5>
                    <div class="d-flex justify-content-center align-items-center" style="height: 250px;">
                        <canvas id="monitoringChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm bg-white rounded-4 h-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold text-dark mb-4">ℹ️ Status dan Informasi Sistem</h5>
                    <div class="alert alert-info border-0 rounded-4 p-4 shadow-sm" role="alert">
                        <div class="d-flex">
                            <div class="me-3 fs-3">💡</div>
                            <div>
                                <h6 class="fw-bold text-info mb-1">Catatan Penggunaan</h6>
                                <p class="mb-0 small text-dark opacity-75">Gunakan menu navigasi di atas untuk menambah, melihat, atau mengelola data satelit dan stasiun bumi secara real-time.</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between text-muted small mt-4">
                        <div>
                            <strong>Sistem Status:</strong> <span class="badge bg-success bg-opacity-75 px-3 py-1 rounded-pill">Online</span>
                        </div>
                        <div>
                            Versi Aplikasi: v1.0.0
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('monitoringChart').getContext('2d');
    const monitoringChart = new Chart(ctx, {
        type: 'doughnut', // Diubah menjadi doughnut agar lebih elegan
        data: {
            labels: ['Total Satelit', 'Satelit Aktif', 'Ground Stations'],
            datasets: [{
                label: 'Jumlah Data',
                data: [
                    {{ $total_satellites ?? 0 }},
                    {{ $active_satellites ?? 0 }},
                    {{ $total_gs ?? 1 }}
                ],
                backgroundColor: [
                    'rgba(30, 60, 114, 0.8)',
                    'rgba(17, 153, 142, 0.8)',
                    'rgba(142, 45, 226, 0.8)'
                ],
                borderColor: [
                    '#1e3c72',
                    '#11998e',
                    '#8e2de2'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
@endsection
