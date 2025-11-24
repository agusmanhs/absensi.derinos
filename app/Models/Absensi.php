<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absensi extends Model
{
    use HasFactory;
    protected $table = 'absensis'; 
    protected $fillable = [
        'user_id',
        'tanggal',
        'lokasi_kantor',
        'absen_masuk',
        'lokasi_masuk',
        'ket_masuk',
        'absen_keluar',
        'lokasi_keluar',
        'ket_keluar',
        'status',
        'ket_izin',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
