@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>🛰️ Daftar Satelit dalam Orbit</h2>
        <a href="{{ route('satellites.create') }}" class="btn btn-primary">+ Daftarkan Satelit Baru</a>
    </div>

    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('satellites.index') }}" method="GET" class="row g-3">
                <div class="col-md-10">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama satelit..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary w-100">Cari</button>
                </div>
            </form>
        </div>
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
                    <th>Nama Satelit</th>
                    <th>Stasiun Bumi (Relasi)</th>
                    <th>Negara</th>
                    <th>Tipe Orbit</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($satellites as $sat)
                <tr>
                    <td><strong>{{ $sat->name }}</strong></td>
                    <td><span class="badge bg-info text-dark">{{ $sat->groundStation->name ?? 'N/A' }}</span></td>
                    <td>{{ $sat->owner_country }}</td>
                    <td>{{ $sat->orbit_type }}</td>
                    <td>
                        @if($sat->is_active)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-danger">Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('satellites.show', $sat->id) }}" class="btn btn-sm btn-info text-white">Detail</a>
                            <a href="{{ route('satellites.edit', $sat->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('satellites.destroy', $sat->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus satelit ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Data satelit tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $satellites->links() }}
        </div>
    </div>
</div>
@endsection
