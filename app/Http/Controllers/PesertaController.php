<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\SkemaSertifikasi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PesertaController extends Controller
{
    public function index(Request $request)
    {
        $query = Peserta::with('skemaSertifikasi');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $peserta = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('peserta.index', compact('peserta'));
    }

    public function create()
    {
        $skema = SkemaSertifikasi::where('status', true)
            ->orderBy('nama_skema')
            ->get();

        return view('peserta.create', compact('skema'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:100',
                'regex:/^[\pL\s]+$/u',
            ],
            'nik' => [
                'required',
                'digits_between:1,16',
                'regex:/^[0-9]+$/',
                'unique:peserta,nik',
            ],
            'email' => ['required', 'email', 'max:100', 'unique:peserta,email'],
            'no_hp' => [
                'required',
                'string',
                'max:13',
                'regex:/^[0-9]+$/',
            ],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'alamat' => ['required', 'string'],
            'skema_sertifikasi_id' => [
                'required',
                'exists:skema_sertifikasi,id'
            ],
            'tanggal_daftar' => ['required', 'date'],
            'status' => [
                'required',
                Rule::in(['Terdaftar', 'Dijadwalkan', 'Selesai'])
            ],
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.regex' => 'Nama hanya boleh menggunakan huruf dan spasi.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits_between' => 'NIK maksimal 16 digit.',
            'nik.regex' => 'NIK hanya boleh berisi angka.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.max' => 'Nomor HP maksimal 13 karakter.',
            'no_hp.regex' => 'Nomor HP hanya boleh berisi angka.',
        ]);

        Peserta::create($validated);

        return redirect()
            ->route('peserta.index')
            ->with('success', 'Data peserta berhasil ditambahkan.');
    }

    public function show(Peserta $peserta)
    {
        $peserta->load('skemaSertifikasi');

        return view('peserta.show', compact('peserta'));
    }

    public function edit(Peserta $peserta)
    {
        $skema = SkemaSertifikasi::where('status', true)
            ->orderBy('nama_skema')
            ->get();

        return view('peserta.edit', compact('peserta', 'skema'));
    }

    public function update(Request $request, Peserta $peserta)
    {
        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:100',
                'regex:/^[\pL\s]+$/u',
            ],
            'nik' => [
                'required',
                'digits_between:1,16',
                'regex:/^[0-9]+$/',
                Rule::unique('peserta', 'nik')->ignore($peserta->id),
            ],
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('peserta', 'email')->ignore($peserta->id),
            ],
            'no_hp' => [
                'required',
                'string',
                'max:13',
                'regex:/^[0-9]+$/',
            ],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'alamat' => ['required', 'string'],
            'skema_sertifikasi_id' => [
                'required',
                'exists:skema_sertifikasi,id'
            ],
            'tanggal_daftar' => ['required', 'date'],
            'status' => [
                'required',
                Rule::in(['Terdaftar', 'Dijadwalkan', 'Selesai'])
            ],
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.regex' => 'Nama hanya boleh menggunakan huruf dan spasi.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits_between' => 'NIK maksimal 16 digit.',
            'nik.regex' => 'NIK hanya boleh berisi angka.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.max' => 'Nomor HP maksimal 13 karakter.',
            'no_hp.regex' => 'Nomor HP hanya boleh berisi angka.',
        ]);

        $peserta->update($validated);

        return redirect()
            ->route('peserta.index')
            ->with('success', 'Data peserta berhasil diperbarui.');
    }

    public function destroy(Peserta $peserta)
    {
        $peserta->delete();

        return redirect()
            ->route('peserta.index')
            ->with('success', 'Data peserta berhasil dihapus.');
    }
}
