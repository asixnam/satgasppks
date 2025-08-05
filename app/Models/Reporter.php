<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class Reporter extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'hubungan_pelapor_dengan_pelaku',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'usia',
        'status_pelapor',
        'no_telepon',
        'email',
        'alamat',
        'keterangan_tambahan'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date'
    ];

    // Relasi dengan violence reports
    public function violenceReports()
    {
        return $this->hasMany(ViolenceReport::class, 'id_reporter');
    }

    // Relasi many-to-many dengan clients melalui violence_reports
    public function clients()
    {
        return $this->belongsToMany(Client::class, 'violence_reports', 'id_reporter', 'id_client');
    }

    // Relasi many-to-many dengan perpetrators melalui violence_reports
    public function perpetrators()
    {
        return $this->belongsToMany(Perpetrator::class, 'violence_reports', 'id_reporter', 'id_perpetrator');
    }

    // Relasi many-to-many dengan violances melalui violence_reports
    public function violances()
    {
        return $this->belongsToMany(Violance::class, 'violence_reports', 'id_reporter', 'id_violance');
    }
}