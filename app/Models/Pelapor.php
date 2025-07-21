<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pelapor extends Model
{
    use HasFactory;

    protected $table = 'pelapor';


    protected $fillable = [
        'hubungan',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'usia',
        'pekerjaan',
        'no_telepon',
        'alamat',
        'keterangan'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'usia' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Relasi dengan model InformasiKekerasan
     */
    public function informasiKekerasan()
    {
        return $this->hasOne(InformasiKekerasan::class,);
    }

    /**
     * Accessor untuk format tanggal lahir
     */
    public function getTanggalLahirFormattedAttribute()
    {
        return $this->tanggal_lahir ? $this->tanggal_lahir->format('d/m/Y') : null;
    }

    /**
     * Accessor untuk label hubungan
     */
    public function getHubunganLabelAttribute()
    {
        $labels = [
            'diri_sendiri' => 'Diri Sendiri',
            'keluarga' => 'Keluarga',
            'teman_dekat' => 'Teman Dekat',
            'teman_kos' => 'Teman Kos',
            'teman_organisasi' => 'Teman Organisasi',
            'tetangga' => 'Tetangga',
            'rekan_kerja' => 'Rekan Kerja',
            'lainnya' => 'Lainnya'
        ];

        return $labels[$this->hubungan] ?? $this->hubungan;
    }

    /**
     * Accessor untuk label jenis kelamin
     */
    public function getJenisKelaminLabelAttribute()
    {
        $labels = [
            'laki-laki' => 'Laki-laki',
            'perempuan' => 'Perempuan'
        ];

        return $labels[$this->jenis_kelamin] ?? $this->jenis_kelamin;
    }

    /**
     * Accessor untuk nama lengkap dengan tempat lahir
     */
    public function getNamaLengkapAttribute()
    {
        return $this->nama . ' (' . $this->tempat_lahir . ')';
    }

    /**
     * Accessor untuk status laporan (apakah sudah lengkap)
     */
    public function getStatusLaporanAttribute()
    {
        return $this->informasiKekerasan ? 'Lengkap' : 'Belum Lengkap';
    }

    /**
     * Scope untuk filter berdasarkan hubungan
     */
    public function scopeByHubungan($query, $hubungan)
    {
        return $query->where('hubungan', $hubungan);
    }

    /**
     * Scope untuk filter berdasarkan jenis kelamin
     */
    public function scopeByJenisKelamin($query, $jenis_kelamin)
    {
        return $query->where('jenis_kelamin', $jenis_kelamin);
    }

    /**
     * Scope untuk filter berdasarkan usia
     */
    public function scopeByUsia($query, $min_usia, $max_usia)
    {
        return $query->whereBetween('usia', [$min_usia, $max_usia]);
    }

    /**
     * Scope untuk laporan yang sudah lengkap
     */
    public function scopeComplete($query)
    {
        return $query->whereHas('informasiKekerasan');
    }

    /**
     * Scope untuk laporan yang belum lengkap
     */
    public function scopeIncomplete($query)
    {
        return $query->whereDoesntHave('informasiKekerasan');
    }
}
