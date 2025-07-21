<?php

namespace App\Http\Controllers\Frontend\Articel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;

class ArticelController extends Controller
{
    public function index()
    {

        return view('Frontend.Articel.articel');
    }


    public function detail()
    {
        return view('Frontend.Articel.detail-articel');
    }
}
