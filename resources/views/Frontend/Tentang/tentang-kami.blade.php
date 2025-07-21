@extends('Frontend.Home.home')

@section('content')

<div class="container mx-auto px-4 py-8 mt-16">
    <!-- Header Section -->
    <div class="text-center mb-16">
        <img src="/image/logo-warna.png" alt="SATGAS PPKS Logo" class="mx-auto h-24 mb-8 drop-shadow-lg">
        <h1 class="text-4xl md:text-5xl font-bold section-title mb-6 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
            Tentang SATGAS PPKS
        </h1>
        <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto mb-8"></div>
        <p class="text-gray-600 text-lg max-w-4xl mx-auto leading-relaxed">
            Satuan Tugas Penanganan dan Pencegahan Kekerasan Seksual Universitas Nahdlatul Ulama Yogyakarta
            merupakan layanan pengaduan, penanganan, dan pencegahan kekerasan seksual di
            tingkat kampus bagi Civitas Akademika (mahasiswa, dosen, dan tenaga pendidik)
        </p>
    </div>

    <!-- Vision & Mission Section -->
    <div class="max-w-6xl mx-auto mb-16">
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Vision Card -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-8 border border-gray-100">
                <div class="flex items-center mb-6">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-3 rounded-full mr-4">
                        <i class="fas fa-eye text-white text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">VISI</h2>
                </div>
                <p class="text-gray-700 leading-relaxed">
                    Menjadi satuan tugas yang profesional, terpercaya, dan responsif dalam menciptakan lingkungan kampus yang aman, 
                    bebas dari kekerasan seksual, serta mendukung terciptanya budaya kampus yang menghormati harkat dan martabat 
                    setiap individu di Universitas Nahdlatul Ulama Yogyakarta.
                </p>
            </div>

            <!-- Mission Card -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-8 border border-gray-100">
                <div class="flex items-center mb-6">
                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-3 rounded-full mr-4">
                        <i class="fas fa-bullseye text-white text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">MISI</h2>
                </div>
                <ul class="text-gray-700 leading-relaxed space-y-3">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                        <span>Melakukan pencegahan kekerasan seksual melalui edukasi dan sosialisasi kepada civitas akademika</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                        <span>Menyediakan layanan pengaduan yang mudah diakses, aman, dan terpercaya</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                        <span>Menangani kasus kekerasan seksual dengan profesional dan berkeadilan</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                        <span>Membangun budaya kampus yang menghormati hak asasi manusia</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Team Section -->
    <div class="text-center mb-12">
        <div class="flex items-center justify-center mb-8">
            <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 p-3 rounded-full mr-4">
                <i class="fas fa-users text-white text-xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-800">Tim Kami</h2>
        </div>
        <p class="text-gray-600 max-w-2xl mx-auto mb-12">
            Tim profesional yang berdedikasi untuk menciptakan lingkungan kampus yang aman dan nyaman bagi seluruh civitas akademika
        </p>
    </div>

    <!-- Team Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 justify-items-center max-w-6xl mx-auto">
        <!-- Anggota 1 -->
        <div class="text-center group">
            <div class="relative mb-4">
                <img src="/image/sampel.png" alt="Foto Anggota Tim" 
                     class="w-32 h-32 object-cover rounded-full mx-auto shadow-lg group-hover:shadow-xl transition-shadow duration-300 border-4 border-white">
                <div class="absolute inset-0 bg-gradient-to-t from-blue-500/20 to-transparent rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </div>
            <div class="bg-white rounded-lg p-4 shadow-md group-hover:shadow-lg transition-shadow duration-300">
                <p class="font-semibold text-gray-800 text-sm mb-1">Suharti M.A</p>
                <p class="text-blue-600 text-xs font-medium">Ketua SATGAS PPKS</p>
                <p class="text-gray-500 text-xs">UNU Yogyakarta</p>
            </div>
        </div>

        <!-- Anggota 2 -->
        <div class="text-center group">
            <div class="relative mb-4">
                <img src="/image/sampel.png" alt="Foto Anggota Tim" 
                     class="w-32 h-32 object-cover rounded-full mx-auto shadow-lg group-hover:shadow-xl transition-shadow duration-300 border-4 border-white">
                <div class="absolute inset-0 bg-gradient-to-t from-purple-500/20 to-transparent rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </div>
            <div class="bg-white rounded-lg p-4 shadow-md group-hover:shadow-lg transition-shadow duration-300">
                <p class="font-semibold text-gray-800 text-sm mb-1">Harisna Hikmah, S.Pd, M.Pd</p>
                <p class="text-purple-600 text-xs font-medium">Sekretaris SATGAS PPKS</p>
                <p class="text-gray-500 text-xs">UNU Yogyakarta</p>
            </div>
        </div>

        <!-- Anggota 3 -->
        <div class="text-center group">
            <div class="relative mb-4">
                <img src="/image/sampel.png" alt="Foto Anggota Tim" 
                     class="w-32 h-32 object-cover rounded-full mx-auto shadow-lg group-hover:shadow-xl transition-shadow duration-300 border-4 border-white">
                <div class="absolute inset-0 bg-gradient-to-t from-green-500/20 to-transparent rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </div>
            <div class="bg-white rounded-lg p-4 shadow-md group-hover:shadow-lg transition-shadow duration-300">
                <p class="font-semibold text-gray-800 text-sm mb-1">Saaroni, S.Ag., M.Ag</p>
                <p class="text-green-600 text-xs font-medium">Anggota SATGAS PPKS</p>
                <p class="text-gray-500 text-xs">UNU Yogyakarta</p>
            </div>
        </div>

        <!-- Anggota 4 -->
        <div class="text-center group">
            <div class="relative mb-4">
                <img src="/image/sampel.png" alt="Foto Anggota Tim" 
                     class="w-32 h-32 object-cover rounded-full mx-auto shadow-lg group-hover:shadow-xl transition-shadow duration-300 border-4 border-white">
                <div class="absolute inset-0 bg-gradient-to-t from-indigo-500/20 to-transparent rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </div>
            <div class="bg-white rounded-lg p-4 shadow-md group-hover:shadow-lg transition-shadow duration-300">
                <p class="font-semibold text-gray-800 text-sm mb-1">Yuliani Wakidi</p>
                <p class="text-indigo-600 text-xs font-medium">Anggota SATGAS PPKS</p>
                <p class="text-gray-500 text-xs">UNU Yogyakarta</p>
            </div>
        </div>

        <!-- Anggota 5 -->
        <div class="text-center group">
            <div class="relative mb-4">
                <img src="/image/sampel.png" alt="Foto Anggota Tim" 
                     class="w-32 h-32 object-cover rounded-full mx-auto shadow-lg group-hover:shadow-xl transition-shadow duration-300 border-4 border-white">
                <div class="absolute inset-0 bg-gradient-to-t from-red-500/20 to-transparent rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </div>
            <div class="bg-white rounded-lg p-4 shadow-md group-hover:shadow-lg transition-shadow duration-300">
                <p class="font-semibold text-gray-800 text-sm mb-1">Sholeh Huda</p>
                <p class="text-red-600 text-xs font-medium">Anggota SATGAS PPKS</p>
                <p class="text-gray-500 text-xs">UNU Yogyakarta</p>
            </div>
        </div>
    </div>

    <!-- Call to Action Section -->
    <!-- <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl p-8 mt-16 text-center text-white">
        <h3 class="text-2xl font-bold mb-4">Butuh Bantuan?</h3>
        <p class="mb-6 opacity-90">Jangan ragu untuk menghubungi kami. Keamanan dan kenyamanan Anda adalah prioritas utama kami.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#" class="bg-white text-blue-600 px-6 py-3 rounded-full font-semibold hover:bg-gray-100 transition-colors duration-300">
                <i class="fas fa-phone mr-2"></i>Hubungi Kami
            </a>
            <a href="#" class="border-2 border-white text-white px-6 py-3 rounded-full font-semibold hover:bg-white hover:text-blue-600 transition-colors duration-300">
                <i class="fas fa-envelope mr-2"></i>Kirim Pesan
            </a>
        </div>
    </div> -->

</div>

@endsection
