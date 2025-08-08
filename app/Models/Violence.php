<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class Violence extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'jenis_kekerasan',
        'bentuk_kekerasan',
        'lokasi_kejadian',
        'waktu_kejadian',
        'deskripsi_kekerasan'

    ];

    protected $casts = [
        'waktu_kejadian' => 'datetime',
        'bentuk_kekerasan' => 'array',
    ];

    // Relasi dengan violence reports
    public function violenceReports()
    {
        return $this->hasMany(ViolenceReport::class, 'id_violence');
    }

    // Relasi many-to-many dengan clients melalui violence_reports
    public function clients()
    {
        return $this->belongsToMany(Client::class, 'violence_reports', 'id_violence', 'id_client');
    }

    // Relasi many-to-many dengan reporters melalui violence_reports
    public function reporters()
    {
        return $this->belongsToMany(Reporter::class, 'violence_reports', 'id_violence', 'id_reporter');
    }

    // Relasi many-to-many dengan perpetrators melalui violence_reports
    public function perpetrators()
    {
        return $this->belongsToMany(Perpetrator::class, 'violence_reports', 'id_violence', 'id_perpetrator');
    }
}
