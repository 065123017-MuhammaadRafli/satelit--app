@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
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
                            <th>Koordinat</th>
                            <td>: {{ $station->latitude }}, {{ $station->longitude }}</td>
                        </tr>
                        <tr>
                            <th>Daftar Satelit Dipantau</th>
                            <td>
                                <ul class="list-group list-group-flush mt-2">
                                    @forelse($station->satellites as $sat)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $sat->name }}
                                            <span class="badge bg-secondary">{{ $sat->orbit_type }}</span>
                                        </li>
                                    @empty
                                        <li class="list-group-item text-muted">Tidak ada satelit yang dipantau stasiun ini.</li>
                                    @endforelse
                                </ul>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
