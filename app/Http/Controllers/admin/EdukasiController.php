<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Edukasi;
use Illuminate\Http\Request;


class EdukasiController extends Controller
{
    public function index()
    {
        $edukasis = Edukasi::latest()->paginate(10);
        return view('admin.edukasis.index', compact('edukasis'));
    }

    public function create()
    {
        return view('admin.edukasis.create');
    }




public function store(Request $request) 
{
    $validated = $request->validate([
        'judul' => 'required|string|max:255',
        'konten' => 'required|string',
        'gambar' => 'nullable|image|max:5000',
    ]);

    $data = [
        'judul' => $validated['judul'],
        'konten' => $validated['konten'],
    ];

    // Upload gambar jika ada
    if ($request->hasFile('gambar')) {
        $path = $request->file('gambar')->store('edukasi', 'public');
        $data['gambar'] = $path;
    }

    Edukasi::create($data);

    return redirect()->route('edukasis.index')->with('success', 'Data edukasi berhasil ditambahkan.');
}


    // Tambahan opsional
    public function edit($id)
    {
        $edukasi = Edukasi::findOrFail($id);
        return view('admin.edukasis.edit', compact('edukasi'));
    }

    public function update(Request $request, $id)
    {
        $edukasi = Edukasi::findOrFail($id);

        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|max:5000',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('edukasi', 'public');
        }

        $edukasi->update($data);

        return redirect()->route('edukasis.index')->with('success', 'Edukasi berhasil diperbarui!');
    }




    

    public function destroy($id)
    {
        $edukasi = Edukasi::findOrFail($id);
        $edukasi->delete();

        return redirect()->route('edukasis.index')->with('success', 'Edukasi berhasil dihapus!');
    }
}
