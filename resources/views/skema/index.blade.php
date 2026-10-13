<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Skema Sertifikasi</title>

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

        .page-title {
            color: #344b68;
            font-weight: 700;
        }

        .table-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead th {
            background-color: #f8f9fa;
            color: #495057;
            padding: 14px 16px;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 15px 16px;
            vertical-align: middle;
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

        .action-buttons {
            display: flex;
            gap: 6px;
            white-space: nowrap;
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

        </div>
    </nav>

    <!-- KONTEN UTAMA -->
    <div class="container py-4">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2 class="page-title mb-1">Skema Sertifikasi</h2>
                <p class="text-muted mb-0">
                    Kelola data skema sertifikasi.
                </p>
            </div>

            <div class="d-flex gap-2">

                <a href="{{ route('dashboard') }}" class="btn btn-outline-custom">
                    Kembali
                </a>

                <a href="{{ route('skema.create') }}" class="btn btn-primary-custom">
                    + Tambah Skema
                </a>

            </div>

        </div>

        <!-- PESAN BERHASIL -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- PESAN GAGAL -->
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- TABEL SKEMA -->
        <div class="card table-card shadow-sm">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead>
                        <tr>
                            <th style="width: 70px;">#</th>
                            <th style="width: 160px;">Kode</th>
                            <th>Nama Skema</th>
                            <th style="width: 130px;">Status</th>
                            <th style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($skemas as $skema)

                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $skema->kode_skema }}
                                    </span>
                                </td>

                                <td>
                                    <strong>{{ $skema->nama_skema }}</strong>

                                    @if ($skema->deskripsi)
                                        <div class="text-muted small mt-1">
                                            {{ $skema->deskripsi }}
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    @if ($skema->status)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Tidak Aktif</span>
                                    @endif
                                </td>

                                <td>
                                    <div class="action-buttons">

                                        <a href="{{ route('skema.edit', $skema) }}"
                                           class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('skema.destroy', $skema) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus skema ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>

                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center text-muted py-5">
                                    Belum ada data skema.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <!-- PAGINATION -->
            <div class="p-3">
                {{ $skemas->links() }}
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
