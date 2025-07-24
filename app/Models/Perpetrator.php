<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class Perpetrator extends Model
{
    use HasFactory, HasUuid;

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
        'upload_bukti'
    ];

    protected $casts = [
        'tanggal_lahir_pelaku' => 'date',
        'waktu_kejadian' => 'datetime',
        'upload_bukti' => 'array'
    ];

    // Relasi dengan violence reports
    public function violenceReports()
    {
        return $this->hasMany(ViolenceReport::class, 'id_perpetrator');
    }

    // Relasi many-to-many dengan clients melalui violence_reports
    public function clients()
    {
        return $this->belongsToMany(Client::class, 'violence_reports', 'id_perpetrator', 'id_client');
    }

    // Relasi many-to-many dengan reporters melalui violence_reports
    public function reporters()
    {
        return $this->belongsToMany(Reporter::class, 'violence_reports', 'id_perpetrator', 'id_reporter');
    }

    // Relasi many-to-many dengan violances melalui violence_reports
    public function violances()
    {
        return $this->belongsToMany(Violance::class, 'violence_reports', 'id_perpetrator', 'id_violance');
    }
}
