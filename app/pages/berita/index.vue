<script setup lang="ts">
import { ref, watch } from 'vue'
import { Search, Newspaper, ArrowRight, ChevronLeft, ChevronRight } from 'lucide-vue-next'
import type { Berita } from '~/types/database'

const supabase = useSupabaseClient()
const searchQuery = ref('')
const page = ref(1)
const itemsPerPage = 6

// Debounced / reactive search. We will watch searchQuery and reset page to 1
watch(searchQuery, () => {
  page.value = 1
})

const { data: result, refresh, pending } = useLazyAsyncData('berita-list', async () => {
  let query = supabase
    .from('beritas')
    .select('*', { count: 'exact' })
    .order('created_at', { ascending: false })

  if (searchQuery.value.trim() !== '') {
    // ilike matches case-insensitively
    query = query.ilike('judul', `%${searchQuery.value}%`)
  }

  const from = (page.value - 1) * itemsPerPage
  const to = from + itemsPerPage - 1

  const { data, count } = await query.range(from, to)
  
  return {
    list: (data as Berita[]) || [],
    total: count || 0
  }
}, {
  watch: [page, searchQuery]
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
      <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900">Portal Berita PPKS</h1>
      <div class="w-16 h-1 bg-[#0a5c36] mx-auto rounded-full"></div>
      <p class="text-gray-600 text-sm sm:text-base">
        Informasi terkini mengenai sosialisasi pencegahan kekerasan seksual, regulasi terbaru, kegiatan satuan tugas, serta pengumuman penting lainnya.
      </p>
    </div>

    <!-- Search bar -->
    <div class="max-w-md mx-auto relative shadow-sm rounded-xl">
      <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        <Search class="h-5 w-5 text-gray-400" />
      </div>
      <input 
        type="text" 
        v-model="searchQuery" 
        placeholder="Cari judul berita..." 
        class="block w-full pl-10 pr-4 py-3 bg-white border border-gray-200 rounded-xl text-slate-800 placeholder-gray-400 focus:outline-none focus:border-[#0a5c36] focus:ring-1 focus:ring-[#0a5c36] transition-colors"
      />
    </div>

    <!-- Main Listing -->
    <div v-if="pending" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <div v-for="n in 6" :key="n" class="bg-white border border-gray-100 rounded-2xl p-6 space-y-4 animate-pulse">
        <div class="h-48 bg-gray-200 rounded-xl"></div>
        <div class="h-4 w-1/3 bg-gray-200 rounded"></div>
        <div class="h-6 w-3/4 bg-gray-200 rounded"></div>
        <div class="h-4 w-full bg-gray-200 rounded"></div>
      </div>
    </div>
    
    <div v-else>
      <div v-if="result && result.list.length > 0" class="space-y-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <article 
            v-for="berita in result.list" 
            :key="berita.id" 
            class="clean-card overflow-hidden flex flex-col justify-between group"
          >
            <div>
              <div class="h-48 bg-slate-100 overflow-hidden relative">
                <img 
                  v-if="berita.gambar" 
                  :src="getImageUrl(berita.gambar)" 
                  :alt="berita.judul" 
                  class="w-full h-full object-cover group-hover:scale-[1.02] transition-transform duration-500" 
                />
                <div v-else class="w-full h-full flex items-center justify-center text-slate-300">
                  <Newspaper class="w-12 h-12" />
                </div>
              </div>
              <div class="p-6 space-y-3">
                <p class="text-xs text-gray-400 font-semibold">
                  {{ new Date(berita.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) }}
                </p>
                <h2 class="text-lg font-bold text-slate-800 group-hover:text-[#0a5c36] transition-colors line-clamp-2">
                  <NuxtLink :to="`/berita/${berita.id}`">{{ berita.judul }}</NuxtLink>
                </h2>
                <p class="text-gray-500 text-sm line-clamp-3 leading-relaxed">
                  {{ berita.isi.replace(/<[^>]*>/g, '') }}
                </p>
              </div>
            </div>

            <div class="px-6 pb-6 pt-2">
              <NuxtLink 
                :to="`/berita/${berita.id}`" 
                class="text-[#0a5c36] hover:text-[#074026] text-sm font-semibold inline-flex items-center space-x-1"
              >
                <span>Baca Selengkapnya</span>
                <ArrowRight class="w-4 h-4" />
              </NuxtLink>
            </div>
          </article>
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
        <Newspaper class="w-16 h-16 text-slate-300 mx-auto mb-4" />
        <p class="text-slate-600 font-semibold">Tidak ada berita yang ditemukan.</p>
        <p class="text-slate-400 text-sm mt-1">Coba gunakan kata kunci pencarian yang lain.</p>
      </div>
    </div>
  </div>
</template>
