<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Satelit--App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; }
        .card { border: none; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .stat-icon { font-size: 2rem; opacity: 0.3; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-primary mb-4">
    <div class="container">
        <span class="navbar-brand mb-0 h1">🛰️ Satelit--App Monitoring</span>
        <div class="d-flex">
            <a href="{{ route('ground-stations.index') }}" class="btn btn-light btn-sm me-2">Ground Stations</a>
            <a href="{{ route('satellites.index') }}" class="btn btn-light btn-sm">Satellites</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row mb-4">
        <div class="col">
            <h2>Pusat Kontrol Satelit</h2>
            <p class="text-muted">Status pemantauan ruang angkasa saat ini.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card bg-white p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase text-muted small">Total Satelit</h6>
                        <h2 class="fw-bold">{{ $total_satellites }}</h2>
                    </div>
                    <div class="stat-icon text-primary">📡</div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card bg-white p-3 border-start border-success border-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase text-muted small">Satelit Aktif</h6>
                        <h2 class="fw-bold text-success">{{ $active_satellites }}</h2>
                    </div>
                    <div class="stat-icon text-success">✔️</div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card bg-white p-3 border-start border-info border-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase text-muted small">Ground Stations</h6>
                        <h2 class="fw-bold text-info">{{ $total_gs }}</h2>
                    </div>
                    <div class="stat-icon text-info">🌍</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="alert alert-info">
                <strong>Info:</strong> Gunakan menu di atas untuk menambah atau mengelola data satelit dan stasiun bumi.
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
