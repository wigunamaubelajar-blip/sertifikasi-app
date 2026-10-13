<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    // MENAMPILKAN DATA PESERTA MILIK USER YANG LOGIN
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $peserta = $user->peserta()
            ->with('skemaSertifikasi')
            ->first();

        // Jika akun tidak memiliki data peserta yang terhubung
        if (!$peserta) {
            abort(403, 'Akun ini belum terhubung dengan data peserta.');
        }

        return view('peserta-dashboard', compact('peserta'));
    }

    // MEMPERBARUI DATA PESERTA MILIK USER SENDIRI
    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $peserta = $user->peserta;

        if (!$peserta) {
            abort(403, 'Akun ini belum terhubung dengan data peserta.');
        }

        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:100',
                'regex:/^[\pL\s]+$/u',
            ],
            'nik' => [
                'required',
                'string',
                'digits_between:1,16',
                Rule::unique('peserta', 'nik')->ignore($peserta->id),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('peserta', 'email')->ignore($peserta->id),
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'no_hp' => [
                'required',
                'string',
                'max:13',
                'regex:/^[0-9]+$/',
            ],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])
            ],
            'alamat' => [
                'required',
                'string',
                'max:500',
            ],
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.regex' => 'Nama hanya boleh menggunakan huruf dan spasi.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits_between' => 'NIK harus terdiri dari 1 sampai 16 angka.',
            'nik.unique' => 'NIK sudah digunakan peserta lain.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.max' => 'Nomor HP maksimal 13 angka.',
            'no_hp.regex' => 'Nomor HP hanya boleh berisi angka.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'alamat.required' => 'Alamat wajib diisi.',
        ]);

        // Perbarui data peserta dan data akun secara bersamaan
        DB::transaction(function () use ($peserta, $user, $validated) {
            $peserta->update($validated);

            $user->update([
                'name' => $validated['nama'],
                'email' => $validated['email'],
            ]);
        });

        return redirect()
            ->route('home')
            ->with('success', 'Data peserta berhasil diperbarui.');
    }
}
