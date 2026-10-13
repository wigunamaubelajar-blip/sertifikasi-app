<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peserta extends Model
{
    protected $table = 'peserta';

    protected $fillable = [
        'nama',
        'nik',
        'email',
        'no_hp',
        'jenis_kelamin',
        'alamat',
        'skema_sertifikasi_id',
        'tanggal_daftar',
        'status',
    ];

    protected $casts = [
        'tanggal_daftar' => 'date',
    ];

    public function skemaSertifikasi(): BelongsTo
    {
        return $this->belongsTo(
            SkemaSertifikasi::class,
            'skema_sertifikasi_id'
        );
    }
    
    public function user()
    {
        return $this->hasOne(User::class);
    }
}