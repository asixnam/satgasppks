<?php

namespace App\Http\Controllers\Frontend\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tim; // Sesuaikan dengan nama model Tim Anda
use App\Models\VisiMisi; // Sesuaikan dengan nama model VisiMisi Anda

class AboutController extends Controller
{
    public function index()
    {
        // Ambil semua data tim
        $tims = Tim::all();
        
        // Ambil data visi misi (asumsi hanya ada satu record)
        $visiMisi = VisiMisi::first();
        
        return view('Frontend.Tentang.tentang-kami', compact('tims', 'visiMisi'));
    }
}