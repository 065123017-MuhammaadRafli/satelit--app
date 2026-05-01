@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Detail Satelit: {{ $satellite->name }}</h4>
                    <a href="{{ route('satellites.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                </div>

                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">Nama Satelit</th>
                            <td>: <strong>{{ $satellite->name }}</strong></td>
                        </tr>
                        <tr>
                            <th>Stasiun Bumi</th>
                            <td>: <span class="badge bg-info text-dark">{{ $satellite->groundStation->name ?? 'N/A' }}</span></td>
                        </tr>
                        <tr>
                            <th>Negara Pemilik</th>
                            <td>: {{ $satellite->owner_country }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Peluncuran</th>
                            <td>: {{ \Carbon\Carbon::parse($satellite->launch_date)->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <th>Tipe Orbit</th>
                            <td>: <span class="badge bg-secondary">{{ $satellite->orbit_type }}</span></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>:
                                <span class="badge {{ $satellite->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $satellite->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Data TLE</th>
                            <td>
                                <div class="p-3 bg-light rounded border font-monospace small">
                                    {{ $satellite->tle }}
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="card-footer bg-light d-flex justify-content-end gap-2">
                    <a href="{{ route('satellites.edit', $satellite->id) }}" class="btn btn-warning btn-sm">Edit Data</a>
                    <form action="{{ route('satellites.destroy', $satellite->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus satelit ini?')">
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
