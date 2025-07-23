<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    public function index()
    {
        $heroes = Hero::all();
        return view('admin.heroes.index', compact('heroes')); // FIXED: dari 'hero' ke 'heroes'
    }

    public function create()
    {
        return view('admin.heroes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_gambar' => 'required|string|max:255',
            'gambar' => 'required|image|max:2048',
        ]);

        $path = $request->file('gambar')->store('heroes', 'public');

        Hero::create([
            'nama_gambar' => $validated['nama_gambar'],
            'gambar' => $path,
        ]);

        return redirect()->route('hero.index')->with('success', 'Hero berhasil ditambahkan');
    }

    public function edit($id)
    {
        $hero = Hero::findOrFail($id);
        return view('admin.heroes.edit', compact('hero')); // FIXED: dari 'admin.hero.edit' ke 'admin.heroes.edit'
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_gambar' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $hero = Hero::findOrFail($id);
        
        $hero->nama_gambar = $request->nama_gambar;

        // Jika ada gambar baru yang diupload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($hero->gambar && Storage::disk('public')->exists($hero->gambar)) {
                Storage::disk('public')->delete($hero->gambar);
            }

            // Upload gambar baru
            $gambarPath = $request->file('gambar')->store('heroes', 'public');
            $hero->gambar = $gambarPath;
        }

        $hero->save();

        return redirect()->route('hero.index')->with('success', 'Hero berhasil diupdate!');
    }

    public function destroy(Hero $hero)
    {
        Storage::disk('public')->delete($hero->gambar);
        $hero->delete();

        return redirect()->route('hero.index')->with('success', 'Hero berhasil dihapus');
    }
}