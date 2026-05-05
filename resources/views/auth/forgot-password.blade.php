@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center py-5" style="min-height: 75vh;">
    <div class="col-md-5 col-lg-4">
        <div class="card border-0 shadow-lg rounded-5 overflow-hidden" style="background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(10px);">

            <div class="bg-primary bg-gradient p-1"></div>

            <div class="card-body p-5 text-center">

                <div class="mb-4">
                    <span class="fs-1 d-inline-block p-3 rounded-circle bg-primary bg-opacity-10 text-primary">
                        🛰️
                    </span>
                </div>

                <h3 class="fw-bolder text-dark mb-2">Lupa Password?</h3>
                <p class="text-muted px-2 mb-4" style="font-size: 0.9rem;">
                    Masukkan email Anda di bawah ini dan kami akan mengirimkan tautan untuk mereset kata sandi Anda.
                </p>

                @if (session('status'))
                    <div class="alert alert-success border-0 rounded-4 py-2 px-3 mb-4 small" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="text-start">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label text-secondary small fw-bold">Alamat Email</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light border-0 text-muted">✉️</span>
                            <input id="email"
                                   class="form-control bg-light border-0 @error('email') is-invalid @enderror"
                                   type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   autofocus
                                   autocomplete="username"
                                   placeholder="nama@email.com"
                                   style="font-size: 1rem;">
                        </div>
                        @error('email')
                            <div class="invalid-feedback d-block small mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg rounded-4 shadow-sm py-3 fw-bold text-uppercase" style="font-size: 0.95rem;">
                            Kirim Tautan Reset
                        </button>
                    </div>
                </form>

                <div class="mt-4 pt-3 border-top">
                    <p class="text-muted mb-0" style="font-size: 0.85rem;">
                        Ingat password Anda?
                        <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Log in di sini</a>
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
