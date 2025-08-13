@extends('Layouts.app')

@section('content')

<div class="container mx-auto px-4 py-8 mt-16">
    <!-- Header Section -->
    <div class="text-center mb-16">
        <img src="/image/logo-warna.png" alt="SATGAS PPKS Logo" class="mx-auto h-44 mb-8 drop-shadow-lg">
            <h1 class="text-4xl md:text-5xl font-bold section-title mb-6 text-[#166534]">
                Tentang SATGAS PPKPT
            </h1>
        <!-- <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto mb-8"></div> -->
        <p class="text-gray-600 text-lg max-w-4xl mx-auto leading-relaxed">
            {{ $visiMisi->about }}
        </p>
    </div>

    <!-- Vision & Mission Section -->
    <div class="max-w-6xl mx-auto mb-16">
        @if($visiMisi)
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Vision Card -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-8 border border-gray-100">
                <div class="flex items-center mb-6">
                    <div class=" rounded-full mr-4">
                        <i class="fas fa-lightbulb text-green-600 text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-green-800">VISI</h2>
                </div>
                <p class="text-gray-700 leading-relaxed">
                    {{ $visiMisi->visi }}
                </p>
            </div>

            <!-- Mission Card -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-8 border border-gray-100">
                <div class="flex items-center mb-6">
                    <div class=" rounded-full mr-4">
                        <i class="fas fa-bullseye text-green-600 text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-green-800">MISI</h2>
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
            <div class=" rounded-full mr-4">
                <i class="fas fa-users text-green-600 text-xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-green-800">Tim Kami</h2>
        </div>
        <p class="text-gray-600 max-w-2xl mx-auto mb-12">
            Tim profesional yang berdedikasi untuk menciptakan lingkungan kampus yang aman dan nyaman bagi seluruh civitas akademika
        </p>
    </div>

    <!-- Team Grid - Modified to 3 columns with larger cards -->
    @if($tims->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 max-w-7xl mx-auto">
        @php
            $colors = ['blue', 'purple', 'green', 'indigo', 'red', 'yellow', 'pink', 'teal'];
        @endphp
        
        @foreach($tims as $index => $tim)
        @php
            $color = $colors[$index % count($colors)];
        @endphp
        <!-- Team Member Card -->
        <!-- <div class="bg-red rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-8 group border border-gray-100 transform hover:-translate-y-2"> -->
            <div class="text-center h-full flex flex-col items-center">
        <!-- Photo Section -->
            <div class="relative mb-2">
                @if($tim->foto)
                    <img src="{{ asset('storage/' . $tim->foto) }}" 
                        alt="Foto {{ $tim->nama }}" 
                        class="w-56 h-56 object-cover rounded-xl sm:size-48 lg:size-60 mx-auto">
                @else
                    <img src="/image/sampel.png" 
                        alt="Foto Default" 
                        class="w-56 h-56 object-cover rounded-2xl mx-auto shadow-lg group-hover:shadow-xl transition-shadow duration-300 border-4 border-white">
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-{{ $color }}-500/20 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </div>
            
            <!-- Info Section -->
            <div class="space-y-1 mt-1">
                <h3 class="text-sm font-medium text-gray-800 sm:text-base lg:text-lg dark:text-neutral-200t">{{ $tim->nama }}</h3>
                <p class="text-xs-{{ $color }}-400 sm:text-sm lg:text-base dark:text-neutral-500">{{ $tim->jabatan }}</p>
                <p class="text-xs-{{ $color }}-600 sm:text-sm lg:text-base dark:text-neutral-500"> UNU Yogyakarta</p>
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
</div>

@endsection