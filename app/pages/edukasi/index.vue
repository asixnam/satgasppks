<script setup lang="ts">
import { ref } from 'vue'
import { BookOpen, BookOpenCheck, ArrowRight, ChevronLeft, ChevronRight } from 'lucide-vue-next'
import type { Edukasi } from '~/types/database'

const supabase = useSupabaseClient()
const page = ref(1)
const itemsPerPage = 6

const { data: result, pending } = useLazyAsyncData('edukasi-list', async () => {
  const from = (page.value - 1) * itemsPerPage
  const to = from + itemsPerPage - 1

  const { data, count } = await supabase
    .from('edukasis')
    .select('*', { count: 'exact' })
    .order('created_at', { ascending: false })
    .range(from, to)

  return {
    list: (data as Edukasi[]) || [],
    total: count || 0
  }
}, {
  watch: [page]
})

const totalPages = computed(() => {
  if (!result.value) return 0
  return Math.ceil(result.value.total / itemsPerPage)
})

const getImageUrl = (path: string | null) => {
  if (!path) return '/images/placeholder.jpg'
  if (path.startsWith('http://') || path.startsWith('https://') || path.startsWith('images/') || path.startsWith('image/')) {
    return path
  }
  const { data } = supabase.storage.from('public-assets').getPublicUrl(path)
  return data.publicUrl
}
</script>

<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-12">
    <!-- Header banner -->
    <div class="text-center max-w-3xl mx-auto space-y-4">
      <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900">Edukasi & Sosialisasi</h1>
      <div class="w-16 h-1 bg-[#0a5c36] mx-auto rounded-full"></div>
      <p class="text-gray-600 text-sm sm:text-base">
        Kumpulan artikel, brosur, materi presentasi, dan panduan edukasi untuk memahami definisi, pencegahan, perlindungan, dan penanganan kasus kekerasan seksual di kampus.
      </p>
    </div>

    <!-- Main Listing -->
    <div v-if="pending" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <div v-for="n in 6" :key="n" class="bg-white border border-slate-100 rounded-2xl p-6 space-y-4 animate-pulse">
        <div class="h-48 bg-gray-200 rounded-xl"></div>
        <div class="h-4 w-1/3 bg-gray-200 rounded"></div>
        <div class="h-6 w-3/4 bg-gray-200 rounded"></div>
        <div class="h-4 w-full bg-gray-200 rounded"></div>
      </div>
    </div>
    
    <div v-else>
      <div v-if="result && result.list.length > 0" class="space-y-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <div 
            v-for="edu in result.list" 
            :key="edu.id" 
            class="clean-card overflow-hidden flex flex-col justify-between group"
          >
            <div>
              <div class="h-48 bg-gradient-to-br from-[#074026] to-[#0a5c36] text-white flex items-center justify-center overflow-hidden relative">
                <img 
                  v-if="edu.gambar" 
                  :src="getImageUrl(edu.gambar)" 
                  alt="Edukasi image" 
                  class="w-full h-full object-cover group-hover:scale-[1.02] transition-transform duration-500" 
                />
                <BookOpenCheck v-else class="w-16 h-16 opacity-75" />
              </div>
              
              <div class="p-6 space-y-3">
                <span class="inline-block px-2.5 py-1 bg-green-50 text-[#0a5c36] text-xs font-bold rounded-md uppercase tracking-wider">Materi</span>
                <h3 class="text-lg font-bold text-slate-800 group-hover:text-[#0a5c36] transition-colors line-clamp-2">
                  <NuxtLink :to="`/edukasi/${edu.id}`">{{ edu.judul }}</NuxtLink>
                </h3>
                <p class="text-gray-500 text-sm line-clamp-3 leading-relaxed">
                  {{ edu.konten.replace(/<[^>]*>/g, '') }}
                </p>
              </div>
            </div>

            <div class="px-6 pb-6 pt-2">
              <NuxtLink 
                :to="`/edukasi/${edu.id}`" 
                class="text-[#0a5c36] hover:text-[#074026] text-sm font-semibold inline-flex items-center space-x-1"
              >
                <span>Pelajari Detail</span>
                <ArrowRight class="w-4 h-4" />
              </NuxtLink>
            </div>
          </div>
        </div>

        <!-- Pagination -->
        <div v-if="totalPages > 1" class="flex justify-center items-center space-x-4 pt-6">
          <button 
            @click="page--" 
            :disabled="page === 1"
            class="p-2 border border-gray-200 rounded-lg hover:bg-slate-100 disabled:opacity-50 disabled:hover:bg-transparent transition-colors"
          >
            <ChevronLeft class="w-5 h-5 text-gray-600" />
          </button>
          
          <span class="text-sm font-semibold text-gray-700">Halaman {{ page }} dari {{ totalPages }}</span>

          <button 
            @click="page++" 
            :disabled="page === totalPages"
            class="p-2 border border-gray-200 rounded-lg hover:bg-slate-100 disabled:opacity-50 disabled:hover:bg-transparent transition-colors"
          >
            <ChevronRight class="w-5 h-5 text-gray-600" />
          </button>
        </div>
      </div>

      <div v-else class="text-center py-20 bg-white border border-gray-100 rounded-2xl">
        <BookOpen class="w-16 h-16 text-slate-300 mx-auto mb-4" />
        <p class="text-slate-600 font-semibold">Belum ada materi edukasi yang tersedia saat ini.</p>
        <p class="text-slate-400 text-sm mt-1">Silakan kunjungi lagi nanti untuk pembaruan konten terbaru.</p>
      </div>
    </div>
  </div>
</template>
