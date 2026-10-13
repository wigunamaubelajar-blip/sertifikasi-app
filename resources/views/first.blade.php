<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Sertifikasi App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f6f8;
            color: #263445;
        }

        .navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            padding: 12px 0;
        }

        .company-logo {
            width: 58px;
            height: 58px;
            object-fit: contain;
        }

        .welcome-wrapper {
            min-height: calc(100vh - 83px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .welcome-card {
            max-width: 620px;
            width: 100%;
            background-color: #ffffff;
            padding: 55px 45px;
            border: 1px solid #e9edf2;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(15, 23, 42, 0.05);
        }

        .welcome-label {
            display: inline-block;
            background-color: #eef2f7;
            color: #475569;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            padding: 7px 13px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .welcome-title {
            color: #1e293b;
            font-size: 34px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .app-name {
            color: #344b68;
            font-size: 21px;
            font-weight: 600;
            margin-bottom: 18px;
        }

        .welcome-description {
            color: #64748b;
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 32px;
        }

        .btn-login {
            background-color: #344b68;
            color: #ffffff;
            border: 1px solid #344b68;
            padding: 11px 30px;
            border-radius: 6px;
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
            padding: 11px 30px;
            border-radius: 6px;
            font-weight: 500;
            transition: 0.2s;
        }

        .btn-register:hover {
            background-color: #f1f5f9;
            color: #263445;
            border-color: #94a3b8;
        }

        .welcome-footer {
            color: #94a3b8;
            font-size: 12px;
            margin-top: 35px;
        }

        @media (max-width: 576px) {
            .welcome-card {
                padding: 40px 25px;
            }

            .welcome-title {
                font-size: 28px;
            }

            .app-name {
                font-size: 19px;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <a href="{{ route('first') }}" class="navbar-brand">
                <img src="{{ asset('images/logo.png.png') }}"
                     alt="Logo Perusahaan"
                     class="company-logo">
            </a>
        </div>
    </nav>

    <!-- Welcome Content -->
    <main class="welcome-wrapper">
        <div class="welcome-card text-center">

            <span class="welcome-label">
                SISTEM INFORMASI SERTIFIKASI
            </span>

            <h1 class="welcome-title">
                Selamat Datang
            </h1>

            <h2 class="app-name">
                Sertifikasi App
            </h2>

            <p class="welcome-description">
                Aplikasi pengelolaan data peserta sertifikasi yang
                membantu menyediakan informasi peserta secara
                terstruktur dan mudah diakses.
                Silakan login jika sudah memiliki akun atau daftar
                untuk membuat akun baru.
            </p>

            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="{{ route('login') }}" class="btn btn-login">
                    Login
                </a>

                <a href="{{ route('register') }}" class="btn btn-register">
                    Register
                </a>
            </div>

            <div class="welcome-footer">
                &copy; {{ date('Y') }} Sertifikasi App. All Rights Reserved.
            </div>

        </div>
    </main>

</body>
</html>
