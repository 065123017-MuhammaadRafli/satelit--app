@extends('layouts.stisla')

@section('content')
<div class="section-header">
    <h1>Daftar Stasiun Bumi</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Stasiun Bumi</div>
    </div>
</div>

<div class="section-body">
    <h2 class="section-title">Manajemen Stasiun Bumi</h2>
    <p class="section-lead">
        Kelola data lokasi stasiun bumi yang terhubung dengan jaringan satelit Anda.
    </p>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header border-0 d-flex justify-content-between">
                    <h4 class="text-primary">Data Stasiun</h4>
                    <div class="card-header-action">
                        <a href="{{ route('ground-stations.create') }}" class="btn btn-primary btn-icon icon-left">
                            <i class="fas fa-plus"></i> Tambah Stasiun
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <thead>
                                <tr>
                                    <th class="pl-4">Nama Stasiun</th>
                                    <th>Lokasi</th>
                                    <th>Negara</th>
                                    <th>Koordinat (Lat/Long)</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($ground_stations as $gs)
                                <tr>
                                    <td class="pl-4 fw-600 text-dark">{{ $gs->name }}</td>
                                    <td>{{ $gs->location }}</td>
                                    <td>
                                        <div class="badge badge-light border text-capitalize">
                                            {{ $gs->country }}
                                        </div>
                                    </td>
                                    <td>
                                        <code class="text-primary fw-bold">{{ $gs->latitude }}, {{ $gs->longitude }}</code>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('ground-stations.show', $gs->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                        <a href="{{ route('ground-stations.edit', $gs->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('ground-stations.destroy', $gs->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus stasiun ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="fas fa-folder-open mb-2 d-block" style="font-size: 2rem;"></i>
                                        Belum ada data stasiun bumi.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if(method_exists($ground_stations, 'links'))
                <div class="card-footer text-right">
                    {{ $ground_stations->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
