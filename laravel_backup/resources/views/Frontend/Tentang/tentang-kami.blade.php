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
            {{ $visiMisi->about ?? 'Deskripsi tentang SATGAS PPKPT belum tersedia.' }}
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

    <!-- Team Grid/Slider -->
    @if($tims->count() > 0)
    @php
        $colors = ['blue', 'purple', 'green', 'indigo', 'red', 'yellow', 'pink', 'teal'];
    @endphp
    
    <!-- Mobile Slider (visible on mobile only) -->
    <div class="lg:hidden relative max-w-md mx-auto mb-8">
        <div class="overflow-hidden">
            <div id="teamSlider" class="flex transition-transform duration-300 ease-in-out">
                @foreach($tims as $index => $tim)
                @php
                    $color = $colors[$index % count($colors)];
                @endphp
                <div class="w-full flex-shrink-0 px-4">
                    <div class="text-center flex flex-col items-center">
                        <!-- Photo Section -->
                        <div class="relative mb-4">
                            @if($tim->foto)
                                <img src="{{ asset('storage/' . $tim->foto) }}" 
                                    alt="Foto {{ $tim->nama }}" 
                                    class="w-64 h-64 object-cover rounded-xl mx-auto shadow-lg">
                            @else
                                <img src="/image/sampel.png" 
                                    alt="Foto Default" 
                                    class="w-64 h-64 object-cover rounded-xl mx-auto shadow-lg">
                            @endif
                        </div>
                        
                        <!-- Info Section -->
                        <div class="space-y-2">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $tim->nama }}</h3>
                            <p class="text-sm text-gray-600">{{ $tim->jabatan }}</p>
                            <p class="text-sm text-green-600">UNU Yogyakarta</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <!-- Navigation Buttons -->
        <button id="prevBtn" class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 bg-white rounded-full p-3 shadow-lg hover:bg-gray-100 transition-colors">
            <i class="fas fa-chevron-left text-gray-600"></i>
        </button>
        <button id="nextBtn" class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 bg-white rounded-full p-3 shadow-lg hover:bg-gray-100 transition-colors">
            <i class="fas fa-chevron-right text-gray-600"></i>
        </button>
        
        <!-- Dots Indicator -->
        <div class="flex justify-center gap-2 mt-6">
            @foreach($tims as $index => $tim)
            <button class="slider-dot w-2 h-2 rounded-full bg-gray-300 transition-all" data-index="{{ $index }}"></button>
            @endforeach
        </div>
    </div>

    <!-- Desktop Grid (visible on desktop only) -->
    <div class="hidden lg:grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 max-w-7xl mx-auto">
        @foreach($tims as $index => $tim)
        @php
            $color = $colors[$index % count($colors)];
        @endphp
        <div class="text-center h-full flex flex-col items-center">
            <!-- Photo Section -->
            <div class="relative mb-2">
                @if($tim->foto)
                    <img src="{{ asset('storage/' . $tim->foto) }}" 
                        alt="Foto {{ $tim->nama }}" 
                        class="w-56 h-56 object-cover rounded-xl lg:size-60 mx-auto">
                @else
                    <img src="/image/sampel.png" 
                        alt="Foto Default" 
                        class="w-56 h-56 object-cover rounded-xl lg:size-60 mx-auto shadow-lg">
                @endif
            </div>
            
            <!-- Info Section -->
            <div class="space-y-1 mt-1">
                <h3 class="text-base lg:text-lg font-medium text-gray-800">{{ $tim->nama }}</h3>
                <p class="text-sm lg:text-base text-gray-600">{{ $tim->jabatan }}</p>
                <p class="text-sm lg:text-base text-green-600">UNU Yogyakarta</p>
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

<!-- Slider JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById('teamSlider');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const dots = document.querySelectorAll('.slider-dot');
    const totalSlides = dots.length;
    let currentIndex = 0;

    function updateSlider() {
        slider.style.transform = `translateX(-${currentIndex * 100}%)`;
        
        // Update dots
        dots.forEach((dot, index) => {
            if (index === currentIndex) {
                dot.classList.remove('bg-gray-300');
                dot.classList.add('bg-green-600', 'w-8');
            } else {
                dot.classList.remove('bg-green-600', 'w-8');
                dot.classList.add('bg-gray-300');
            }
        });
    }

    prevBtn?.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        updateSlider();
    });

    nextBtn?.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateSlider();
    });

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentIndex = index;
            updateSlider();
        });
    });

    // Auto slide (optional)
    let autoSlide = setInterval(() => {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateSlider();
    }, 5000);

    // Pause auto slide on hover
    slider?.addEventListener('mouseenter', () => clearInterval(autoSlide));
    slider?.addEventListener('mouseleave', () => {
        autoSlide = setInterval(() => {
            currentIndex = (currentIndex + 1) % totalSlides;
            updateSlider();
        }, 5000);
    });

    // Touch support for mobile
    let touchStartX = 0;
    let touchEndX = 0;

    slider?.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
    });

    slider?.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        if (touchStartX - touchEndX > 50) {
            // Swipe left
            currentIndex = (currentIndex + 1) % totalSlides;
            updateSlider();
        } else if (touchEndX - touchStartX > 50) {
            // Swipe right
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
            updateSlider();
        }
    });
});
</script>

@endsection