@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg rounded-4 p-4" style="background-color: #ffffff;">

                <div class="text-center mb-4">
                    <span class="fs-1">🛰️</span>
                    <h3 class="fw-bold text-primary mt-2">Masuk ke Satelit--App</h3>
                    <p class="text-muted">Masukkan email dan kata sandi Anda untuk melanjutkan.</p>
                </div>

                @if (session('status'))
                    <div class="alert alert-success mb-3" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <div class="input-group">
                            <input id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="current-password">
                            <button class="btn btn-outline-secondary px-3" type="button" id="togglePassword">
                                🔒
                            </button>
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                            <label class="form-check-label text-muted" for="remember_me">Ingat saya</label>
                        </div>

                        @if (Route::has('password.request'))
                            <a class="text-decoration-none small text-primary fw-bold" href="{{ route('password.request') }}">
                                Lupa password?
                            </a>
                        @endif
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg fw-bold rounded-3 shadow-sm">
                            LOG IN
                        </button>
                    </div>

                    <div class="text-center mt-4 border-top pt-3">
                        <p class="text-muted mb-0">Belum memiliki akun? <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">Register di sini</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function (e) {
        // Toggle tipe input
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        // Ubah ikon teks
        this.textContent = type === 'password' ? '🔒' : '🔓';
    });
</script>
@endsection
