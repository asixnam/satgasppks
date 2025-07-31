<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    public function index()
    {
        $data = VisiMisi::first();
        return view('admin.visi-misi.index', compact('data'));
    }

    public function create()
    {
        return view('admin.visi-misi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
        ]);

        VisiMisi::create($request->all());

        return redirect()->route('admin.visi-misi.index')->with('success', 'Visi & Misi berhasil ditambahkan.');
    }

    public function edit(VisiMisi $visiMisi)
    {
        return view('admin.visi-misi.edit', compact('visiMisi'));
    }

    public function update(Request $request, VisiMisi $visiMisi)
    {
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
        ]);

        $visiMisi->update($request->all());

        return redirect()->route('admin.visi-misi.index')->with('success', 'Visi & Misi berhasil diperbarui.');
    }
}

