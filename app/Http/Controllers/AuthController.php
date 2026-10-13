<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // MENAMPILKAN HALAMAN LOGIN
    public function showLogin()
    {
        return view('auth.login');
    }

    // MENAMPILKAN HALAMAN REGISTER
    public function showRegister()
    {
        return view('auth.register');
    }


    // PROSES REGISTER
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'digits_between:1,16'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits_between' => 'NIK harus terdiri dari 1 sampai 16 angka.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Cari data peserta yang sesuai dengan nama, NIK, dan email
        $peserta = Peserta::where('nama', $validated['name'])
            ->where('nik', $validated['nik'])
            ->where('email', $validated['email'])
            ->whereDoesntHave('user')
            ->first();

        // Tolak registrasi jika data tidak cocok atau sudah terhubung ke akun lain
        if (!$peserta) {
            return back()
                ->withErrors([
                    'peserta' => 'Data peserta tidak ditemukan, tidak cocok, atau sudah memiliki akun. Periksa kembali data Anda.'
                ])
                ->withInput($request->only('name', 'nik', 'email'));
        }

        // Buat akun dan hubungkan dengan data peserta
        $user = User::create([
            'name' => $peserta->nama,
            'email' => $peserta->email,
            'password' => Hash::make($validated['password']),
            'peserta_id' => $peserta->id,
        ]);

        // Tetapkan role sebagai user
        $user->role = 'user';
        $user->save();

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home');
    }


    // PROSES LOGIN ADMIN/PENGGUNA
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard');
            }

            // Jika user, masuk dashboard peserta
            return redirect()->route('home');
        }

        return back()
            ->withErrors([
                'email' => 'Email atau password tidak sesuai.',
            ])
            ->onlyInput('email');
    }

    // PROSES LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
