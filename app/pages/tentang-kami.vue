<script setup lang="ts">
import { ref, computed } from 'vue'
import type { Tim, VisiMisi } from '~/types/database'

const supabase = useSupabaseClient()

// Fetch team members
const { data: tims } = useLazyAsyncData<Tim[]>('tims', async () => {
  const { data } = await supabase
    .from('tims')
    .select('*')
    .order('id', { ascending: true })
  return (data as Tim[]) || []
})

// Fetch visi & misi (first row)
const { data: visiMisi } = useLazyAsyncData<VisiMisi>('visiMisi', async () => {
  const { data } = await supabase
    .from('visi_misis')
    .select('*')
    .order('id', { ascending: true })
    .limit(1)
    .maybeSingle()
  return data as VisiMisi
})

// Helper for image URLs
const getImageUrl = (path: string | null) => {
  if (!path) return '/image/sampel.png'
  if (path.startsWith('images/') || path.startsWith('image/')) {
    const basename = path.split('/').pop()
    return `/image/${basename}`
  }
  const { data } = supabase.storage.from('public-assets').getPublicUrl(path)
  return data.publicUrl
}

// Split mission text by line breaks
const misiItems = computed(() => {
  if (!visiMisi.value?.misi) return []
  return visiMisi.value.misi.split('\n').map(item => item.trim()).filter(item => item.length > 0)
})

// Mobile slider index
const currentSlide = ref(0)
const nextSlide = () => {
  if (!tims.value) return
  currentSlide.value = (currentSlide.value + 1) % tims.value.length
}
const prevSlide = () => {
  if (!tims.value) return
  currentSlide.value = (currentSlide.value - 1 + tims.value.length) % tims.value.length
}
</script>

<template>
  <div class="container mx-auto px-4 py-8 max-w-7xl">
    <!-- Header Section -->
    <div class="text-center mb-16">
      <img src="/image/logo-warna.png" alt="SATGAS PPKS Logo" class="mx-auto h-44 mb-8 drop-shadow-lg object-contain">
      <h1 class="text-4xl md:text-5xl font-bold mb-6 text-[#166534]">
        Tentang SATGAS PPKPT
      </h1>
      <p class="text-gray-600 text-lg max-w-4xl mx-auto leading-relaxed">
        {{ visiMisi?.about || 'Deskripsi tentang SATGAS PPKPT belum tersedia.' }}
      </p>
    </div>

    <!-- Vision & Mission Section -->
    <div class="max-w-6xl mx-auto mb-16">
      <div v-if="visiMisi" class="grid md:grid-cols-2 gap-8">
        <!-- Vision Card -->
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-8 border border-gray-100">
          <div class="flex items-center mb-6">
            <div class="rounded-full mr-4">
              <i class="fas fa-lightbulb text-[#166534] text-xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-green-800">VISI</h2>
          </div>
          <p class="text-gray-700 leading-relaxed whitespace-pre-line">
            {{ visiMisi.visi }}
          </p>
        </div>

        <!-- Mission Card -->
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-8 border border-gray-100">
          <div class="flex items-center mb-6">
            <div class="rounded-full mr-4">
              <i class="fas fa-bullseye text-[#166534] text-xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-green-800">MISI</h2>
          </div>
          <ul class="text-gray-700 leading-relaxed space-y-3">
            <li 
              v-for="(item, idx) in misiItems" 
              :key="idx"
              class="flex items-start"
            >
              <i class="fas fa-check-circle text-green-500 mt-1 mr-3 shrink-0"></i>
              <span>{{ item }}</span>
            </li>
          </ul>
        </div>
      </div>

      <!-- Default Visi Misi if database empty -->
      <div v-else class="grid md:grid-cols-2 gap-8">
        <!-- Vision Card -->
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-8 border border-gray-100">
          <div class="flex items-center mb-6">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-3 rounded-full mr-4">
              <i class="fas fa-eye text-white text-xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">VISI</h2>
          </div>
          <p class="text-gray-700 leading-relaxed">
            Menjadi satuan tugas yang profesional, terpercaya, dan responsif dalam menciptakan lingkungan kampus yang aman, bebas dari kekerasan seksual, serta mendukung terciptanya budaya kampus yang menghormati harkat dan martabat setiap individu di Universitas Nahdlatul Ulama Yogyakarta.
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

    <!-- Team Section Header -->
    <div class="text-center mb-12">
      <div class="flex items-center justify-center mb-8">
        <div class="rounded-full mr-4">
          <i class="fas fa-users text-green-600 text-xl"></i>
        </div>
        <h2 class="text-3xl font-bold text-green-800">Tim Kami</h2>
      </div>
      <p class="text-gray-600 max-w-2xl mx-auto mb-12">
        Tim profesional yang berdedikasi untuk menciptakan lingkungan kampus yang aman dan nyaman bagi seluruh civitas akademika
      </p>
    </div>

    <!-- Team Grid/Slider -->
    <div v-if="tims && tims.length > 0">
      
      <!-- Mobile Slider (visible on mobile only) -->
      <div class="lg:hidden relative max-w-md mx-auto mb-8 overflow-hidden">
        <div class="w-full">
          <div 
            class="flex transition-transform duration-500 ease-in-out"
            :style="`transform: translateX(-${currentSlide * 100}%);`"
          >
            <div 
              v-for="tim in tims" 
              :key="tim.id"
              class="w-full flex-shrink-0 px-4"
            >
              <div class="text-center flex flex-col items-center">
                <!-- Photo Section -->
                <div class="relative mb-4">
                  <img 
                    :src="getImageUrl(tim.foto)" 
                    :alt="`Foto ${tim.nama}`" 
                    class="w-64 h-64 object-cover rounded-xl mx-auto shadow-lg"
                  />
                </div>
                
                <!-- Info Section -->
                <div class="space-y-2">
                  <h3 class="text-lg font-semibold text-gray-800">{{ tim.nama }}</h3>
                  <p class="text-sm text-gray-600">{{ tim.jabatan }}</p>
                  <p class="text-sm text-green-600 font-semibold">UNU Yogyakarta</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Navigation Buttons -->
        <button 
          @click="prevSlide"
          class="absolute left-0 top-1/3 -translate-y-1/2 bg-white/90 border border-gray-150 rounded-full p-3 shadow-md hover:bg-gray-100 transition-colors z-20"
        >
          <i class="fas fa-chevron-left text-gray-600"></i>
        </button>
        <button 
          @click="nextSlide"
          class="absolute right-0 top-1/3 -translate-y-1/2 bg-white/90 border border-gray-150 rounded-full p-3 shadow-md hover:bg-gray-100 transition-colors z-20"
        >
          <i class="fas fa-chevron-right text-gray-600"></i>
        </button>
        
        <!-- Dots Indicator -->
        <div class="flex justify-center gap-2 mt-6">
          <button 
            v-for="(tim, index) in tims" 
            :key="index"
            @click="currentSlide = index"
            class="h-2 rounded-full transition-all"
            :class="index === currentSlide ? 'bg-green-600 w-8' : 'bg-gray-300 w-2'"
            :aria-label="`Go to team member ${index + 1}`"
          ></button>
        </div>
      </div>

      <!-- Desktop Grid (visible on desktop only) -->
      <div class="hidden lg:grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 max-w-7xl mx-auto">
        <div 
          v-for="tim in tims" 
          :key="tim.id"
          class="text-center h-full flex flex-col items-center group"
        >
          <!-- Photo Section -->
          <div class="relative mb-2 overflow-hidden rounded-xl shadow-md group-hover:shadow-lg transition-all duration-300">
            <img 
              :src="getImageUrl(tim.foto)" 
              :alt="`Foto ${tim.nama}`" 
              class="w-56 h-56 lg:w-60 lg:h-60 object-cover rounded-xl mx-auto group-hover:scale-105 transition-transform duration-500"
            />
          </div>
          
          <!-- Info Section -->
          <div class="space-y-1 mt-3">
            <h3 class="text-base lg:text-lg font-medium text-gray-800 leading-snug">{{ tim.nama }}</h3>
            <p class="text-sm lg:text-base text-gray-600">{{ tim.jabatan }}</p>
            <p class="text-sm lg:text-base text-green-700 font-semibold">UNU Yogyakarta</p>
          </div>
        </div>
      </div>

    </div>

    <!-- Empty State -->
    <div v-else class="text-center py-12">
      <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
        <i class="fas fa-users text-gray-400 text-3xl"></i>
      </div>
      <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Data Tim</h3>
      <p class="text-gray-500">Data anggota tim belum tersedia saat ini.</p>
    </div>
  </div>
</template>
