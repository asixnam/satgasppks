<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tim extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', // ✅ tambahkan ini
        'jabatan', // tambahkan kolom lain sesuai kebutuhan
        'foto',
    ];
}
