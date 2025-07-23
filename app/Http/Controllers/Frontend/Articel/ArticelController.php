<?php

namespace App\Http\Controllers\Frontend\Articel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;

class ArticelController extends Controller
{
public function index(Request $request)
{
    $query = Berita::query()->orderBy('created_at', 'desc');

    // Fitur pencarian
    if ($request->has('search') && $request->search != '') {
        $query->where(function($q) use ($request) {
            $q->where('judul', 'like', '%' . $request->search . '%')
              ->orWhere('isi', 'like', '%' . $request->search . '%');
        });
    }

    // Paginasi (6 item per halaman)
    $beritas = $query->paginate(6);

    return view('Frontend.Articel.articel', compact('beritas'));
    }



    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        
        // Get related articles (latest articles excluding current article)
        $relatedArticles = Berita::where('id', '!=', $id)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
        
        return view('Frontend.Articel.show', compact('berita', 'relatedArticles'));
    }
    
    /**
     * Get latest berita for homepage or widget
     */
    public function latest($limit = 5)
    {
        $beritas = Berita::orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
            
        return $beritas;
    }
}
