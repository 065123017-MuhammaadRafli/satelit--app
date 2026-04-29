@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>🌍 Daftar Ground Stations Abdul</h2>
        <a href="{{ route('ground-stations.create') }}" class="btn btn-primary">+ Tambah Stasiun</a>
    </div>

    <div class="table-responsive bg-white p-3 rounded shadow-sm">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama Stasiun</th>
                    <th>Lokasi</th>
                    <th>Negara</th>
                    <th>Koordinat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stations as $gs)
                <tr>
                    <td>{{ $gs->name }}</td>
                    <td>{{ $gs->location }}</td>
                    <td>{{ $gs->country }}</td>
                    <td>{{ $gs->latitude }}, {{ $gs->longitude }}</td>
                    <td>
                        <a href="{{ route('ground-stations.edit', $gs->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
