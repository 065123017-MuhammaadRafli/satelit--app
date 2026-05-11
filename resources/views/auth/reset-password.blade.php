<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Reset Password &mdash; Satelit--App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <style>
        body { background: linear-gradient(135deg, #191d21 0%, #34395e 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .reset-card { width: 400px; border-radius: 15px; box-shadow: 0 15px 35px rgba(0,0,0,0.4); background: #fff; overflow: hidden; }
        .brand-icon { width: 70px; height: 70px; background: #ffa426; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 30px auto 20px; box-shadow: 0 5px 15px rgba(255, 164, 38, 0.4); }
    </style>
</head>
<body>
    <div class="reset-card">
        <div class="text-center p-4">
            <div class="brand-icon"><i class="fas fa-key fa-2x"></i></div>
            <h4 class="font-weight-bold text-dark">Setel Ulang Password</h4>
            <p class="text-muted small">Silakan masukkan password baru Anda.</p>
        </div>
        <div class="px-4 pb-4">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div class="form-group">
                    <label class="small font-weight-bold">Email</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $request->email) }}" required readonly>
                </div>
                <div class="form-group">
                    <label class="small font-weight-bold">Password Baru</label>
                    <input id="password" type="password" class="form-control" name="password" required autofocus>
                </div>
                <div class="form-group">
                    <label class="small font-weight-bold">Konfirmasi Password Baru</label>
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                </div>
                <button type="submit" class="btn btn-warning btn-block btn-lg font-weight-bold shadow-warning mt-4">SIMPAN PASSWORD BARU</button>
            </form>
        </div>
    </div>
</body>
</html>
