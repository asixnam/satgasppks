@extends('Frontend.Home.home')

@section('content')

<div class="container mx-auto px-4 py-8 mt-16">
    <!-- Header Section -->
    <div class="text-center mb-16">
        <img src="/image/logo-warna.png" alt="SATGAS PPKS Logo" class="mx-auto h-24 mb-8 drop-shadow-lg">
        <h1 class="text-4xl md:text-5xl font-bold section-title mb-6 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
            Tentang SATGAS PPKPT
        </h1>
        <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto mb-8"></div>
        <p class="text-gray-600 text-lg max-w-4xl mx-auto leading-relaxed">
            Satuan Tugas Pencegahan dan Penanganan Kekerasan Perguruan Tinggi Universitas Nahdlatul Ulama Yogyakarta
            merupakan layanan pengaduan, penanganan, dan pencegahan kekerasan seksual di
            tingkat kampus bagi Civitas Akademika (mahasiswa, dosen, dan tenaga pendidik)
        </p>
    </div>

    <!-- Vision & Mission Section -->
    <div class="max-w-6xl mx-auto mb-16">
        @if($visiMisi)
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
                    {{ $visiMisi->visi }}
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
                    @foreach(explode("\n", $visiMisi->misi) as $item)
                        @if(trim($item))
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span>{{ trim($item) }}</span>
                        </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
        @else
        <!-- Default Vision & Mission jika tidak ada data -->
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
        @endif
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
    @if($tims->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 justify-items-center max-w-6xl mx-auto">
        @php
            $colors = ['blue', 'purple', 'green', 'indigo', 'red', 'yellow', 'pink', 'teal'];
        @endphp
        
        @foreach($tims as $index => $tim)
        @php
            $color = $colors[$index % count($colors)];
        @endphp
        <!-- Anggota {{ $index + 1 }} -->
        <div class="text-center group">
            <div class="relative mb-4">
                @if($tim->foto)
                    <img src="{{ asset('storage/' . $tim->foto) }}" alt="Foto {{ $tim->nama }}" 
                         class="w-32 h-32 object-cover rounded-full mx-auto shadow-lg group-hover:shadow-xl transition-shadow duration-300 border-4 border-white">
                @else
                    <img src="/image/sampel.png" alt="Foto Default" 
                         class="w-32 h-32 object-cover rounded-full mx-auto shadow-lg group-hover:shadow-xl transition-shadow duration-300 border-4 border-white">
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-{{ $color }}-500/20 to-transparent rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </div>
            <div class="bg-white rounded-lg p-4 shadow-md group-hover:shadow-lg transition-shadow duration-300">
                <p class="font-semibold text-gray-800 text-sm mb-1">{{ $tim->nama }}</p>
                <p class="text-{{ $color }}-600 text-xs font-medium">{{ $tim->jabatan }}</p>
                <p class="text-gray-500 text-xs">UNU Yogyakarta</p>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <!-- Empty State untuk Tim -->
    <div class="text-center py-12">
        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-users text-gray-400 text-3xl"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Data Tim</h3>
        <p class="text-gray-500">Data anggota tim belum tersedia saat ini.</p>
    </div>
    @endif

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