@extends('layouts.stisla')

@section('content')
<style>
    .table-action-btns {
        display: flex;
        gap: 5px;
    }
    .badge-orbit {
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 700;
        font-size: 10px;
        padding: 5px 12px;
        border-radius: 50px;
    }
</style>

<div class="section-header">
    <h1>Daftar Armada Satelit</h1>
    <div class="section-header-button">
        <a href="{{ route('satellites.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus mr-1"></i> Tambah Satelit
        </a>
    </div>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Satelit</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header">
                    <h4><i class="fas fa-satellite text-primary mr-2"></i> Data Satelit Terdaftar</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-md align-middle" id="table-1">
                            <thead>
                                <tr class="text-uppercase" style="font-size: 11px; letter-spacing: 1px;">
                                    <th class="text-center" style="width: 5%;">#</th>
                                    <th>Nama Satelit</th>
                                    <th>Negara</th>
                                    <th class="text-center">Orbit</th>
                                    <th>Altitude</th>
                                    <th>Stasiun Bumi</th>
                                    <th class="text-center" style="width: 15%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($satellites as $satellite)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            <span class="font-weight-600 text-dark">{{ $satellite->name }}</span>
                                        </td>
                                        <td class="text-capitalize">{{ $satellite->country }}</td>
                                        <td class="text-center">
                                            <span class="badge badge-primary badge-orbit">{{ $satellite->orbit_type }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light font-weight-bold">{{ $satellite->altitude }} Km</span>
                                        </td>
                                        <td>
                                            <div class="text-muted small">
                                                <i class="fas fa-broadcast-tower mr-1"></i>
                                                {{ $satellite->groundStation->name ?? 'Tidak Terhubung' }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="table-action-btns justify-content-center">
                                                <a href="{{ route('satellites.show', $satellite->id) }}"
                                                   class="btn btn-info btn-sm shadow-sm"
                                                   title="Detail Telemetri">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                <a href="{{ route('satellites.edit', $satellite->id) }}"
                                                   class="btn btn-warning btn-sm shadow-sm text-white"
                                                   title="Edit Konfigurasi">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>

                                                <form action="{{ route('satellites.destroy', $satellite->id) }}"
                                                      method="POST"
                                                      class="d-inline"
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus satelit ini? Semua data telemetri akan hilang.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm shadow-sm" title="Hapus Data">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <div class="empty-state">
                                                <div class="empty-state-icon bg-light text-muted p-4 rounded-circle mb-3">
                                                    <i class="fas fa-satellite-dish fa-2x"></i>
                                                </div>
                                                <h6>Belum ada data satelit</h6>
                                                <p class="text-muted">Silakan klik tombol "Tambah Satelit" untuk memulai.</p>
                                            </div>
                                        </td>
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
