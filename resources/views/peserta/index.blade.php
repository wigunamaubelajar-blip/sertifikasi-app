<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Peserta</title>

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
            background-color: #344b68;
            color: white;
            padding: 14px;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 13px 14px;
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
    <div class="container py-5">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2 class="page-title mb-1">Data Peserta Sertifikasi</h2>

                <p class="text-muted mb-0">
                    Kelola data peserta sertifikasi.
                </p>
            </div>

            <a href="{{ route('peserta.create') }}" class="btn btn-primary-custom">
                + Tambah Peserta
            </a>

        </div>

        <!-- PESAN BERHASIL -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- PENCARIAN -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">

                <form method="GET" action="{{ route('peserta.index') }}" class="row g-2">

                    <div class="col-md-10">
                        <input type="text"
                               name="search"
                               class="form-control"
                               placeholder="Cari nama, NIK, atau email..."
                               value="{{ request('search') }}">
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary-custom w-100">
                            Cari
                        </button>
                    </div>

                </form>

            </div>
        </div>

        <!-- TABEL PESERTA -->
        <div class="card table-card shadow-sm">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Email</th>
                            <th>Skema</th>
                            <th>Status</th>
                            <th style="width: 220px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($peserta as $item)

                            <tr>

                                <td>
                                    {{ $peserta->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    {{ $item->nama }}
                                </td>

                                <td>
                                    {{ $item->nik }}
                                </td>

                                <td>
                                    {{ $item->email }}
                                </td>

                                <td>
                                    {{ $item->skemaSertifikasi->nama_skema ?? '-' }}
                                </td>

                                <td>
                                    @if ($item->status == 'Selesai')
                                        <span class="badge bg-success">Selesai</span>
                                    @elseif ($item->status == 'Dijadwalkan')
                                        <span class="badge bg-warning text-dark">Dijadwalkan</span>
                                    @else
                                        <span class="badge bg-primary">Terdaftar</span>
                                    @endif
                                </td>

                                <td>

                                    <div class="d-flex gap-1">

                                        <a href="{{ route('peserta.show', $item) }}"
                                           class="btn btn-sm btn-info text-white">
                                            Detail
                                        </a>

                                        <a href="{{ route('peserta.edit', $item) }}"
                                           class="btn btn-sm btn-warning">
                                            Edit
                                        </a>

                                        <form action="{{ route('peserta.destroy', $item) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-danger">
                                                Hapus
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="text-center text-muted py-5">
                                    Belum ada data peserta.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <!-- PAGINATION -->
            <div class="p-3">
                {{ $peserta->links() }}
            </div>

        </div>

        <!-- KEMBALI -->
        <div class="mt-3">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-custom">
                ← Kembali ke Dashboard
            </a>
        </div>

    </div>

</body>
</html>
