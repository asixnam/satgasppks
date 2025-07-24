<?php
namespace App\Http\Controllers;

use App\Models\ViolenceReport;
use App\Models\Client;
use App\Models\Reporter;
use App\Models\Perpetrator;
use App\Models\Violance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViolenceReportController extends Controller
{
    // Ambil semua laporan dengan relasi
    public function index(Request $request)
    {
        $query = ViolenceReport::with(['client', 'reporter', 'perpetrator', 'violance']);
        
        // Apply filters
        if ($request->has('violence_type') && $request->violence_type) {
            $query->whereHas('violance', function($q) use ($request) {
                $q->where('jenis_kekerasan', 'like', '%' . $request->violence_type . '%');
            });
        }
        
        if ($request->has('faculty') && $request->faculty) {
            $query->whereHas('client', function($q) use ($request) {
                $q->where('fakultas', 'like', '%' . $request->faculty . '%');
            });
        }
        
        if ($request->has('start_date') && $request->has('end_date') && $request->start_date && $request->end_date) {
            $query->whereHas('violance', function($q) use ($request) {
                $q->whereBetween('waktu_kejadian', [$request->start_date, $request->end_date]);
            });
        }
        
        $reports = $query->get();
        
        return view('admin.violence-report.index', compact('reports'));
    }

    public function create()
    {
        // Tampilkan form untuk membuat laporan baru
        return view('admin.violence-report.create');
    }

    // Ambil laporan berdasarkan ID
    public function show($id)
    {
        $report = ViolenceReport::with([
            'client',
            'reporter',
            'perpetrator',
            'violance'
        ])->findOrFail($id);

        return view('admin.violence-report.show', compact('report'));
    }

    // Buat laporan baru
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'client_data' => 'required|array',
            'reporter_data' => 'required|array',
            'perpetrator_data' => 'required|array',
            'violance_data' => 'required|array'
        ]);

        DB::beginTransaction();
        
        try {
            // Buat client
            $client = Client::create($validated['client_data']);
            
            // Buat reporter
            $reporter = Reporter::create($validated['reporter_data']);
            
            // Buat perpetrator
            $perpetrator = Perpetrator::create($validated['perpetrator_data']);
            
            // Buat violance
            $violance = Violance::create($validated['violance_data']);

            // Buat violence report
            $violenceReport = ViolenceReport::create([
                'id_client' => $client->id,
                'id_reporter' => $reporter->id,
                'id_perpetrator' => $perpetrator->id,
                'id_violance' => $violance->id
            ]);

            DB::commit();

            return redirect()->route('violence-reports.index')
                           ->with('success', 'Laporan kekerasan berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                           ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                           ->withInput();
        }
    }

    public function edit($id)
    {
        // Ambil data report beserta relasinya
        $report = ViolenceReport::with([
            'client',
            'reporter',
            'perpetrator',
            'violance'
        ])->findOrFail($id);

        // Tampilkan form edit dan kirim data report
        return view('admin.violence-report.create', compact('report'));
    }

    // Update laporan
    public function update(Request $request, $id)
    {
        $report = ViolenceReport::findOrFail($id);

        DB::beginTransaction();
        
        try {
            // Update masing-masing entitas terkait jika ada data
            if ($request->has('client_data')) {
                $report->client()->update($request->client_data);
            }

            if ($request->has('reporter_data')) {
                $report->reporter()->update($request->reporter_data);
            }

            if ($request->has('perpetrator_data')) {
                $report->perpetrator()->update($request->perpetrator_data);
            }

            if ($request->has('violance_data')) {
                $report->violance()->update($request->violance_data);
            }

            DB::commit();

            return redirect()->route('violence-reports.index')
                           ->with('success', 'Laporan kekerasan berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                           ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
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
            $violanceId = $report->id_violance;

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
            
            if ($violanceId) {
                Violance::find($violanceId)?->delete();
            }

            DB::commit();

            return redirect()->route('violence-reports.index')
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
            ->join('violances', 'violence_reports.id_violance', '=', 'violances.id')
            ->select([
                'violence_reports.*',
                'clients.nama_lengkap as client_name',
                'clients.nim',
                'reporters.nama as reporter_name',
                'perpetrators.nama_pelaku as perpetrator_name',
                'violances.jenis_kekerasan',
                'violances.waktu_kejadian'
            ])
            ->paginate(15);

        return view('admin.violence-report.details', compact('reports'));
    }

    // Filter berdasarkan jenis kekerasan
    public function filterByViolenceType(Request $request)
    {
        $type = $request->get('type');
        
        if (!$type) {
            return redirect()->route('violence-reports.index')
                           ->with('error', 'Jenis kekerasan harus dipilih.');
        }

        $reports = ViolenceReport::whereHas('violance', function ($query) use ($type) {
            $query->where('jenis_kekerasan', 'like', '%' . $type . '%');
        })->with(['client', 'reporter', 'perpetrator', 'violance'])
          ->paginate(15);

        return view('admin.violence-report.index', compact('reports'))
               ->with('filter_type', 'violence_type')
               ->with('filter_value', $type);
    }

    // Filter berdasarkan fakultas client
    public function filterByFaculty(Request $request)
    {
        $faculty = $request->get('faculty');
        
        if (!$faculty) {
            return redirect()->route('violence-reports.index')
                           ->with('error', 'Fakultas harus dipilih.');
        }

        $reports = ViolenceReport::whereHas('client', function ($query) use ($faculty) {
            $query->where('fakultas', 'like', '%' . $faculty . '%');
        })->with(['client', 'reporter', 'perpetrator', 'violance'])
          ->paginate(15);

        return view('admin.violence-report.index', compact('reports'))
               ->with('filter_type', 'faculty')
               ->with('filter_value', $faculty);
    }

    // Tambahan: Filter berdasarkan periode waktu
    public function filterByDateRange(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        
        if (!$startDate || !$endDate) {
            return redirect()->route('violence-reports.index')
                           ->with('error', 'Tanggal mulai dan akhir harus diisi.');
        }

        $reports = ViolenceReport::whereHas('violance', function ($query) use ($startDate, $endDate) {
            $query->whereBetween('waktu_kejadian', [$startDate, $endDate]);
        })->with(['client', 'reporter', 'perpetrator', 'violance'])
          ->paginate(15);

        return view('admin.violence-report.index', compact('reports'))
               ->with('filter_type', 'date_range')
               ->with('filter_value', $startDate . ' - ' . $endDate);
    }

    // Tambahan: Reset filter
    public function resetFilter()
    {
        return redirect()->route('violence-reports.index');
    }

    // Tambahan: Export data (opsional)
    public function export(Request $request)
    {
        $reports = ViolenceReport::with([
            'client',
            'reporter', 
            'perpetrator',
            'violance'
        ])->get();

        // Implementasi export sesuai kebutuhan (Excel, PDF, dll)
        // Untuk sementara redirect kembali
        return redirect()->route('violence-reports.index')
                       ->with('info', 'Fitur export akan segera tersedia.');
    }
}