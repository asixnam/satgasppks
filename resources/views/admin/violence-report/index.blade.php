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
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <form id="filterForm" method="GET" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div>
                            <label for="filter-violence-type" class="block text-sm font-medium text-gray-700 mb-2">
                                Jenis Kekerasan
                            </label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm" 
                                    id="filter-violence-type" name="violence_type">
                                <option value="">Semua Jenis</option>
                                <option value="Fisik" {{ request('violence_type') == 'Fisik' ? 'selected' : '' }}>Fisik</option>
                                <option value="Psikis" {{ request('violence_type') == 'Psikis' ? 'selected' : '' }}>Psikis</option>
                                <option value="Seksual" {{ request('violence_type') == 'Seksual' ? 'selected' : '' }}>Seksual</option>
                                <option value="Ekonomi" {{ request('violence_type') == 'Ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="filter-faculty" class="block text-sm font-medium text-gray-700 mb-2">
                                Fakultas
                            </label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm" 
                                    id="filter-faculty" name="faculty">
                                <option value="">Semua Fakultas</option>
                                <option value="FMIPA" {{ request('faculty') == 'FMIPA' ? 'selected' : '' }}>FMIPA</option>
                                <option value="FEB" {{ request('faculty') == 'FEB' ? 'selected' : '' }}>FEB</option>
                                <option value="FH" {{ request('faculty') == 'FH' ? 'selected' : '' }}>FH</option>
                                <option value="FK" {{ request('faculty') == 'FK' ? 'selected' : '' }}>FK</option>
                                <option value="FT" {{ request('faculty') == 'FT' ? 'selected' : '' }}>FT</option>
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
                            Filter
                        </button>
                        <a href="{{ route('admin.violence-reports.index') }}" 
                           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 inline-flex items-center text-sm">
                            <i class="fas fa-refresh mr-2"></i>
                            Reset
                        </a>
                        <button type="button" onclick="exportData()" 
                                class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 inline-flex items-center text-sm">
                            <i class="fas fa-download mr-2"></i>
                            Export
                        </button>
                    </div>
                </form>
            </div>

            <!-- Active Filter Info -->
            @if(isset($filter_type) && isset($filter_value))
            <div class="px-6 py-3 bg-green-50 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-green-700">
                        <i class="fas fa-info-circle mr-2"></i>
                        <span class="text-sm">
                            Filter aktif: 
                            @if($filter_type == 'violence_type')
                                Jenis Kekerasan = {{ $filter_value }}
                            @elseif($filter_type == 'faculty')
                                Fakultas = {{ $filter_value }}
                            @elseif($filter_type == 'date_range')
                                Periode = {{ $filter_value }}
                            @endif
                        </span>
                    </div>
                    <a href="{{ route('admin.violence-reports.index') }}" 
                       class="text-green-600 hover:text-green-800 text-sm inline-flex items-center">
                        <i class="fas fa-times mr-1"></i>
                        Hapus Filter
                    </a>
                </div>
            </div>
            @endif

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
                                    <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">No</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nama Klien</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">NIM</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Fakultas</th>
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
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $report->client->nama_lengkap ?? '-' }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $report->client->nim ?? '-' }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $report->client->fakultas ?? '-' }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $report->reporter->nama ?? '-' }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $report->perpetrator->nama_pelaku ?? '-' }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">
                                        @if($report->violance && $report->violance->jenis_kekerasan)
                                            @php
                                                $badgeClasses = match($report->violance->jenis_kekerasan) {
                                                    'Fisik' => 'bg-red-100 text-red-800',
                                                    'Psikis' => 'bg-yellow-100 text-yellow-800',
                                                    'Seksual' => 'bg-purple-100 text-purple-800',
                                                    'Ekonomi' => 'bg-blue-100 text-blue-800',
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
                                            {{ \Carbon\Carbon::parse($report->violance->waktu_kejadian)->format('d/m/Y H:i') }}
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
                                            <button type="button" 
                                                    onclick="deleteReport('{{ $report->id }}')" 
                                                    class="bg-red-500 hover:bg-red-600 text-white p-2 rounded transition-colors duration-200"
                                                    title="Hapus">
                                                <i class="fas fa-trash text-xs"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="px-4 py-12 text-center text-gray-500">
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
                        {{ $reports->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal (Hidden Form) -->
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
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
});

// Enhanced filter function
function filterReports() {
    const form = document.getElementById('filterForm');
    const violenceType = document.getElementById('filter-violence-type').value;
    const faculty = document.getElementById('filter-faculty').value;
    const startDate = document.getElementById('start-date').value;
    const endDate = document.getElementById('end-date').value;

    // Validate date range
    if ((startDate && !endDate) || (!startDate && endDate)) {
        Swal.fire({
            icon: 'warning',
            title: 'Peringatan',
            text: 'Harap isi kedua tanggal (mulai dan akhir) untuk filter berdasarkan periode!',
            confirmButtonColor: '#059669'
        });
        return false;
    }

    if (startDate && endDate && startDate > endDate) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Tanggal mulai tidak boleh lebih besar dari tanggal akhir!',
            confirmButtonColor: '#059669'
        });
        return false;
    }

    form.submit();
}

// Export function
function exportData() {
    const urlParams = new URLSearchParams(window.location.search);
    let exportUrl = '{{ route("admin.violence-reports.index") }}/export';
    
    if (urlParams.toString()) {
        exportUrl += '?' + urlParams.toString();
    }
    
    window.location.href = exportUrl;
}

// Enhanced delete function
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
            // Show loading
            Swal.fire({
                title: 'Menghapus...',
                text: 'Sedang memproses penghapusan data',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });

            // Perform delete with fetch
            fetch(`/admin/violence-reports/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data laporan berhasil dihapus',
                    timer: 2000,
                    showConfirmButton: false,
                    confirmButtonColor: '#059669'
                }).then(() => {
                    location.reload();
                });
            })
            .catch(error => {
                console.error('Delete error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Gagal menghapus data. Silakan coba lagi.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#059669'
                });
            });
        }
    });
}

// Handle form submission for filters
document.getElementById('filterForm').addEventListener('submit', function(e) {
    e.preventDefault();
    filterReports();
});
</script>
@endsection