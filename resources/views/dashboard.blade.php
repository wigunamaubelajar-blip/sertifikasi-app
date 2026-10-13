<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Sertifikasi App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f6f8;
        }

        .navbar {
            background-color: #344b68;
        }

        .company-logo {
            width: 65px;
            height: 65px;
            object-fit: contain;
        }

        .dashboard-title {
            color: #344b68;
        }

        .card {
            border: none;
            border-radius: 10px;
        }

        .stat-number {
            color: #344b68;
        }

        .btn-primary-custom {
            background-color: #344b68;
            color: white;
            border: none;
        }

        .btn-primary-custom:hover {
            background-color: #26394f;
            color: white;
        }

        .btn-outline-custom {
            color: #344b68;
            border: 1px solid #344b68;
        }

        .btn-outline-custom:hover {
            background-color: #344b68;
            color: white;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-dark">
        <div class="container">

            <a href="{{ route('dashboard') }}" class="navbar-brand">
                <img src="{{ asset('images/logo.png.png') }}"
                     alt="Logo Perusahaan"
                     class="company-logo">
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="btn btn-light btn-sm">
                    Logout
                </button>
            </form>

        </div>
    </nav>

    <!-- KONTEN DASHBOARD -->
    <div class="container py-5">

        <h2 class="fw-bold dashboard-title">Dashboard Admin</h2>

        <p class="text-muted">
            Selamat datang, {{ auth()->user()->name }}.
        </p>

        <div class="row mt-4 g-4">

            <!-- TOTAL PESERTA -->
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body p-4">

                        <h6 class="text-muted">Total Peserta</h6>

                        <h2 class="fw-bold stat-number">
                            {{ \App\Models\Peserta::count() }}
                        </h2>

                        <p class="text-muted mb-0">
                            Jumlah peserta sertifikasi
                        </p>

                    </div>
                </div>
            </div>

            <!-- TOTAL SKEMA -->
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body p-4">

                        <h6 class="text-muted">Total Skema</h6>

                        <h2 class="fw-bold stat-number">
                            {{ \App\Models\SkemaSertifikasi::count() }}
                        </h2>

                        <p class="text-muted mb-0">
                            Jumlah skema sertifikasi
                        </p>

                    </div>
                </div>
            </div>

            <!-- MENU PENGELOLAAN -->
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body p-4">

                        <h5 class="fw-bold dashboard-title mb-3">
                            Menu Pengelolaan
                        </h5>

                        <div class="d-grid gap-2">

                            <a href="{{ route('peserta.index') }}"
                               class="btn btn-primary-custom">
                                Kelola Peserta
                            </a>

                            <a href="{{ route('skema.index') }}"
                               class="btn btn-outline-custom">
                                Kelola Skema Sertifikasi
                            </a>

                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>

</body>
</html>
