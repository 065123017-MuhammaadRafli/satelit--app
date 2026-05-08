@extends('layouts.stisla')

@section('content')
<div class="section-header">
    <h1>Pusat Kontrol Satelit</h1>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card card-statistic-1 shadow-sm">
                <div class="card-icon bg-primary"><i class="fas fa-satellite"></i></div>
                <div class="card-wrap">
                    <div class="card-header"><h4>Total Satelit</h4></div>
                    <div class="card-body">{{ $total_satellites }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card card-statistic-1 shadow-sm">
                <div class="card-icon bg-success"><i class="fas fa-check-circle"></i></div>
                <div class="card-wrap">
                    <div class="card-header"><h4>Satelit Aktif</h4></div>
                    <div class="card-body">{{ $active_satellites }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card card-statistic-1 shadow-sm">
                <div class="card-icon bg-warning"><i class="fas fa-broadcast-tower"></i></div>
                <div class="card-wrap">
                    <div class="card-header"><h4>Stasiun Bumi</h4></div>
                    <div class="card-body">{{ $total_gs }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card card-statistic-1 shadow-sm">
                <div class="card-icon bg-info"><i class="fas fa-bolt"></i></div>
                <div class="card-wrap">
                    <div class="card-header"><h4>Sistem</h4></div>
                    <div class="card-body">Online</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-md-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4>Monitor Sinyal (Real-time)</h4>
                </div>
                <div class="card-body">
                    <canvas id="lineChart" height="120"></canvas>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header">
                    <h4>Log Aktivitas Terbaru</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm mb-0">
                            <thead>
                                <tr>
                                    <th class="pl-4">Status</th>
                                    <th>Aktivitas</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="pl-4"><span class="badge badge-success">Success</span></td>
                                    <td class="font-weight-600">Sinkronisasi Palapa-D</td>
                                    <td class="text-muted small">Baru saja</td>
                                </tr>
                                <tr>
                                    <td class="pl-4"><span class="badge badge-primary">New</span></td>
                                    <td class="font-weight-600 text-capitalize">GS-{{ $total_gs > 0 ? 'Aktif' : 'Demo' }} Ditambahkan</td>
                                    <td class="text-muted small">2 Jam lalu</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4>Penyebaran Orbit</h4>
                </div>
                <div class="card-body">
                    <canvas id="orbitPieChart" height="250"></canvas>
                    <div class="mt-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span><i class="fas fa-circle text-primary mr-1"></i> LEO</span>
                            <span class="font-weight-bold">{{ $leo_count }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span><i class="fas fa-circle text-warning mr-1"></i> MEO</span>
                            <span class="font-weight-bold">{{ $meo_count }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span><i class="fas fa-circle text-danger mr-1"></i> GEO</span>
                            <span class="font-weight-bold">{{ $geo_count }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Line Chart
    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: ['00:00', '04:00', '08:00', '12:00', '16:00', '20:00'],
            datasets: [{
                label: 'Signal (dB)',
                data: [60, 75, 55, 90, 70, 85],
                borderColor: '#6777ef',
                backgroundColor: 'rgba(103, 119, 239, 0.1)',
                fill: true, tension: 0.3
            }]
        }
    });

    // Pie Chart
    new Chart(document.getElementById('orbitPieChart'), {
        type: 'pie',
        data: {
            labels: ['LEO', 'MEO', 'GEO'],
            datasets: [{
                data: [{{ $leo_count }}, {{ $meo_count }}, {{ $geo_count }}],
                backgroundColor: ['#6777ef', '#ffa426', '#fc544b']
            }]
        },
        options: { plugins: { legend: { display: false } } }
    });
</script>
@endsection
