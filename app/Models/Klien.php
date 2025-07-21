<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klien extends Model
{
    use HasFactory;

    protected $table = 'klien';

    protected $fillable = [
        'nama_lengkap',
        'nim',
        'program_studi',
        'fakultas',
        'angkatan',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'status_perkawinan',
        'sumber_rujukan',
    ];
}
