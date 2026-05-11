@extends('layouts.stisla')

@section('content')
<div class="section-header">
    <h1>Data Stasiun Bumi</h1>
</div>
<div class="section-body">
    <div class="card card-primary shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Daftar Stasiun</h4>
            <div class="card-header-action">
                <a href="{{ route('ground_stations.create') }}" class="btn btn-primary btn-icon icon-left">
                    <i class="fas fa-plus"></i> Tambah Stasiun
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Lokasi</th>
                            <th>Koordinat</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ground_stations as $gs)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $gs->name }}</strong></td>
                            <td>{{ $gs->location }}</td>
                            <td><small>{{ $gs->latitude }}, {{ $gs->longitude }}</small></td>
                            <td class="text-center">
                                <a href="{{ route('ground_stations.show', $gs->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('ground_stations.edit', $gs->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                <form action="{{ route('ground_stations.destroy', $gs->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
