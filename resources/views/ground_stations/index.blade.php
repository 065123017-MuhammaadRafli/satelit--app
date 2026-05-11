@extends('layouts.stisla')

@section('content')
<style>
    /* Styling agar tabel terlihat modern */
    .table-container { background: white; border-radius: 15px; padding: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.04); }
    .table thead th {
        background-color: #f9f9f9;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 1px;
        color: #94a3b8;
        border: none;
        padding: 15px;
    }
    .table tbody td { vertical-align: middle; padding: 15px; border-bottom: 1px solid #f1f5f9; }

    /* Hover effect baris */
    .table tbody tr:hover { background-color: #fcfdfe; transition: 0.3s; }

    /* Badge & Button styling */
    .badge-status { font-size: 10px; padding: 5px 12px; border-radius: 50px; font-weight: 700; }
    .btn-action { width: 35px; height: 35px; display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; margin: 0 2px; transition: 0.3s; }
    .btn-action:hover { transform: translateY(-3px); box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
</style>

<div class="section-header">
    <h1>Data Stasiun Bumi</h1>
    <div class="section-header-button">
        <a href="{{ route('ground_stations.create') }}" class="btn btn-primary shadow-primary">
            <i class="fas fa-plus mr-1"></i> Tambah Stasiun
        </a>
    </div>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Stasiun Bumi</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header">
                    <h4><i class="fas fa-broadcast-tower mr-2 text-primary"></i> Daftar Stasiun Terdaftar</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-md">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Identitas Stasiun</th>
                                    <th>Wilayah / Lokasi</th>
                                    <th>Koordinat Geografis</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($ground_stations as $gs)
                                    <tr>
                                        <td class="text-center text-muted">{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-light p-2 rounded mr-3 text-primary">
                                                    <i class="fas fa-satellite-dish"></i>
                                                </div>
                                                <div>
                                                    <span class="d-block font-weight-bold text-dark">{{ $gs->name }}</span>
                                                    <span class="text-muted small">ID: GS-{{ str_pad($gs->id, 3, '0', STR_PAD_LEFT) }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-dark"><i class="fas fa-map-marker-alt text-danger mr-1"></i> {{ $gs->location }}</span>
                                        </td>
                                        <td>
                                            <code class="text-primary font-weight-bold" style="background: #f0f3ff; padding: 4px 8px; border-radius: 5px;">
                                                {{ $gs->latitude }}, {{ $gs->longitude }}
                                            </code>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('ground_stations.show', $gs->id) }}" class="btn-action btn-info shadow-sm text-white" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('ground_stations.edit', $gs->id) }}" class="btn-action btn-warning shadow-sm text-white" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{ route('ground_stations.destroy', $gs->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus stasiun bumi ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action btn-danger shadow-sm border-0 text-white" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">Belum ada data stasiun bumi yang terdaftar.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
