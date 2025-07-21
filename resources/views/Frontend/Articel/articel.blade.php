@extends('Frontend.Home.home')

@section('content')
    <div class="container mx-auto px-4 py-8 mt-16">
        <!-- Header Section -->
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 leading-tight">
                Berita & Artikel
            </h1>
            <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-600 mx-auto mb-6"></div>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Informasi terkini seputar isu kekerasan seksual, pencegahan, dan dukungan untuk korban.
            </p>
        </div>

        <div class="space-y-12">
            <!-- Article 1 -->
            <article
                class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100">
                <div class="flex flex-col lg:flex-row">
                    <div class="lg:w-2/5 relative overflow-hidden">
                        <a href="#">
                            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                                alt="Pelatihan SIMFONI PPA & SISA"
                                class="w-full h-64 lg:h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                        </a>
                    </div>
                    <div class="lg:w-3/5 p-8 lg:p-10">
                        <div class="flex items-center gap-3 mb-4">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                ARTIKEL
                            </span>
                            <span class="text-sm text-gray-500 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Minggu, 12 Oktober 2025
                            </span>
                        </div>
                        <a href="#">
                            <h2
                                class="text-2xl lg:text-3xl font-bold text-gray-900 mb-4 group-hover:text-blue-700 transition-colors duration-300 leading-tight">
                                Pelatihan SIMFONI PPA & SISA "Data Perlindungan"
                            </h2>
                        </a>
                        <p class="text-gray-700 text-base leading-relaxed mb-6 line-clamp-4">
                            Komunitas Suara Aman menggelar kampanye bertajuk "Bersuara untuk Aman" yang berlangsung di Taman
                            Kota pada Minggu pagi (12/10). Kegiatan ini bertujuan untuk meningkatkan kesadaran masyarakat
                            luas terhadap isu kekerasan seksual serta pentingnya menciptakan lingkungan yang aman, khususnya
                            bagi perempuan dan anak. Kampanye ini terbuka untuk umum dan dihadiri oleh ratusan peserta dari
                            berbagai kalangan.
                        </p>
                        <a href="#"
                            class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-semibold transition-colors duration-300 group/link">
                            Baca Selengkapnya
                            <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </article>

            <!-- Article 2 -->
            <article
                class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100">
                <div class="flex flex-col lg:flex-row">
                    <div class="lg:w-2/5 relative overflow-hidden">
                        <a href="{{ url('/detail-articel') }}">
                            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                                alt="Kekerasan Seksual oleh Dosen"
                                class="w-full h-64 lg:h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                        </a>
                    </div>
                    <div class="lg:w-3/5 p-8 lg:p-10">
                        <div class="flex items-center gap-3 mb-4">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                ARTIKEL
                            </span>
                            <span class="text-sm text-gray-500 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Senin, 1 November 2025
                            </span>
                        </div>
                        <a href="{{ url('/detail-articel') }}">
                            <h2
                                class="text-2xl lg:text-3xl font-bold text-gray-900 mb-4 group-hover:text-blue-700 transition-colors duration-300 leading-tight">
                                Kekerasan Seksual dilakukan oleh Dosen ke Mahasiswa
                            </h2>
                        </a>
                        <p class="text-gray-700 text-base leading-relaxed mb-6 line-clamp-4">
                            Seorang mahasiswi dari salah satu universitas negeri di Yogyakarta melaporkan bahwa dirinya
                            menjadi korban pelecehan seksual oleh seorang dosen pembimbing skripsi. Kasus ini pertama kali
                            mencuat setelah korban, berinisial N, mengungkapkan pengalamannya melalui media sosial yang
                            kemudian viral dan mendapat banyak dukungan dari warganet serta aktivis perempuan.
                        </p>
                        <a href="{{ url('/detail-articel') }}"
                            class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-semibold transition-colors duration-300 group/link">
                            Baca Selengkapnya
                            <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </article>

            <!-- Article 3 -->
            <article
                class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100">
                <div class="flex flex-col lg:flex-row">
                    <div class="lg:w-2/5 relative overflow-hidden">
                        <a href="{{ url('/detail-articel') }}">
                            <img src="https://images.unsplash.com/photo-1497486751825-1233686d5d80?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                                alt="Kampanye Perlindungan di Sekolah"
                                class="w-full h-64 lg:h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                        </a>
                    </div>
                    <div class="lg:w-3/5 p-8 lg:p-10">
                        <div class="flex items-center gap-3 mb-4">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                ARTIKEL
                            </span>
                            <span class="text-sm text-gray-500 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Selasa, 2 November 2025
                            </span>
                        </div>
                        <a href="{{ url('/detail-articel') }}">
                            <h2
                                class="text-2xl lg:text-3xl font-bold text-gray-900 mb-4 group-hover:text-blue-700 transition-colors duration-300 leading-tight">
                                Kampanye Perlindungan dari Kekerasan Seksual di Sekolah
                            </h2>
                        </a>
                        <p class="text-gray-700 text-base leading-relaxed mb-6 line-clamp-4">
                            Program edukasi dan kampanye pencegahan kekerasan seksual di lingkungan sekolah telah dimulai di
                            berbagai sekolah menengah di Yogyakarta. Kegiatan ini melibatkan siswa, guru, dan orang tua
                            dalam upaya menciptakan lingkungan pendidikan yang aman dan bebas dari segala bentuk kekerasan.
                            Program ini juga memberikan pelatihan kepada guru untuk mengenali tanda-tanda kekerasan dan cara
                            penanganannya.
                        </p>
                        <a href="{{ url('/detail-articel') }}"
                            class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-semibold transition-colors duration-300 group/link">
                            Baca Selengkapnya
                            <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </article>
        </div>

        {{-- <!-- Pagination -->
    <div class="flex justify-center mt-16">
        <nav aria-label="Pagination" class="bg-white rounded-xl shadow-lg border border-gray-200 p-2">
            <ul class="inline-flex items-center gap-1">
                <li>
                    <a href="#" class="px-4 py-2 text-gray-500 bg-transparent hover:bg-gray-100 rounded-lg transition-all duration-300 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Previous
                    </a>
                </li>
                <li>
                    <a href="#" aria-current="page" class="px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold transition-all duration-300 shadow-md">1</a>
                </li>
                <li>
                    <a href="#" class="px-4 py-2 text-gray-700 bg-transparent hover:bg-gray-100 rounded-lg transition-all duration-300">2</a>
                </li>
                <li>
                    <a href="#" class="px-4 py-2 text-gray-700 bg-transparent hover:bg-gray-100 rounded-lg transition-all duration-300">3</a>
                </li>
                <li>
                    <span class="px-2 py-2 text-gray-400">...</span>
                </li>
                <li>
                    <a href="#" class="px-4 py-2 text-gray-700 bg-transparent hover:bg-gray-100 rounded-lg transition-all duration-300">10</a>
                </li>
                <li>
                    <a href="#" class="px-4 py-2 text-gray-500 bg-transparent hover:bg-gray-100 rounded-lg transition-all duration-300 flex items-center gap-2">
                        Next
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </li>
            </ul>
        </nav>
    </div> --}}
    </div>

    <style>
        .px-4 {
            padding-left: 10rem;
            padding-right: 1rem;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
@endsection
