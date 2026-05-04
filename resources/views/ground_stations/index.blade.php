@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>🌍 Daftar Ground Station</h2>
        <a href="{{ route('ground-stations.create') }}" class="btn btn-primary">+ Tambah Stasiun</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive bg-white p-3 rounded shadow-sm">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nama Stasiun</th>
                    <th>Lokasi</th>
                    <th>Negara</th>
                    <th>Koordinat (Lat/Long)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stations as $gs)
                <tr>
                    <td><strong>{{ $gs->name }}</strong></td>
                    <td>{{ $gs->location }}</td>
                    <td>{{ $gs->country }}</td>
                    <td>{{ $gs->latitude }}, {{ $gs->longitude }}</td>
                    <td>
            <div class="d-flex gap-2">
                <a href="{{ route('ground-stations.show', $gs->id) }}" class="btn btn-sm btn-info text-white">Detail</a>
                <a href="{{ route('ground-stations.edit', $gs->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('ground-stations.destroy', $gs->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data stasiun ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                </form>
                    </div>
            </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">Belum ada data stasiun bumi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
