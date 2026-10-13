<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peserta - Sertifikasi App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f6f8;
            color: #263445;
        }

        .company-logo {
            width: 55px;
            height: 55px;
            object-fit: contain;
        }

        .navbar {
            border-bottom: 1px solid #e5e7eb;
        }

        .main-content {
            max-width: 1000px;
            margin: 40px auto;
        }

        .card {
            border: 1px solid #e5e7eb;
            border-radius: 10px;
        }

        .card-header {
            background-color: #ffffff;
            padding: 18px 22px;
        }

        .card-body {
            padding: 25px;
        }

        .form-control,
        .form-select {
            border-radius: 6px;
            padding: 10px;
        }

        .btn-primary-custom {
            background-color: #344b68;
            color: white;
            border: 1px solid #344b68;
        }

        .btn-primary-custom:hover {
            background-color: #26394f;
            color: white;
        }

        .btn-outline-custom {
            border: 1px solid #cbd5e1;
            color: #475569;
        }

        .btn-outline-custom:hover {
            background-color: #f1f5f9;
            color: #263445;
        }

        .data-label {
            color: #64748b;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .data-value {
            color: #263445;
            font-weight: 600;
        }
    </style>
</head>

<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg bg-white">
        <div class="container">

            <a href="{{ route('home') }}" class="navbar-brand">
                <img src="{{ asset('images/logo.png.png') }}" alt="Logo Perusahaan" class="company-logo">
            </a>

            <div class="d-flex align-items-center gap-3">
                <span class="text-secondary small">
                    Halo, {{ auth()->user()->name }}
                </span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-custom btn-sm">
                        Logout
                    </button>
                </form>
            </div>

        </div>
    </nav>

    {{-- Konten --}}
    <div class="container main-content">

        <h3 class="fw-bold mb-2">Dashboard Peserta</h3>
        <p class="text-secondary mb-4">
            Informasi data peserta sertifikasi Anda.
        </p>

        {{-- Pesan berhasil --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Pesan error --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Data Peserta --}}
        <div class="card shadow-sm">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">Data Peserta Saya</h5>

                <span class="badge bg-light text-secondary border">
                    {{ $peserta->status }}
                </span>
            </div>

            <div class="card-body">

                <div class="row g-4">

                    <div class="col-md-6">
                        <p class="data-label">Nama Lengkap</p>
                        <p class="data-value">{{ $peserta->nama }}</p>
                    </div>

                    <div class="col-md-6">
                        <p class="data-label">NIK</p>
                        <p class="data-value">{{ $peserta->nik }}</p>
                    </div>

                    <div class="col-md-6">
                        <p class="data-label">Email</p>
                        <p class="data-value">{{ $peserta->email }}</p>
                    </div>

                    <div class="col-md-6">
                        <p class="data-label">Nomor HP</p>
                        <p class="data-value">{{ $peserta->no_hp }}</p>
                    </div>

                    <div class="col-md-6">
                        <p class="data-label">Jenis Kelamin</p>
                        <p class="data-value">
                            {{ $peserta->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </p>
                    </div>

                    <div class="col-md-6">
                        <p class="data-label">Alamat</p>
                        <p class="data-value">{{ $peserta->alamat }}</p>
                    </div>

                    <div class="col-md-6">
                        <p class="data-label">Skema Sertifikasi</p>
                        <p class="data-value">
                            {{ $peserta->skemaSertifikasi->nama_skema ?? '-' }}
                        </p>
                    </div>

                    <div class="col-md-6">
                        <p class="data-label">Kode Skema</p>
                        <p class="data-value">
                            {{ $peserta->skemaSertifikasi->kode_skema ?? '-' }}
                        </p>
                    </div>

                    <div class="col-md-6">
                        <p class="data-label">Tanggal Pendaftaran</p>
                        <p class="data-value">
                            {{ $peserta->tanggal_daftar?->format('d-m-Y') ?? '-' }}
                        </p>
                    </div>

                    <div class="col-md-6">
                        <p class="data-label">Status Peserta</p>
                        <p class="data-value">{{ $peserta->status }}</p>
                    </div>

                </div>

                <hr>

                <div class="text-end">
                    <button type="button" class="btn btn-primary-custom px-4"
                        data-bs-toggle="modal" data-bs-target="#editModal">
                        Edit Data Saya
                    </button>
                </div>

            </div>
        </div>

        <p class="text-center text-secondary small mt-4">
            &copy; {{ date('Y') }} Sertifikasi App. All Rights Reserved.
        </p>

    </div>

    {{-- Modal Edit --}}
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Edit Data Peserta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('peserta-saya.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control"
                                    value="{{ old('nama', $peserta->nama) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">NIK</label>
                                <input type="text" name="nik" class="form-control"
                                    value="{{ old('nik', $peserta->nik) }}" maxlength="16" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $peserta->email) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Nomor HP</label>
                                <input type="text" name="no_hp" class="form-control"
                                    value="{{ old('no_hp', $peserta->no_hp) }}" maxlength="13" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select" required>
                                    <option value="L" {{ old('jenis_kelamin', $peserta->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                                        Laki-laki
                                    </option>
                                    <option value="P" {{ old('jenis_kelamin', $peserta->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                                        Perempuan
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control" rows="2" required>{{ old('alamat', $peserta->alamat) }}</textarea>
                            </div>

                        </div>

                        <p class="text-secondary small mt-3 mb-0">
                            Perubahan nama dan email juga akan memperbarui informasi akun login Anda.
                        </p>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-custom"
                            data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn btn-primary-custom">
                            Simpan Perubahan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @if ($errors->any())
        <script>
            new bootstrap.Modal(document.getElementById('editModal')).show();
        </script>
    @endif

</body>
</html>
