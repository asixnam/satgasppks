<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Edukasi;
use App\Models\Berita;
use App\Models\Tim;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    public function index()
    {
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

            // $laporan = Laporan::select('jenis_laporan', 'status', 'created_at')
            //                   ->latest()
            //                   ->take(5)
            //                   ->get()
            //                   ->map(function ($item) {
            //                       $message = $item->status === 'Selesai'
            //                           ? 'Laporan "' . $item->jenis_laporan . '" telah diselesaikan'
            //                           : 'Laporan baru "' . $item->jenis_laporan . '" diterima';
            //                       return [
            //                           'type' => 'laporan',
            //                           'message' => $message,
            //                           'icon' => $item->status === 'Selesai' ? 'fas fa-check' : 'fas fa-exclamation',
            //                           'color' => $item->status === 'Selesai' ? 'green' : 'red',
            //                           'created_at' => $item->created_at,
            //                       ];
            //                   });

    // Gabungkan dan urutkan semua aktivitas berdasarkan waktu terbaru
    $aktivitasTerbaru = $berita
        ->merge($edukasi)
        // ->merge($laporan)
        ->sortByDesc('created_at')
        ->take(5); // tampilkan 5 aktivitas terbaru saja

        return view('admin.dashboard.index', compact(
            'jumlahTim',
            'jumlahBerita',
            'jumlahBeritaBulanIni',
            'jumlahEdukasi',
            'jumlahEdukasiBulanIni',
            'aktivitasTerbaru'
        ));
    }
}
