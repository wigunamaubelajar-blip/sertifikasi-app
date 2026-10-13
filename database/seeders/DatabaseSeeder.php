<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Peserta;
use App\Models\SkemaSertifikasi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@sertifikasi.test',
            'password' => Hash::make('password123'),
        ]);


        // Skema Sertifikasi
        $webDeveloper = SkemaSertifikasi::create([
            'nama_skema' => 'Junior Web Developer',
            'kode_skema' => 'JWD-001',
            'deskripsi' => 'Skema sertifikasi untuk kompetensi Junior Web Developer.',
            'status' => true,
        ]);

        $programmer = SkemaSertifikasi::create([
            'nama_skema' => 'Junior Programmer',
            'kode_skema' => 'JPR-001',
            'deskripsi' => 'Skema sertifikasi untuk kompetensi Junior Programmer.',
            'status' => true,
        ]);

        $database = SkemaSertifikasi::create([
            'nama_skema' => 'Junior Database Administrator',
            'kode_skema' => 'JDA-001',
            'deskripsi' => 'Skema sertifikasi untuk kompetensi pengelolaan database.',
            'status' => true,
        ]);
    }
}