@extends('layouts.admin')

@section('title', 'Laporan Kekerasan')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
        <div class="px-4 py-4 sm:px-6 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <h1 class="text-xl sm:text-2xl font-semibold text-gray-900 mb-2 sm:mb-0">
                    Data Laporan Kekerasan
                </h1>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.violence-reports.create') }}"
                        class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 sm:px-4 sm:py-2 rounded-lg transition-colors duration-200 inline-flex items-center text-sm">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Laporan
                    </a>
                    <a href="{{ route('admin.violence-reports.details.all') }}"
                        class="bg-green-500 hover:bg-green-600 text-white px-3 py-2 sm:px-4 sm:py-2 rounded-lg transition-colors duration-200 inline-flex items-center text-sm">
                        <i class="fas fa-list mr-2"></i>
                        View Details
                    </a>
                    <a href="{{ route('admin.violence-reports.statistics') }}"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 sm:px-4 sm:py-2 rounded-lg transition-colors duration-200 inline-flex items-center text-sm">
                        <i class="fas fa-chart-bar mr-2"></i>
                        Statistik
                    </a>
                </div>
            </div>
        </div>

        <div class="px-4 py-4 sm:px-6 border-b border-gray-200 bg-gray-50">
            <form id="filterForm" method="GET" class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                    <div>
                        <label for="violence_type" class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">
                            Bentuk Kekerasan
                        </label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                id="filter-violence-form" name="violence_type">
                            <option value="">Semua Bentuk</option>
                            <option value="Fisik" {{ request('violence_type') == 'Fisik' ? 'selected' : '' }}>Fisik</option>
                            <option value="Psikis" {{ request('violence_type') == 'Psikis' ? 'selected' : '' }}>Psikis</option>
                            <option value="Seksual" {{ request('violence_type') == 'Seksual' ? 'selected' : '' }}>Seksual</option>
                            <option value="Perundungan" {{ request('violence_type') == 'Perundungan' ? 'selected' : '' }}>Perundungan</option>
                            <option value="Diskriminasi" {{ request('violence_type') == 'Diskriminasi' ? 'selected' : '' }}>Diskriminasi</option>
                        </select>
                    </div>

                    <div>
                        <label for="filter-status" class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">
                            Status Korban
                        </label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                id="filter-status" name="status">
                            <option value="">Semua Status</option>
                            <option value="Mahasiswa" {{ request('status') == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                            <option value="Dosen" {{ request('status') == 'Dosen' ? 'selected' : '' }}>Dosen</option>
                            <option value="Tendik" {{ request('status') == 'Tendik' ? 'selected' : '' }}>Tendik</option>
                            <option value="Atasan" {{ request('status') == 'Atasan' ? 'selected' : '' }}>Atasan</option>
                            <option value="Masyarakat" {{ request('status') == 'Masyarakat' ? 'selected' : '' }}>Masyarakat</option>
                            <option value="Pegawai" {{ request('status') == 'Pegawai' ? 'selected' : '' }}>Pegawai Lainnya</option>
                        </select>
                    </div>

                    <div>
                        <label for="filter-gender" class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">
                            Jenis Kelamin
                        </label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                id="filter-gender" name="gender">
                            <option value="">Semua</option>
                            <option value="Laki-laki" {{ request('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ request('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <label for="start-date" class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">
                            Tanggal Mulai
                        </label>
                        <input type="date"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                               id="start-date" name="start_date" value="{{ request('start_date') }}">
                    </div>

                    <div>
                        <label for="end-date" class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">
                            Tanggal Akhir
                        </label>
                        <input type="date"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
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
    </div>

    <div class="space-y-4 sm:hidden">
        @forelse($reports as $report)
        <div class="bg-white shadow rounded-lg p-4 border border-gray-200">
            <div class="flex justify-between items-center mb-2">
                <span class="font-bold text-base">{{ $report->client->nama_lengkap ?? '-' }}</span>
                <span class="text-xs px-2 py-1 rounded-full font-medium {{ $report->status == 'selesai' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                    {{ ucfirst($report->status) }}
                </span>
            </div>
            <p class="text-sm text-gray-600">Kode: <span class="font-mono">{{ $report->code ?? 'N/A' }}</span></p>
            <p class="text-sm text-gray-600">Pelapor: {{ $report->reporter->nama_lengkap ?? '-' }}</p>
            <p class="text-sm text-gray-600">Pelaku: {{ $report->perpetrator->nama ?? '-' }}</p>
            <div class="mt-3 flex gap-2 flex-wrap">
                <a href="{{ route('admin.violence-reports.show', $report->id) }}" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs">Lihat</a>
                <a href="{{ route('admin.violence-reports.edit', $report->id) }}" class="bg-amber-500 hover:bg-amber-600 text-white px-3 py-1 rounded text-xs">Edit</a>
                <form action="{{ route('admin.violence-reports.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Yakin hapus laporan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">Hapus</button>
                </form>
            </div>
        </div>
        @empty
        <div class="text-center py-12 text-gray-500">
            <i class="fas fa-inbox text-4xl mb-4"></i>
            <p class="text-lg font-medium">Tidak ada data laporan kekerasan</p>
            <p class="text-sm mt-1">Klik "Tambah Laporan" untuk membuat laporan baru.</p>
        </div>
        @endforelse
    </div>

    <div class="px-0 sm:px-6 py-4 hidden sm:block">
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-green-600">
                        <tr>
                            <th class="px-4 py-3 text-left">
                                <input type="checkbox" id="select-all" class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">No</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Kode Laporan</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nama Klien</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Jenis Kelamin</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Status Laporan</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Status Korban</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nama Pelapor</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nama Pelaku</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Bentuk Kekerasan</th>
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
                                <span class="font-mono text-xs bg-gray-100 px-2 py-1 rounded">{{ $report->code ?? 'N/A' }}</span>
                            </td>
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
                                <form action="{{ route('admin.violence-reports.update-status', $report->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="text-xs px-2 py-1 rounded border border-gray-300 focus:outline-none focus:ring-1 focus:ring-green-500
                                        @if($report->status == 'terlapor') bg-gray-100 text-gray-800
                                        @elseif($report->status == 'ditolak') bg-red-100 text-red-800
                                        @elseif($report->status == 'diproses') bg-yellow-100 text-yellow-800
                                        @elseif($report->status == 'selesai') bg-green-100 text-green-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        <option value="terlapor" {{ $report->status == 'terlapor' ? 'selected' : '' }}>Terlapor</option>
                                        <option value="diproses" {{ $report->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="selesai" {{ $report->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="ditolak" {{ $report->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                </form>
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
                                @if($report->violence && $report->violence->bentuk_kekerasan)
                                    @php
                                        $bentukList = is_array($report->violence->bentuk_kekerasan)
                                            ? $report->violence->bentuk_kekerasan
                                            : json_decode($report->violence->bentuk_kekerasan, true);
                                    @endphp

                                    @foreach ($bentukList as $bentuk)
                                        @php
                                            $badgeClasses = match($bentuk) {
                                                'Fisik' => 'bg-red-100 text-red-800',
                                                'Psikis' => 'bg-yellow-100 text-yellow-800',
                                                'Seksual' => 'bg-purple-100 text-purple-800',
                                                'Ekonomi' => 'bg-blue-100 text-blue-800',
                                                default => 'bg-gray-100 text-gray-800'
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeClasses }} mb-1">{{ $bentuk }}</span>
                                    @endforeach
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">-</span>
                                @endif
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                @if($report->violence && $report->violence->waktu_kejadian)
                                    <div class="flex flex-col">
                                        <span class="font-medium text-sm">{{ \Carbon\Carbon::parse($report->violence->waktu_kejadian)->format('d/m/Y') }}</span>
                                        <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($report->violence->waktu_kejadian)->format('H:i') }}</span>
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
                                    <form action="{{ route('admin.violence-reports.destroy', $report->id) }}" method="POST" onsubmit="return confirmDelete(event)" class="inline-block">
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
                            <td colspan="12" class="px-4 py-12 text-center text-gray-500">
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

        <div class="mt-6">
            {{ $reports->links() }}
        </div>
    </div>
</div>

<script>
    // Auto-hide alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert[role="alert"]');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.transition = 'opacity 0.5s ease-out';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }, 5000);
        });

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

    // Confirm delete function
    function confirmDelete(event) {
        if (!confirm('Apakah Anda yakin ingin menghapus laporan ini? Data yang dihapus tidak dapat dikembalikan!')) {
            event.preventDefault();
            return false;
        }
        return true;
    }

    // Bulk delete function
    function bulkDelete() {
        const checkedBoxes = document.querySelectorAll('.report-checkbox:checked');
        const selectedIds = Array.from(checkedBoxes).map(cb => cb.value);

        if (selectedIds.length === 0) {
            alert('Pilih minimal satu laporan untuk dihapus!');
            return;
        }

        if (confirm(`Apakah Anda yakin ingin menghapus ${selectedIds.length} laporan yang dipilih? Data yang dihapus tidak dapat dikembalikan!`)) {
            const form = document.getElementById('bulk-delete-form');
            document.getElementById('selected-reports').value = JSON.stringify(selectedIds);
            form.submit();
        }
    }
</script>
@endsection