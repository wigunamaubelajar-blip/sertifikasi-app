<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SkemaSertifikasi extends Model
{
    protected $table = 'skema_sertifikasi';

    protected $fillable = [
        'nama_skema',
        'kode_skema',
        'deskripsi',
        'status',
    ];

    public function peserta(): HasMany
    {
        return $this->hasMany(Peserta::class, 'skema_sertifikasi_id');
    }
}