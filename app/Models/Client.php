<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class Client extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'nama_lengkap',
        'jenis_kelamin',
        'status_korban',
        'kategori_disable',
        'status',
        'sumber_informasi'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date'
    ];

    // Relasi dengan violence reports
    public function violenceReports()
    {
        return $this->hasMany(ViolenceReport::class, 'id_client');
    }

    // Relasi many-to-many dengan reporters melalui violence_reports
    public function reporters()
    {
        return $this->belongsToMany(Reporter::class, 'violence_reports', 'id_client', 'id_reporter');
    }

    // Relasi many-to-many dengan perpetrators melalui violence_reports
    public function perpetrators()
    {
        return $this->belongsToMany(Perpetrator::class, 'violence_reports', 'id_client', 'id_perpetrator');
    }

    // Relasi many-to-many dengan violances melalui violence_reports
    public function violances()
    {
        return $this->belongsToMany(Violance::class, 'violence_reports', 'id_client', 'id_violance');
    }
}

