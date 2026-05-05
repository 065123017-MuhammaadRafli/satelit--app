@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg rounded-4 p-4" style="background-color: #ffffff;">

                <div class="text-center mb-4">
                    <span class="fs-1">🛰️</span>
                    <h3 class="fw-bold text-primary mt-2">Registrasi Satelit--App</h3>
                    <p class="text-muted">Buat akun baru untuk mengakses sistem monitoring.</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger mb-3" role="alert">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                        <input id="name" class="form-control form-control-lg @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <div class="input-group">
                            <input id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="new-password">
                            <button class="btn btn-outline-secondary px-3" type="button" id="toggleRegPassword">
                                 🔒

                            </button>
                        </div>
                        <div class="form-text text-muted small">
                            * Ketentuan: Minimal 8 karakter, kombinasi huruf dan angka.
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password</label>
                        <input id="password_confirmation" class="form-control form-control-lg" type="password" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg fw-bold rounded-3 shadow-sm">
                            REGISTER
                        </button>
                    </div>

                    <div class="text-center mt-4 border-top pt-3">
                        <p class="text-muted mb-0">Sudah memiliki akun? <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Log in di sini</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const toggleRegPassword = document.querySelector('#toggleRegPassword');
    const regPassword = document.querySelector('#password');

    toggleRegPassword.addEventListener('click', function (e) {
        // Toggle tipe input
        const type = regPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        regPassword.setAttribute('type', type);

        // Ubah ikon teks
        this.textContent = type === 'password' ? '🔒' : '🔓';
    });
</script>
@endsection
