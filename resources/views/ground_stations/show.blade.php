@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0 rounded-4">

                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3 px-4 rounded-top-4">
                    <h4 class="mb-0 fw-bold">🌍 Detail Stasiun Bumi: {{ $station->name }}</h4>
                    <a href="{{ route('ground-stations.index') }}" class="btn btn-light btn-sm fw-bold text-primary px-3">
                        Kembali
                    </a>
                </div>

                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle mb-0">
                            <tr>
                                <th width="35%" class="text-muted fw-semibold">Nama Stasiun</th>
                                <td class="fw-bold fs-5 text-dark">: {{ $station->name }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted fw-semibold">Lokasi</th>
                                <td>: {{ $station->location }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted fw-semibold">Negara</th>
                                <td>: {{ $station->country }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted fw-semibold">Koordinat (Lat, Long)</th>
                                <td>: <code>{{ $station->latitude }}</code>, <code>{{ $station->longitude }}</code></td>
                            </tr>
                            <tr>
                                <th class="text-muted fw-semibold">Jumlah Satelit Dipantau</th>
                                <td>
                                    : <span class="badge bg-info bg-opacity-10 text-info border border-info px-3 py-2 rounded-pill">
                                        {{ $station->satellites->count() }} Satelit
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3 fw-bold text-dark">📍 Visualisasi Lokasi pada Peta</h5>
                    <div style="height: 350px;" class="bg-light rounded-3 border overflow-hidden shadow-sm">
                        <iframe
                            width="100%"
                            height="100%"
                            frameborder="0"
                            style="border:0"
                            src="https://maps.google.com/maps?q={{ $station->latitude }},{{ $station->longitude }}&hl=id&z=10&output=embed"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>

                <div class="card-footer bg-light border-0 d-flex justify-content-end gap-2 py-3 px-4 rounded-bottom-4">
                    <a href="{{ route('ground-stations.edit', $station->id) }}" class="btn btn-warning text-dark fw-bold px-4">
                        Edit Data
                    </a>
                    <form action="{{ route('ground-stations.destroy', $station->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus stasiun bumi ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger fw-bold px-4">Hapus</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
