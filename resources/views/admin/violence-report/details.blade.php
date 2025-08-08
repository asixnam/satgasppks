@extends('layouts.admin')

@section('title', 'Detail Laporan Kekerasan')

@section('content')
<div class="min-h-screen bg-gray-50 p-4">
    <div class="max-w-7xl mx-auto">
        <!-- Header Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.violence-reports.index') }}" 
                           class="text-gray-600 hover:text-gray-800 transition-colors duration-200">
                            <i class="fas fa-arrow-left text-lg"></i>
                        </a>
                        <h1 class="text-2xl font-semibold text-gray-900">Detail Laporan Kekerasan</h1>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('admin.violence-reports.create') }}" 
                           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 inline-flex items-center text-sm">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Laporan
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
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
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
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-2">
                                Pencarian
                            </label>
                            <input type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm" 
                                   id="search" name="search" value="{{ request('search') }}" placeholder="Cari nama...">
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap gap-2">
                        <button type="submit" 
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 inline-flex items-center text-sm">
                            <i class="fas fa-filter mr-2"></i>
                            Jalankan Filter
                        </button>
                        <a href="{{ route('admin.violence-reports.details.all') }}" 
                           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 inline-flex items-center text-sm">
                            <i class="fas fa-refresh mr-2"></i>
                            Reset
                        </a>
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
            </div>

            <!-- Summary Stats -->
            <!-- <div class="px-6 py-4 border-b border-gray-200 bg-blue-50">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-blue-600">{{ $reports->total() }}</div>
                        <div class="text-sm text-gray-600">Total Laporan</div>
                    </div>
                    <div class="text-center">
                    <div class="text-2xl font-bold text-red-600">
                        {{ $jumlah_kekerasan['Kekerasan Fisik'] ?? 0 }}
                    </div>
                    <div class="text-sm text-gray-600">Kekerasan Fisik</div>
                </div>

                <div class="text-center">
                    <div class="text-2xl font-bold text-yellow-600">
                        {{ $jumlah_kekerasan['Kekerasan Psikis'] ?? 0 }}
                    </div>
                    <div class="text-sm text-gray-600">Kekerasan Psikis</div>
                </div>

                <div class="text-center">
                    <div class="text-2xl font-bold text-purple-600">
                        {{ $jumlah_kekerasan['Kekerasan Seksual'] ?? 0 }}
                    </div>
                    <div class="text-sm text-gray-600">Kekerasan Seksual</div>
                </div>
                </div>
            </div> -->

            <!-- Detailed Cards View -->
            <div class="p-6">
                @forelse($reports as $report)
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-6 hover:shadow-md transition-shadow duration-200">
                    <!-- Card Header -->
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <div class="flex justify-between items-start">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-green-600 text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">
                                        {{ is_array($report->client_name) ? implode(', ', $report->client_name) : ($report->client_name ?? '-') }}
                                    </h3>
                                    <p class="text-sm text-gray-600">
                                        Laporan #{{ $report->id }} • 
                                        {{ $report->created_at ? $report->created_at->format('d M Y, H:i') : '-' }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                @if($report->jenis_kekerasan)
                                    @php
                                        $badgeClasses = match($report->jenis_kekerasan) {
                                            'Kekerasan Fisik' => 'bg-red-100 text-red-800',
                                            'Kekerasan Psikis' => 'bg-yellow-100 text-yellow-800',
                                            'Kekerasan Seksual' => 'bg-purple-100 text-purple-800',
                                            'Kekerasan Ekonomi' => 'bg-blue-100 text-blue-800',
                                            default => 'bg-gray-100 text-gray-800'
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $badgeClasses }}">
                                        {{ $report->jenis_kekerasan }}
                                    </span>
                                @endif
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
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Content -->
                    <div class="px-6 py-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- Informasi Korban -->
                            <div class="space-y-3">
                                <h4 class="font-semibold text-gray-900 flex items-center">
                                    <i class="fas fa-user-injured mr-2 text-red-500"></i>
                                    Informasi Korban
                                </h4>
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Nama:</span>
                                        <span class="font-medium">{{ is_array($report->client_name) ? implode(', ', $report->client_name) : ($report->client_name ?? '-') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Jenis Kelamin:</span>
                                        <div>
                                            @if($report->client_gender == 'Laki-laki')
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    <i class="fas fa-mars mr-1"></i>
                                                    Laki-laki
                                                </span>
                                            @elseif($report->client_gender == 'Perempuan')
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-pink-100 text-pink-800">
                                                    <i class="fas fa-venus mr-1"></i>
                                                    Perempuan
                                                </span>
                                            @else
                                                <span class="text-gray-500">-</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Status:</span>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ $report->client_status ?? '-' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Informasi Pelapor -->
                            <div class="space-y-3">
                                <h4 class="font-semibold text-gray-900 flex items-center">
                                    <i class="fas fa-user-shield mr-2 text-blue-500"></i>
                                    Informasi Pelapor
                                </h4>
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Nama:</span>
                                        <span class="font-medium">{{ $report->reporter_name ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Informasi Pelaku -->
                            <div class="space-y-3">
                                <h4 class="font-semibold text-gray-900 flex items-center">
                                    <i class="fas fa-user-times mr-2 text-orange-500"></i>
                                    Informasi Pelaku
                                </h4>
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Nama:</span>
                                        <span class="font-medium">{{ $report->perpetrator_name ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Kejadian -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h4 class="font-semibold text-gray-900 flex items-center mb-4">
                                <i class="fas fa-calendar-alt mr-2 text-purple-500"></i>
                                Informasi Kejadian
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Jenis Kekerasan:</span>
                                <div>
                                    @if(!empty($report->jenis_kekerasan) && is_array($report->jenis_kekerasan))
                                        @foreach($report->jenis_kekerasan as $jk)
                                            @php
                                                $badgeClasses = match($jk) {
                                                    'Kekerasan Fisik' => 'bg-red-100 text-red-800',
                                                    'Kekerasan Psikis' => 'bg-yellow-100 text-yellow-800',
                                                    'Kekerasan Seksual' => 'bg-purple-100 text-purple-800',
                                                    'Kekerasan Ekonomi' => 'bg-blue-100 text-blue-800',
                                                    default => 'bg-gray-100 text-gray-800'
                                                };
                                            @endphp
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $badgeClasses }}">
                                                {{ $jk }}
                                            </span>
                                        @endforeach
                                    @elseif(!empty($report->jenis_kekerasan))
                                        @php
                                            $badgeClasses = match($report->jenis_kekerasan) {
                                                'Kekerasan Fisik' => 'bg-red-100 text-red-800',
                                                'Kekerasan Psikis' => 'bg-yellow-100 text-yellow-800',
                                                'Kekerasan Seksual' => 'bg-purple-100 text-purple-800',
                                                'Kekerasan Ekonomi' => 'bg-blue-100 text-blue-800',
                                                default => 'bg-gray-100 text-gray-800'
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $badgeClasses }}">
                                            {{ $report->jenis_kekerasan }}
                                        </span>
                                    @else
                                        <span class="text-gray-500">-</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Waktu Kejadian:</span>
                                    <div class="text-right">
                                        @if($report->waktu_kejadian)
                                            <div class="font-medium">{{ \Carbon\Carbon::parse($report->waktu_kejadian)->format('d/m/Y') }}</div>
                                            <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($report->waktu_kejadian)->format('H:i') }} WIB</div>
                                        @else
                                            <span class="text-gray-500">-</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-12">
                    <div class="flex flex-col items-center">
                        <i class="fas fa-inbox text-6xl mb-4 text-gray-400"></i>
                        <p class="text-xl font-medium mb-2 text-gray-600">Tidak ada data laporan kekerasan</p>
                        <p class="text-gray-500 mb-6">Data yang Anda cari tidak ditemukan atau belum ada laporan</p>
                        <a href="{{ route('admin.violence-reports.create') }}" 
                           class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg transition-colors duration-200 inline-flex items-center">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Laporan Baru
                        </a>
                    </div>
                </div>
                @endforelse

                <!-- Pagination -->
                @if(method_exists($reports, 'links') && $reports->hasPages())
                    <div class="mt-8 flex justify-center">
                        {{ $reports->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
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

// Print functionality
function printReport() {
    window.print();
}

// Enhanced search functionality
document.getElementById('search')?.addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const reportCards = document.querySelectorAll('.bg-white.border.border-gray-200');
    
    reportCards.forEach(card => {
        const text = card.textContent.toLowerCase();
        if (searchTerm === '' || text.includes(searchTerm)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});
</script>

<style>
@media print {
    .no-print {
        display: none !important;
    }
    
    .bg-gray-50 {
        background-color: white !important;
    }
    
    .shadow-sm, .shadow-md {
        box-shadow: none !important;
    }
    
    .border {
        border: 1px solid #e5e7eb !important;
    }
}
</style>
@endsection