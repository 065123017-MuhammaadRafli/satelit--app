<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; Satelit--App</title>

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
        }
        .login-card {
            width: 400px;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            overflow: hidden;
            border: none;
        }
        .login-header {
            background: #fff;
            padding: 30px 30px 10px 30px;
            text-align: center;
        }
        .login-body {
            background: #fff;
            padding: 10px 30px 30px 30px;
        }
        .login-footer {
            background: #fdfdfd;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            border-top: 1px solid #f9f9f9;
        }
        .brand-icon {
            width: 80px;
            height: 80px;
            background: #6777ef;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 5px 15px rgba(103, 119, 239, 0.4);
        }
        .form-control {
            border-radius: 5px;
            background: #f8f9fa;
        }
        .btn-login {
            border-radius: 5px;
            font-weight: bold;
            letter-spacing: 1px;
        }
    </style>
</head>

<body>
    <div class="login-card animated fadeIn">
        <div class="login-header">
            <div class="brand-icon">
                <i class="fas fa-satellite-dish fa-2x"></i>
            </div>
            <h4 class="font-weight-bold text-dark">Satelit--App</h4>
            <p class="text-muted small">Administrator Login System</p>
        </div>

        <div class="login-body">
            @if ($errors->any())
                <div class="alert alert-danger p-2 text-small mb-3">
                    <ul class="mb-0 pl-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label class="small font-weight-bold">Email Address</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                        </div>
                        <input type="email" name="email" class="form-control" placeholder="admin@satelit.app" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label class="small font-weight-bold">Password</label>
                        <a href="{{ route('password.request') }}" class="text-small">Forgot?</a>
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-lock"></i></div>
                        </div>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="remember" class="custom-control-input" id="remember-me">
                        <label class="custom-control-label small" for="remember-me">Remember Me</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-lg btn-login shadow-primary">
                    SIGN IN <i class="fas fa-chevron-right ml-2"></i>
                </button>
            </form>
        </div>

        <div class="login-footer text-muted">
            &copy; 2026 Satelit--App Team. All rights reserved.
            <div class="mt-2">
                Don't have an account? <a href="{{ route('register') }}" class="font-weight-bold">Register</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
