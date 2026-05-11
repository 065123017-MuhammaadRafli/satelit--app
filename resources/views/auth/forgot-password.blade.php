<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Lupa Password &mdash; Satelit--App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <style>
        body { background: linear-gradient(135deg, #191d21 0%, #34395e 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .forgot-card { width: 400px; border-radius: 15px; box-shadow: 0 15px 35px rgba(0,0,0,0.4); background: #fff; overflow: hidden; }
        .brand-icon { width: 70px; height: 70px; background: #6777ef; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 30px auto 20px; box-shadow: 0 5px 15px rgba(103, 119, 239, 0.4); }
    </style>
</head>
<body>
    <div class="forgot-card">
        <div class="text-center p-4">
            <div class="brand-icon"><i class="fas fa-unlock-alt fa-2x"></i></div>
            <h4 class="font-weight-bold text-dark">Lupa Password?</h4>
            <p class="text-muted small">Masukkan email Anda untuk menerima tautan reset.</p>
        </div>
        <div class="px-4 pb-4">
            @if (session('status'))
                <div class="alert alert-success small mb-3">{{ session('status') }}</div>
            @endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                    <label class="small font-weight-bold text-dark">Email Administrator</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><div class="input-group-text"><i class="fas fa-envelope"></i></div></div>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-lg font-weight-bold shadow-primary mt-4">KIRIM TAUTAN RESET</button>
            </form>
            <div class="text-center mt-4 pt-3 border-top"><a href="{{ route('login') }}" class="text-small font-weight-bold">Kembali ke Login</a></div>
        </div>
    </div>
</body>
</html>
