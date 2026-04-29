@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Monitoring Satelit</h2>
        <a href="{{ route('satellites.create') }}" class="btn btn-success">+ Tambah Satelit</a>
    </div>

    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('satellites.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama satelit..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Cari</button>
                    <a href="{{ route('satellites.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive bg-white p-3 rounded shadow-sm">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Nama Satelit</th>
                    <th>Negara</th>
                    <th>Orbit</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($satellites as $sat)
                <tr>
                    <td>{{ $sat->name }}</td>
                    <td>{{ $sat->owner_country }}</td>
                    <td>{{ $sat->orbit_type }}</td>
                    <td>
                        <span class="badge {{ $sat->is_active ? 'bg-success' : 'bg-danger' }}">
                            {{ $sat->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('satellites.destroy', $sat->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4">Data tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
