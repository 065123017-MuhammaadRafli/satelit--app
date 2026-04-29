<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Satelit-App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { 
            background-color: #f4f6f9; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar-brand { font-weight: 700; letter-spacing: 1px; }
        .card { 
            border: none; 
            border-radius: 12px; 
            box-shadow: 0 4px 6px rgba(0,0,0,0.05); 
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card:hover { 
            transform: translateY(-5px); 
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }
        .stat-icon { 
            font-size: 2.5rem; 
            opacity: 0.8; 
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="bi bi-globe-americas me-2 text-primary"></i>Satelit--App</a>
            <div class="d-flex">
                <a href="{{ route('ground-stations.index') }}" class="btn btn-outline-light btn-sm me-2">
                    <i class="bi bi-hdd-network"></i> Ground Stations
                </a>
                <a href="{{ route('satellites.index') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-rocket-takeoff"></i> Satellites
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row mb-4">
            <div class="col">
                <h2 class="fw-bold text-dark">Pusat Kontrol Satelit</h2>
                <p class="text-muted">Status pemantauan ruang angkasa dan stasiun bumi saat ini.</p>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card bg-primary text-white h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-1 fw-bold">Total Satelit Aktif</h6>
                            <h2 class="mb-0">12</h2> </div>
                        <i class="bi bi-rocket stat-icon text-white"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card bg-success text-white h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-1 fw-bold">Stasiun Bumi</h6>
                            <h2 class="mb-0">5</h2>
                        </div>
                        <i class="bi bi-broadcast stat-icon text-white"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card bg-warning text-dark h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-1 fw-bold">Status Sistem</h6>
                            <h4 class="mb-0 mt-2">Normal</h4>
                        </div>
                        <i class="bi bi-activity stat-icon text-dark"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-bold border-bottom pb-2 mb-3">Aktivitas Terbaru</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-check-circle-fill text-success me-2"></i> Koneksi ke Satelit Palapa-D berhasil.</span>
                                <span class="badge bg-secondary rounded-pill">10 min ago</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-exclamation-triangle-fill text-warning me-2"></i> Pemeliharaan Stasiun Bumi Jakarta.</span>
                                <span class="badge bg-secondary rounded-pill">1 hour ago</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>