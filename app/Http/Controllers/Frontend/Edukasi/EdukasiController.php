<?php

namespace App\Http\Controllers\Frontend\Edukasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Edukasi;

class EdukasiController extends Controller
{
    public function index()
    {
        $edukasis = Edukasi::orderBy('created_at', 'desc')->paginate(6);
            return view('frontend.edukasi.index', compact('edukasis'));
    }

        // EducationController.php
    public function show($id)
    
    
{
    $edukasi = Edukasi::findOrFail($id);

    // Ambil 3 edukasi lain yang berbeda dengan yang ditampilkan
    $relatedEdukasi = Edukasi::where('id', '!=', $id)
                            ->orderBy('created_at', 'desc')
                            ->take(3)
                            ->get();

    return view('frontend.edukasi.detail-edukasi', compact('edukasi', 'relatedEdukasi'));
}
}
