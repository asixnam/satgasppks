<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->paginate(10);
        return view('admin.beritas.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.beritas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|max:5000'
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create($validated);

        return redirect()->route('beritas.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.beritas.edit', compact('berita'));
    }

   public function update(Request $request, $id)
{
    // ✅ Tambahkan ini dulu!
    $berita = Berita::findOrFail($id);

    $validated = $request->validate([
        'judul' => 'required|string|max:255',
        'isi' => 'required|string',
        'gambar' => 'nullable|image|max:5000'
    ]);

    if ($request->hasFile('gambar')) {
        // Hapus gambar lama jika ada
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }

        // Upload gambar baru
        $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
    }

    $berita->update($validated);

    return redirect()->route('beritas.index')->with('success', 'Berita berhasil diperbarui!');
}

    public function destroy($id)
    {
        $berita = Berita::find($id);

    if (!$berita) {
        return redirect()->route('beritas.index')->with('error', 'Data tidak ditemukan.');
    }

    $berita->delete();

    return redirect()->route('beritas.index')->with('success', 'Berita berhasil dihapus!');
    }
}
