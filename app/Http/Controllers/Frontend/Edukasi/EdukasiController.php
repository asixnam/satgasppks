<?php

namespace App\Http\Controllers\Frontend\Edukasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EdukasiController extends Controller
{
    public function index()
    {
        return view('Frontend.Edukasi.edukasi');
    }

    public function detail()
    {
        return view('Frontend.Edukasi.detail-edukasi');
    }
}
