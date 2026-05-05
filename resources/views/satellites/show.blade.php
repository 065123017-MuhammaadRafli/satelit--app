@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0 rounded-4">

                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3 px-4 rounded-top-4">
                    <h4 class="mb-0 fw-bold">🛰️ Detail Satelit: {{ $satellite->name }}</h4>
                    <a href="{{ route('satellites.index') }}" class="btn btn-light btn-sm fw-bold text-primary px-3">
                        Kembali
                    </a>
                </div>

                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle mb-0">
                            <tr>
                                <th width="35%" class="text-muted fw-semibold">Nama Satelit</th>
                                <td class="fw-bold fs-5 text-dark">: {{ $satellite->name }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted fw-semibold">Stasiun Bumi (Relasi)</th>
                                <td>: <span class="badge bg-info bg-opacity-10 text-info border border-info px-3 py-1 rounded-pill">
                                    {{ $satellite->groundStation->name ?? 'N/A' }}
                                </span></td>
                            </tr>
                            <tr>
                                <th class="text-muted fw-semibold">Negara Pemilik</th>
                                <td>: {{ $satellite->owner_country }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted fw-semibold">Tanggal Peluncuran</th>
                                <td>:
                                    @if($satellite->launch_date)
                                        {{ \Carbon\Carbon::parse($satellite->launch_date)->format('d F Y') }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="text-muted fw-semibold">Tipe Orbit</th>
                                <td>: {{ $satellite->orbit_type }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted fw-semibold">Status Satelit</th>
                                <td>
                                    :
                                    @if($satellite->is_active)
                                        <span class="badge bg-success bg-opacity-75 px-3">Aktif</span>
                                    @else
                                        <span class="badge bg-danger bg-opacity-75 px-3">Nonaktif</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="text-muted fw-semibold align-top pt-3">Data TLE</th>
                                <td class="pt-3">
                                    :
                                    <pre class="bg-light p-3 rounded border mt-2 shadow-sm" style="max-height: 250px; overflow-y: auto;">
<code>@if(!empty($satellite->tle_lines))
@foreach($satellite->tle_lines as $line)
{{ $line }}
@endforeach
@else
Tidak ada data TLE
@endif</code>
                                    </pre>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="card-footer bg-light border-0 d-flex justify-content-end gap-2 py-3 px-4 rounded-bottom-4">
                    <a href="{{ route('satellites.edit', $satellite->id) }}" class="btn btn-warning text-dark fw-bold px-4">
                        Edit
                    </a>
                    <form action="{{ route('satellites.destroy', $satellite->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus satelit ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger fw-bold px-4">Hapus</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
