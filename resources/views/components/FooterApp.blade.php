<!-- Footer -->
<footer class="footer-gradient relative" role="contentinfo">
    <div class="absolute inset-0 bg-black opacity-15"></div>
    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10 lg:py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 lg:gap-12 mb-6 sm:mb-8">
            
            <!-- Kolom 1: About/Description -->
            <div class="md:col-span-1">
                <!-- Logo dan Nama -->
                <div class="flex items-center mb-4">
                <img src="{{ asset('image/logoputih.png') }}" 
                    alt="SATGAS PPKPT Logo" 
                    class="h-7 sm:h-8 md:h-10 lg:h-12 w-auto object-contain flex-shrink-0 mr-3">
                
                <div class="flex flex-col leading-tight">
                    <div class="hidden sm:block min-w-0">
                        <h1 class="text-yellow-300 font-bold text-xs sm:text-sm md:text-base lg:text-lg leading-tight truncate nav-text">SATGAS PPKPT</h1>
                        <p class="text-white text-xs md:text-sm font-medium opacity-90 truncate nav-text">UNU Yogyakarta</p>
                    </div>
                </div>
            </div>
                
                <!-- Deskripsi -->
                <p class="text-white text-sm sm:text-base leading-relaxed opacity-90 mb-6">
                    Bersama SATGAS UNU JOGJA Ciptakan Kampus yang Aman
                </p>
                
                <!-- Contact Info -->
                <div class="space-y-3">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-map-marker-alt text-yellow-300 text-sm w-4 text-center flex-shrink-0" aria-hidden="true"></i>
                        <a href="https://maps.app.goo.gl/PHN93G8Ybga3AVeJ7" class="text-white text-xs sm:text-sm hover:text-yellow-300 transition-colors">
                            Jl. Ringroad Barat, Dowangan, Banyuraden
                        </a>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-phone text-yellow-300 text-sm w-4 text-center flex-shrink-0" aria-hidden="true"></i>
                        <a href="https://wa.me/6281323596022" class="text-white text-xs sm:text-sm hover:text-yellow-300 transition-colors">
                            0813-2359-6022
                        </a>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-envelope text-yellow-300 text-sm w-4 text-center flex-shrink-0" aria-hidden="true"></i>
                        <a href="mailto:satgasppks@unu-jogja.ac.id" class="text-white text-xs sm:text-sm hover:text-yellow-300 transition-colors">
                            satgasppks@unu-jogja.ac.id
                        </a>
                    </div>
                </div>
            </div>

            <!-- Kolom 2: Navigasi -->
            <div class="flex flex-col items-center md:col-span-1">
                <h3 class="text-yellow-300 text-lg sm:text-xl font-semibold mb-4 sm:mb-6 uppercase tracking-wide">Navigasi</h3>
                <nav>
                    <ul class="space-y-2 sm:space-y-3">
                        <li>
                            <a href="{{ route('tentang-kami') }}" class="text-white text-sm sm:text-base hover:text-yellow-300 transition-colors duration-200">
                                Tentang Kami
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('berita') }}" class="text-white text-sm sm:text-base hover:text-yellow-300 transition-colors duration-200">
                                Berita
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('edukasi') }}" class="text-white text-sm sm:text-base hover:text-yellow-300 transition-colors duration-200">
                                Edukasi
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Kolom 3: Ikuti Kami & Newsletter -->
            <div class="md:col-span-1">
                <h3 class="text-yellow-300 text-lg sm:text-xl font-semibold mb-4 sm:mb-6 uppercase tracking-wide">Ikuti Kami</h3>
                
                <!-- Social Media -->
                <div class="mb-6">
                    <div class="flex space-x-4">
                        <a href="https://www.instagram.com/satgasppks.unuyo" target="_blank" rel="noopener noreferrer" class="text-yellow-300 hover:text-white transition-colors duration-200" aria-label="Instagram">
                            <i class="fab fa-instagram text-2xl" aria-hidden="true"></i>
                        </a>
                        <a href="mailto:satgasppks@unu-jogja.ac.id" class="text-yellow-300 hover:text-white transition-colors duration-200" aria-label="Email">
                            <i class="fas fa-envelope text-2xl" aria-hidden="true"></i>
                        </a>
                        <a href="https://wa.me/6281323596022" target="_blank" rel="noopener noreferrer" class="text-yellow-300 hover:text-white transition-colors duration-200" aria-label="WhatsApp">
                            <i class="fab fa-whatsapp text-2xl" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>

                <!-- Newsletter -->
                <div>
                    <h4 class="text-white font-semibold mb-3">Newsletter</h4>
                    <p class="text-white text-sm opacity-90 mb-4">Dapatkan update terbaru dari SATGAS PPKPT</p>
                    <form class="flex">
                        <input type="email" placeholder="Email Anda" class="flex-1 px-3 py-2 text-sm bg-white bg-opacity-10 border border-white border-opacity-20 rounded-l text-white placeholder-white placeholder-opacity-60 focus:outline-none focus:bg-opacity-20" required>
                        <button type="submit" class="px-4 py-2 bg-yellow-300 text-black font-semibold text-sm rounded-r hover:bg-yellow-400 transition-colors">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Bottom Section -->
       <div class="border-t border-white border-opacity-20 pt-6 sm:pt-8">
            <div class="flex justify-center items-center">
                <p class="text-white text-xs sm:text-sm opacity-80 font-medium text-center">
                    © 2024 SATGAS PPKS UNU Yogyakarta. Semua hak dilindungi.
                </p>
            </div>
        </div>
    </div>
</footer>

