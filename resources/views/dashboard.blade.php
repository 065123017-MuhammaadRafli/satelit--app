@extends('layouts.stisla')

@section('content')
<div class="section-header">
    <h1>Dashboard Monitoring</h1>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1 shadow-sm">
                <div class="card-icon bg-primary">
                    <i class="fas fa-satellite"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header"><h4>Total Satelit</h4></div>
                    <div class="card-body">{{ $total_satellites }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1 shadow-sm">
                <div class="card-icon bg-success">
                    <i class="fas fa-broadcast-tower"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header"><h4>Stasiun Bumi</h4></div>
                    <div class="card-body">{{ $total_gs }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1 shadow-sm">
                <div class="card-icon bg-warning">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header"><h4>Satelit Aktif</h4></div>
                    <div class="card-body">{{ $active_satellites }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-md-12 col-12 col-sm-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4>Log Aktivitas Transmisi</h4>
                </div>
                <div class="card-body">
                    <canvas id="myChart" height="150"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-12 col-12 col-sm-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4>Status Sistem</h4>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled list-unstyled-border">
                        <li class="media">
                            <div class="media-body">
                                <div class="badge badge-pill badge-success float-right">Online</div>
                                <h6 class="media-title">Server Monitoring</h6>
                                <div class="text-small text-muted">Berjalan normal</div>
                            </div>
                        </li>
                        <li class="media">
                            <div class="media-body">
                                <div class="badge badge-pill badge-success float-right">Active</div>
                                <h6 class="media-title">API TLE Data</h6>
                                <div class="text-small text-muted">Sinkronisasi berhasil</div>
                            </div>
                        </li>
                        <li class="media">
                            <div class="media-body">
                                <div class="badge badge-pill badge-danger float-right">Maintenance</div>
                                <h6 class="media-title">Backup Database</h6>
                                <div class="text-small text-muted">Dijadwalkan malam ini</div>
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
                borderWidth: 2,
                backgroundColor: 'rgba(103, 119, 239, 0.2)',
                borderColor: '#6777ef',
                pointBackgroundColor: '#ffffff',
                pointRadius: 4
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection
