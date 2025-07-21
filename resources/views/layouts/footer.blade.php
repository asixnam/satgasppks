<main class="flex-1 overflow-y-auto bg-gray-50">
    <!-- Enhanced Content Header -->
    <div class="glass-effect border-b border-gray-200/50 px-8 py-6 sticky top-0 z-30">
        <div class="flex items-center justify-between">
            <div class="space-y-1">
                <h2 class="text-2xl font-bold text-gray-800 tracking-tight">@yield('page_title', 'Dashboard')</h2>
                <p class="text-sm text-gray-600">@yield('page_description', 'Selamat datang di panel admin SATGAS PPKS')</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="hidden sm:flex items-center space-x-3 bg-white/60 px-4 py-2 rounded-xl backdrop-blur-sm">
                    <i class="fas fa-calendar-alt text-gray-400"></i>
                    <span class="text-sm text-gray-700 font-medium">{{ date('d M Y') }}</span>
                </div>
                <div class="flex items-center space-x-2 bg-green-50 px-3 py-2 rounded-xl">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-sm text-green-700 font-medium">Online</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Content Body -->
    <div class="p-8">
        <!-- Enhanced Alerts -->
        @if (session('success'))
            <div
                class="mb-8 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 p-6 rounded-2xl shadow-sm">
                <div class="flex items-start space-x-4">
                    <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-green-800 mb-1">Berhasil!</h4>
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                    <button class="text-green-400 hover:text-green-600 transition-colors duration-200">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-8 bg-gradient-to-r from-red-50 to-rose-50 border border-red-200 p-6 rounded-2xl shadow-sm">
                <div class="flex items-start space-x-4">
                    <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-exclamation-circle text-red-600"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-red-800 mb-1">Terjadi Kesalahan!</h4>
                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                    <button class="text-red-400 hover:text-red-600 transition-colors duration-200">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        <!-- Main Content Area -->
        <div class="space-y-8">
            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
                <p class="text-gray-500 text-sm mt-1">Kelola sistem Anda dengan mudah</p>
            </div>

            <!-- Ringkasan Data -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <!-- Total Pengaduan -->
                <a href="#"
                    class="bg-white p-5 rounded-lg border border-gray-200 hover:border-blue-200 hover:shadow-sm transition-all duration-200 cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Total Pengaduan</p>
                            <h2 class="text-2xl font-semibold text-gray-900 mt-1">15</h2>
                            <p class="text-green-600 text-xs mt-2">+2 dari minggu lalu</p>
                        </div>
                        <div class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Berita Dipublikasikan -->
                <a href="#"
                    class="bg-white p-5 rounded-lg border border-gray-200 hover:border-green-200 hover:shadow-sm transition-all duration-200 cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Berita Dipublikasikan</p>
                            <h2 class="text-2xl font-semibold text-gray-900 mt-1">29</h2>
                            <p class="text-green-600 text-xs mt-2">+5 dari minggu lalu</p>
                        </div>
                        <div class="w-10 h-10 bg-green-50 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Materi Edukasi -->
                <a href="#"
                    class="bg-white p-5 rounded-lg border border-gray-200 hover:border-purple-200 hover:shadow-sm transition-all duration-200 cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Materi Edukasi</p>
                            <h2 class="text-2xl font-semibold text-gray-900 mt-1">3</h2>
                            <p class="text-gray-400 text-xs mt-2">Tidak ada perubahan</p>
                        </div>
                        <div class="w-10 h-10 bg-purple-50 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Anggota Tim -->
                <a href="#"
                    class="bg-white p-5 rounded-lg border border-gray-200 hover:border-orange-200 hover:shadow-sm transition-all duration-200 cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Anggota Tim</p>
                            <h2 class="text-2xl font-semibold text-gray-900 mt-1">6</h2>
                            <p class="text-green-600 text-xs mt-2">+1 dari minggu lalu</p>
                        </div>
                        <div class="w-10 h-10 bg-orange-50 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Aksi Cepat -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Aksi Cepat</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Tambah Berita Baru -->
                    <div class="bg-white p-5 rounded-lg border border-gray-200">
                        <div class="flex items-center mb-3">
                            <div class="w-8 h-8 bg-green-50 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <h3 class="text-sm font-medium text-gray-900">Tambah Berita</h3>
                        </div>
                        <p class="text-gray-500 text-xs mb-4">Publikasikan artikel terbaru untuk masyarakat
                        </p>
                        <a href="{{ route('beritas.create') }}"
                            class="inline-flex items-center text-green-600 text-xs font-medium">
                            <span>Tambah Berita</span>
                            <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                    </div>

                    <!-- Tambah Materi Edukasi -->
                    <div class="bg-white p-5 rounded-lg border border-gray-200">
                        <div class="flex items-center mb-3">
                            <div class="w-8 h-8 bg-purple-50 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-sm font-medium text-gray-900">Tambah Materi</h3>
                        </div>
                        <p class="text-gray-500 text-xs mb-4">Bagikan pengetahuan untuk masyarakat</p>
                        <a href="{{ route('edukasis.create') }}"
                            class="inline-flex items-center text-purple-600 text-xs font-medium">
                            <span>Tambah Materi</span>
                            <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                    </div>

                    <!-- Lihat Pengaduan Terbaru -->
                    <div class="bg-white p-5 rounded-lg border border-gray-200">
                        <div class="flex items-center mb-3">
                            <div class="w-8 h-8 bg-yellow-50 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-sm font-medium text-gray-900">Lihat Pengaduan</h3>
                        </div>
                        <p class="text-gray-500 text-xs mb-4">Tinjau laporan dari masyarakat</p>
                        <a href="{{ route('laporans.index') }}"
                            class="inline-flex items-center text-yellow-600 text-xs font-medium">
                            <span>Lihat Pengaduan</span>
                            <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Aktivitas Terbaru -->
            <div class="bg-white rounded-lg border border-gray-200 p-5">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Aktivitas Terbaru</h3>
                <div class="space-y-3">
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <div class="w-8 h-8 bg-blue-50 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-900">Pengaduan baru dari Jl. Merdeka No. 123</p>
                            <p class="text-xs text-gray-500">2 jam yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <div class="w-8 h-8 bg-green-50 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-900">Berita "Program Kebersihan" berhasil
                                dipublikasikan</p>
                            <p class="text-xs text-gray-500">5 jam yang lalu</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
