<?php

namespace App\Http\Controllers\Frontend\Pelapor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelapor;
use App\Models\Klien;
use App\Models\Pelaku;
use App\Models\Kekerasan;
use App\Models\InformasiKekerasan;
use Illuminate\Support\Facades\Storage;

class LaporController extends Controller
{
    // Step 1 - Data Pelapor
    public function index()
    {
        return view('Frontend.Pelapor.from-lapor-1');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'hubungan' => 'required|string',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'usia' => 'required|integer|min:1|max:120',
            'pekerjaan' => 'nullable|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'alamat' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        // ✅ Fix: Simpan ke variabel terlebih dahulu
        $pelapor = Pelapor::create($validated);
        session(['pelapor_id' => $pelapor->id]);
        
        return redirect()->route('lapor.step2')->with('success', 'Data pelapor berhasil disimpan!');
    }

    // Step 2 - Data Klien
    public function step2()
    {
        $pelapor_id = session('pelapor_id');
        
        if (!$pelapor_id) {
            return redirect()->route('lapor.form')->with('error', 'Silakan isi data pelapor terlebih dahulu.');
        }

        return view('Frontend.Pelapor.from-lapor-2');
    }

    public function storeStep2(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nim' => 'required|string|max:50',
            'program_studi' => 'required|string|max:100',
            'fakultas' => 'required|string|max:100',
            'angkatan' => 'required|string|max:10',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'agama' => 'required|string|max:50',
            'status_perkawinan' => 'required|string|max:50',
            'sumber_rujukan' => 'required|string|max:255',
        ]);

        $pelapor_id = session('pelapor_id');
        
        if (!$pelapor_id) {
            return redirect()->route('lapor.form')->with('error', 'Silakan isi data pelapor terlebih dahulu.');
        }

        // ✅ Fix: Tambahkan pelapor_id ke dalam data klien
        $validated['pelapor_id'] = $pelapor_id;
        $klien = Klien::create($validated);
        session(['klien_id' => $klien->id]);

        return redirect()->route('lapor.step3');
    }

    // Step 3 - Informasi Kekerasan
    public function step3()
    {
        $pelapor_id = session('pelapor_id');
        $klien_id = session('klien_id');

        if (!$pelapor_id || !$klien_id) {
            return redirect()->route('lapor.form')->with('error', 'Silakan lengkapi data sebelumnya terlebih dahulu.');
        }

        $pelapor = Pelapor::findOrFail($pelapor_id);
        $klien = Klien::findOrFail($klien_id);
        
        return view('Frontend.Pelapor.from-lapor-3', compact('pelapor', 'klien'));
    }

    public function storeStep3(Request $request)
    {
        $validated = $request->validate([
            'jenis_kekerasan' => 'required|string',
            'kategori_kekerasan_seksual' => 'nullable|string',
            'lokus_kejadian' => 'required|string',
            'waktu_kejadian' => 'required|date',
            'keterangan_pihak_ke3' => 'nullable|string',
            'kategori_pidana' => 'nullable|string',
            'bentuk_kekerasan' => 'required|string',
            'narasi_kronologis' => 'required|string',
        ]);

        $pelapor_id = session('pelapor_id');
        $klien_id = session('klien_id');

        if (!$pelapor_id || !$klien_id) {
            return redirect()->route('lapor.form')->with('error', 'Silakan lengkapi data sebelumnya terlebih dahulu.');
        }

        // ✅ Fix: Tambahkan kedua ID
        $validated['pelapor_id'] = $pelapor_id;
        $validated['klien_id'] = $klien_id;
        
        InformasiKekerasan::create($validated);

        return redirect()->route('lapor.step4');
    }

    // Step 4 - Data Pelaku
    public function step4()
    {
        $pelapor_id = session('pelapor_id');
        $klien_id = session('klien_id');

        if (!$pelapor_id || !$klien_id) {
            return redirect()->route('lapor.form')->with('error', 'Silakan lengkapi data sebelumnya terlebih dahulu.');
        }

        $pelapor = Pelapor::findOrFail($pelapor_id);
        $klien = Klien::findOrFail($klien_id);
        
        return view('Frontend.Pelapor.from-lapor-4', compact('pelapor', 'klien'));
    }

    public function storeStep4(Request $request)
    {
        $validated = $request->validate([
            'hubungan_dengan_korban' => 'required|string',
            'nik_pelaku' => 'nullable|string|max:16',
            'nama_pelaku' => 'required|string|max:255',
            'jenis_kelamin_pelaku' => 'required|in:laki-laki,perempuan',
            'umur_pelaku' => 'nullable|integer|min:1|max:120',
            'tempat_lahir_pelaku' => 'nullable|string|max:255',
            'tanggal_lahir_pelaku' => 'nullable|date|before_or_equal:today',
            'agama_pelaku' => 'nullable|string|max:50',
            'status_perkawinan_pelaku' => 'nullable|string|max:50',
            'pendidikan_pelaku' => 'nullable|string|max:50',
            'pekerjaan_pelaku' => 'nullable|string|max:100',
            'alamat_pelaku' => 'nullable|string',
            'telepon_pelaku' => 'nullable|string|max:20',
            'upload_bukti.*' => 'nullable|file|max:5120|mimes:pdf,jpg,jpeg,png,doc,docx',
            'jenis_kekerasan' => 'required|string',
            'kronologi' => 'required|string',
        ]);

        
    $pelapor_id = session('pelapor_id');
    $klien_id = session('klien_id');

    if (!$pelapor_id || !$klien_id) {
        return redirect()->route('lapor.form')->with('error', 'Silakan lengkapi data sebelumnya terlebih dahulu.');
    }

    $uploadPaths = [];
    if ($request->hasFile('upload_bukti')) {
        foreach ($request->file('upload_bukti') as $file) {
            $uploadPaths[] = $file->store('bukti_laporan', 'public');
        }
    }

    $validated['klien_id'] = $klien_id;
    $validated['pelapor_id'] = $pelapor_id;
    $validated['upload_bukti'] = json_encode($uploadPaths);

    Pelaku::create($validated);

    // ✅ Hapus sesi setelah selesai
    session()->forget(['pelapor_id', 'klien_id']);

    // ✅ Redirect dengan parameter pelapor
    return redirect()->route('lapor.selesai')->with('success', 'Laporan berhasil dikirim.');
    }

    // Final Step - Terima kasih
    public function selesai()
    {
        return view('Frontend.Pelapor.selesai');
    }
}