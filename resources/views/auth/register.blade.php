<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Registrasi &mdash; Satelit--App</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

    <style>
        body {
            background: linear-gradient(135deg, #191d21 0%, #34395e 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 0;
        }
        .register-card {
            width: 450px;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            overflow: hidden;
            border: none;
            background: #fff;
        }
        .register-header {
            padding: 30px 30px 10px 30px;
            text-align: center;
        }
        .register-body {
            padding: 10px 30px 30px 30px;
        }
        .register-footer {
            background: #fdfdfd;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            border-top: 1px solid #f9f9f9;
        }
        .brand-icon {
            width: 70px;
            height: 70px;
            background: #6777ef;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            box-shadow: 0 5px 15px rgba(103, 119, 239, 0.4);
        }
        .form-control {
            border-radius: 5px;
            background: #f8f9fa;
        }
        .btn-register {
            border-radius: 5px;
            font-weight: bold;
            letter-spacing: 1px;
        }
    </style>
</head>

<body>
    <div class="register-card animated fadeIn">
        <div class="register-header">
            <div class="brand-icon">
                <i class="fas fa-user-plus fa-2x"></i>
            </div>
            <h4 class="font-weight-bold text-dark">Registrasi Akun</h4>
            <p class="text-muted small">Buat akun untuk mengakses sistem monitoring.</p>
        </div>

        <div class="register-body">
            @if ($errors->any())
                <div class="alert alert-danger p-2 text-small mb-3">
                    <ul class="mb-0 pl-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label class="small font-weight-bold">Nama Lengkap</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-user"></i></div>
                        </div>
                        <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label class="small font-weight-bold">Email Address</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                        </div>
                        <input type="email" name="email" class="form-control" placeholder="admin@satelit.app" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="small font-weight-bold">Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-lock"></i></div>
                        </div>
                        <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="small font-weight-bold">Konfirmasi Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-check-double"></i></div>
                        </div>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-lg btn-register shadow-primary mt-4">
                    DAFTARKAN AKUN <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </form>
        </div>

        <div class="register-footer text-muted">
            Sudah memiliki akun? <a href="{{ route('login') }}" class="font-weight-bold">Log in di sini</a>
            <div class="mt-2 text-small">
                &copy; 2026 Satelit--App Monitoring
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
