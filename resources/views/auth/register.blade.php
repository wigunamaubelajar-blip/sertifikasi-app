<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - Sertifikasi App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            background-color: #f5f6f8;
        }

        .register-card {
            border: none;
            border-radius: 12px;
        }

        .register-title {
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

        .form-control {
            padding: 10px 12px;
        }

        .form-control:focus {
            border-color: #344b68;
            box-shadow: 0 0 0 0.2rem rgba(52, 75, 104, 0.12);
        }
    </style>
</head>

<body>

<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100 py-4">

        <div class="col-md-5 col-lg-4">

            <div class="card register-card shadow-sm">
                <div class="card-body p-4">

                    <!-- JUDUL -->
                    <div class="text-center mb-4">
                        <h3 class="fw-bold register-title">Buat Akun</h3>
                        <p class="text-muted mb-0">
                            Daftar akun Sertifikasi App
                        </p>
                    </div>

                    <!-- PESAN ERROR PESERTA -->
                    @error('peserta')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <!-- FORM REGISTER -->
                    <form action="{{ route('register.process') }}" method="POST">
                        @csrf

                        <!-- NAMA -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>

                            <input type="text"
                                   name="name"
                                   id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}"
                                   placeholder="Masukkan nama lengkap"
                                   required>

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- NIK -->
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>

                            <input type="text"
                                   name="nik"
                                   id="nik"
                                   class="form-control @error('nik') is-invalid @enderror"
                                   value="{{ old('nik') }}"
                                   placeholder="Masukkan NIK"
                                   maxlength="16"
                                   inputmode="numeric"
                                   required>

                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- EMAIL -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>

                            <input type="email"
                                   name="email"
                                   id="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}"
                                   placeholder="Masukkan email"
                                   required>

                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- PASSWORD -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>

                            <input type="password"
                                   name="password"
                                   id="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Minimal 8 karakter"
                                   required>

                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- KONFIRMASI PASSWORD -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">
                                Konfirmasi Password
                            </label>

                            <input type="password"
                                   name="password_confirmation"
                                   id="password_confirmation"
                                   class="form-control"
                                   placeholder="Ulangi password"
                                   required>
                        </div>

                        <!-- TOMBOL DAFTAR -->
                        <button type="submit" class="btn btn-primary-custom w-100 py-2">
                            Daftar
                        </button>

                    </form>

                    <!-- LINK LOGIN -->
                    <div class="text-center mt-4">
                        <span class="text-muted">Sudah punya akun?</span>

                        <a href="{{ route('login') }}"
                           class="text-decoration-none fw-semibold"
                           style="color: #344b68;">
                            Login
                        </a>
                    </div>

                </div>
            </div>

            <p class="text-center text-muted small mt-3">
                Sertifikasi App
            </p>

        </div>
    </div>
</div>

</body>
</html>
