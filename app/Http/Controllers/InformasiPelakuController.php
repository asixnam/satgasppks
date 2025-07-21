<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelaku;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class InformasiPelakuController extends Controller
{
       public function pelapor()
        {
            return $this->belongsTo(Pelapor::class);
        }
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'usia' => 'required|integer|min:1|max:120',
            'hubungan_dengan_korban' => 'nullable|string|max:100',
            'pekerjaan' => 'nullable|string|max:100',
            'alamat' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:1000',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Mohon periksa kembali data yang diisi.');
        }

        try {
            // Simpan data ke database
            Pelaku::create([
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'usia' => $request->usia,
                'hubungan_dengan_korban' => $request->hubungan_dengan_korban,
                'pekerjaan' => $request->pekerjaan,
                'alamat' => $request->alamat,
                'keterangan' => $request->keterangan,
            ]);

         
         return redirect()->back()->with('success', 'Data pelaku berhasil disimpan.');
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan data pelaku: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data pelaku.');
        }
    }
}
