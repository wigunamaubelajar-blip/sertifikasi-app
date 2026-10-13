<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Peserta</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">

        <div class="card">

            <div class="card-header">
                <h4 class="mb-0">Tambah Peserta Sertifikasi</h4>
            </div>

            <div class="card-body">

                @if ($errors->any())

                    <div class="alert alert-danger">

                        <strong>Terjadi kesalahan:</strong>

                        <ul class="mb-0 mt-2">

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                @endif

                <form action="{{ route('peserta.update', $peserta) }}" method="POST">
                @csrf
                @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Nama Lengkap
                            </label>

                            <input type="text" name="nama" class="form-control"
                                value="{{ old('nama', $peserta->nama) }}" required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                NIK
                            </label>

                            <input type="text" name="nik" class="form-control"
                                value="{{ old('nik', $peserta->nik) }}" required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Email
                            </label>

                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $peserta->email) }}" required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                No. HP
                            </label>

                            <input type="text" name="no_hp" class="form-control"
                                value="{{ old('no_hp', $peserta->no_hp) }}" required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Jenis Kelamin
                            </label>

                            <select name="jenis_kelamin" class="form-select" required>

                                <option value="">
                                    -- Pilih --
                                </option>

                                <option value="L"
                                    {{ old('jenis_kelamin', $peserta->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                                    Laki-laki
                                </option>

                                <option value="P"
                                    {{ old('jenis_kelamin', $peserta->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                                    Perempuan
                                </option>

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Skema Sertifikasi
                            </label>

                            <select name="skema_sertifikasi_id" class="form-select" required>

                                @foreach ($skema as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('skema_sertifikasi_id', $peserta->skema_sertifikasi_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_skema }}
                                        ({{ $item->kode_skema }})
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Tanggal Daftar
                            </label>

                            <input type="date" name="tanggal_daftar" class="form-control"
                                value="{{ old('tanggal_daftar', $peserta->tanggal_daftar->format('Y-m-d')) }}"
                                required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Status
                            </label>

                            <select name="status" class="form-select" required>

                                <option value="Terdaftar"
                                    {{ old('status', $peserta->status) == 'Terdaftar' ? 'selected' : '' }}>
                                    Terdaftar
                                </option>

                                <option value="Dijadwalkan"
                                    {{ old('status', $peserta->status) == 'Dijadwalkan' ? 'selected' : '' }}>
                                    Dijadwalkan
                                </option>

                                <option value="Selesai"
                                    {{ old('status', $peserta->status) == 'Selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>

                            </select>

                        </div>

                        <div class="col-12 mb-3">

                            <label class="form-label">
                                Alamat
                            </label>

                            <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $peserta->alamat) }}</textarea>
                        </div>

                    </div>

                    <div class="mt-3">

                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>

                        <a href="{{ route('peserta.index') }}" class="btn btn-secondary">
                            Batal
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</body>

</html>
