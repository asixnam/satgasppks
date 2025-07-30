@php
    $hero = $heroes->first();
@endphp

<!-- Hero Section dengan Gambar Hero Pertama -->
<section class="hero-bg min-h-screen flex items-center justify-center text-white text-center px-4"
    style="background: linear-gradient(135deg, rgba(0, 73, 44, 0.8), rgba(0, 0, 0, 0.6)), url('{{ asset('storage/' . $hero->gambar) }}'); background-size: cover; background-position: center; background-attachment: fixed;">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl md:text-5xl font-bold mb-6 leading-tight">
            Bersama <span class="gradient-text">SATGAS UNU JOGJA</span><br>
            Ciptakan Kampus yang Aman
        </h1>
        <p class="text-lg md:text-xl mb-8 max-w-3xl mx-auto leading-relaxed opacity-90">
            SATGAS PPKS Universitas Nahdlatul Ulama Yogyakarta merupakan lembaga garda terdepan
            dalam pencegahan dan penanganan kekerasan seksual.
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="/lapor" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-4 px-8 rounded-full transition-all duration-300 transform hover:scale-105 inline-flex items-center justify-center">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                Laporkan Kasus
            </a>
            <a href="/edukasi" class="bg-white bg-opacity-20 hover:bg-opacity-30 backdrop-blur-sm text-white font-semibold py-4 px-8 rounded-full transition-all duration-300 transform hover:scale-105 inline-flex items-center justify-center border border-white border-opacity-30">
                <i class="fas fa-info-circle mr-2"></i>
                Pelajari Lebih Lanjut
            </a>
        </div>
    </div>
    <!-- Swiper Controls -->
        <div class="swiper-pagination z-20"></div>
        <div class="swiper-button-prev z-20"></div>
        <div class="swiper-button-next z-20"></div>
</section>

