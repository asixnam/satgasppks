<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Edukasi;
use App\Models\Berita;
use App\Models\Tim;
use Illuminate\Support\Collection;
use App\Models\Violance;
use carbon\carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalReports = Violance::count(); // atau ViolenceReport::count()
        $jumlahlaporanBulanIni = Violance::whereMonth('created_at', Carbon::now()->month)
                                      ->whereYear('created_at', Carbon::now()->year)
                                      ->count();

        // return view('admin.dashboard.index', compact('totalReports', 'jumlahlaporanBulanIni'));

        $jumlahTim = Tim::count(); 
        $jumlahBerita = Berita::count();
        $jumlahBeritaBulanIni = Berita::whereMonth('created_at', now()->month)
                                      ->whereYear('created_at', now()->year)
                                      ->count();

        $jumlahEdukasi = Edukasi::count();
        $jumlahEdukasiBulanIni = Edukasi::whereMonth('created_at', now()->month)->count();

         // Ambil masing-masing aktivitas terbaru
            $berita = Berita::select('judul', 'created_at')
                            ->latest()
                            ->take(5)
                            ->get()
                            ->map(function ($item) {
                                return [
                                    'type' => 'berita',
                                    'message' => 'Berita baru "' . $item->judul . '" ditambahkan',
                                    'icon' => 'fas fa-plus',
                                    'color' => 'blue',
                                    'created_at' => $item->created_at,
                                ];
                            });

            $edukasi = Edukasi::select('judul', 'created_at')
                            ->latest()
                            ->take(5)
                            ->get()
                            ->map(function ($item) {
                                return [
                                    'type' => 'edukasi',
                                    'message' => 'Konten edukasi "' . $item->judul . '" diperbarui',
                                    'icon' => 'fas fa-book',
                                    'color' => 'purple',
                                    'created_at' => $item->created_at,
                                ];
                            });

            $laporan = Violance::select('jenis_kekerasan', 'created_at')
                ->latest()
                ->take(5)
                ->get()
                ->map(function ($item) {
                    return [
                        'type' => 'laporan',
                        'message' => 'Laporan kekerasan "' . $item->jenis_kekerasan . '" ditambahkan',
                        'icon' => 'fas fa-exclamation',
                        'color' => 'red',
                        'created_at' => $item->created_at,
                    ];
                });
    // Gabungkan dan urutkan semua aktivitas berdasarkan waktu terbaru
    $aktivitasTerbaru = $berita
        ->merge($edukasi)
        ->merge($laporan)
        ->sortByDesc('created_at')
        ->take(5); // tampilkan 5 aktivitas terbaru saja

        return view('admin.dashboard.index', compact(
            'totalReports',
            'jumlahlaporanBulanIni',
            'jumlahTim',
            'jumlahBerita',
            'jumlahBeritaBulanIni',
            'jumlahEdukasi',
            'jumlahEdukasiBulanIni',
            'aktivitasTerbaru'
        ));
    }
}
