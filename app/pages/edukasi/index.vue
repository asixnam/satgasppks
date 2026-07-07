<script setup lang="ts">
import { ref, computed } from 'vue'
import { BookOpen, BookOpenCheck, FileText, ChevronDown, ChevronUp, ChevronLeft, ChevronRight } from 'lucide-vue-next'
import type { Edukasi } from '~/types/database'

const supabase = useSupabaseClient()
const page = ref(1)
const itemsPerPage = 6
const activeEduId = ref<number | null>(null)

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

const toggleActiveEdu = (id: number) => {
  if (activeEduId.value === id) {
    activeEduId.value = null
  } else {
    activeEduId.value = id
  }
}

const getPdfUrl = (path: string | null) => {
  if (!path) return ''
  if (path.startsWith('http://') || path.startsWith('https://')) {
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
            class="clean-card overflow-hidden flex flex-col justify-between group transition-all duration-305"
            :class="{ 'lg:col-span-3 md:col-span-2 border-green-300 ring-2 ring-green-100 bg-white': activeEduId === edu.id }"
          >
            <div>
              <!-- Content Info -->
              <div class="p-6 space-y-3">
                <span class="inline-block px-2.5 py-1 bg-green-50 text-[#0a5c36] text-xs font-bold rounded-md uppercase tracking-wider">Materi Edukasi</span>
                <h3 class="text-lg font-bold text-slate-800 hover:text-[#0a5c36] transition-colors">
                  <!-- Desktop: toggle preview -->
                  <button 
                    @click="toggleActiveEdu(edu.id)"
                    class="hidden md:block text-left font-bold text-slate-800 hover:text-[#0a5c36] transition-colors focus:outline-none"
                  >
                    {{ edu.judul }}
                  </button>
                  <!-- Mobile: open directly in new tab -->
                  <a 
                    v-if="edu.konten"
                    :href="getPdfUrl(edu.konten)"
                    target="_blank"
                    class="block md:hidden text-left font-bold text-slate-800 hover:text-[#0a5c36] transition-colors"
                  >
                    {{ edu.judul }}
                  </a>
                  <span v-else-if="!edu.konten" class="block md:hidden text-left font-bold text-slate-800">
                    {{ edu.judul }}
                  </span>
                </h3>
              </div>
            </div>

            <!-- PDF Viewer directly below card header if active (desktop only) -->
            <div v-if="activeEduId === edu.id" class="hidden md:block px-6 pb-6 pt-2 border-t border-slate-100 bg-slate-50/50">
              <iframe 
                v-if="edu.konten"
                :src="getPdfUrl(edu.konten)" 
                class="w-full h-[600px] border border-slate-200 rounded-2xl shadow-inner bg-white"
              ></iframe>
              <div v-else class="text-center py-8 text-gray-400 font-semibold">
                Berkas PDF tidak ditemukan.
              </div>
            </div>

            <!-- Card footer actions -->
            <div class="px-6 pb-6 pt-3 border-t border-slate-50 flex items-center justify-between">
              <!-- Desktop: Toggle preview -->
              <button 
                @click="toggleActiveEdu(edu.id)" 
                class="hidden md:inline-flex text-[#0a5c36] hover:text-[#074026] text-sm font-semibold items-center space-x-1.5 transition-colors focus:outline-none"
              >
                <span v-if="activeEduId === edu.id">Tutup PDF</span>
                <span v-else>Buka / Baca PDF</span>
                <ChevronUp v-if="activeEduId === edu.id" class="w-4 h-4" />
                <ChevronDown v-else class="w-4 h-4" />
              </button>

              <!-- Mobile: Open directly in a new tab -->
              <a 
                v-if="edu.konten"
                :href="getPdfUrl(edu.konten)"
                target="_blank"
                class="inline-flex md:hidden text-[#0a5c36] hover:text-[#074026] text-sm font-semibold items-center space-x-1.5 transition-colors"
              >
                <span>Buka / Baca PDF</span>
                <ChevronRight class="w-4 h-4" />
              </a>

              <a 
                v-if="edu.konten"
                :href="getPdfUrl(edu.konten)" 
                download
                target="_blank"
                class="text-xs text-slate-500 hover:text-slate-700 hover:underline font-semibold"
              >
                Unduh PDF
              </a>
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
