@extends('layouts.stisla')

@section('content')
<div class="section-header">
    <div class="section-header-back">
        <a href="{{ route('ground-stations.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Detail Stasiun Bumi</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('ground-stations.index') }}">Stasiun Bumi</a></div>
        <div class="breadcrumb-item">Detail</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header">
                    <h4><i class="fas fa-info-circle mr-2 text-primary"></i> Informasi Utama</h4>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <label class="text-muted small font-weight-bold">Nama Stasiun</label>
                        <h4 class="text-dark font-weight-700">{{ $ground_station->name }}</h4>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="text-muted small font-weight-bold">Lokasi</label>
                            <p class="text-dark mb-0">{{ $ground_station->location }}</p>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="text-muted small font-weight-bold">Negara</label>
                            <div><span class="badge badge-light border text-capitalize">{{ $ground_station->country }}</span></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted small font-weight-bold">Koordinat (Lat, Long)</label>
                        <p class="text-primary font-weight-bold mb-0">
                            <i class="fas fa-map-marker-alt mr-1"></i> {{ $ground_station->latitude }}, {{ $ground_station->longitude }}
                        </p>
                    </div>

                    <div class="mb-4">
                        <label class="text-muted small font-weight-bold">Status Monitoring</label>
                        <div>
                            <span class="badge badge-success px-3 rounded-pill">
                                <i class="fas fa-satellite mr-1"></i> {{ $ground_station->satellites_count ?? 0 }} Satelit Terpantau
                            </span>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top d-flex gap-2">
                        <a href="{{ route('ground-stations.edit', $ground_station->id) }}" class="btn btn-warning btn-lg btn-icon icon-left flex-grow-1">
                            <i class="fas fa-edit"></i> Edit Data
                        </a>
                        <form action="{{ route('ground-stations.destroy', $ground_station->id) }}" method="POST" class="flex-grow-1" onsubmit="return confirm('Hapus data stasiun ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-lg btn-icon icon-left w-100">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header">
                    <h4><i class="fas fa-map-marked-alt mr-2 text-primary"></i> Visualisasi Lokasi</h4>
                </div>
                <div class="card-body d-flex flex-column">
                    <div class="flex-grow-1 rounded overflow-hidden mb-3 shadow-inner" style="min-height: 300px; border: 1px solid #eee;">
                        <iframe
                            width="100%"
                            height="100%"
                            frameborder="0"
                            style="border:0;"
                            src="https://www.google.com/maps?q={{ $ground_station->latitude }},{{ $ground_station->longitude }}&hl=id&z=12&output=embed"
                            allowfullscreen>
                        </iframe>
                    </div>
                    <a href="https://www.google.com/maps/search/?api=1&query={{ $ground_station->latitude }},{{ $ground_station->longitude }}" target="_blank" class="btn btn-outline-primary btn-block py-2">
                        <i class="fas fa-external-link-alt mr-1"></i> Buka di Google Maps
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
