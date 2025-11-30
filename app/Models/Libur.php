<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libur extends Model
{
    protected $fillable = [
        'tanggal',
        'keterangan',
    ];
    
}
