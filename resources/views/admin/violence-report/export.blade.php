@extends('layouts.admin')

@section('title', 'Statistik Laporan Kekerasan')

@section('content')
<div class="min-h-screen bg-gray-50 p-4">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-900">Statistik Laporan Kekerasan</h1>
                        <p class="text-sm text-gray-600 mt-1">Dashboard analitik dan statistik laporan kekerasan</p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('admin.violence-reports.index') }}" 
                           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 inline-flex items-center text-sm">
                            <i class="fas fa-list mr-2"></i>
                            Lihat Laporan
                        </a>
                        <button onclick="refreshData()" 
                                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 inline-flex items-center text-sm">
                            <i class="fas fa-sync-alt mr-2"></i>
                            Refresh Data
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Overview Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Reports -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-file-alt text-blue-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Laporan</p>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($totalReports) }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-sm">
                            <span class="text-green-600 font-medium">
                                <i class="fas fa-arrow-up mr-1"></i>
                                Semua waktu
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Disable Victims -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-wheelchair text-red-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Korban Disable</p>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($disableVictims) }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-sm">
                            <span class="text-gray-600">
                                {{ $totalReports > 0 ? number_format(($disableVictims / $totalReports) * 100, 1) : 0 }}% dari total
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Reports -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-clock text-yellow-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">30 Hari Terakhir</p>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($recentReports) }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-sm">
                            <span class="text-gray-600">
                                {{ $totalReports > 0 ? number_format(($recentReports / $totalReports) * 100, 1) : 0 }}% dari total
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Average per Month -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-chart-line text-purple-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Rata-rata/Bulan</p>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($recentReports / 1, 0) }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-sm">
                            <span class="text-gray-600">
                                Estimasi bulanan
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Violence Types Chart -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-chart-pie mr-2 text-blue-600"></i>
                        Jenis Kekerasan Terbanyak
                    </h3>
                </div>
                <div class="p-6">
                    @if($violenceTypes->count() > 0)
                        <div class="space-y-4">
                            @foreach($violenceTypes as $type)
                                @php
                                    $percentage = $totalReports > 0 ? ($type->total / $totalReports) * 100 : 0;
                                    $colorClass = match($loop->index) {
                                        0 => 'bg-red-500',
                                        1 => 'bg-yellow-500',
                                        2 => 'bg-purple-500',
                                        3 => 'bg-blue-500',
                                        default => 'bg-gray-500'
                                    };
                                @endphp
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center flex-1">
                                        <div class="w-4 h-4 rounded {{ $colorClass }} mr-3"></div>
                                        <span class="text-sm font-medium text-gray-700 flex-1">
                                            {{ $type->jenis_kekerasan }}
                                        </span>
                                        <span class="text-sm text-gray-500 ml-2">
                                            {{ number_format($type->total) }} kasus
                                        </span>
                                    </div>
                                </div>
                                <div class="ml-7">
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="h-2 rounded-full {{ $colorClass }}" 
                                             style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <span class="text-xs text-gray-500 mt-1 block">
                                        {{ number_format($percentage, 1) }}%
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-chart-pie text-gray-300 text-4xl mb-4"></i>
                            <p class="text-gray-500">Tidak ada data jenis kekerasan</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Gender Statistics -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-venus-mars mr-2 text-pink-600"></i>
                        Statistik Berdasarkan Jenis Kelamin
                    </h3>
                </div>
                <div class="p-6">
                    @if($genderStats->count() > 0)
                        <div class="space-y-6">
                            @foreach($genderStats as $gender)
                                @php
                                    $percentage = $totalReports > 0 ? ($gender->total / $totalReports) * 100 : 0;
                                    $colorClass = $gender->jenis_kelamin === 'Perempuan' ? 'bg-pink-500' : 'bg-blue-500';
                                    $iconClass = $gender->jenis_kelamin === 'Perempuan' ? 'fa-venus' : 'fa-mars';
                                @endphp
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center">
                                            <i class="fas {{ $iconClass }} {{ $gender->jenis_kelamin === 'Perempuan' ? 'text-pink-600' : 'text-blue-600' }} mr-2"></i>
                                            <span class="text-sm font-medium text-gray-700">
                                                {{ $gender->jenis_kelamin }}
                                            </span>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-lg font-bold text-gray-900">{{ number_format($gender->total) }}</span>
                                            <span class="text-xs text-gray-500 ml-1">kasus</span>
                                        </div>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="h-3 rounded-full {{ $colorClass }}" 
                                             style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <span class="text-xs text-gray-500 mt-1 block">
                                        {{ number_format($percentage, 1) }}% dari total laporan
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-venus-mars text-gray-300 text-4xl mb-4"></i>
                            <p class="text-gray-500">Tidak ada data jenis kelamin</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Detailed Statistics Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-table mr-2 text-green-600"></i>
                    Ringkasan Detail Statistik
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kategori
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jumlah
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Persentase
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <i class="fas fa-file-alt text-blue-600 mr-2"></i>
                                    <span class="text-sm font-medium text-gray-900">Total Laporan</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ number_format($totalReports) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                100%
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Aktif
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <i class="fas fa-wheelchair text-red-600 mr-2"></i>
                                    <span class="text-sm font-medium text-gray-900">Korban Disable</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ number_format($disableVictims) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $totalReports > 0 ? number_format(($disableVictims / $totalReports) * 100, 1) : 0 }}%
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Prioritas
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <i class="fas fa-clock text-yellow-600 mr-2"></i>
                                    <span class="text-sm font-medium text-gray-900">Laporan 30 Hari Terakhir</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ number_format($recentReports) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $totalReports > 0 ? number_format(($recentReports / $totalReports) * 100, 1) : 0 }}%
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    Terkini
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mt-6">
            <div class="px-6 py-4">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="text-sm text-gray-600">
                        Data terakhir diperbarui: {{ now()->format('d/m/Y H:i') }}
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('admin.violence-reports.export') }}" 
                           class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 inline-flex items-center text-sm">
                            <i class="fas fa-download mr-2"></i>
                            Export Data
                        </a>
                        <a href="{{ route('admin.violence-reports.index') }}" 
                           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 inline-flex items-center text-sm">
                            <i class="fas fa-list mr-2"></i>
                            Lihat Semua Laporan
                        </a>
                        <a href="{{ route('admin.violence-reports.create') }}" 
                           class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 inline-flex items-center text-sm">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Laporan Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function refreshData() {
    Swal.fire({
        title: 'Memperbarui Data...',
        text: 'Sedang mengambil data terkini',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        willOpen: () => {
            Swal.showLoading();
        }
    });

    // Simulate refresh (reload page)
    setTimeout(() => {
        window.location.reload();
    }, 1000);
}

// Show success/error messages if they exist
@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        timer: 3000,
        showConfirmButton: false
    });
@endif

@if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: '{{ session('error') }}',
        confirmButtonColor: '#059669'
    });
@endif

// Animate counters on page load
document.addEventListener('DOMContentLoaded', function() {
    const counters = document.querySelectorAll('.text-2xl.font-bold');
    
    counters.forEach(counter => {
        const target = parseInt(counter.textContent.replace(/,/g, ''));
        let current = 0;
        const increment = target / 50;
        
        const updateCounter = () => {
            if (current < target) {
                current += increment;
                counter.textContent = Math.floor(current).toLocaleString();
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target.toLocaleString();
            }
        };
        
        updateCounter();
    });
});
</script>
@endsection