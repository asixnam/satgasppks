<template>
  <!-- Footer -->
  <footer class="bg-black text-white relative overflow-hidden" role="contentinfo">
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-16">
      <div class="grid grid-cols-1 md:grid-cols-12 gap-8 lg:gap-12 mb-8">
        
        <!-- Kolom 1: About/Description (Span 5) -->
        <div class="md:col-span-5 space-y-4">
          <!-- Logo dan Nama -->
          <div class="flex items-center space-x-3.5">
            <img 
              src="/image/logoputih.png" 
              alt="SATGAS PPKS Logo" 
              class="h-10 sm:h-12 w-auto object-contain"
            >
            <div class="flex flex-col leading-none">
              <span class="text-yellow-400 font-extrabold text-sm sm:text-base uppercase tracking-wider">SATGAS PPKS</span>
              <span class="text-xs font-semibold text-slate-100 opacity-90 mt-0.5">UNU Yogyakarta</span>
            </div>
          </div>
          
          <!-- Deskripsi -->
          <p class="text-slate-200 text-sm leading-relaxed max-w-md">
            Bersama SATGAS UNU JOGJA, kita wujudkan lingkungan akademik yang inklusif, sehat, aman, serta bebas dari segala bentuk kekerasan seksual.
          </p>
          
          <!-- Contact Info -->
          <div class="space-y-2 pt-2 text-sm text-slate-200">
            <div class="flex items-center space-x-3">
              <i class="fas fa-map-marker-alt text-yellow-400 text-sm w-4 shrink-0" aria-hidden="true"></i>
              <a href="https://maps.app.goo.gl/PHN93G8Ybga3AVeJ7" target="_blank" rel="noopener noreferrer" class="hover:text-yellow-400 transition-colors">
                Jl. Ringroad Barat, Dowangan, Banyuraden, Sleman
              </a>
            </div>
            <div class="flex items-center space-x-3">
              <i class="fas fa-phone text-yellow-400 text-sm w-4 shrink-0" aria-hidden="true"></i>
              <a href="https://wa.me/6287762703887" target="_blank" rel="noopener noreferrer" class="hover:text-yellow-400 transition-colors">
                +62 877-6270-3887
              </a>
            </div>
            <div class="flex items-center space-x-3">
              <i class="fas fa-envelope text-yellow-400 text-sm w-4 shrink-0" aria-hidden="true"></i>
              <a href="mailto:satgasppks@unu-jogja.ac.id" class="hover:text-yellow-400 transition-colors">
                satgasppks@unu-jogja.ac.id
              </a>
            </div>
          </div>
        </div>

        <!-- Kolom 2: Navigasi (Span 3) -->
        <div class="md:col-span-3">
          <h3 class="text-yellow-450 text-xs font-bold uppercase tracking-widest text-yellow-400 mb-4">Navigasi</h3>
          <nav>
            <ul class="space-y-2.5 text-sm text-slate-200">
              <li>
                <NuxtLink to="/tentang-kami" class="hover:text-yellow-450 hover:underline hover:text-yellow-400 transition-all">
                  Tentang Kami
                </NuxtLink>
              </li>
              <li>
                <NuxtLink to="/berita" class="hover:text-yellow-450 hover:underline hover:text-yellow-400 transition-all">
                  Berita Terkini
                </NuxtLink>
              </li>
              <li>
                <NuxtLink to="/edukasi" class="hover:text-yellow-450 hover:underline hover:text-yellow-400 transition-all">
                  Materi Edukasi
                </NuxtLink>
              </li>
            </ul>
          </nav>
        </div>

        <!-- Kolom 3: Ikuti Kami & Newsletter (Span 4) -->
        <div class="md:col-span-4 space-y-5">
          <div>
            <h3 class="text-yellow-450 text-xs font-bold uppercase tracking-widest text-yellow-400 mb-3">Ikuti Kami</h3>
            <!-- Social Media Icons -->
            <div class="flex space-x-4">
              <a href="https://www.instagram.com/satgasppks.unuyo" target="_blank" rel="noopener noreferrer" class="text-yellow-400 hover:text-white transition-colors duration-200" aria-label="Instagram">
                <i class="fab fa-instagram text-xl" aria-hidden="true"></i>
              </a>
              <a href="mailto:satgasppks@unu-jogja.ac.id" class="text-yellow-400 hover:text-white transition-colors duration-200" aria-label="Email">
                <i class="fas fa-envelope text-xl" aria-hidden="true"></i>
              </a>
              <a href="https://wa.me/6287762703887" target="_blank" rel="noopener noreferrer" class="text-yellow-400 hover:text-white transition-colors duration-200" aria-label="WhatsApp">
                <i class="fab fa-whatsapp text-xl" aria-hidden="true"></i>
              </a>
            </div>
          </div>

          <!-- Newsletter Form -->
          <div class="space-y-2">
            <h4 class="text-slate-100 text-sm font-semibold">Newsletter</h4>
            <p class="text-slate-200 text-xs opacity-90">Dapatkan update info pencegahan berkala langsung ke email Anda.</p>
            <form @submit.prevent class="flex">
              <input 
                type="email" 
                placeholder="Email Anda" 
                class="flex-1 px-3 py-2 text-xs bg-white bg-opacity-10 border border-white border-opacity-15 rounded-l text-white placeholder-white placeholder-opacity-50 focus:outline-none focus:bg-opacity-20" 
                required
              >
              <button type="submit" class="px-4 py-2 bg-yellow-400 text-slate-900 font-bold text-xs rounded-r hover:bg-yellow-500 transition-colors uppercase tracking-wider">
                Daftar
              </button>
            </form>
          </div>
        </div>
      </div>
      
      <!-- Bottom Footer copyright -->
      <div class="border-t border-white/10 pt-6 mt-8">
        <p class="text-slate-200 text-xs opacity-80 text-center">
          © 2024 SATGAS PPKS Universitas Nahdlatul Ulama Yogyakarta. Semua Hak Dilindungi.
        </p>
      </div>
    </div>
  </footer>
</template>
