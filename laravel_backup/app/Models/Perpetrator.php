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
        'nama',
        'telepon',
        'jenis_kelamin',
        'keterangan',
        'upload_bukti'
    ];

    protected $casts = [
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
    public function violences()
    {
        return $this->belongsToMany(Violence::class, 'violence_reports', 'id_perpetrator', 'id_violence');
    }
}
