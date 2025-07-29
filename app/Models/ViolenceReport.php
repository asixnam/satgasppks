<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class ViolenceReport extends Model
{
    use HasFactory, HasUuid;

     protected $fillable = [
        'id_client',
        'id_reporter',
        'id_perpetrator',
        'id_violance'
    ];

    protected $casts = [
        'id_client' => 'string',
        'id_reporter' => 'string',
        'id_perpetrator' => 'string',
        'id_violance' => 'string'
    ];

    // Scope untuk laporan terbaru
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Scope untuk laporan dalam rentang tanggal
    public function scopeInDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    // Scope untuk laporan berdasarkan jenis kekerasan
    public function scopeByViolenceType($query, $type)
    {
        return $query->whereHas('violance', function($q) use ($type) {
            $q->where('jenis_kekerasan', $type);
        });
    }

    // Accessor untuk mendapatkan nomor laporan
    public function getReportNumberAttribute()
    {
        return 'RPT-' . $this->created_at->format('Ymd') . '-' . str_pad($this->id, 4, '0', STR_PAD_LEFT);
    }

    // Method untuk mengecek apakah laporan sudah lama (lebih dari 6 bulan)
    public function getIsOldReportAttribute()
    {
        return $this->created_at->diffInMonths(now()) > 6;
    }

    // Relasi belongsTo
    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }

    public function reporter()
    {
        return $this->belongsTo(Reporter::class, 'id_reporter');
    }

    public function perpetrator()
    {
        return $this->belongsTo(Perpetrator::class, 'id_perpetrator');
    }

    public function violance()
    {
        return $this->belongsTo(Violance::class, 'id_violance');
    }

    // Method untuk mendapatkan ringkasan laporan
    public function getSummaryAttribute()
    {
        return [
            'report_number' => $this->report_number,
            'client_name' => $this->client->nama_lengkap,
            'reporter_name' => $this->reporter->nama_lengkap,
            'violence_type' => $this->violance->jenis_kekerasan,
            'incident_date' => $this->violance->waktu_kejadian,
            'report_date' => $this->created_at,
            'location' => $this->violance->lokasi_kejadian
        ];
    }

    // Method untuk mendapatkan status laporan berdasarkan waktu
    public function getStatusAttribute()
    {
        $daysSinceReport = $this->created_at->diffInDays(now());

        if ($daysSinceReport <= 7) {
            return 'Baru';
        } elseif ($daysSinceReport <= 30) {
            return 'Sedang Diproses';
        } elseif ($daysSinceReport <= 90) {
            return 'Dalam Tindak Lanjut';
        } else {
            return 'Arsip';
        }
    }
}
