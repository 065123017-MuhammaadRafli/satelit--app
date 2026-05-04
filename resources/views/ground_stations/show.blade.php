@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Detail Stasiun Bumi: {{ $station->name }}</h4>
                    <a href="{{ route('ground-stations.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                </div>

                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">Nama Stasiun</th>
                            <td>: <strong>{{ $station->name }}</strong></td>
                        </tr>
                        <tr>
                            <th>Lokasi</th>
                            <td>: {{ $station->location }}</td>
                        </tr>
                        <tr>
                            <th>Negara</th>
                            <td>: {{ $station->country }}</td>
                        </tr>
                        <tr>
                            <th>Koordinat (Lat, Long)</th>
                            <td>: {{ $station->latitude }}, {{ $station->longitude }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah Satelit Dipantau</th>
                            <td>: <span class="badge bg-info">{{ $station->satellites->count() }} Satelit</span></td>
                        </tr>
                    </table>

                    <hr>

                    <h5 class="mb-3">Visualisasi Lokasi pada Peta</h5>
                    <div style="height: 300px;" class="bg-light rounded border overflow-hidden shadow-sm">
                        <iframe
                            width="100%"
                            height="100%"
                            frameborder="0"
                            style="border:0"
                            src="https://www.google.com/maps?q={{ $station->latitude }},{{ $station->longitude }}&hl=id&z=10&output=embed"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>

                <div class="card-footer bg-light d-flex justify-content-end gap-2">
                    <a href="{{ route('ground-stations.edit', $station->id) }}" class="btn btn-warning btn-sm">Edit Data</a>
                    <form action="{{ route('ground-stations.destroy', $station->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus stasiun bumi ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
