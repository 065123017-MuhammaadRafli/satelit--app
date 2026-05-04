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

    <div class="alert alert-info border-0 shadow-sm" role="alert">
        <strong>Info:</strong> Gunakan menu navigasi di atas untuk menambah, melihat, atau mengelola data satelit dan stasiun bumi.
    </div>
</div>
@endsection
