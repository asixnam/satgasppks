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
use App\Models\Violence;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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
            $hero = new \stdClass();
            $hero->gambar = 'images/gedung-unujogja.jpg';
            $heroes = collect([$hero]);
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
        return view('Frontend.violence-report.create');
    }
    public function successLaporan()
    {
        if (!session()->has('report_id')) {
            return redirect()->route('home')->with('error', 'Akses tidak valid ke halaman sukses.');
        }

        $reportId = session('report_id');

        return view('Frontend.violence-report.success', compact('reportId'));
    }



    /**
     * Store violence report
     */
    public function store(Request $request)
    {
        // dd('store jalan', $request->all());
        // Validation rules for client data
        $clientRules = [
            'client_data.nama_lengkap' => 'required|string|max:255',
            'client_data.jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'client_data.status_korban' => ['required', Rule::in(['Disable', 'Tidak'])],
            'client_data.kategori_disable' => 'nullable|string|max:255',
            'client_data.status' => 'required|string|max:255',
            'client_data.sumber_informasi' => 'nullable|string|max:1000'
        ];

        // Validation rules for reporter data
        $reporterRules = [
            'reporter_data.hubungan_pelapor_dengan_pelaku' => 'required|string|max:255',
            'reporter_data.nama_lengkap' => 'required|string|max:255',
            'reporter_data.tempat_lahir' => 'required|string|max:255',
            'reporter_data.tanggal_lahir' => 'required|date|before_or_equal:today',
            'reporter_data.jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'reporter_data.usia' => 'required|integer|min:1|max:120',
            'reporter_data.status_pelapor' => 'required|string|max:255',
            'reporter_data.no_telepon' => 'required|string|max:20|regex:/^[0-9+\-\s]+$/',
            'reporter_data.email' => [
                'required',
                'string',
                'email',
                'max:255',
                function ($attribute, $value, $fail) {
                    $allowedDomains = [
                        '@unu-jogja.ac.id',
                        '@student.unu-jogja.ac.id',
                        '@staff.unu-jogja.ac.id',
                    ];

                    $isValid = false;
                    foreach ($allowedDomains as $domain) {
                        if (str_ends_with($value, $domain)) {
                            $isValid = true;
                            break;
                        }
                    }

                    if (! $isValid) {
                        $fail('Email harus menggunakan domain UNU yang valid.');
                    }
                },
            ],
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
            'perpetrator_data.upload_bukti' => 'nullable|array|max:5',
            'perpetrator_data.upload_bukti.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
        ];

        // Validation rules for violence data
        $violenceRules = [
            'violence_data.jenis_kekerasan' => 'required|array',
            'violence_data.jenis_kekerasan.*' => 'string',
            'violence_data.bentuk_kekerasan' => 'required|array|min:1',
            'violence_data.bentuk_kekerasan.*' => 'required|string|max:255',
            'violence_data.lokasi_kejadian' => 'required|string|max:500',
            'violence_data.waktu_kejadian' => 'required|date|before_or_equal:today',
            'violence_data.deskripsi_kekerasan' => 'required|string|max:5000'
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
                array_merge($clientRules, $reporterRules, $perpetratorRules, $violenceRules),
                $customMessages
            );
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Mohon periksa kembali data yang Anda masukkan.');
        }

        DB::beginTransaction();
        $uploadedFiles = [];

        try {
            // Save client data with proper null coalescing
            $client = Client::create([
                'nama_lengkap' => $validated['client_data']['nama_lengkap'],
                'jenis_kelamin' => $validated['client_data']['jenis_kelamin'],
                'status_korban' => $validated['client_data']['status_korban'],
                'kategori_disable' => $validated['client_data']['kategori_disable'] ?? null,
                'status' => $validated['client_data']['status'],
                'sumber_informasi' => $validated['client_data']['sumber_informasi'] ?? null,
            ]);

            // Save reporter data with proper null coalescing
            $reporter = Reporter::create([
                'hubungan_pelapor_dengan_pelaku' => $validated['reporter_data']['hubungan_pelapor_dengan_pelaku'],
                'nama_lengkap' => $validated['reporter_data']['nama_lengkap'],
                'tempat_lahir' => $validated['reporter_data']['tempat_lahir'],
                'tanggal_lahir' => $validated['reporter_data']['tanggal_lahir'],
                'jenis_kelamin' => $validated['reporter_data']['jenis_kelamin'],
                'usia' => $validated['reporter_data']['usia'],
                'status_pelapor' => $validated['reporter_data']['status_pelapor'],
                'no_telepon' => $validated['reporter_data']['no_telepon'],
                'email' => $validated['reporter_data']['email'],
                'alamat' => $validated['reporter_data']['alamat'],
                'keterangan_tambahan' => $validated['reporter_data']['keterangan_tambahan'] ?? null,
            ]);

            // Handle file uploads with improved error handling
            if ($request->hasFile('perpetrator_data.upload_bukti')) {
                $files = $request->file('perpetrator_data.upload_bukti');
                
                foreach ($files as $index => $file) {
                    if ($file && $file->isValid()) {
                        try {
                            // Validate file size and type again for security
                            $allowedMimes = ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx'];
                            $extension = strtolower($file->getClientOriginalExtension());
                            
                            if (!in_array($extension, $allowedMimes)) {
                                throw new \Exception("File type tidak diizinkan: {$extension}");
                            }

                            if ($file->getSize() > 5120 * 1024) { // 5MB in bytes
                                throw new \Exception("File terlalu besar (maksimal 5MB)");
                            }

                            // Generate secure filename
                            $filename = 'evidence_' . time() . '_' . $index . '_' . Str::random(10) . '.' . $extension;
                            
                            // Store file
                            $path = $file->storeAs('violence-reports/evidence', $filename, 'public');
                            
                            if ($path) {
                                $uploadedFiles[] = $path;
                            }
                        } catch (\Exception $fileException) {
                            // Log file upload error but continue with process
                            Log::warning('File upload failed', [
                                'file_index' => $index,
                                'error' => $fileException->getMessage()
                            ]);
                        }
                    }
                }
            }

            // Save perpetrator data
            $perpetratorData = $validated['perpetrator_data'];
            $perpetrator = Perpetrator::create([
                'hubungan_dengan_korban' => $perpetratorData['hubungan_dengan_korban'],
                'nama' => $perpetratorData['nama'],
                'telepon' => $perpetratorData['telepon'] ?? null,
                'jenis_kelamin' => $perpetratorData['jenis_kelamin'],
                'keterangan' => $perpetratorData['keterangan'],
                'upload_bukti' => !empty($uploadedFiles) ? json_encode($uploadedFiles) : null,
            ]);

            // Save violence data
            $violenceData = $validated['violence_data'];
            $violence = Violence::create([
                'jenis_kekerasan' => json_encode($violenceData['jenis_kekerasan']),
                'bentuk_kekerasan' => json_encode($violenceData['bentuk_kekerasan']),
                'lokasi_kejadian' => $violenceData['lokasi_kejadian'],
                'waktu_kejadian' => $violenceData['waktu_kejadian'],
                'deskripsi_kekerasan' => $violenceData['deskripsi_kekerasan'],
            ]);

            // Save violence report relationship
            $violenceReport = ViolenceReport::create([
                'id_client' => $client->id,
                'id_reporter' => $reporter->id,
                'id_perpetrator' => $perpetrator->id,
                'id_violence' => $violence->id,
                'status' => 'terlapor',
                'created_at' => now(),
            ]);

            DB::commit();

            // Log successful creation
            Log::info('Violence report created successfully', [
                'report_id' => $violenceReport->id,
                'client_name' => $client->nama_lengkap,
                'reporter_name' => $reporter->nama_lengkap,
                'uploaded_files_count' => count($uploadedFiles)
            ]);


           return redirect()
            ->route('Frontend.violence-report.success')
            ->with([
                'success' => 'Laporan kekerasan berhasil dibuat dan akan segera diproses.',
                'report_id' => $violenceReport->code
            ]);




        } catch (\Exception $e) {
            DB::rollBack();
            
            // Clean up uploaded files on error
            if (!empty($uploadedFiles)) {
                foreach ($uploadedFiles as $file) {
                    try {
                        if (Storage::disk('public')->exists($file)) {
                            Storage::disk('public')->delete($file);
                        }
                    } catch (\Exception $deleteException) {
                        Log::warning('Failed to delete uploaded file after error', [
                            'file' => $file,
                            'error' => $deleteException->getMessage()
                        ]);
                    }
                }
            }

            // Log detailed error information
            Log::error('Failed to create violence report', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['_token', 'perpetrator_data.upload_bukti'])
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan laporan. Silakan coba lagi atau hubungi administrator jika masalah berlanjut.');
        }
    }

    /**
     * Display status check page
     */
    // Form cek status
    public function cekStatus(Request $request)
    {
        $report = null;
        $error = null;

        if ($request->has('ticket_number')) {
            $code = $request->ticket_number;

            if (!preg_match('/^PPKS-\d{4}-[A-Z0-9]{10}$/', $code)) {
                $error = 'Format nomor tiket tidak valid. Gunakan format PPKS-YYYY-XXXXXXXXXX.';
            }
            else {
                $report = ViolenceReport::with(['client', 'reporter', 'perpetrator', 'violence'])
                    ->where('code', $code)
                    ->first();

                if (!$report) {
                    $error = 'Laporan tidak ditemukan. Pastikan nomor tiket benar.';
                }
            }
        }

        return view('Frontend.status.cek-status', compact('report', 'error'));
    }

    // Tampilkan laporan
    public function showLaporan($code)
    {
        try {
            $report = ViolenceReport::with(['client', 'reporter', 'perpetrator', 'violence'])
                ->where('code', 'LIKE', "%$code")
                ->firstOrFail();

            return view('Frontend.laporan.show', compact('report'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('cek-status')->with('error', 'Laporan tidak ditemukan.');
        }
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