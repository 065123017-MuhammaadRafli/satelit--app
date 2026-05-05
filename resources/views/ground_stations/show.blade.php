@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="p-4 mb-4 bg-white rounded-4 shadow-sm border-0">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h3 class="fw-bold text-dark mb-1">🌍 Detail Stasiun Bumi: {{ $ground_station->name }}</h3>
                <p class="text-muted fs-6 mb-0">Informasi lengkap dan lokasi stasiun bumi yang terdaftar.</p>
            </div>
            <div>
                <a href="{{ route('ground-stations.index') }}" class="btn btn-outline-secondary rounded-3 px-4 py-2 fw-bold shadow-sm">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-primary mb-4">Informasi Utama</h5>

                    <div class="mb-3 border-bottom pb-3">
                        <span class="text-muted d-block small fw-bold mb-1">Nama Stasiun</span>
                        <span class="fs-5 fw-bold text-dark">{{ $ground_station->name }}</span>
                    </div>

                    <div class="mb-3 border-bottom pb-3">
                        <span class="text-muted d-block small fw-bold mb-1">Lokasi</span>
                        <span class="fs-6 text-secondary">{{ $ground_station->location }}</span>
                    </div>

                    <div class="mb-3 border-bottom pb-3">
                        <span class="text-muted d-block small fw-bold mb-1">Negara</span>
                        <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary px-3 py-1 rounded-pill">
                            {{ $ground_station->country }}
                        </span>
                    </div>

                    <div class="mb-3 border-bottom pb-3">
                        <span class="text-muted d-block small fw-bold mb-1">Koordinat (Lat, Long)</span>
                        <code class="fs-6 text-primary fw-semibold">
                            {{ $ground_station->latitude }}, {{ $ground_station->longitude }}
                        </code>
                    </div>

                    <div class="mb-4">
                        <span class="text-muted d-block small fw-bold mb-1">Jumlah Satelit Dipantau</span>
                        <span class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-1 rounded-pill">
                            {{ $ground_station->satellites_count ?? 0 }} Satelit
                        </span>
                    </div>

                    <div class="d-flex gap-2 mt-4 pt-3 border-top">
                        <a href="{{ route('ground-stations.edit', $ground_station->id) }}" class="btn btn-warning text-dark fw-bold px-4 py-2 rounded-3 shadow-sm flex-fill">
                            ✏️ Edit Data
                        </a>

                        <form action="{{ route('ground-stations.destroy', $ground_station->id) }}" method="POST" class="flex-fill" onsubmit="return confirm('Yakin ingin menghapus stasiun bumi ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger text-white fw-bold px-4 py-2 rounded-3 shadow-sm w-100">
                                🗑️ Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4 d-flex flex-column">
                    <h5 class="fw-bold text-primary mb-3"> Visualisasi Lokasi pada Peta</h5>

                    <div class="flex-grow-1 rounded-3 overflow-hidden shadow-sm mb-3" style="min-height: 280px; position: relative;">
                        <iframe
                            width="100%"
                            height="100%"
                            frameborder="0"
                            style="border:0;"
                            src="https://maps.google.com/maps?q={{ $ground_station->latitude }},{{ $ground_station->longitude }}&hl=id&z=14&output=embed"
                            allowfullscreen=""
                            loading="lazy">
                        </iframe>
                    </div>

                    <div class="d-grid">
                        <a href="https://www.google.com/maps?q={{ $ground_station->latitude }},{{ $ground_station->longitude }}" target="_blank" class="btn btn-outline-primary py-2 fw-semibold rounded-3 shadow-sm">
                            Buka di Google Maps ↗
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
