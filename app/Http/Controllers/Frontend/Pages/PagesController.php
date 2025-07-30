<?php

namespace App\Http\Controllers\Frontend\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hero; 
use App\Models\Berita;
use App\Models\Edukasi;

class PagesController extends Controller
{
    public function home()
    {
        $heroes = Hero::all(); // Ambil semua hero dari database
        // Ambil berita terbaru (misal 3 untuk tampil di homepage)
        $beritas = Berita::orderBy('created_at', 'desc')->limit(3)->get();
        $edukasis = Edukasi::latest()->limit(3)->get();

        return view('Frontend.Pages.pages', compact('heroes', 'beritas','edukasis'));
    }
}
