<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Peserta</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body class="bg-light">

<div class="container py-5">

    <div class="card">

        <div class="card-header">
            <h4 class="mb-0">
                Detail Peserta Sertifikasi
            </h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="250">Nama</th>
                    <td>{{ $peserta->nama }}</td>
                </tr>

                <tr>
                    <th>NIK</th>
                    <td>{{ $peserta->nik }}</td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td>{{ $peserta->email }}</td>
                </tr>

                <tr>
                    <th>No. HP</th>
                    <td>{{ $peserta->no_hp }}</td>
                </tr>

                <tr>
                    <th>Jenis Kelamin</th>
                    <td>
                        {{ $peserta->jenis_kelamin == 'L'
                            ? 'Laki-laki'
                            : 'Perempuan' }}
                    </td>
                </tr>

                <tr>
                    <th>Alamat</th>
                    <td>{{ $peserta->alamat }}</td>
                </tr>

                <tr>
                    <th>Skema Sertifikasi</th>
                    <td>
                        {{ $peserta->skemaSertifikasi->nama_skema ?? '-' }}
                    </td>
                </tr>

                <tr>
                    <th>Kode Skema</th>
                    <td>
                        {{ $peserta->skemaSertifikasi->kode_skema ?? '-' }}
                    </td>
                </tr>

                <tr>
                    <th>Tanggal Daftar</th>
                    <td>
                        {{ $peserta->tanggal_daftar->format('d-m-Y') }}
                    </td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>
                        {{ $peserta->status }}
                    </td>
                </tr>

            </table>

            <a href="{{ route('peserta.index') }}"
               class="btn btn-secondary">
                ← Kembali
            </a>

            <a href="{{ route('peserta.edit', $peserta) }}"
               class="btn btn-warning">
                Edit
            </a>

        </div>

    </div>

</div>

</body>
</html>