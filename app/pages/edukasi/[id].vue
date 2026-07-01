<script setup lang="ts">
import { useRoute } from 'vue-router'
import { BookOpen, BookOpenCheck, ChevronLeft } from 'lucide-vue-next'
import type { Edukasi } from '~/types/database'

const route = useRoute()
const supabase = useSupabaseClient()
const eduId = route.params.id

// Fetch active education material
const { data: edukasi } = useLazyAsyncData<Edukasi>(`edukasi-${eduId}`, async () => {
  const { data } = await supabase
    .from('edukasis')
    .select('*')
    .eq('id', eduId)
    .single()
  return data as Edukasi
})

// Fetch related education materials (latest 3 excluding current)
const { data: related } = useLazyAsyncData<Edukasi[]>(`edukasi-related-${eduId}`, async () => {
  const { data } = await supabase
    .from('edukasis')
    .select('*')
    .neq('id', eduId)
    .order('created_at', { ascending: false })
    .limit(3)
  return (data as Edukasi[]) || []
})

const getImageUrl = (path: string | null) => {
  if (!path) return ''
  if (path.startsWith('http://') || path.startsWith('https://') || path.startsWith('images/') || path.startsWith('image/')) {
    return path
  }
  const { data } = supabase.storage.from('public-assets').getPublicUrl(path)
  return data.publicUrl
}
</script>

<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Back Link -->
    <div class="mb-6">
      <NuxtLink 
        to="/edukasi" 
        class="inline-flex items-center space-x-1.5 text-[#0a5c36] hover:text-[#074026] text-sm font-semibold transition-colors"
      >
        <ChevronLeft class="w-4 h-4" />
        <span>Kembali ke Edukasi</span>
      </NuxtLink>
    </div>

    <div v-if="edukasi" class="grid grid-cols-1 lg:grid-cols-12 gap-10">
      
      <!-- Main Edu Content (Span 8) -->
      <article class="lg:col-span-8 bg-white border border-slate-100 rounded-3xl p-6 sm:p-8 space-y-6 shadow-sm">
        <header class="space-y-4">
          <span class="inline-block px-3 py-1 bg-green-50 text-[#0a5c36] text-xs font-bold rounded-lg uppercase tracking-wider">Materi Edukasi</span>
          <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 leading-tight">
            {{ edukasi.judul }}
          </h1>
          <div class="h-0.5 bg-slate-50 w-full"></div>
        </header>

        <!-- Image Banner -->
        <div v-if="getImageUrl(edukasi.gambar)" class="h-64 sm:h-96 rounded-2xl overflow-hidden shadow-inner">
          <img 
            :src="getImageUrl(edukasi.gambar)" 
            :alt="edukasi.judul" 
            class="w-full h-full object-cover" 
          />
        </div>
        <div v-else class="h-48 bg-gradient-to-br from-[#074026] to-[#0a5c36] rounded-2xl flex items-center justify-center text-white">
          <BookOpenCheck class="w-16 h-16 opacity-75" />
        </div>

        <!-- Contents -->
        <div 
          class="prose prose-slate max-w-none text-slate-700 leading-relaxed text-sm sm:text-base space-y-4"
          v-html="edukasi.konten"
        ></div>
      </article>

      <!-- Sidebar (Span 4) -->
      <aside class="lg:col-span-4 space-y-8">
        
        <!-- Related Edu materials widget -->
        <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm space-y-6">
          <h3 class="font-bold text-slate-800 text-lg border-b border-slate-100 pb-3">Materi Lainnya</h3>
          
          <div v-if="related && related.length > 0" class="space-y-5">
            <div 
              v-for="item in related" 
              :key="item.id" 
              class="flex space-x-3 group"
            >
              <div class="w-16 h-16 bg-slate-100 rounded-xl overflow-hidden shrink-0 flex items-center justify-center">
                <img 
                  v-if="item.gambar" 
                  :src="getImageUrl(item.gambar)" 
                  :alt="item.judul" 
                  class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200" 
                />
                <BookOpenCheck v-else class="w-8 h-8 text-[#0a5c36] opacity-60" />
              </div>
              <div class="space-y-1">
                <h4 class="font-bold text-slate-700 text-sm leading-snug group-hover:text-[#0a5c36] transition-colors line-clamp-2">
                  <NuxtLink :to="`/edukasi/${item.id}`">{{ item.judul }}</NuxtLink>
                </h4>
              </div>
            </div>
          </div>
          
          <div v-else class="text-center py-6 text-gray-400 text-sm font-semibold">
            Belum ada materi edukasi lainnya.
          </div>
        </div>

        <!-- Call to Action Box -->
        <div class="bg-gradient-to-br from-[#074026] to-[#0a5c36] text-white rounded-3xl p-6 space-y-4 shadow-sm">
          <h3 class="font-bold text-yellow-300 text-base leading-tight">Butuh Konsultasi?</h3>
          <p class="text-gray-300 text-xs sm:text-sm leading-relaxed">
            Jika Anda mengalami, melihat, atau mendengar tindakan kekerasan seksual, Anda tidak sendirian. Satgas PPKS siap mendengarkan dan mendampingi Anda kapan saja secara gratis dan rahasia.
          </p>
          <NuxtLink 
            to="/lapor-kekerasan" 
            class="block text-center py-2.5 bg-yellow-400 hover:bg-yellow-500 text-slate-900 font-bold rounded-xl text-xs sm:text-sm shadow-sm transition-colors"
          >
            Mulai Pengaduan
          </NuxtLink>
        </div>

      </aside>

    </div>

    <div v-else class="text-center py-24 bg-white border border-gray-100 rounded-3xl">
      <BookOpen class="w-16 h-16 text-slate-300 mx-auto mb-4" />
      <p class="text-slate-600 font-bold text-lg">Materi Edukasi Tidak Ditemukan</p>
      <p class="text-slate-400 text-sm mt-1">Halaman edukasi yang Anda cari tidak tersedia atau sudah dipindahkan.</p>
    </div>
  </div>
</template>
