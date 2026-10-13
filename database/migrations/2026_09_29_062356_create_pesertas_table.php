<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peserta', function (Blueprint $table) {
            $table->id();

            $table->string('nama');
            $table->string('nik')->unique();
            $table->string('email')->unique();
            $table->string('no_hp');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat');

            $table->foreignId('skema_sertifikasi_id')
                ->constrained('skema_sertifikasi')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->date('tanggal_daftar');
            $table->enum('status', [
                'Terdaftar',
                'Dijadwalkan',
                'Selesai'
            ])->default('Terdaftar');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesertas');
    }
};
