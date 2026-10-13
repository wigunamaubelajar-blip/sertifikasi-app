<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Tambah Skema</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <h3 class="mb-4">
                        Tambah Skema Sertifikasi
                    </h3>


                    @if ($errors->any())

                        <div class="alert alert-danger">

                            <strong>
                                Periksa input berikut:
                            </strong>

                            <ul class="mb-0 mt-2">

                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach

                            </ul>

                        </div>

                    @endif


                    <form
                        action="{{ route('skema.store') }}"
                        method="POST"
                    >

                        @csrf


                        <div class="mb-3">

                            <label class="form-label">
                                Nama Skema
                            </label>

                            <input
                                type="text"
                                name="nama_skema"
                                class="form-control"
                                value="{{ old('nama_skema') }}"
                                required
                            >

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Kode Skema
                            </label>

                            <input
                                type="text"
                                name="kode_skema"
                                class="form-control"
                                value="{{ old('kode_skema') }}"
                                placeholder="Contoh: JWD-001"
                                required
                            >

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Deskripsi
                            </label>

                            <textarea
                                name="deskripsi"
                                class="form-control"
                                rows="4"
                            >{{ old('deskripsi') }}</textarea>

                        </div>


                        <div class="mb-4">

                            <label class="form-label">
                                Status
                            </label>

                            <select
                                name="status"
                                class="form-select"
                                required
                            >

                                <option value="1">
                                    Aktif
                                </option>

                                <option value="0">
                                    Tidak Aktif
                                </option>

                            </select>

                        </div>


                        <a
                            href="{{ route('skema.index') }}"
                            class="btn btn-secondary"
                        >
                            Kembali
                        </a>

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            Simpan
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>