<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hero;
use App\Models\Berita;
use App\Models\Edukasi;
use App\Models\Tim;
use App\Models\VisiMisi;
use App\Models\ViolenceReport;
use App\Models\Client;
use App\Models\Reporter;
use App\Models\Perpetrator;
use App\Models\Violance;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AppController extends Controller
{
    /**
     * Display the homepage
     */
    public function home()
    {
         $heroes = Hero::all(); // Ambil semua hero dari database
        $hero = $heroes->first();

    if (!$hero) {
        // Buat hero kosong dengan gambar default (tanpa menyimpan ke DB)
        $hero = new \stdClass();
        $hero->gambar = 'images/gedung-unujogja.jpg';
    }
    
        // Ambil berita terbaru (misal 3 untuk tampil di homepage)
        $beritas = Berita::orderBy('created_at', 'desc')->limit(3)->get();
        $edukasis = Edukasi::latest()->limit(3)->get();

        return view('Frontend.Pages.pages', compact('heroes', 'beritas','edukasis','hero'));
    }

    /**
     * Display all berita with search functionality
     */
    public function berita(Request $request)
    {
        $query = Berita::query()->orderBy('created_at', 'desc');

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('isi', 'like', '%' . $request->search . '%');
            });
        }

        $beritas = $query->paginate(6);

        return view('Frontend.Articel.articel', compact('beritas'));
    }

    /**
     * Display specific berita
     */
    public function showBerita($id)
    {
        $berita = Berita::findOrFail($id);
        
        // Get related articles (latest articles excluding current article)
        $relatedArticles = Berita::where('id', '!=', $id)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
        
        return view('Frontend.Articel.show', compact('berita', 'relatedArticles'));
    }

    /**
     * Display all edukasi
     */
    public function edukasi()
    {
        $edukasis = Edukasi::orderBy('created_at', 'desc')->paginate(6);
        return view('frontend.edukasi.index', compact('edukasis'));
    }

    /**
     * Display specific edukasi
     */
    public function showEdukasi($id)
    {
        $edukasi = Edukasi::findOrFail($id);

        // Get 3 other related education content
        $relatedEdukasi = Edukasi::where('id', '!=', $id)
                                ->orderBy('created_at', 'desc')
                                ->take(3)
                                ->get();

        return view('frontend.edukasi.detail-edukasi', compact('edukasi', 'relatedEdukasi'));
    }

    /**
     * Display about us page
     */
    public function tentangKami()
    {
        $tims = Tim::all();
        $visiMisi = VisiMisi::first();
        
        return view('Frontend.Tentang.tentang-kami', compact('tims', 'visiMisi'));
    }

    /**
     * Display violence report creation form
     */
    public function createLaporan()
    {
        return view('Frontend.violance-report.create');
    }

    /**
     * Store violence report
     */
    public function storeLaporan(Request $request)
    {
        // Validation rules for client data
        $clientRules = [
            'client_data.nama_lengkap' => 'required|string|max:255',
            'client_data.jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'client_data.status_korban' => ['required', Rule::in(['Disable', 'Tidak'])],
            'client_data.kategori_disable' => 'nullable|string|max:255',
            'client_data.status' => 'required|string|max:255',
            'client_data.sumber_informasi' => 'nullable|string'
        ];

        // Validation rules for reporter data
        $reporterRules = [
            'reporter_data.hubungan_pelapor_dengan_pelaku' => 'required|string|max:255',
            'reporter_data.nama_lengkap' => 'required|string|max:255',
            'reporter_data.tempat_lahir' => 'required|string|max:255',
            'reporter_data.tanggal_lahir' => 'required|date|before:today',
            'reporter_data.jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'reporter_data.usia' => 'required|integer|min:1|max:120',
            'reporter_data.status_pelapor' => 'required|string|max:255',
            'reporter_data.no_telepon' => 'required|string|max:20|regex:/^[0-9+\-\s]+$/',
            'reporter_data.alamat' => 'required|string|max:1000',
            'reporter_data.keterangan_tambahan' => 'nullable|string|max:2000'
        ];

        // Validation rules for perpetrator data
        $perpetratorRules = [
            'perpetrator_data.hubungan_dengan_korban' => 'required|string|max:255',
            'perpetrator_data.nama' => 'required|string|max:255',
            'perpetrator_data.telepon' => 'nullable|string|max:20|regex:/^[0-9+\-\s]*$/',
            'perpetrator_data.jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'perpetrator_data.keterangan' => 'required|string|max:2000',
            'perpetrator_data.upload_bukti.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
        ];

        // Validation rules for violence data
        $violanceRules = [
            'violance_data.jenis_kekerasan' => 'required|string|max:255',
            'violance_data.bentuk_kekerasan' => 'required|array|min:1',
            'violance_data.bentuk_kekerasan.*' => 'required|string|max:255',
            'violance_data.lokasi_kejadian' => 'required|string|max:500',
            'violance_data.waktu_kejadian' => 'required|date|before_or_equal:today',
            'violance_data.deskripsi_kekerasan' => 'required|string|max:5000'
        ];

        // Custom error messages
        $customMessages = [
            'required' => 'Field :attribute wajib diisi.',
            'string' => 'Field :attribute harus berupa teks.',
            'max' => 'Field :attribute tidak boleh lebih dari :max karakter.',
            'min' => 'Field :attribute minimal :min item.',
            'integer' => 'Field :attribute harus berupa angka.',
            'date' => 'Field :attribute harus berupa tanggal yang valid.',
            'before' => 'Field :attribute harus tanggal sebelum hari ini.',
            'before_or_equal' => 'Field :attribute tidak boleh lebih dari hari ini.',
            'regex' => 'Format :attribute tidak valid.',
            'in' => 'Pilihan :attribute tidak valid.',
            'file' => 'Field :attribute harus berupa file.',
            'mimes' => 'File :attribute harus berformat: :values.',
            'array' => 'Field :attribute harus berupa array.',
        ];

        try {
            $validated = $request->validate(
                array_merge($clientRules, $reporterRules, $perpetratorRules, $violanceRules),
                $customMessages
            );
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Mohon periksa kembali data yang Anda masukkan.');
        }

        DB::beginTransaction();

        try {
            // Save client data
            $client = Client::create([
                'nama_lengkap' => $validated['client_data']['nama_lengkap'],
                'jenis_kelamin' => $validated['client_data']['jenis_kelamin'],
                'status_korban' => $validated['client_data']['status_korban'],
                'kategori_disable' => $validated['client_data']['kategori_disable'] ?? null,
                'status' => $validated['client_data']['status'],
                'sumber_informasi' => $validated['client_data']['sumber_informasi'] ?? null,
            ]);

            // Save reporter data
            $reporter = Reporter::create([
                'hubungan_pelapor_dengan_pelaku' => $validated['reporter_data']['hubungan_pelapor_dengan_pelaku'],
                'nama_lengkap' => $validated['reporter_data']['nama_lengkap'],
                'tempat_lahir' => $validated['reporter_data']['tempat_lahir'],
                'tanggal_lahir' => $validated['reporter_data']['tanggal_lahir'],
                'jenis_kelamin' => $validated['reporter_data']['jenis_kelamin'],
                'usia' => $validated['reporter_data']['usia'],
                'status_pelapor' => $validated['reporter_data']['status_pelapor'],
                'no_telepon' => $validated['reporter_data']['no_telepon'],
                'alamat' => $validated['reporter_data']['alamat'],
                'keterangan_tambahan' => $validated['reporter_data']['keterangan_tambahan'] ?? null,
            ]);

            // Handle file uploads and save perpetrator data
            $perpetratorData = $validated['perpetrator_data'];
            $uploadedFiles = [];

            if ($request->hasFile('perpetrator_data.upload_bukti')) {
                foreach ($request->file('perpetrator_data.upload_bukti') as $file) {
                    if ($file->isValid()) {
                        // Generate unique filename
                        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $path = $file->storeAs('violence-reports/evidence', $filename, 'public');
                        $uploadedFiles[] = $path;
                    }
                }
            }

            $perpetrator = Perpetrator::create([
                'hubungan_dengan_korban' => $perpetratorData['hubungan_dengan_korban'],
                'nama' => $perpetratorData['nama'],
                'telepon' => $perpetratorData['telepon'] ?? null,
                'jenis_kelamin' => $perpetratorData['jenis_kelamin'],
                'keterangan' => $perpetratorData['keterangan'],
                'upload_bukti' => json_encode($uploadedFiles),
            ]);

            // Save violence data
            $violanceData = $validated['violance_data'];
            
            $violance = Violance::create([
                'jenis_kekerasan' => $violanceData['jenis_kekerasan'],
                'bentuk_kekerasan' => json_encode($violanceData['bentuk_kekerasan']),
                'lokasi_kejadian' => $violanceData['lokasi_kejadian'],
                'waktu_kejadian' => $violanceData['waktu_kejadian'],
                'deskripsi_kekerasan' => $violanceData['deskripsi_kekerasan'],
            ]);

            // Save violence report relationship
            $violenceReport = ViolenceReport::create([
                'id_client' => $client->id,
                'id_reporter' => $reporter->id,
                'id_perpetrator' => $perpetrator->id,
                'id_violance' => $violance->id,
                'status' => 'pending',
                'created_at' => now(),
            ]);

            DB::commit();

            // Log successful creation
            Log::info('Violence report created successfully', [
                'report_id' => $violenceReport->id,
                'client_name' => $client->nama_lengkap,
                'reporter_name' => $reporter->nama_lengkap,
            ]);

            return redirect()->route('home')
                ->with('success', 'Laporan kekerasan berhasil dibuat dan akan segera diproses.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            // Delete uploaded files if error occurs
            if (!empty($uploadedFiles)) {
                foreach ($uploadedFiles as $file) {
                    Storage::disk('public')->delete($file);
                }
            }

            // Log error
            Log::error('Failed to create violence report', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['_token', 'perpetrator_data.upload_bukti'])
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan laporan. Silakan coba lagi atau hubungi administrator jika masalah berlanjut.');
        }
    }

    /**
     * Display violence reports list
     */
    public function indexLaporan()
    {
        $reports = ViolenceReport::with(['client', 'reporter', 'perpetrator', 'violance'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('Frontend.violance-report.index', compact('reports'));
    }

    /**
     * Display specific violence report
     */
    public function showLaporan($id)
    {
        $report = ViolenceReport::with(['client', 'reporter', 'perpetrator', 'violance'])
            ->findOrFail($id);

        return view('Frontend.violance-report.show', compact('report'));
    }

    /**
     * Display status check page
     */
    public function cekStatus()
    {
        return view('Frontend.status.cek-status');
    }

    /**
     * Get latest berita for API or widget
     */
    public function latestBerita($limit = 5)
    {
        $beritas = Berita::orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
            
        return response()->json($beritas);
    }

    /**
     * Get latest edukasi for API or widget
     */
    public function latestEdukasi($limit = 5)
    {
        $edukasis = Edukasi::orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
            
        return response()->json($edukasis);
    }
}