<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tim;
;

class TimController extends Controller
{
    public function index()
    {
        $tims = \App\Models\Tim::all(); // Ambil semua data tim dari database
        return view('admin.tims.index', compact('tims'));
    }

    public function create()
    {
        return view('admin.tims.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'jabatan' => 'required|string',
        'foto' => 'nullable|image|max:5000',
    ]);

    // Upload foto jika ada
    $path = $request->hasFile('foto') 
        ? $request->file('foto')->store('tim', 'public') 
        : null;

    Tim::create([
        'nama' => $validated['nama'],
        'jabatan' => $validated['jabatan'],
        'foto' => $path,
    ]);

   return redirect()->route('tims.index');
}

public function edit($id)
{
    $tim = Tim::findOrFail($id);
    return view('admin.tims.edit', compact('tim'));
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'jabatan' => 'required|string',
        'foto' => 'nullable|image|max:5000',
    ]);

    $tim = Tim::findOrFail($id);

    // Jika ada file baru, upload dan ganti
    if ($request->hasFile('foto')) {
        // Hapus foto lama jika ada
        if ($tim->foto && \Storage::disk('public')->exists($tim->foto)) {
            \Storage::disk('public')->delete($tim->foto);
        }

        $tim->foto = $request->file('foto')->store('tim', 'public');
    }

    $tim->nama = $validated['nama'];
    $tim->jabatan = $validated['jabatan'];
    $tim->save();

    return redirect()->route('tims.index')->with('success', 'Data tim berhasil diperbarui.');
}

public function destroy($id)
{
    $tim = Tim::findOrFail($id);

    // Hapus file foto jika ada
    if ($tim->foto && \Storage::disk('public')->exists($tim->foto)) {
        \Storage::disk('public')->delete($tim->foto);
    }

    $tim->delete();

    return redirect()->route('tims.index')->with('success', 'Data tim berhasil dihapus.');
}

}
