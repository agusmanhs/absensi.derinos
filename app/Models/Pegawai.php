<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $fillable = [
        'user_id',
        'jabatan_id',
        'foto',
        'nik',
        'nama',
        'jenisKelamin',
        'alamat',
        'notelp',  
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }
}
