<?php

namespace App\Http\Controllers;

use App\Models\ViolenceReport;
use App\Models\Client;
use App\Models\Reporter;
use App\Models\Perpetrator;
use App\Models\Violence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ViolenceReportController extends Controller
{
    // Ambil semua laporan dengan relasi
    public function index(Request $request)
    {
        $query = ViolenceReport::with(['client', 'reporter', 'perpetrator', 'violence']);

        // Apply filters
        if ($request->has('violence_type') && $request->violence_type) {
            $query->whereHas('violence', function($q) use ($request) {
                $q->where('bentuk_kekerasan', 'like', '%' . $request->violence_type . '%');
            });
        }

        if ($request->has('status') && $request->status) {
            $query->whereHas('client', function($q) use ($request) {
                $q->where('status', 'like', '%' . $request->status . '%');
            });
        }

        if ($request->has('gender') && $request->gender) {
            $query->whereHas('client', function($q) use ($request) {
                $q->where('jenis_kelamin', $request->gender);
            });
        }

        if ($request->has('start_date') && $request->has('end_date') && $request->start_date && $request->end_date) {
            $query->whereHas('violence', function($q) use ($request) {
                $q->whereBetween('waktu_kejadian', [$request->start_date, $request->end_date]);
            });
        }

        $reports = $query->latest()->paginate(15);

        return view('admin.violence-report.index', compact('reports'));
    }

    /**
     * Update status laporan kekerasan
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:terlapor,ditolak,diproses,selesai'
        ]);

        try {
            $report = ViolenceReport::findOrFail($id);
            $report->status = $request->status;
            $report->save();

            return redirect()->back()->with('success', 'Status laporan berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui status laporan');
        }
    }

    /**
     * Get status options for dropdown
     */
    public function getStatusOptions()
    {
        return [
            'terlapor' => 'Terlapor',
            'ditolak' => 'Ditolak',
            'diproses' => 'Diproses',
            'selesai' => 'Selesai'
        ];
    }

    // Ambil laporan berdasarkan ID
    public function show($id)
    {
        $report = ViolenceReport::with([
            'client',
            'reporter',
            'perpetrator',
            'violence'
        ])->findOrFail($id);

        return view('admin.violence-report.show', compact('report'));
    }

    public function create()
    {
        // Tampilkan form untuk membuat laporan baru
        return view('admin.violence-report.create');
    }


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
                // Rule::unique('reporters', 'email')->ignore($report->reporter->id ?? null),
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
            ->route('admin.violence-reports.index')
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

    // Tampilkan form edit laporan
    public function edit($id)
    {
        // Ambil data report beserta relasinya
        $report = ViolenceReport::with([
            'client',
            'reporter',
            'perpetrator',
            'violence'
        ])->findOrFail($id);

        //Pastikan relasi ada, kalau belum buat default kosong
            if (!$report->client) {
                $report->client()->create([
                    'nama_lengkap' => '',
                    'jenis_kelamin' => '',
                    'status_korban' => '',
                    'kategori_disable' => '',
                    'status' => '',
                    'sumber_informasi' => '',
                ]);
            }

            if (!$report->reporter) {
                $report->reporter()->create([
                    'hubungan_pelapor_dengan_pelaku' => '',
                    'nama_lengkap' => '',
                    'tempat_lahir' => '',
                    'tanggal_lahir' => null,
                    'jenis_kelamin' => '',
                    'usia' => '',
                    'status_pelapor' => '',
                    'no_telepon' => '',
                    'email' => '',
                    'alamat' => '',
                    'keterangan_tambahan' => '',
                ]);
            }

            if (!$report->perpetrator) {
                $report->perpetrator()->create([
                    'hubungan_dengan_korban' => '',
                    'nama' => '',
                    'telepon' => '',
                    'jenis_kelamin' => '',
                    'keterangan' => '',
                    'upload_bukti' => '',
                ]);
            }

            if (!$report->violence) {
                $report->violence()->create([
                    'jenis_kekerasan' => '',
                    'bentuk_kekerasan' => '',
                    'lokasi_kejadian' => '',
                    'waktu_kejadian' => null,
                    'deskripsi_kekerasan' => '',
                ]);
            }

            // Refresh relasi
            $report->load(['client', 'reporter', 'perpetrator', 'violence']);

            return view('admin.violence-report.edit', compact('report'));
}


    // Update laporan
    public function update(Request $request, $id)
{
    // Debug request data
    Log::info('Update request data:', $request->all());

    $report = ViolenceReport::with(['client', 'reporter', 'perpetrator', 'violence'])->findOrFail($id);

    // // === VALIDASI ===
    $clientRules = [
        'client_data.nama_lengkap' => 'required|string|max:255',
        'client_data.jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
        'client_data.status_korban' => ['required', Rule::in(['Disable', 'Tidak'])],
        'client_data.kategori_disable' => 'nullable|string|max:255',
        'client_data.status' => 'required|string|max:255',
        'client_data.sumber_informasi' => 'nullable|string|max:1000'
    ];

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
            function ($attribute, $value, $fail) use ($report) {
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

                if (!$isValid) {
                    $fail('Email harus menggunakan domain UNU yang valid.');
                }
            },
        ],
        'reporter_data.alamat' => 'required|string|max:1000',
        'reporter_data.keterangan_tambahan' => 'nullable|string|max:2000'
    ];

    $perpetratorRules = [
        'perpetrator_data.hubungan_dengan_korban' => 'required|string|max:255',
        'perpetrator_data.nama' => 'required|string|max:255',
        'perpetrator_data.telepon' => 'nullable|string|max:20|regex:/^[0-9+\-\s]*$/',
        'perpetrator_data.jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
        'perpetrator_data.keterangan' => 'required|string|max:2000',
        'perpetrator_data.upload_bukti' => 'sometimes|array|max:5',
        'perpetrator_data.upload_bukti.*' => 'sometimes|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
    ];

    $violenceRules = [
        'violence_data.jenis_kekerasan' => 'required|array',
        'violence_data.jenis_kekerasan.*' => 'string',
        'violence_data.bentuk_kekerasan' => 'required|array|min:1',
        'violence_data.bentuk_kekerasan.*' => 'required|string|max:255',
        'violence_data.lokasi_kejadian' => 'required|string|max:500',
        'violence_data.waktu_kejadian' => 'required|date|before_or_equal:today',
        'violence_data.deskripsi_kekerasan' => 'required|string|max:5000'
    ];
    $rules = array_merge($clientRules, $reporterRules, $perpetratorRules, $violenceRules);

        // 2. Validasi data request
        $validatedData = $request->validate($rules);

        // 3. Lakukan update pakai data yang sudah tervalidasi
        $report->client->update($validatedData['client_data']);
        $report->reporter->update($validatedData['reporter_data']);
        $report->perpetrator->update($validatedData['perpetrator_data']);
        $report->violence->update($validatedData['violence_data']);

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

        // Debug validation success
        Log::info('Validation passed:', $validated);

    } catch (\Illuminate\Validation\ValidationException $e) {
        // Log validation errors
        Log::error('Validation failed:', [
            'errors' => $e->validator->errors()->toArray(),
            'input' => $request->all()
        ]);

        return redirect()->back()
            ->withErrors($e->validator)
            ->withInput()
            ->with('error', 'Mohon periksa kembali data yang Anda masukkan.');
    }

    DB::beginTransaction();
    $newUploadedFiles = [];

    try {
        // Debug: Check if relations exist
        if (!$report->client || !$report->reporter || !$report->perpetrator || !$report->violence) {
            throw new \Exception('Missing required relations on report');
        }

        Log::info('Starting update process for report ID: ' . $id);

        // === UPDATE CLIENT ===
        $clientUpdated = $report->client->update([
            'nama_lengkap' => $validated['client_data']['nama_lengkap'],
            'jenis_kelamin' => $validated['client_data']['jenis_kelamin'],
            'status_korban' => $validated['client_data']['status_korban'],
            'kategori_disable' => $validated['client_data']['kategori_disable'] ?? null,
            'status' => $validated['client_data']['status'],
            'sumber_informasi' => $validated['client_data']['sumber_informasi'] ?? null,
        ]);

        Log::info('Client update result: ' . ($clientUpdated ? 'success' : 'failed'));

        // === UPDATE REPORTER ===
        $reporterUpdated = $report->reporter->update([
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

        Log::info('Reporter update result: ' . ($reporterUpdated ? 'success' : 'failed'));

        // === HANDLE FILE UPLOAD ===
        $perpetratorData = $validated['perpetrator_data'];

        // Get existing files
        $oldBukti = [];
        if ($report->perpetrator->upload_bukti) {
            $oldBukti = is_string($report->perpetrator->upload_bukti)
                ? json_decode($report->perpetrator->upload_bukti, true)
                : $report->perpetrator->upload_bukti;
        }
        $oldBukti = $oldBukti ?? [];

        // Handle new file uploads
        if ($request->hasFile('perpetrator_data.upload_bukti')) {
            $files = $request->file('perpetrator_data.upload_bukti');

            foreach ($files as $index => $file) {
                if ($file && $file->isValid()) {
                    try {
                        // Validate file
                        $allowedMimes = ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx'];
                        $extension = strtolower($file->getClientOriginalExtension());

                        if (!in_array($extension, $allowedMimes)) {
                            throw new \Exception("File type tidak diizinkan: {$extension}");
                        }

                        if ($file->getSize() > 5120 * 1024) {
                            throw new \Exception("File terlalu besar (maksimal 5MB)");
                        }

                        // Generate secure filename
                        $filename = 'evidence_' . time() . '_' . $index . '_' . Str::random(10) . '.' . $extension;

                        // Store file
                        $path = $file->storeAs('violence-reports/evidence', $filename, 'public');

                        if ($path) {
                            $newUploadedFiles[] = $path;
                        }
                    } catch (\Exception $fileException) {
                        Log::warning('File upload failed during update', [
                            'report_id' => $id,
                            'file_index' => $index,
                            'error' => $fileException->getMessage()
                        ]);
                    }
                }
            }
        }

        // Gabungkan file lama dan baru
        $allFiles = array_merge($oldBukti, $newUploadedFiles);

        // === UPDATE PERPETRATOR ===
        $perpetratorUpdated = $report->perpetrator->update([
            'hubungan_dengan_korban' => $perpetratorData['hubungan_dengan_korban'],
            'nama' => $perpetratorData['nama'],
            'telepon' => $perpetratorData['telepon'] ?? null,
            'jenis_kelamin' => $perpetratorData['jenis_kelamin'],
            'keterangan' => $perpetratorData['keterangan'],
            'upload_bukti' => !empty($allFiles) ? json_encode($allFiles) : null,
        ]);

        Log::info('Perpetrator update result: ' . ($perpetratorUpdated ? 'success' : 'failed'), [
            'files_count' => count($allFiles),
            'new_files' => count($newUploadedFiles)
        ]);

        // === UPDATE VIOLENCE DATA ===
        $violenceData = $validated['violence_data'];

        // Ensure jenis_kekerasan is properly encoded
        $jenisKekerasanJson = is_array($violenceData['jenis_kekerasan'])
            ? json_encode($violenceData['jenis_kekerasan'])
            : $violenceData['jenis_kekerasan'];

        $bentukKekerasanJson = is_array($violenceData['bentuk_kekerasan'])
            ? json_encode($violenceData['bentuk_kekerasan'])
            : $violenceData['bentuk_kekerasan'];

        $violenceUpdated = $report->violence->update([
            'jenis_kekerasan' => $jenisKekerasanJson,
            'bentuk_kekerasan' => $bentukKekerasanJson,
            'lokasi_kejadian' => $violenceData['lokasi_kejadian'],
            'waktu_kejadian' => $violenceData['waktu_kejadian'],
            'deskripsi_kekerasan' => $violenceData['deskripsi_kekerasan'],
        ]);

        Log::info('Violence data update result: ' . ($violenceUpdated ? 'success' : 'failed'), [
            'jenis_kekerasan' => $jenisKekerasanJson,
            'bentuk_kekerasan' => $bentukKekerasanJson
        ]);

        DB::commit();

        // Verify the update was successful
        $report->refresh();

        // Log successful update with detailed info
        Log::info('Violence report updated successfully', [
            'report_id' => $report->id,
            'client_name' => $report->client->nama_lengkap,
            'reporter_name' => $report->reporter->nama_lengkap,
            'perpetrator_name' => $report->perpetrator->nama,
            'new_files_count' => count($newUploadedFiles),
            'total_files_count' => count($allFiles),
            'update_results' => [
                'client' => $clientUpdated,
                'reporter' => $reporterUpdated,
                'perpetrator' => $perpetratorUpdated,
                'violence' => $violenceUpdated
            ]
        ]);

        return redirect()->route('admin.violence-reports.index')
            ->with('success', 'Laporan kekerasan berhasil diperbarui.');

    } catch (\Exception $e) {
        DB::rollBack();

        // Clean up new uploaded files on error
        if (!empty($newUploadedFiles)) {
            foreach ($newUploadedFiles as $file) {
                try {
                    if (Storage::disk('public')->exists($file)) {
                        Storage::disk('public')->delete($file);
                    }
                } catch (\Exception $deleteException) {
                    Log::warning('Failed to delete uploaded file after update error', [
                        'file' => $file,
                        'error' => $deleteException->getMessage()
                    ]);
                }
            }
        }

        // Log detailed error information
        Log::error('Failed to update violence report', [
            'report_id' => $id,
            'error_message' => $e->getMessage(),
            'error_file' => $e->getFile(),
            'error_line' => $e->getLine(),
            'stack_trace' => $e->getTraceAsString(),
            'request_data' => $request->except(['_token', 'perpetrator_data.upload_bukti']),
            'report_exists' => isset($report),
            'relations_check' => [
                'client' => isset($report) && $report->client ? 'exists' : 'missing',
                'reporter' => isset($report) && $report->reporter ? 'exists' : 'missing',
                'perpetrator' => isset($report) && $report->perpetrator ? 'exists' : 'missing',
                'violence' => isset($report) && $report->violence ? 'exists' : 'missing'
            ]
        ]);

        return redirect()->back()
            ->with('error', 'Terjadi kesalahan saat memperbarui laporan: ' . $e->getMessage() . ' (Cek log untuk detail lengkap)')
            ->withInput();
    }
}

    // Hapus laporan dan semua data terkait
    public function destroy($id)
    {
        $report = ViolenceReport::findOrFail($id);

        DB::beginTransaction();

        try {
            // Simpan ID untuk menghapus data terkait
            $clientId = $report->id_client;
            $reporterId = $report->id_reporter;
            $perpetratorId = $report->id_perpetrator;
            $violenceId = $report->id_violence;

            // Hapus report terlebih dahulu
            $report->delete();

            // Hapus semua data terkait
            if ($clientId) {
                Client::find($clientId)?->delete();
            }

            if ($reporterId) {
                Reporter::find($reporterId)?->delete();
            }

            if ($perpetratorId) {
                Perpetrator::find($perpetratorId)?->delete();
            }

            if ($violenceId) {
                Violence::find($violenceId)?->delete();
            }

            DB::commit();

            return redirect()->route('admin.violence-reports.index')
                           ->with('success', 'Laporan dan semua data terkait berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                           ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Query dengan join untuk menampilkan detail
    public function reportsWithDetails()
    {
        $reports = ViolenceReport::join('clients', 'violence_reports.id_client', '=', 'clients.id')
            ->join('reporters', 'violence_reports.id_reporter', '=', 'reporters.id')
            ->join('perpetrators', 'violence_reports.id_perpetrator', '=', 'perpetrators.id')
            ->join('violences', 'violence_reports.id_violence', '=', 'violences.id')
            ->select([
                'violence_reports.*',
                'clients.nama_lengkap as client_name',
                'clients.status as client_status',
                'clients.jenis_kelamin as client_gender',
                'reporters.nama_lengkap as reporter_name',
                'perpetrators.nama as perpetrator_name',
                'violences.jenis_kekerasan',
                'violences.waktu_kejadian'
            ])
            ->latest('violence_reports.created_at')
            ->paginate(15);

        return view('admin.violence-report.details', compact('reports'));
    }

    // Filter berdasarkan jenis kekerasan
    public function filterByViolenceType(Request $request)
    {
        $type = $request->get('violence_type');

        if (!$type) {
            return redirect()->route('admin.violence-reports.index')
                            ->with('error', 'bentuk kekerasan harus dipilih.');
        }

        $reports = ViolenceReport::whereHas('violence', function ($query) use ($type) {
            $query->whereJsonContains('bentuk_kekerasan', $type);
        })
        ->with(['client', 'reporter', 'perpetrator', 'violence'])
        ->latest()
        ->paginate(15);

        return view('admin.violence-report.index', compact('reports'))
            ->with('filter_type', 'violence_type')
            ->with('filter_value', $type);
    }


    // Filter berdasarkan status client
    public function filterByStatus(Request $request)
    {
        $status = $request->get('status');

        if (!$status) {
            return redirect()->route('admin.violence-reports.index')
                           ->with('error', 'Status harus dipilih.');
        }

        $reports = ViolenceReport::whereHas('client', function ($query) use ($status) {
            $query->where('status', 'like', '%' . $status . '%');
        })->with(['client', 'reporter', 'perpetrator', 'violence'])
          ->latest()
          ->paginate(15);

        return view('admin.violence-report.index', compact('reports'))
               ->with('filter_type', 'status')
               ->with('filter_value', $status);
    }

    // Filter berdasarkan jenis kelamin
    public function filterByGender(Request $request)
    {
        $gender = $request->get('gender');

        if (!$gender) {
            return redirect()->route('admin.violence-reports.index')
                           ->with('error', 'Jenis kelamin harus dipilih.');
        }

        $reports = ViolenceReport::whereHas('client', function ($query) use ($gender) {
            $query->where('jenis_kelamin', $gender);
        })->with(['client', 'reporter', 'perpetrator', 'violence'])
          ->latest()
          ->paginate(15);

        return view('admin.violence-report.index', compact('reports'))
               ->with('filter_type', 'gender')
               ->with('filter_value', $gender);
    }

    // Filter berdasarkan periode waktu
    public function filterByDateRange(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        if (!$startDate || !$endDate) {
            return redirect()->route('admin.violence-reports.index')
                           ->with('error', 'Tanggal mulai dan akhir harus diisi.');
        }

        $reports = ViolenceReport::whereHas('violence', function ($query) use ($startDate, $endDate) {
            $query->whereBetween('waktu_kejadian', [$startDate, $endDate]);
        })->with(['client', 'reporter', 'perpetrator', 'violence'])
          ->latest()
          ->paginate(15);

        return view('admin.violence-report.index', compact('reports'))
               ->with('filter_type', 'date_range')
               ->with('filter_value', $startDate . ' - ' . $endDate);
    }

    // Reset filter
    public function resetFilter()
    {
        return redirect()->route('admin.violence-reports.index');
    }

    // Statistik dashboard

    // Method statistics yang sudah diperbaiki
        public function statistics()
        {
            try {
                // Total laporan
                $totalReports = ViolenceReport::count();

                // Korban dengan status disable
                $disableVictims = ViolenceReport::whereHas('client', function($q) {
                    $q->where('status_korban', 'Disable');
                })->count();

                // Laporan bulan ini
                $recentReports = ViolenceReport::whereHas('violence', function($q) {
                    $q->whereMonth('waktu_kejadian', now()->month)
                    ->whereYear('waktu_kejadian', now()->year);
                })->count();

                // Statistik jenis kekerasan
                $violenceTypes = DB::table('violence_reports')
                    ->join('violences', 'violence_reports.id_violence', '=', 'violences.id')
                    ->select('violences.jenis_kekerasan', DB::raw('count(*) as total'))
                    ->groupBy('violences.jenis_kekerasan')
                    ->orderBy('total', 'desc')
                    ->limit(5)
                    ->get();

                // Statistik berdasarkan jenis kelamin korban
                $genderStats = DB::table('violence_reports')
                    ->join('clients', 'violence_reports.id_client', '=', 'clients.id')
                    ->select('clients.jenis_kelamin', DB::raw('count(*) as total'))
                    ->groupBy('clients.jenis_kelamin')
                    ->get();

                // Statistik laporan per bulan (6 bulan terakhir)
                $monthlyReports = DB::table('violence_reports')
                    ->join('violences', 'violence_reports.id_violence', '=', 'violences.id')
                    ->select(
                        DB::raw('YEAR(violences.waktu_kejadian) as year'),
                        DB::raw('MONTH(violences.waktu_kejadian) as month'),
                        DB::raw('COUNT(*) as total')
                    )
                    ->where('violences.waktu_kejadian', '>=', now()->subMonths(6))
                    ->groupBy('year', 'month')
                    ->orderBy('year', 'desc')
                    ->orderBy('month', 'desc')
                    ->get();

                // Statistik status korban
                $victimStatusStats = DB::table('violence_reports')
                    ->join('clients', 'violence_reports.id_client', '=', 'clients.id')
                    ->select('clients.status_korban', DB::raw('count(*) as total'))
                    ->groupBy('clients.status_korban')
                    ->get();

                // Statistik hubungan pelaku dengan korban
                $perpetratorRelationStats = DB::table('violence_reports')
                    ->join('perpetrators', 'violence_reports.id_perpetrator', '=', 'perpetrators.id')
                    ->select('perpetrators.hubungan_dengan_korban', DB::raw('count(*) as total'))
                    ->groupBy('perpetrators.hubungan_dengan_korban')
                    ->orderBy('total', 'desc')
                    ->limit(5)
                    ->get();

                return view('admin.violence-report.statistics', compact(
                    'totalReports',
                    'disableVictims',
                    'recentReports',
                    'violenceTypes',
                    'genderStats',
                    'monthlyReports',
                    'victimStatusStats',
                    'perpetratorRelationStats'
                ));

            } catch (\Exception $e) {
                return redirect()->route('admin.violence-reports.index')
                            ->with('error', 'Terjadi kesalahan saat memuat statistik: ' . $e->getMessage());
            }
        }

    // Method tambahan untuk dashboard chart data
    public function getChartData()
    {
        try {
            // Data untuk chart jenis kekerasan
            $violenceTypeChart = DB::table('violence_reports')
                ->join('violences', 'violence_reports.id_violence', '=', 'violences.id')
                ->select('violences.jenis_kekerasan as label', DB::raw('count(*) as value'))
                ->groupBy('violences.jenis_kekerasan')
                ->orderBy('value', 'desc')
                ->get();

            // Data untuk chart per bulan
            $monthlyChart = DB::table('violence_reports')
                ->join('violences', 'violence_reports.id_violence', '=', 'violences.id')
                ->select(
                    DB::raw('DATE_FORMAT(violences.waktu_kejadian, "%Y-%m") as month'),
                    DB::raw('COUNT(*) as total')
                )
                ->where('violences.waktu_kejadian', '>=', now()->subMonths(12))
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            // Data untuk chart gender
            $genderChart = DB::table('violence_reports')
                ->join('clients', 'violence_reports.id_client', '=', 'clients.id')
                ->select('clients.jenis_kelamin as label', DB::raw('count(*) as value'))
                ->groupBy('clients.jenis_kelamin')
                ->get();

            return response()->json([
                'violence_types' => $violenceTypeChart,
                'monthly_reports' => $monthlyChart,
                'gender_distribution' => $genderChart
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

// Method untuk export statistik
    public function exportStatistics()
    {
        try {
            $statistics = [
                'total_reports' => ViolenceReport::count(),
                'disable_victims' => ViolenceReport::whereHas('client', function($q) {
                    $q->where('status_korban', 'Disable');
                })->count(),
                'recent_reports' => ViolenceReport::whereHas('violence', function($q) {
                    $q->where('waktu_kejadian', '>=', now()->subDays(30));
                })->count(),
                'violence_types' => DB::table('violence_reports')
                    ->join('violences', 'violence_reports.id_violence', '=', 'violences.id')
                    ->select('violences.jenis_kekerasan', DB::raw('count(*) as total'))
                    ->groupBy('violences.jenis_kekerasan')
                    ->orderBy('total', 'desc')
                    ->get(),
                'gender_stats' => DB::table('violence_reports')
                    ->join('clients', 'violence_reports.id_client', '=', 'clients.id')
                    ->select('clients.jenis_kelamin', DB::raw('count(*) as total'))
                    ->groupBy('clients.jenis_kelamin')
                    ->get()
            ];

            // Return JSON untuk AJAX request atau redirect untuk download
            if (request()->wantsJson()) {
                return response()->json($statistics);
            }

            return redirect()->route('admin.violence-reports.statistics')
                        ->with('success', 'Data statistik berhasil diekspor.');

        } catch (\Exception $e) {
            return redirect()->route('admin.violence-reports.statistics')
                        ->with('error', 'Gagal mengekspor statistik: ' . $e->getMessage());
        }
    }

    // Export data (opsional)
    public function export(Request $request)
    {
        $reports = ViolenceReport::with([
            'client',
            'reporter',
            'perpetrator',
            'violence'
        ])->get();

        // Implementasi export sesuai kebutuhan (Excel, PDF, dll)
        // Untuk sementara redirect kembali
        return redirect()->route('admin.violence-reports.index')
                       ->with('info', 'Fitur export akan segera tersedia.');
    }

    // Bulk actions

}
