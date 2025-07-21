@extends('Frontend.Home.home')

@section('content')

<div class="container mx-auto px-4 py-8 mt-16 text-right">
    <!-- Header Section -->
    <div class="text-center mb-16">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full mb-6 shadow-lg">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
            Pusat <span class="text-orange-500">Edukasi</span>
        </h1>
        <div class="w-24 h-1 bg-gradient-to-r from-orange-400 to-orange-600 mx-auto mb-6"></div>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
            Tingkatkan pemahaman Anda tentang isu kekerasan seksual, pencegahan, dan dukungan melalui materi edukasi yang komprehensif
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Materi Edukasi 1 - Mengenali Tanda-tanda -->
        <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-orange-200">
            <div class="relative bg-gradient-to-br from-red-50 to-red-100 p-8 flex items-center justify-center h-48">
                <div class="absolute inset-0 bg-gradient-to-br from-red-400/10 to-red-600/10 group-hover:from-red-400/20 group-hover:to-red-600/20 transition-all duration-500"></div>
                <div class="relative bg-white rounded-full p-6 shadow-lg group-hover:scale-110 group-hover:shadow-xl transition-all duration-500">
                    <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                    PENTING
                </div>
            </div>
            <div class="p-8">
                <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-orange-600 transition-colors duration-300">
                    Mengenali Tanda-tanda Kekerasan Seksual
                </h3>
                <p class="text-gray-600 text-sm mb-6 leading-relaxed line-clamp-3">
                    Menurut Peraturan Menteri Pendidikan, Kebudayaan Riset, Dan Teknologi tentang Pencegahan dan Penanganan Kekerasan di Lingkungan Perguruan Tinggi, penting untuk mengenali berbagai bentuk dan tanda-tanda kekerasan seksual...
                </p>
                <a href="{{ route('detail.edukasi') }}" class="inline-flex items-center gap-2 text-orange-600 hover:text-orange-700 font-semibold transition-colors duration-300 group/link">
                    Pelajari Lebih Lanjut
                    <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Materi Edukasi 2 - Pencegahan -->
        <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-orange-200">
            <div class="relative bg-gradient-to-br from-blue-50 to-blue-100 p-8 flex items-center justify-center h-48">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-400/10 to-blue-600/10 group-hover:from-blue-400/20 group-hover:to-blue-600/20 transition-all duration-500"></div>
                <div class="relative bg-white rounded-full p-6 shadow-lg group-hover:scale-110 group-hover:shadow-xl transition-all duration-500">
                    <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <div class="absolute top-4 right-4 bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                    PENCEGAHAN
                </div>
            </div>
            <div class="p-8">
                <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-orange-600 transition-colors duration-300">
                    Strategi Pencegahan Kekerasan Seksual
                </h3>
                <p class="text-gray-600 text-sm mb-6 leading-relaxed line-clamp-3">
                    Panduan komprehensif tentang langkah-langkah pencegahan kekerasan seksual di berbagai lingkungan. Termasuk strategi personal, institusional, dan komunitas untuk menciptakan lingkungan yang aman...
                </p>
                <a href="#" class="inline-flex items-center gap-2 text-orange-600 hover:text-orange-700 font-semibold transition-colors duration-300 group/link">
                    Pelajari Lebih Lanjut
                    <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Materi Edukasi 3 - Support & Recovery -->
        <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-orange-200">
            <div class="relative bg-gradient-to-br from-green-50 to-green-100 p-8 flex items-center justify-center h-48">
                <div class="absolute inset-0 bg-gradient-to-br from-green-400/10 to-green-600/10 group-hover:from-green-400/20 group-hover:to-green-600/20 transition-all duration-500"></div>
                <div class="relative bg-white rounded-full p-6 shadow-lg group-hover:scale-110 group-hover:shadow-xl transition-all duration-500">
                    <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <div class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                    DUKUNGAN
                </div>
            </div>
            <div class="p-8">
                <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-orange-600 transition-colors duration-300">
                    Dukungan dan Pemulihan Korban
                </h3>
                <p class="text-gray-600 text-sm mb-6 leading-relaxed line-clamp-3">
                    Informasi tentang layanan dukungan, proses pemulihan, dan cara memberikan bantuan kepada korban kekerasan seksual. Termasuk panduan untuk keluarga, teman, dan komunitas...
                </p>
                <a href="{{ route('detail.edukasi') }}" class="inline-flex items-center gap-2 text-orange-600 hover:text-orange-700 font-semibold transition-colors duration-300 group/link">
                    Pelajari Lebih Lanjut
                    <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Materi Edukasi 4 - Hukum & Regulasi -->
        <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-orange-200">
            <div class="relative bg-gradient-to-br from-purple-50 to-purple-100 p-8 flex items-center justify-center h-48">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-400/10 to-purple-600/10 group-hover:from-purple-400/20 group-hover:to-purple-600/20 transition-all duration-500"></div>
                <div class="relative bg-white rounded-full p-6 shadow-lg group-hover:scale-110 group-hover:shadow-xl transition-all duration-500">
                    <svg class="w-12 h-12 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                    </svg>
                </div>
                <div class="absolute top-4 right-4 bg-purple-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                    HUKUM
                </div>
            </div>
            <div class="p-8">
                <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-orange-600 transition-colors duration-300">
                    Aspek Hukum dan Regulasi
                </h3>
                <p class="text-gray-600 text-sm mb-6 leading-relaxed line-clamp-3">
                    Pemahaman tentang aspek hukum terkait kekerasan seksual, proses pelaporan, dan perlindungan hukum bagi korban. Informasi tentang UU TPKS dan regulasi terkait...
                </p>
                <a href="#" class="inline-flex items-center gap-2 text-orange-600 hover:text-orange-700 font-semibold transition-colors duration-300 group/link">
                    Pelajari Lebih Lanjut
                    <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Materi Edukasi 5 - Edukasi Anak -->
        <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-orange-200">
            <div class="relative bg-gradient-to-br from-yellow-50 to-yellow-100 p-8 flex items-center justify-center h-48">
                <div class="absolute inset-0 bg-gradient-to-br from-yellow-400/10 to-yellow-600/10 group-hover:from-yellow-400/20 group-hover:to-yellow-600/20 transition-all duration-500"></div>
                <div class="relative bg-white rounded-full p-6 shadow-lg group-hover:scale-110 group-hover:shadow-xl transition-all duration-500">
                    <svg class="w-12 h-12 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
                <div class="absolute top-4 right-4 bg-yellow-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                    ANAK
                </div>
            </div>
            <div class="p-8">
                <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-orange-600 transition-colors duration-300">
                    Edukasi Perlindungan Anak
                </h3>
                <p class="text-gray-600 text-sm mb-6 leading-relaxed line-clamp-3">
                    Panduan khusus untuk mendidik anak-anak tentang keamanan diri, batasan tubuh, dan cara melindungi diri dari berbagai bentuk kekerasan. Materi yang disesuaikan dengan usia...
                </p>
                <a href="#" class="inline-flex items-center gap-2 text-orange-600 hover:text-orange-700 font-semibold transition-colors duration-300 group/link">
                    Pelajari Lebih Lanjut
                    <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Materi Edukasi 6 - Trauma Healing -->
        <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-orange-200">
            <div class="relative bg-gradient-to-br from-teal-50 to-teal-100 p-8 flex items-center justify-center h-48">
                <div class="absolute inset-0 bg-gradient-to-br from-teal-400/10 to-teal-600/10 group-hover:from-teal-400/20 group-hover:to-teal-600/20 transition-all duration-500"></div>
                <div class="relative bg-white rounded-full p-6 shadow-lg group-hover:scale-110 group-hover:shadow-xl transition-all duration-500">
                    <svg class="w-12 h-12 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
                <div class="absolute top-4 right-4 bg-teal-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                    HEALING
                </div>
            </div>
            <div class="p-8">
                <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-orange-600 transition-colors duration-300">
                    Trauma Healing dan Recovery
                </h3>
                <p class="text-gray-600 text-sm mb-6 leading-relaxed line-clamp-3">
                    Metode dan teknik pemulihan trauma, terapi yang tersedia, dan langkah-langkah untuk membangun kembali kepercayaan diri. Panduan untuk survivor dan support system...
                </p>
                <a href="#" class="inline-flex items-center gap-2 text-orange-600 hover:text-orange-700 font-semibold transition-colors duration-300 group/link">
                    Pelajari Lebih Lanjut
                    <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
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


