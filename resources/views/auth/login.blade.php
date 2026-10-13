<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Sertifikasi App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f6f8;
            color: #263445;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 15px;
        }

        .login-card {
            max-width: 440px;
            width: 100%;
            background-color: #ffffff;
            border: 1px solid #e9edf2;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(15, 23, 42, 0.05);
            padding: 38px;
        }

        .company-logo {
            width: 72px;
            height: 72px;
            object-fit: contain;
            margin-bottom: 16px;
        }

        .app-title {
            color: #1e293b;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .login-subtitle {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-label {
            color: #334155;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-control {
            padding: 11px 13px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #64748b;
            box-shadow: 0 0 0 3px rgba(100, 116, 139, 0.12);
        }

        .btn-login {
            background-color: #344b68;
            color: #ffffff;
            border: 1px solid #344b68;
            padding: 11px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            transition: 0.2s;
        }

        .btn-login:hover {
            background-color: #26394f;
            border-color: #26394f;
            color: #ffffff;
        }

        .btn-register {
            background-color: #ffffff;
            color: #475569;
            border: 1px solid #cbd5e1;
            padding: 10px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            transition: 0.2s;
        }

        .btn-register:hover {
            background-color: #f1f5f9;
            color: #263445;
            border-color: #94a3b8;
        }

        .alert {
            font-size: 13px;
            border-radius: 6px;
        }

        .login-footer {
            color: #94a3b8;
            font-size: 12px;
            margin-top: 25px;
        }

        @media (max-width: 576px) {
            .login-card {
                padding: 30px 23px;
            }
        }
    </style>
</head>

<body>

    <main class="login-wrapper">

        <div class="login-card">

            <!-- Logo dan Judul -->
            <div class="text-center">

                <img src="{{ asset('images/logo.png.png') }}"
                     alt="Logo Perusahaan"
                     class="company-logo">

                <h1 class="app-title">
                    Sertifikasi App
                </h1>

                <p class="login-subtitle">
                    Silakan masuk menggunakan akun Anda
                </p>

            </div>

            <!-- Pesan Error -->
            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <strong>Login gagal.</strong>
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Form Login -->
            <form method="POST" action="{{ route('login.process') }}">

                @csrf

                <div class="mb-3">

                    <label class="form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email') }}"
                        placeholder="Masukkan email Anda"
                        autocomplete="email"
                        required
                    >

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Masukkan password Anda"
                        autocomplete="current-password"
                        required
                    >

                </div>

                <button type="submit" class="btn btn-login w-100">
                    Login
                </button>

            </form>

            <!-- Link Register -->
            <div class="text-center mt-4">

                <p class="text-muted mb-2" style="font-size: 14px;">
                    Belum memiliki akun?
                </p>

                <a href="{{ route('register') }}" class="btn btn-register w-100">
                    Daftar Akun
                </a>

            </div>

            <!-- Footer -->
            <div class="login-footer text-center">
                &copy; {{ date('Y') }} Sertifikasi App. All Rights Reserved.
            </div>

        </div>

    </main>

</body>

</html>
