<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul', // tambahkan ini
        'isi',
        'gambar',
        // tambahkan field lain yang ingin diisi via mass assignment
    ];
}
