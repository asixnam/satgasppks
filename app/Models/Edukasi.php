<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Edukasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',       // ✅ tambahkan ini
        'gambar',   // tambahkan kolom lain yang digunakan
        'konten',
    ];
}