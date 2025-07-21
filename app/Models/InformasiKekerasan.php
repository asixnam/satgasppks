<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class InformasiKekerasan extends Model
{
    use HasFactory;

    protected $table = 'informasi_kekerasan';

    protected $fillable = [
        'pelapor_id',
        'jenis_kekerasan',
        // 'kategori_kekerasan_seksual',
        'lokus_kejadian',
        'waktu_kejadian',
        'keterangan_pihak_ke3',
        'kategori_pidana',
        'bentuk_kekerasan',
        'narasi_kronologis'
    ];

    protected $casts = [
        'waktu_kejadian' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Relasi dengan model Pelapor
     */
    public function pelapor()
    {
        return $this->belongsTo(Pelapor::class, 'pelapor_id');
    }

    /**
     * Accessor untuk format waktu kejadian
     */
    public function getWaktuKejadianFormattedAttribute()
    {
        return $this->waktu_kejadian ? $this->waktu_kejadian->format('d/m/Y H:i') : null;
    }

    /**
     * Accessor untuk label jenis kekerasan
     */
    public function getJenisKekerasanLabelAttribute()
    {
        $labels = [
            'fisik' => 'Kekerasan Fisik',
            'psikis' => 'Kekerasan Psikis',
            'seksual' => 'Kekerasan Seksual',
            'ekonomi' => 'Kekerasan Ekonomi'
        ];

        return $labels[$this->jenis_kekerasan] ?? $this->jenis_kekerasan;
    }

    /**
     * Accessor untuk label kategori kekerasan seksual
     */
    public function getKategoriKekerasanSeksualLabelAttribute()
    {
        if (!$this->kategori_kekerasan_seksual) {
            return null;
        }

        $labels = [
            'pelecehan' => 'Pelecehan Seksual',
            'pemerkosaan' => 'Pemerkosaan',
            'eksploitasi' => 'Eksploitasi Seksual'
        ];

        return $labels[$this->kategori_kekerasan_seksual] ?? $this->kategori_kekerasan_seksual;
    }

    /**
     * Accessor untuk label lokus kejadian
     */
    public function getLokusKejadianLabelAttribute()
    {
        $labels = [
            'rumah' => 'Rumah',
            'sekolah' => 'Sekolah/Kampus',
            'tempat_kerja' => 'Tempat Kerja',
            'tempat_umum' => 'Tempat Umum',
            'online' => 'Online/Media Sosial'
        ];

        return $labels[$this->lokus_kejadian] ?? $this->lokus_kejadian;
    }

    /**
     * Accessor untuk label keterangan pihak ke-3
     */
    public function getKeteranganPihakKe3LabelAttribute()
    {
        if (!$this->keterangan_pihak_ke3) {
            return null;
        }

        $labels = [
            'ada_saksi' => 'Ada Saksi',
            'tidak_ada_saksi' => 'Tidak Ada Saksi',
            'ada_pelapor_lain' => 'Ada Pelapor Lain'
        ];

        return $labels[$this->keterangan_pihak_ke3] ?? $this->keterangan_pihak_ke3;
    }

    /**
     * Accessor untuk label kategori pidana
     */
    public function getKategoriPidanaLabelAttribute()
    {
        if (!$this->kategori_pidana) {
            return null;
        }

        $labels = [
            'ringan' => 'Pidana Ringan',
            'sedang' => 'Pidana Sedang',
            'berat' => 'Pidana Berat'
        ];

        return $labels[$this->kategori_pidana] ?? $this->kategori_pidana;
    }

    /**
     * Scope untuk filter berdasarkan jenis kekerasan
     */
    public function scopeByJenisKekerasan($query, $jenis)
    {
        return $query->where('jenis_kekerasan', $jenis);
    }

    /**
     * Scope untuk filter berdasarkan lokus kejadian
     */
    public function scopeByLokusKejadian($query, $lokus)
    {
        return $query->where('lokus_kejadian', $lokus);
    }

    /**
     * Scope untuk filter berdasarkan rentang waktu
     */
    public function scopeByWaktuKejadian($query, $start, $end)
    {
        return $query->whereBetween('waktu_kejadian', [$start, $end]);
    }
}
