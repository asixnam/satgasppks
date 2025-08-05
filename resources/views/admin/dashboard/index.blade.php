@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-2xl p-6 text-white shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name ?? 'Admin' }}!</h1>
                <p class="text-green-100">Kelola sistem SATGAS PPKPT dengan mudah dan efisien</p>
            </div>
            <div class="hidden md:block">
                <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-shield-alt text-3xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Pengaduan Aktif -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Jumlah Pengaduan</p>
                    <p class="text-3xl font-bold text-red-600">5</p>
                    <p class="text-xs text-gray-500 mt-1">+2 dari bulan lalu</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-red-600"></i>
                </div>
            </div>
        </div>

        <!-- Total Berita -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-200">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Berita</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $jumlahBerita }}</p>
                    <p class="text-xs text-gray-500 mt-1">+{{ $jumlahBeritaBulanIni }} Berita Bulan Ini</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center shrink-0">
                    <i class="fas fa-newspaper text-blue-600 text-lg"></i>
                </div>
            </div>
        </div>

        <!-- Konten Edukasi -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-200">
            <div class="flex items-center justify-between gap-4">
                <div class="flex-1">
                    <p class="text-gray-600 text-sm font-medium">Jumlah Edukasi</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $jumlahEdukasi }}</p>
                    <p>+{{ $jumlahEdukasiBulanIni }} Edukasi Bulan ini  </p>
                </div>
                <div class="w-14 h-14 bg-purple-100 rounded-lg flex items-center justify-center shrink-0">
                    <i class="fas fa-graduation-cap text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Anggota Tim -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Anggota Tim</p>
                    <p class="text-3xl font-bold text-orange-600">{{ $jumlahTim }}</p>
                    <p class="text-xs text-gray-500 mt-1">Tim aktif</p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-users text-orange-600"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Reports -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">Laporan Terbaru</h2>
                    <a href="{{ route('admin.violence-reports.index') }}" class="text-green-600 hover:text-green-700 text-sm font-medium">
                        Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-start space-x-4 p-4 bg-red-50 rounded-lg border border-red-100">
                        <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-exclamation text-red-600 text-xs"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900">Pelecehan di Kampus</p>
                            <p class="text-xs text-gray-600 mt-1">Dilaporkan 2 jam yang lalu</p>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 mt-2">
                                Mendesak
                            </span>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 p-4 bg-yellow-50 rounded-lg border border-yellow-100">
                        <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-clock text-yellow-600 text-xs"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900">Diskriminasi Gender</p>
                            <p class="text-xs text-gray-600 mt-1">Dilaporkan 1 hari yang lalu</p>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 mt-2">
                                Dalam Proses
                            </span>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-lg border border-gray-100">
                        <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-info text-gray-600 text-xs"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900">Keluhan Fasilitas</p>
                            <p class="text-xs text-gray-600 mt-1">Dilaporkan 3 hari yang lalu</p>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 mt-2">
                                Ditinjau
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900">Aksi Cepat</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('admin.beritas.create') }}" 
                       class="flex flex-col items-center p-4 bg-blue-50 rounded-lg border border-blue-100 hover:bg-blue-100 transition-colors duration-200 group">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition-colors duration-200">
                            <i class="fas fa-plus text-blue-600"></i>
                        </div>
                        <span class="text-sm font-medium text-blue-700 mt-2">Tambah Berita</span>
                    </a>

                    <a href="{{ route('admin.edukasis.create') }}" 
                       class="flex flex-col items-center p-4 bg-purple-50 rounded-lg border border-purple-100 hover:bg-purple-100 transition-colors duration-200 group">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center group-hover:bg-purple-200 transition-colors duration-200">
                            <i class="fas fa-book text-purple-600"></i>
                        </div>
                        <span class="text-sm font-medium text-purple-700 mt-2">Buat Edukasi</span>
                    </a>

                    <a href="{{ route('admin.tims.create') }}" 
                       class="flex flex-col items-center p-4 bg-orange-50 rounded-lg border border-orange-100 hover:bg-orange-100 transition-colors duration-200 group">
                        <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center group-hover:bg-orange-200 transition-colors duration-200">
                            <i class="fas fa-user-plus text-orange-600"></i>
                        </div>
                        <span class="text-sm font-medium text-orange-700 mt-2">Tambah Tim</span>
                    </a>

                    <a href="{{ route('admin.violence-reports.index') }}" 
                       class="flex flex-col items-center p-4 bg-red-50 rounded-lg border border-red-100 hover:bg-red-100 transition-colors duration-200 group">
                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center group-hover:bg-red-200 transition-colors duration-200">
                            <i class="fas fa-clipboard-list text-red-600"></i>
                        </div>
                        <span class="text-sm font-medium text-red-700 mt-2">Kelola Laporan</span>
                    </a>
                </div>

                <!-- System Info -->
                <!-- <div class="mt-6 p-4 bg-gray-50 rounded-lg border border-gray-100">
                    <h3 class="text-sm font-semibold text-gray-900 mb-3">Informasi Sistem</h3>
                    <div class="space-y-2 text-sm text-gray-600">
                        <div class="flex justify-between">
                            <span>Server Status:</span>
                            <span class="flex items-center">
                                <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                Online
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span>Last Backup:</span>
                            <span>{{ now()->subHours(2)->format('H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Active Sessions:</span>
                            <span>3</span>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-900">Aktivitas Terbaru</h2>
        </div>
        <div class="p-6">
            <div class="flow-root">
                <ul class="-mb-8">
                    @foreach ($aktivitasTerbaru as $item)
                        <li>
                            <div class="relative pb-8">
                                @if (!$loop->last)
                                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                @endif

                                <div class="relative flex space-x-3">
                                    <div class="h-8 w-8 rounded-full bg-{{ $item['color'] }}-500 flex items-center justify-center ring-8 ring-white">
                                        <i class="{{ $item['icon'] }} text-white text-xs"></i>
                                    </div>
                                    <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                        <div>
                                            <p class="text-sm text-gray-500">{!! $item['message'] !!}</p>
                                        </div>
                                        <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                            <time>{{ $item['created_at']->diffForHumans() }}</time>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    // Add some interactive features
    document.addEventListener('DOMContentLoaded', function() {
        // Animate statistics cards on load
        const cards = document.querySelectorAll('.grid > div');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'all 0.5s ease-out';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // Add hover effects to quick action buttons
        const actionButtons = document.querySelectorAll('a[class*="bg-"][class*="50"]');
        actionButtons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });
</script>
@endsection