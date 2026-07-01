<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TentangKami;
use Illuminate\Http\Request;

class TentangKamiController extends Controller
{
    public function index()
    {
        $items = TentangKami::all();
        return view('admin.tentangkami.index', compact('items'));
    }

    public function create()
    {
        return view('admin.tentangkami.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        TentangKami::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
        ]);

        return redirect()->route('tentangkami.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function show(TentangKami $tentangkami)
    {
        return view('admin.tentangkami.show', compact('tentangkami'));
    }

    public function edit(TentangKami $tentangkami)
    {
        return view('admin.tentangkami.edit', compact('tentangkami'));
    }

    public function update(Request $request, TentangKami $tentangkami)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        $tentangkami->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
        ]);

        return redirect()->route('tentangkami.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(TentangKami $tentangkami)
    {
        $tentangkami->delete();
        return redirect()->route('tentangkami.index')->with('success', 'Data berhasil dihapus.');
    }
}
