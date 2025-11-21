<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $fillable = [
        'user_id',
        'foto',
        'nik',
        'nama',
        'jenisKelamin',
        'alamat',
        'jabatan',
        'notelp',  
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
