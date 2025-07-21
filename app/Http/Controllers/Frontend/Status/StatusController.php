<?php

namespace App\Http\Controllers\Frontend\Status;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        return view('Frontend.Status.cek-status');
    }
}
