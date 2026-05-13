@extends('layouts.stisla')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">

<style>
    body { font-family: 'Inter', sans-serif; }
    .section-header h1 { font-weight: 800; color: #2c3e50; letter-spacing: -1px; }

    /* Card & Table Styling */
    .card-fleet { border-radius: 15px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.03); }
    .table-fleet thead th {
        background-color: #f8fafc;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 1.5px;
        color: #64748b;
        border: none;
        padding: 20px 15px;
    }
    .table-fleet tbody td { vertical-align: middle; padding: 18px 15px; border-bottom: 1px solid #f1f5f9; }
    .table-fleet tbody tr:hover { background-color: #fcfdfe; transition: 0.3s ease; }

    /* Data Specific Styling */
    .sat-name { font-weight: 700; color: #1e293b; font-size: 15px; }
    .orbit-pill {
        font-size: 10px; font-weight: 800; padding: 5px 15px; border-radius: 50px;
        letter-spacing: 1px; box-shadow: 0 2px 4px rgba(103, 119, 239, 0.2);
    }
    .altitude-text { font-family: 'JetBrains Mono', monospace; font-weight: 600; color: #6777ef; }

    /* GS Info Box */
    .gs-info { display: flex; align-items: center; gap: 10px; }
    .gs-icon-small {
        width: 32px; height: 32px; background: #eef2ff; color: #6366f1;
        border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 12px;
    }

    /* Action Buttons */
    .btn-action-group { display: flex; gap: 8px; justify-content: center; }
    .btn-modern {
        width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;
        border-radius: 10px; transition: 0.3s; border: none; color: white;
    }
    .btn-modern:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
    .btn-view { background: #6777ef; }
    .btn-edit { background: #ffa426; }
    .btn-delete { background: #fc544b; }
</style>

<div class="section-header">
    <h1>Armada Satelit</h1>
    <div class="section-header-button">
        <a href="{{ route('satellites.create') }}" class="btn btn-primary shadow-primary px-4 font-weight-bold">
            <i class="fas fa-plus-circle mr-2"></i> Tambah Satelit
        </a>

        <a href="{{ route('satellites.pdf') }}" class="btn btn-danger shadow-sm px-4 font-weight-bold ml-2">
            <i class="fas fa-file-pdf mr-2"></i> Cetak PDF
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
            <div class="card card-fleet">
                <div class="card-header d-flex justify-content-between align-items-center py-3">
                    <h4 class="text-dark"><i class="fas fa-layer-group text-primary mr-2"></i> Monitoring Hub Satelit</h4>
                    <span class="badge badge-light border">{{ $satellites->count() }} Total Armada</span>
                </div>
                <div class="card-body p-0">
                    @if(session('success'))
                        <div class="px-4 pt-3">
                            <div class="alert alert-success alert-dismissible show fade shadow-sm">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-fleet">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">#</th>
                                    <th>Nama Satelit</th>
                                    <th>Negara</th>
                                    <th class="text-center">Tipe Orbit</th>
                                    <th>Altitude</th>
                                    <th>Stasiun Monitoring</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($satellites as $satellite)
                                    <tr>
                                        <td class="text-center text-muted small">{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="mr-3 text-primary" style="font-size: 20px;">
                                                    <i class="fas fa-satellite"></i>
                                                </div>
                                                <div class="sat-name">{{ $satellite->name }}</div>
                                            </div>
                                        </td>
                                        <td class="text-muted font-weight-600">{{ $satellite->country }}</td>
                                        <td class="text-center">
                                            <span class="badge badge-primary orbit-pill">{{ $satellite->orbit_type }}</span>
                                        </td>
                                        <td>
                                            <span class="altitude-text">{{ $satellite->altitude }}</span> <small class="text-muted font-weight-bold">KM</small>
                                        </td>
                                        <td>
                                            <div class="gs-info">
                                                <div class="gs-icon-small shadow-sm">
                                                    <i class="fas fa-broadcast-tower"></i>
                                                </div>
                                                <div class="small">
                                                    <div class="font-weight-bold text-dark">{{ $satellite->groundStation->name ?? 'N/A' }}</div>
                                                    <div class="text-muted" style="font-size: 10px;">{{ $satellite->groundStation->location ?? '-' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-action-group">
                                                <a href="{{ route('satellites.show', $satellite->id) }}" class="btn-modern btn-view" title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('satellites.edit', $satellite->id) }}" class="btn-modern btn-edit" title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <form action="{{ route('satellites.destroy', $satellite->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data satelit ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-modern btn-delete" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5 text-muted">Data armada satelit belum tersedia.</td>
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
