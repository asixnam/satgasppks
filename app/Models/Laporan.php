<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporans';

    protected $fillable = [
        'judul',
        'isi',
        'pelapor_id',
        'klien_id',
        // 'informasi_kekerasan_id',
        'tanggal_kejadian',
        'hubungan',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'usia',
        'pekerjaan',
        'no_telepon',
        'alamat',
        'keterangan',
    ];

    public function pelapor()
    {
        return $this->belongsTo(Pelapor::class);
    }

    public function klien()
    {
        return $this->belongsTo(Klien::class);
    }

    public function informasiKekerasan()
    {
        return $this->belongsTo(InformasiKekerasan::class);
    }
}
