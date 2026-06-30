<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Supermarket Bintang</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            min-height: 100vh;
            background-color: #f7f7f7;
            position: relative;
            overflow: hidden;
        }
        body::before {
            content: '';
            position: fixed;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 60px,
                rgba(207, 21, 38, 0.08) 60px,
                rgba(207, 21, 38, 0.08) 62px
            ),
            repeating-linear-gradient(
                -45deg,
                transparent,
                transparent 60px,
                rgba(0, 103, 174, 0.08) 60px,
                rgba(0, 103, 174, 0.08) 62px
            );
            z-index: 0;
        }
        .login-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        }
        .login-logo {
            font-size: 2rem;
            font-weight: 700;
            color: #cf1526;
        }
        .form-control:focus {
            border-color: #cf1526;
            box-shadow: 0 0 0 0.2rem rgba(207, 21, 38, 0.25);
        }
        .btn-login {
            background-color: #cf1526;
            border-color: #cf1526;
            color: #fff;
            font-weight: 600;
            padding: 10px;
        }
        .btn-login:hover {
            background-color: #a0101e;
            border-color: #a0101e;
            color: #fff;
        }
        .text-primary-red { color: #cf1526 !important; }
    </style>
</head>
<body>
    <div class="d-flex align-items-center justify-content-center min-vh-100 p-4" style="position: relative; z-index: 1;">
        <div class="login-card p-5 w-100" style="max-width: 420px;">
            <div class="text-center mb-4">
                <div class="login-logo mb-2">
                    <i class="ri-store-2-fill"></i> BINTANG
                </div>
                <h4 class="text-muted mb-0">Admin Login</h4>
                <small class="text-muted">Supermarket Bintang</small>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="login" class="form-label">Username atau Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white">
                            <i class="ri-user-line text-muted"></i>
                        </span>
                        <input type="text" class="form-control @error('login') is-invalid @enderror"
                               id="login" name="login"
                               value="{{ old('login') }}"
                               placeholder="Masukkan username atau email"
                               required autofocus autocomplete="username">
                        @error('login')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white">
                            <i class="ri-lock-line text-muted"></i>
                        </span>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               id="password" name="password"
                               placeholder="Masukkan password"
                               required autocomplete="current-password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                        <label class="form-check-label" for="remember_me">Ingat saya</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-login w-100">
                    <i class="ri-login-box-line me-1"></i> Masuk
                </button>
            </form>

            <div class="text-center mt-4">
                <small class="text-muted">
                    <a href="{{ route('home') }}" class="text-primary-red text-decoration-none">
                        <i class="ri-arrow-left-line"></i> Kembali ke Website
                    </a>
                </small>
            </div>
        </div>
    </div>
</body>
</html>
