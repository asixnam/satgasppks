<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'
import type { Hero, Berita, Edukasi } from '~/types/database'

const supabase = useSupabaseClient()

// Fetch content from Supabase
const { data: heroes } = useLazyAsyncData<Hero[]>('heroes', async () => {
  const { data } = await supabase.from('heroes').select('*').order('id', { ascending: true })
  return (data as Hero[]) || []
})

const { data: beritas } = useLazyAsyncData<Berita[]>('beritas', async () => {
  const { data } = await supabase.from('beritas').select('*').order('created_at', { ascending: false }).limit(3)
  return (data as Berita[]) || []
})

const { data: edukasis } = useLazyAsyncData<Edukasi[]>('edukasis', async () => {
  const { data } = await supabase.from('edukasis').select('*').order('created_at', { ascending: false }).limit(3)
  return (data as Edukasi[]) || []
})



// Helper for image URLs
const getImageUrl = (path: string | null) => {
  if (!path) return '/image/gedung-unujogja.jpg'
  if (path.startsWith('images/') || path.startsWith('image/')) {
    const basename = path.split('/').pop()
    return `/image/${basename}`
  }
  const { data } = supabase.storage.from('public-assets').getPublicUrl(path)
  return data.publicUrl
}

// Custom Vue Hero Slider logic
const currentSlide = ref(0)
let autoplayTimer: any = null

const startAutoplay = () => {
  if (heroes.value && heroes.value.length > 1) {
    autoplayTimer = setInterval(() => {
      currentSlide.value = (currentSlide.value + 1) % (heroes.value?.length || 1)
    }, 6000)
  }
}

const stopAutoplay = () => {
  if (autoplayTimer) {
    clearInterval(autoplayTimer)
  }
}

onMounted(() => {
  startAutoplay()
})

onUnmounted(() => {
  stopAutoplay()
})
</script>

<template>
  <div class="space-y-16 lg:space-y-24">
    
    <!-- Hero Slider Section -->
    <section class="relative w-full h-screen overflow-hidden">
      
      <!-- Default view if no banners uploaded -->
      <div v-if="!heroes || heroes.length === 0" class="w-full h-full">
        <div 
          class="w-full h-full flex items-center bg-slate-900 text-white relative pt-14"
          style="background: linear-gradient(to right, rgba(15, 23, 42, 0.9) 0%, rgba(15, 23, 42, 0.45) 50%, rgba(15, 23, 42, 0.15) 100%), url('/image/gedung-unujogja.jpg'); background-size: cover; background-position: center; background-attachment: fixed;"
        >
          <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl space-y-6 text-left">
              <div class="space-y-3">
                <div>
                  <span class="inline-block px-3.5 py-1.5 bg-yellow-400/20 text-yellow-300 border border-yellow-400/20 text-[10px] font-bold rounded-md uppercase tracking-wider">
                    Garda Keamanan Kampus
                  </span>
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-[1.1] tracking-tight">
                  Bersama <span class="bg-gradient-to-r from-yellow-400 to-amber-500 bg-clip-text text-transparent">SATGAS UNU JOGJA</span><br>
                  Ciptakan Kampus yang Aman
                </h1>
              </div>
              <p class="text-sm sm:text-base md:text-lg text-slate-300 leading-relaxed max-w-xl">
                SATGAS PPKPT Universitas Nahdlatul Ulama Yogyakarta merupakan lembaga garda terdepan
                dalam pencegahan, perlindungan, dan penanganan tindakan kekerasan seksual.
              </p>
              <div class="flex flex-wrap items-center gap-3 pt-2">
                <NuxtLink 
                  to="/lapor-kekerasan"
                  class="bg-theme-primary hover-bg-theme-primary-dark text-white font-bold py-3 px-6 rounded-xl shadow-lg transition-all duration-300 transform hover:scale-[1.02] inline-flex items-center justify-center text-xs uppercase tracking-wider"
                >
                  <i class="fas fa-exclamation-triangle mr-2"></i>
                  Laporkan Kasus
                </NuxtLink>
                <NuxtLink 
                  to="/edukasi"
                  class="bg-white/10 hover:bg-white/20 backdrop-blur-md text-white font-bold py-3 px-6 rounded-xl border border-white/20 transition-all duration-300 transform hover:scale-[1.02] inline-flex items-center justify-center text-xs uppercase tracking-wider"
                >
                  <i class="fas fa-info-circle mr-2"></i>
                  Pelajari Lebih Lanjut
                </NuxtLink>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Loops through database banners -->
      <div v-else class="w-full h-full relative">
        <div 
          v-for="(slide, idx) in heroes" 
          :key="slide.id"
          class="absolute inset-0 transition-opacity duration-1000 ease-in-out"
          :class="{ 'opacity-100 z-10': currentSlide === idx, 'opacity-0 z-0': currentSlide !== idx }"
        >
          <div 
            class="w-full h-full flex items-center bg-slate-900 text-white relative pt-14"
            :style="`background: linear-gradient(to right, rgba(15, 23, 42, 0.9) 0%, rgba(15, 23, 42, 0.45) 50%, rgba(15, 23, 42, 0.15) 100%), url('${getImageUrl(slide.gambar)}'); background-size: cover; background-position: center; background-attachment: fixed;`"
          >
            <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8">
              <div class="max-w-2xl space-y-6 text-left">
                <div class="space-y-3">
                  <div>
                    <span class="inline-block px-3.5 py-1.5 bg-yellow-400/20 text-yellow-300 border border-yellow-400/20 text-[10px] font-bold rounded-md uppercase tracking-wider">
                      SATGAS PPKPT
                    </span>
                  </div>
                  <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-[1.1] tracking-tight">
                    Bersama <span class="bg-gradient-to-r from-yellow-400 to-amber-500 bg-clip-text text-transparent">SATGAS UNU JOGJA</span><br>
                    Ciptakan Kampus yang Aman
                  </h1>
                </div>
                <p class="text-sm sm:text-base md:text-lg text-slate-300 leading-relaxed max-w-xl">
                  SATGAS PPKPT Universitas Nahdlatul Ulama Yogyakarta merupakan lembaga garda terdepan
                  dalam pencegahan, perlindungan, dan penanganan tindakan kekerasan seksual.
                </p>
                <div class="flex flex-wrap items-center gap-3 pt-2">
                  <NuxtLink 
                    to="/lapor-kekerasan"
                    class="bg-theme-primary hover-bg-theme-primary-dark text-white font-bold py-3 px-6 rounded-xl shadow-lg transition-all duration-300 transform hover:scale-[1.02] inline-flex items-center justify-center text-xs uppercase tracking-wider"
                  >
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Laporkan Kasus
                  </NuxtLink>
                  <NuxtLink 
                    to="/edukasi"
                    class="bg-white/10 hover:bg-white/20 backdrop-blur-md text-white font-bold py-3 px-6 rounded-xl border border-white/20 transition-all duration-300 transform hover:scale-[1.02] inline-flex items-center justify-center text-xs uppercase tracking-wider"
                  >
                    <i class="fas fa-info-circle mr-2"></i>
                    Pelajari Lebih Lanjut
                  </NuxtLink>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Indicator dots -->
        <div v-if="heroes.length > 1" class="absolute bottom-6 left-0 right-0 z-20 flex justify-center space-x-2.5">
          <button 
            v-for="(slide, idx) in heroes" 
            :key="idx"
            @click="currentSlide = idx"
            class="h-2 rounded-full transition-all"
            :class="currentSlide === idx ? 'bg-white w-8 scale-105' : 'bg-white/40 w-2'"
            :aria-label="`Slide ${idx + 1}`"
          ></button>
        </div>
      </div>
    </section>

    
    <!-- Tata Cara Pelaporan Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative overflow-hidden">
      <!-- Decorative background petal patterns (matching the image left decoration) -->
      <div class="absolute left-0 bottom-0 top-0 w-1/3 opacity-[0.03] pointer-events-none hidden lg:block -z-10">
        <svg class="w-full h-full text-amber-950" viewBox="0 0 100 150" fill="currentColor">
          <!-- Overlapping quarter-circles pattern -->
          <path d="M 0 20 A 20 20 0 0 1 20 40 L 0 40 Z" />
          <path d="M 20 40 A 20 20 0 0 1 40 60 L 20 60 Z" />
          <path d="M 0 60 A 20 20 0 0 1 20 80 L 20 60 Z" />
          <path d="M 20 80 A 20 20 0 0 1 40 100 L 40 80 Z" />
          <path d="M 40 20 A 20 20 0 0 1 60 40 L 40 40 Z" />
          <path d="M 20 0 A 20 20 0 0 1 40 20 L 40 0 Z" />
        </svg>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-16 items-center">
        <!-- Left Column: Header & Assurances -->
        <div class="space-y-6 lg:col-span-1 text-left relative">
          <div class="space-y-3">
            <span class="inline-block px-3 py-1 bg-amber-500/10 text-amber-600 border border-amber-500/20 text-[10px] font-bold rounded-md uppercase tracking-wider">
              Alur Pengaduan
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
              Tata Cara<br class="hidden lg:block"> Pelaporan Kasus
            </h2>
            <div class="w-12 h-1 bg-theme-primary rounded-full"></div>
          </div>
          <p class="text-slate-500 text-sm leading-relaxed">
            Mekanisme pengaduan kekerasan seksual secara aman, rahasia, dan resmi di Universitas Nahdlatul Ulama Yogyakarta. Kami berkomitmen mendampingi dan melindungi Anda sepenuhnya.
          </p>
          
          <!-- Trust Badges -->
          <div class="border-t border-slate-100 pt-6 space-y-4">
            <div class="flex items-start space-x-3.5">
              <div class="w-9 h-9 bg-amber-50 rounded-xl flex items-center justify-center text-amber-600 shrink-0">
                <i class="fas fa-shield-alt text-base"></i>
              </div>
              <div class="space-y-0.5">
                <h4 class="font-bold text-slate-800 text-xs uppercase tracking-wider">Jaminan Privasi</h4>
                <p class="text-slate-400 text-xs">Identitas pelapor dan korban dilindungi penuh secara hukum.</p>
              </div>
            </div>
            <div class="flex items-start space-x-3.5">
              <div class="w-9 h-9 bg-amber-50 rounded-xl flex items-center justify-center text-amber-600 shrink-0">
                <i class="fas fa-handshake-angle text-base"></i>
              </div>
              <div class="space-y-0.5">
                <h4 class="font-bold text-slate-800 text-xs uppercase tracking-wider">Pendampingan Intensif</h4>
                <p class="text-slate-400 text-xs">Bantuan konseling psikolog & advokasi hukum gratis.</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Column: 2x2 Grid of Leaf Cards -->
        <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">
          
          <!-- Card 1 (Top Left) -->
          <div class="bg-gradient-to-br from-[#b38820] to-[#8c6710] rounded-tr-none rounded-[2rem] p-7 flex flex-col justify-between h-72 shadow-lg shadow-amber-900/5 hover:shadow-xl hover:shadow-amber-900/10 transition-all duration-300 transform hover:-translate-y-1 group">
            <div class="w-11 h-11 bg-white flex items-center justify-center rounded-xl shadow-sm text-[#8c6710] transform group-hover:scale-105 transition-transform duration-300">
              <i class="fas fa-edit text-lg"></i>
            </div>
            <div>
              <div class="text-white text-5xl font-extrabold mb-1">#01</div>
              <div class="text-white/80 text-[10px] font-bold uppercase tracking-wider mb-1">Langkah Pertama</div>
              <h3 class="text-white text-base font-bold">Isi Formulir Laporan</h3>
              <p class="text-white/70 text-xs leading-relaxed mt-1">Akses menu Lapor dan lengkapi data kasus serta kronologi kejadian secara jujur.</p>
            </div>
          </div>

          <!-- Card 2 (Top Right) -->
          <div class="bg-gradient-to-br from-[#b38820] to-[#8c6710] rounded-tl-none rounded-[2rem] p-7 flex flex-col justify-between h-72 shadow-lg shadow-amber-900/5 hover:shadow-xl hover:shadow-amber-900/10 transition-all duration-300 transform hover:-translate-y-1 group">
            <div class="w-11 h-11 bg-white flex items-center justify-center rounded-xl shadow-sm text-[#8c6710] transform group-hover:scale-105 transition-transform duration-300">
              <i class="fas fa-file-upload text-lg"></i>
            </div>
            <div>
              <div class="text-white text-5xl font-extrabold mb-1">#02</div>
              <div class="text-white/80 text-[10px] font-bold uppercase tracking-wider mb-1">Langkah Kedua</div>
              <h3 class="text-white text-base font-bold">Unggah Bukti Kejadian</h3>
              <p class="text-white/70 text-xs leading-relaxed mt-1">Lampirkan bukti pendukung berupa dokumen, foto, rekaman suara, atau screenshot chat.</p>
            </div>
          </div>

          <!-- Card 3 (Bottom Left) -->
          <div class="bg-gradient-to-br from-[#b38820] to-[#8c6710] rounded-tr-none rounded-[2rem] p-7 flex flex-col justify-between h-72 shadow-lg shadow-amber-900/5 hover:shadow-xl hover:shadow-amber-900/10 transition-all duration-300 transform hover:-translate-y-1 group">
            <div class="w-11 h-11 bg-white flex items-center justify-center rounded-xl shadow-sm text-[#8c6710] transform group-hover:scale-105 transition-transform duration-300">
              <i class="fas fa-shield-alt text-lg"></i>
            </div>
            <div>
              <div class="text-white text-5xl font-extrabold mb-1">#03</div>
              <div class="text-white/80 text-[10px] font-bold uppercase tracking-wider mb-1">Langkah Ketiga</div>
              <h3 class="text-white text-base font-bold">Kirim Pengaduan Aman</h3>
              <p class="text-white/70 text-xs leading-relaxed mt-1">Kirimkan laporan Anda. Seluruh informasi dan identitas pelapor dijamin aman.</p>
            </div>
          </div>

          <!-- Card 4 (Bottom Right) -->
          <div class="bg-gradient-to-br from-[#b38820] to-[#8c6710] rounded-tl-none rounded-[2rem] p-7 flex flex-col justify-between h-72 shadow-lg shadow-amber-900/5 hover:shadow-xl hover:shadow-amber-900/10 transition-all duration-300 transform hover:-translate-y-1 group">
            <div class="w-11 h-11 bg-white flex items-center justify-center rounded-xl shadow-sm text-[#8c6710] transform group-hover:scale-105 transition-transform duration-300">
              <i class="fas fa-user-shield text-lg"></i>
            </div>
            <div>
              <div class="text-white text-5xl font-extrabold mb-1">#04</div>
              <div class="text-white/80 text-[10px] font-bold uppercase tracking-wider mb-1">Langkah Keempat</div>
              <h3 class="text-white text-base font-bold">Tindak Lanjut Satgas</h3>
              <p class="text-white/70 text-xs leading-relaxed mt-1">Tim Satgas segera memverifikasi laporan dan menghubungi Anda untuk pendampingan.</p>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- Berita Terkini Section -->
    <section class="bg-slate-50/50 py-16 lg:py-24 border-y border-slate-100">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto space-y-3 mb-10 sm:mb-14">
          <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">Berita Terkini</h2>
          <div class="w-12 h-1 bg-theme-primary mx-auto rounded-full"></div>
          <p class="text-slate-500 text-sm sm:text-base">Dapatkan rilis pers, berita sosialisasi, dan informasi penting lainnya</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <article 
            v-for="berita in beritas" 
            :key="berita.id"
            class="clean-card overflow-hidden flex flex-col justify-between group"
          >
            <div>
              <!-- Cover image wrapper -->
              <div class="h-48 overflow-hidden relative bg-slate-100">
                <img 
                  v-if="berita.gambar"
                  :src="getImageUrl(berita.gambar)" 
                  :alt="berita.judul" 
                  class="w-full h-full object-cover group-hover:scale-[1.02] transition-transform duration-500"
                />
                <div v-else class="w-full h-full flex items-center justify-center text-slate-300">
                  <i class="fas fa-image text-3xl"></i>
                </div>
              </div>

              <!-- Body details -->
              <div class="p-6 space-y-3">
                <span class="text-[10px] font-bold text-amber-600 bg-amber-50 px-2.5 py-1 rounded-md uppercase tracking-wider">ARTIKEL</span>
                <h3 class="font-bold text-slate-800 text-lg leading-snug group-hover:text-theme-primary transition-colors line-clamp-2">
                  {{ berita.judul }}
                </h3>
                <p class="text-slate-500 text-xs leading-relaxed line-clamp-3">
                  {{ berita.isi.replace(/<[^>]*>/g, '') }}
                </p>
              </div>
            </div>

            <!-- Read link -->
            <div class="px-6 pb-6 pt-0 border-t border-slate-50/50 mt-3">
              <NuxtLink 
                :to="`/berita/${berita.id}`"
                class="text-xs font-bold text-theme-primary hover:text-amber-600 inline-flex items-center pt-4"
              >
                <span>BACA SELENGKAPNYA</span>
                <i class="fas fa-arrow-right ml-1.5 transition-transform group-hover:translate-x-1"></i>
              </NuxtLink>
            </div>
          </article>

          <!-- Empty layout -->
          <div v-if="!beritas || beritas.length === 0" class="col-span-full py-16 bg-white border border-slate-100 rounded-2xl text-center text-slate-400 space-y-2">
            <i class="fas fa-newspaper text-4xl"></i>
            <p class="font-semibold text-sm">Belum ada rilis berita saat ini.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Materi Edukasi Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8 pt-16 lg:pt-24">
      <div class="text-center max-w-3xl mx-auto space-y-3 mb-10 sm:mb-14">
        <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">Materi Edukasi</h2>
        <div class="w-12 h-1 bg-theme-primary mx-auto rounded-full"></div>
        <p class="text-slate-500 text-sm sm:text-base">Materi edukatif seputar hukum, regulasi, dan pencegahan kekerasan seksual</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div 
          v-for="edu in edukasis" 
          :key="edu.id"
          class="clean-card overflow-hidden flex flex-col justify-between group"
        >
          <div>
            <!-- Banner placeholder or image -->
            <div class="h-44 bg-gradient-to-br from-amber-50 to-amber-100/40 flex items-center justify-center overflow-hidden relative">
              <img 
                v-if="edu.gambar"
                :src="getImageUrl(edu.gambar)" 
                alt="Edukasi Banner" 
                class="w-full h-full object-cover group-hover:scale-[1.02] transition-transform duration-500"
              />
              <i v-else class="fas fa-book text-4xl text-theme-primary/40"></i>
            </div>

            <!-- Content details -->
            <div class="p-6 space-y-3">
              <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">E-LEARNING</span>
              <h3 class="font-bold text-slate-800 text-base leading-snug line-clamp-2">{{ edu.judul }}</h3>
              <p class="text-slate-500 text-xs leading-relaxed line-clamp-3">
                {{ edu.konten.replace(/<[^>]*>/g, '') }}
              </p>
            </div>
          </div>

          <!-- Bottom CTA -->
          <div class="px-6 pb-6 pt-0 border-t border-slate-50/50 mt-3">
            <NuxtLink 
              :to="`/edukasi/${edu.id}`"
              class="text-xs font-bold text-theme-primary hover:text-amber-600 inline-flex items-center pt-4"
            >
              <span>PELAJARI MATERI</span>
              <i class="fas fa-arrow-right ml-1.5 transition-transform group-hover:translate-x-1"></i>
            </NuxtLink>
          </div>
        </div>

        <!-- Empty Layout -->
        <div v-if="!edukasis || edukasis.length === 0" class="col-span-full py-16 bg-white border border-slate-100 rounded-2xl text-center text-slate-400 space-y-2">
          <i class="fas fa-book-open text-4xl"></i>
          <p class="font-semibold text-sm">Belum ada materi pembelajaran yang diunggah.</p>
        </div>
      </div>
    </section>

  </div>
</template>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
