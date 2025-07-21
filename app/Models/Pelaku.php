<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelaku extends Model
{
    use HasFactory;

    protected $table = 'pelaku_laporan';

    protected $fillable = [
        'hubungan_dengan_korban',
        'nik_pelaku',
        'nama_pelaku',
        'jenis_kelamin_pelaku',
        'umur_pelaku',
        'tempat_lahir_pelaku',
        'tanggal_lahir_pelaku',
        'agama_pelaku',
        'status_perkawinan_pelaku',
        'pendidikan_pelaku',
        'pekerjaan_pelaku',
        'alamat_pelaku',
        'telepon_pelaku',
        'jenis_kekerasan',
        'waktu_kejadian',
        'tempat_kejadian',
        'kronologi',
        'keterangan_tambahan',
        'upload_bukti',
        'jenis_kekerasan',
        'kronologi',
    ];
}
