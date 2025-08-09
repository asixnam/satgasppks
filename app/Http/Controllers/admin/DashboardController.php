<?php

// file: app/Http/Controllers/Admin/DashboardController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Edukasi;
use App\Models\Berita;
use App\Models\Tim;
use App\Models\Violence;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

class DashboardController extends Controller
{
    public function index()
    {
        $totalReports = Violence::count();
        $jumlahlaporanBulanIni = Violence::whereMonth('created_at', Carbon::now()->month)
                                    ->whereYear('created_at', Carbon::now()->year)
                                    ->count();

        // PERBAIKAN: Pastikan menggunakan get() untuk mendapatkan Collection, bukan array
        $laporanTerbaru = Violence::latest()->take(3)->get();

        $jumlahTim = Tim::count();
        $jumlahBerita = Berita::count();
        $jumlahBeritaBulanIni = Berita::whereMonth('created_at', now()->month)
                                      ->whereYear('created_at', now()->year)
                                      ->count();

        $jumlahEdukasi = Edukasi::count();
        $jumlahEdukasiBulanIni = Edukasi::whereMonth('created_at', now()->month)->count();

        // PERBAIKAN: Gunakan toArray() pada akhir untuk memastikan konsistensi
        $berita = Berita::select('id','judul','created_at')
            ->latest()->take(5)->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'type' => 'berita',
                    'message' => 'Berita baru "' . $item->judul . '" ditambahkan',
                    'icon' => 'fas fa-plus',
                    'color' => 'blue',
                    'created_at' => $item->created_at->toDateTimeString(),
                ];
            });

        $edukasi = Edukasi::select('id','judul','created_at')
            ->latest()->take(5)->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'type' => 'edukasi',
                    'message' => 'Konten edukasi "' . $item->judul . '" diperbarui',
                    'icon' => 'fas fa-book',
                    'color' => 'purple',
                    'created_at' => $item->created_at->toDateTimeString(),
                ];
            });

        $laporan = Violence::select('id','jenis_kekerasan','created_at')
            ->latest()->take(5)->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'type' => 'laporan',
                    'message' => 'Laporan kekerasan "' . $item->jenis_kekerasan . '" ditambahkan',
                    'icon' => 'fas fa-exclamation',
                    'color' => 'red',
                    'created_at' => $item->created_at->toDateTimeString(),
                ];
            });

        // PERBAIKAN: Gunakan collect() untuk memastikan bekerja dengan Collection
        $aktivitasTerbaru = collect()
            ->merge($berita)
            ->merge($edukasi)
            ->merge($laporan)
            ->sortByDesc(function ($a) {
                return strtotime($a['created_at']);
            })
            ->take(5)
            ->values(); // reset keys

        // PERBAIKAN: Pastikan URL generation aman
        $aktivitasTerbaru = $aktivitasTerbaru->map(function ($a) {
            try {
                switch ($a['type']) {
                    case 'berita':
                        if (Route::has('admin.beritas.show')) {
                            $a['url'] = route('admin.beritas.show', $a['id']);
                        } elseif (Route::has('berita.show')) {
                            $a['url'] = route('berita.show', $a['id']);
                        } else {
                            $a['url'] = url("/admin/beritas/{$a['id']}");
                        }
                        break;
                    
                    case 'edukasi':
                        if (Route::has('admin.edukasis.show')) {
                            $a['url'] = route('admin.edukasis.show', $a['id']);
                        } elseif (Route::has('edukasi.show')) {
                            $a['url'] = route('edukasi.show', $a['id']);
                        } else {
                            $a['url'] = url("/admin/edukasis/{$a['id']}");
                        }
                        break;
                    
                    case 'laporan':
                        if (Route::has('admin.violence-reports.show')) {
                            $a['url'] = route('admin.violence-reports.show', $a['id']);
                        } elseif (Route::has('violence.show')) {
                            $a['url'] = route('violence.show', $a['id']);
                        } else {
                            $a['url'] = url("/admin/violence-reports/{$a['id']}");
                        }
                        break;
                    
                    default:
                        $a['url'] = url("/admin/{$a['type']}/{$a['id']}");
                }
            } catch (\Throwable $e) {
                // Fallback yang lebih aman
                $a['url'] = url("/admin/{$a['type']}/{$a['id']}");
            }
            return $a;
        });

        return view('admin.dashboard.index', compact(
            'totalReports',
            'jumlahlaporanBulanIni',
            'jumlahTim',
            'jumlahBerita',
            'jumlahBeritaBulanIni',
            'jumlahEdukasi',
            'jumlahEdukasiBulanIni',
            'aktivitasTerbaru',
            'laporanTerbaru'
        ));
    }
}