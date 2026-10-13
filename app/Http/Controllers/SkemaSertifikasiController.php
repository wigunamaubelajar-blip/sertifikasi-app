<?php

namespace App\Http\Controllers;

use App\Models\SkemaSertifikasi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SkemaSertifikasiController extends Controller
{
    public function index()
    {
        $skemas = SkemaSertifikasi::latest()->paginate(10);

        return view('skema.index', compact('skemas'));
    }

    public function create()
    {
        return view('skema.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_skema' => ['required', 'string', 'max:255'],
            'kode_skema' => ['required', 'string', 'max:100', 'unique:skema_sertifikasi,kode_skema'],
            'deskripsi' => ['nullable', 'string'],
            'status' => ['required', 'boolean'],
        ]);

        SkemaSertifikasi::create($validated);

        return redirect()
            ->route('skema.index')
            ->with('success', 'Skema sertifikasi berhasil ditambahkan.');
    }

    public function edit(SkemaSertifikasi $skema)
    {
        return view('skema.edit', compact('skema'));
    }

    public function update(Request $request, SkemaSertifikasi $skema)
    {
        $validated = $request->validate([
            'nama_skema' => ['required', 'string', 'max:255'],
            'kode_skema' => [
                'required',
                'string',
                'max:100',
                Rule::unique('skema_sertifikasi', 'kode_skema')
                    ->ignore($skema->id),
            ],
            'deskripsi' => ['nullable', 'string'],
            'status' => ['required', 'boolean'],
        ]);

        $skema->update($validated);

        return redirect()
            ->route('skema.index')
            ->with('success', 'Skema sertifikasi berhasil diperbarui.');
    }

    public function destroy(SkemaSertifikasi $skema)
    {
        if ($skema->peserta()->exists()) {
            return redirect()
                ->route('skema.index')
                ->with('error', 'Skema tidak dapat dihapus karena masih digunakan oleh peserta.');
        }

        $skema->delete();

        return redirect()
            ->route('skema.index')
            ->with('success', 'Skema sertifikasi berhasil dihapus.');
    }
}