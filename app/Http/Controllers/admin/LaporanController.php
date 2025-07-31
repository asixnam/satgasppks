<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Klien;
use App\Models\Pelapor;
use App\Models\InformasiKekerasan;
use App\Models\PelakuLaporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Laporan::query();

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_pelapor', 'like', "%{$search}%")
                    ->orWhere('nama_klien', 'like', "%{$search}%")
                    ->orWhere('nama', 'like', "%{$search}%");
            });
        }

        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        if ($request->has('tanggal_dari') && !empty($request->tanggal_dari)) {
            $query->whereDate('created_at', '>=', $request->tanggal_dari);
        }

        if ($request->has('tanggal_sampai') && !empty($request->tanggal_sampai)) {
            $query->whereDate('created_at', '<=', $request->tanggal_sampai);
        }

        $laporans = $query->paginate(10);

        $laporans->appends($request->query());
        return view('admin.dashboard', compact('laporans'));
    }





    public function create()
    {
        return view('admin.laporans.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
             'isi' => 'nullable|string',
            'nama_pelapor' => 'nullable|string|max:255',
            'nama_pelaku' => 'nullable|string|max:255',
            'nama_klien' => 'nullable|string|max:255',
            'tanggal_kejadian' => 'nullable|date',
            'hubungan' => 'nullable|string|max:100',
            'nama' => 'nullable|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:laki-laki,perempuan',
            'usia' => 'nullable|numeric|min:0|max:150',
            'pekerjaan' => 'nullable|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'status' => 'nullable|in:pending,proses,selesai',
        ]);

        // Set default status if not provided
        if (!isset($validatedData['status'])) {
            $validatedData['status'] = 'pending';
        }

        Laporan::create($validatedData);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Laporan berhasil ditambahkan');
    }






    public function show($id)
    {
        $laporan = Laporan::find($id);
        $laporans = Pelapor::paginate(1);
        $kliens = Klien::all();
        $informasiKekerasan = InformasiKekerasan::all();
        $pelakuLaporan = Pelapor::all();

        return view('admin.laporans.show', compact('laporan', 'laporans', 'kliens', 'informasiKekerasan', 'pelakuLaporan'));
    }





    public function edit($id)
    {
        $laporan = Laporan::with('pelapor')->findOrFail($id);
        return view('admin.laporans.edit', compact('laporan'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_pelapor' => 'nullable|string|max:255',
            'nama_pelaku' => 'nullable|string|max:255',
            'nama_klien' => 'nullable|string|max:255',
            'tanggal_kejadian' => 'nullable|date',
            'hubungan' => 'nullable|string|max:100',
            'nama' => 'nullable|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:laki-laki,perempuan',
            'usia' => 'nullable|numeric|min:0|max:150',
            'pekerjaan' => 'nullable|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'status' => 'nullable|in:pending,proses,selesai',
        ]);

        $laporan = Laporan::findOrFail($id);
    $laporan->update($request->all());

        return redirect()->route('admin.dashboard')
            ->with('success', 'Laporan berhasil diperbarui');
    }

    public function destroy(Laporan $laporan)
    {
        try {
            $laporan->delete();
            return redirect()->route('admin.dashboard')
                ->with('success', 'Laporan berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Gagal menghapus laporan');
        }
    }

    /**
     * Bulk delete selected reports
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'selected_ids' => 'required|array',
            'selected_ids.*' => 'exists:laporans,id'
        ]);

        try {
            Laporan::whereIn('id', $request->selected_ids)->delete();
            return redirect()->route('admin.dashboard')
                ->with('success', count($request->selected_ids) . ' laporan berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Gagal menghapus laporan terpilih');
        }
    }

    /**
     * Update status for selected reports
     */
    public function bulkUpdateStatus(Request $request)
    {
        $request->validate([
            'selected_ids' => 'required|array',
            'selected_ids.*' => 'exists:laporans,id',
            'status' => 'required|in:pending,proses,selesai'
        ]);

        try {
            Laporan::whereIn('id', $request->selected_ids)
                ->update(['status' => $request->status]);

            return redirect()->route('admin.dashboard')
                ->with('success', 'Status ' . count($request->selected_ids) . ' laporan berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Gagal memperbarui status laporan');
        }
    }
}
