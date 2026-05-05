@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="p-4 mb-4 bg-white rounded-4 shadow-sm border-0">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h3 class="fw-bold text-dark mb-1">🌍 Daftar Stasiun Bumi</h3>
                <p class="text-muted fs-6 mb-0">Kelola data lokasi stasiun bumi yang terhubung dengan jaringan satelit.</p>
            </div>
            <div>
                <a href="{{ route('ground-stations.create') }}" class="btn btn-primary rounded-3 px-4 py-2 fw-bold shadow-sm">
                    + Tambah Stasiun
                </a>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-uppercase fs-7 text-secondary">
                        <tr>
                            <th class="ps-4 py-3">Nama Stasiun</th>
                            <th class="py-3">Lokasi</th>
                            <th class="py-3">Negara</th>
                            <th class="py-3">Koordinat (Lat/Long)</th>
                            <th class="pe-4 py-3 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ground_stations as $gs)
                            <tr>
                                <td class="ps-4 fw-bold text-dark">{{ $gs->name }}</td>
                                <td>{{ $gs->location }}</td>
                                <td>
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary px-3 py-1 rounded-pill">
                                        {{ $gs->country }}
                                    </span>
                                </td>
                                <td>
                                    <code class="text-primary">{{ $gs->latitude }}, {{ $gs->longitude }}</code>
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('ground-stations.show', $gs->id) }}" class="btn btn-sm btn-info text-white fw-bold px-3 rounded-3 shadow-sm">
                                             Detail
                                        </a>
                                        <a href="{{ route('ground-stations.edit', $gs->id) }}" class="btn btn-sm btn-warning text-dark fw-bold px-3 rounded-3 shadow-sm">
                                            ✏️ Edit
                                        </a>
                                        <form action="{{ route('ground-stations.destroy', $gs->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus stasiun bumi ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger fw-bold px-3 rounded-3 shadow-sm">
                                                🗑️ Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <div class="py-4">
                                        <span class="fs-1 d-block mb-2">📭</span>
                                        Belum ada data stasiun bumi yang terdaftar.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if(method_exists($ground_stations, 'links'))
            <div class="card-footer bg-white border-0 py-3 px-4">
                {{ $ground_stations->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
