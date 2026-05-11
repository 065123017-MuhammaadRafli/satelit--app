@extends('layouts.stisla')

@section('content')
<style>
    /* Membuat card bisa diklik dan memiliki efek hover */
    .card-stats-clickable {
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none !important;
    }
    .card-stats-clickable:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .card-icon-custom {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        border-radius: 12px;
    }
</style>

<div class="section-header">
    <h1>Dashboard Monitoring</h1>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <a href="{{ route('satellites.index') }}" class="card card-statistic-1 shadow-sm card-stats-clickable">
                <div class="card-icon bg-primary">
                    <i class="fas fa-satellite"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Satelit</h4>
                    </div>
                    <div class="card-body text-dark">
                        {{ $totalSatelit }}
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <a href="{{ route('ground_stations.index') }}" class="card card-statistic-1 shadow-sm card-stats-clickable">
                <div class="card-icon bg-success">
                    <i class="fas fa-broadcast-tower"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Stasiun Bumi</h4>
                    </div>
                    <div class="card-body text-dark">
                        {{ $totalGS }}
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1 shadow-sm">
                <div class="card-icon bg-warning">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Satelit Aktif</h4>
                    </div>
                    <div class="card-body text-dark">
                        {{ $totalSatelit }}
                        <span class="text-muted small" style="font-size: 10px;">(100% Online)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-md-12 col-12 col-sm-12">
            <div class="card shadow-sm">
                <div class="card-header border-bottom">
                    <h4><i class="fas fa-chart-line text-primary mr-2"></i> Log Aktivitas Transmisi</h4>
                </div>
                <div class="card-body">
                    <canvas id="myChart" height="150"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-12 col-12 col-sm-12">
            <div class="card shadow-sm">
                <div class="card-header border-bottom">
                    <h4>Status Sistem</h4>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled list-unstyled-border">
                        <li class="media">
                            <div class="media-body">
                                <div class="float-right text-primary font-weight-bold">Online</div>
                                <div class="media-title">Server Monitoring</div>
                                <span class="text-small text-muted">Berjalan normal tanpa gangguan.</span>
                            </div>
                        </li>
                        <li class="media">
                            <div class="media-body">
                                <div class="float-right text-success font-weight-bold">Active</div>
                                <div class="media-title">API TLE Data</div>
                                <span class="text-small text-muted">Sinkronisasi data terakhir: 2 menit lalu.</span>
                            </div>
                        </li>
                        <li class="media">
                            <div class="media-body">
                                <div class="float-right text-danger font-weight-bold">Offline</div>
                                <div class="media-title">Backup Database</div>
                                <span class="text-small text-muted">Dijadwalkan malam ini pukul 00:00.</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"],
            datasets: [{
                label: 'Sinyal Diterima (MHz)',
                data: [640, 580, 670, 720, 600, 550, 690],
                borderWidth: 3,
                borderColor: '#6777ef',
                backgroundColor: 'rgba(103,119,239,0.1)',
                pointBackgroundColor: '#ffffff',
                pointRadius: 4,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true, grid: { display: false } },
                x: { grid: { display: false } }
            }
        }
    });
</script>
@endsection
