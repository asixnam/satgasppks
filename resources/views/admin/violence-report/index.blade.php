@extends('layouts.admin')

@section('title', 'Laporan Kekerasan')

@section('content')
<div class="min-h-screen bg-gray-50 p-4">
    <div class="max-w-7xl mx-auto">
        <!-- Header Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <h1 class="text-2xl font-semibold text-gray-900">Data Laporan Kekerasan</h1>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('admin.violence-reports.create') }}" 
                           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 inline-flex items-center text-sm">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Laporan
                        </a>
                        <a href="{{ route('admin.violence-reports.details.all') }}" 
                           class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 inline-flex items-center text-sm">
                            <i class="fas fa-list mr-2"></i>
                            View Details
                        </a>
                        <a href="{{ route('admin.violence-reports.statistics') }}" 
                           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 inline-flex items-center text-sm">
                            <i class="fas fa-chart-bar mr-2"></i>
                            Statistik
                        </a>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <form id="filterForm" method="GET" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                        <div>
                            <label for="filter-violence-type" class="block text-sm font-medium text-gray-700 mb-2">
                                Jenis Kekerasan
                            </label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm" 
                                    id="filter-violence-type" name="violence_type">
                                <option value="">Semua Jenis</option>
                                <option value="Kekerasan Fisik" {{ request('violence_type') == 'Kekerasan Fisik' ? 'selected' : '' }}>Kekerasan Fisik</option>
                                <option value="Kekerasan Psikis" {{ request('violence_type') == 'Kekerasan Psikis' ? 'selected' : '' }}>Kekerasan Psikis</option>
                                <option value="Kekerasan Seksual" {{ request('violence_type') == 'Kekerasan Seksual' ? 'selected' : '' }}>Kekerasan Seksual</option>
                                <option value="Kekerasan Ekonomi" {{ request('violence_type') == 'Kekerasan Ekonomi' ? 'selected' : '' }}>Kekerasan Ekonomi</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="filter-status" class="block text-sm font-medium text-gray-700 mb-2">
                                Status Korban
                            </label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm" 
                                    id="filter-status" name="status">
                                <option value="">Semua Status</option>
                                <option value="Mahasiswa" {{ request('status') == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                <option value="Dosen" {{ request('status') == 'Dosen' ? 'selected' : '' }}>Dosen</option>
                                <option value="Tendik" {{ request('status') == 'Tendik' ? 'selected' : '' }}>Tendik</option>
                                <option value="Masyarakat" {{ request('status') == 'Masyarakat' ? 'selected' : '' }}>Masyarakat</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="filter-gender" class="block text-sm font-medium text-gray-700 mb-2">
                                Jenis Kelamin
                            </label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm" 
                                    id="filter-gender" name="gender">
                                <option value="">Semua</option>
                                <option value="Laki-laki" {{ request('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ request('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="start-date" class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Mulai
                            </label>
                            <input type="date" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm" 
                                   id="start-date" name="start_date" value="{{ request('start_date') }}">
                        </div>
                        
                        <div>
                            <label for="end-date" class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Akhir
                            </label>
                            <input type="date" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm" 
                                   id="end-date" name="end_date" value="{{ request('end_date') }}">
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap gap-2">
                        <button type="submit" 
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 inline-flex items-center text-sm">
                            <i class="fas fa-filter mr-2"></i>
                            Jalankan Filter
                        </button>
                        <a href="{{ route('admin.violence-reports.index') }}" 
                           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 inline-flex items-center text-sm">
                            <i class="fas fa-refresh mr-2"></i>
                            Reset
                        </a>
                        <form method="POST" action="{{ route('admin.violence-reports.bulk-delete') }}" id="bulk-delete-form" style="display: none;">
                            @csrf
                            <input type="hidden" name="selected_reports" id="selected-reports">
                        </form>
                        <button type="button" onclick="bulkDelete()" 
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 inline-flex items-center text-sm"
                                id="bulk-delete-btn" style="display: none;">
                            <i class="fas fa-trash mr-2"></i>
                            Hapus Terpilih
                        </button>
                    </div>
                </form>
            </div>

            <!-- Alerts -->
            <div class="px-6">
                @if(session('success'))
                    <div class="mt-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg" role="alert">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mt-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg" role="alert">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ session('error') }}
                        </div>
                    </div>
                @endif

                @if(session('info'))
                    <div class="mt-4 bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg" role="alert">
                        <div class="flex items-center">
                            <i class="fas fa-info-circle mr-2"></i>
                            {{ session('info') }}
                        </div>
                    </div>
                @endif
            </div>

            <!-- Table -->
            <div class="px-6 py-4">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-green-600">
                                <tr>
                                    <th class="px-4 py-3 text-left">
                                        <input type="checkbox" id="select-all" class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">No</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nama Klien</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Jenis Kelamin</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Status Korban</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nama Pelapor</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nama Pelaku</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Jenis Kekerasan</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Waktu Kejadian</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($reports as $index => $report)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <input type="checkbox" class="report-checkbox rounded border-gray-300 text-green-600 focus:ring-green-500" 
                                               value="{{ $report->id }}">
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration + (($reports->currentPage() - 1) * $reports->perPage()) }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex flex-col">
                                            <span class="font-medium">{{ $report->client->nama_lengkap ?? '-' }}</span>
                                            @if($report->client && $report->client->status_korban == 'Disable')
                                                <span class="text-xs text-orange-600 font-medium">
                                                    <i class="fas fa-wheelchair mr-1"></i>
                                                    {{ $report->client->kategori_disable ?? 'Disable' }}
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                        @if($report->client && $report->client->jenis_kelamin == 'Laki-laki')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <i class="fas fa-mars mr-1"></i>
                                                Laki-laki
                                            </span>
                                        @elseif($report->client && $report->client->jenis_kelamin == 'Perempuan')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-pink-100 text-pink-800">
                                                <i class="fas fa-venus mr-1"></i>
                                                Perempuan
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ $report->client->status ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                        @if($report->client && $report->client->status_korban == 'Disable')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                <i class="fas fa-wheelchair mr-1"></i>
                                                Disable
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Normal
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $report->reporter->nama_lengkap ?? '-' }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $report->perpetrator->nama ?? '-' }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">
                                        @if($report->violance && $report->violance->jenis_kekerasan)
                                            @php
                                                $badgeClasses = match($report->violance->jenis_kekerasan) {
                                                    'Kekerasan Fisik' => 'bg-red-100 text-red-800',
                                                    'Kekerasan Psikis' => 'bg-yellow-100 text-yellow-800',
                                                    'Kekerasan Seksual' => 'bg-purple-100 text-purple-800',
                                                    'Kekerasan Ekonomi' => 'bg-blue-100 text-blue-800',
                                                    default => 'bg-gray-100 text-gray-800'
                                                };
                                            @endphp
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeClasses }}">
                                                {{ $report->violance->jenis_kekerasan }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                        @if($report->violance && $report->violance->waktu_kejadian)
                                            <div class="flex flex-col">
                                                <span class="font-medium">{{ \Carbon\Carbon::parse($report->violance->waktu_kejadian)->format('d/m/Y') }}</span>
                                                <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($report->violance->waktu_kejadian)->format('H:i') }}</span>
                                            </div>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-1">
                                            <a href="{{ route('admin.violence-reports.show', $report->id) }}" 
                                               class="bg-green-500 hover:bg-green-600 text-white p-2 rounded transition-colors duration-200"
                                               title="Lihat Detail">
                                                <i class="fas fa-eye text-xs"></i>
                                            </a>
                                            <a href="{{ route('admin.violence-reports.edit', $report->id) }}" 
                                               class="bg-amber-500 hover:bg-amber-600 text-white p-2 rounded transition-colors duration-200"
                                               title="Edit">
                                                <i class="fas fa-edit text-xs"></i>
                                            </a>
                                            <form action="{{ route('admin.violence-reports.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus laporan ini?')" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                    class="bg-red-500 hover:bg-red-600 text-white p-2 rounded transition-colors duration-200"
                                                    title="Hapus">
                                                <i class="fas fa-trash text-xs"></i>
                                                </button>
                                            </form>
                                            
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="11" class="px-4 py-12 text-center text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <i class="fas fa-inbox text-4xl mb-4 text-gray-400"></i>
                                            <p class="text-lg font-medium mb-2">Tidak ada data laporan kekerasan</p>
                                            <p class="text-sm">Klik tombol "Tambah Laporan" untuk membuat laporan baru</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                @if(method_exists($reports, 'links'))
                    <div class="mt-6 flex justify-center">
                        {{ $reports->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Auto-hide alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        const alerts = document.querySelectorAll('[role="alert"]');
        alerts.forEach(alert => {
            alert.style.transition = 'opacity 0.5s ease-out';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);

    // Setup checkbox functionality
    setupCheckboxes();
});

// Setup checkbox functionality
function setupCheckboxes() {
    const selectAll = document.getElementById('select-all');
    const checkboxes = document.querySelectorAll('.report-checkbox');
    const bulkDeleteBtn = document.getElementById('bulk-delete-btn');

    if (selectAll && checkboxes.length > 0) {
        selectAll.addEventListener('change', function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            toggleBulkDeleteButton();
        });

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const checkedBoxes = document.querySelectorAll('.report-checkbox:checked');
                selectAll.checked = checkedBoxes.length === checkboxes.length;
                selectAll.indeterminate = checkedBoxes.length > 0 && checkedBoxes.length < checkboxes.length;
                toggleBulkDeleteButton();
            });
        });
    }

    function toggleBulkDeleteButton() {
        const checkedBoxes = document.querySelectorAll('.report-checkbox:checked');
        if (bulkDeleteBtn) {
            if (checkedBoxes.length > 0) {
                bulkDeleteBtn.style.display = 'inline-flex';
            } else {
                bulkDeleteBtn.style.display = 'none';
            }
        }
    }
}

// Delete function
function deleteReport(id) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: "Apakah Anda yakin ingin menghapus laporan ini? Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#059669',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.getElementById('deleteForm');
            form.action = `/admin/violence-reports/${id}`;
            form.submit();
        }
    });
}

// Bulk delete function
function bulkDelete() {
    const checkedBoxes = document.querySelectorAll('.report-checkbox:checked');
    const selectedIds = Array.from(checkedBoxes).map(cb => cb.value);

    if (selectedIds.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Peringatan',
            text: 'Pilih minimal satu laporan untuk dihapus!',
            confirmButtonColor: '#059669'
        });
        return;
    }

    Swal.fire({
        title: 'Konfirmasi Hapus Massal',
        text: `Apakah Anda yakin ingin menghapus ${selectedIds.length} laporan yang dipilih?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#059669',
        confirmButtonText: 'Ya, Hapus Semua!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.getElementById('bulk-delete-form');
            document.getElementById('selected-reports').value = JSON.stringify(selectedIds);
            form.submit();
        }
    });
}
</script>
@endsection