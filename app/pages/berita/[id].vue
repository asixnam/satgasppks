<script setup lang="ts">
import { useRoute } from 'vue-router'
import { Calendar, ChevronLeft, Newspaper } from 'lucide-vue-next'
import type { Berita } from '~/types/database'

const route = useRoute()
const supabase = useSupabaseClient()
const beritaId = route.params.id

// Fetch active berita
const { data: berita } = useLazyAsyncData<Berita>(`berita-${beritaId}`, async () => {
  const { data } = await supabase
    .from('beritas')
    .select('*')
    .eq('id', beritaId)
    .single()
  return data as Berita
})

// Fetch related articles (latest 3 excluding current)
const { data: related } = useLazyAsyncData<Berita[]>(`beritas-related-${beritaId}`, async () => {
  const { data } = await supabase
    .from('beritas')
    .select('*')
    .neq('id', beritaId)
    .order('created_at', { ascending: false })
    .limit(3)
  return (data as Berita[]) || []
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
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Back link -->
    <div class="mb-6">
      <NuxtLink 
        to="/berita" 
        class="inline-flex items-center space-x-1.5 text-[#0a5c36] hover:text-[#074026] text-sm font-semibold transition-colors"
      >
        <ChevronLeft class="w-4 h-4" />
        <span>Kembali ke Berita</span>
      </NuxtLink>
    </div>

    <div v-if="berita" class="grid grid-cols-1 lg:grid-cols-12 gap-10">
      
      <!-- Left side: News body (Span 8) -->
      <article class="lg:col-span-8 bg-white border border-slate-100 p-6 sm:p-8 space-y-6 shadow-sm">
        
        <header class="space-y-4">
          <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 leading-tight">
            {{ berita.judul }}
          </h1>
          <div class="flex items-center space-x-2 text-xs sm:text-sm text-gray-500 font-semibold">
            <Calendar class="w-4 h-4 text-[#0a5c36]" />
            <span>{{ new Date(berita.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>
          </div>
        </header>

        <div v-if="berita.gambar" class="h-64 sm:h-96 overflow-hidden shadow-inner">
          <img 
            :src="getImageUrl(berita.gambar)" 
            :alt="berita.judul" 
            class="w-full h-full object-cover" 
          />
        </div>

        <!-- News content -->
        <div 
          class="prose prose-slate max-w-none text-slate-700 leading-relaxed text-sm sm:text-base whitespace-pre-line"
          v-html="berita.isi"
        ></div>

      </article>

      <!-- Right side: Sidebar (Span 4) -->
      <aside class="lg:col-span-4 space-y-8">
        
        <!-- Related Articles widget -->
        <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm space-y-6">
          <h3 class="font-bold text-slate-800 text-lg border-b border-slate-100 pb-3">Berita Terkait</h3>
          
          <div v-if="related && related.length > 0" class="space-y-5">
            <div 
              v-for="item in related" 
              :key="item.id" 
              class="flex space-x-3 group"
            >
              <div class="w-16 h-16 bg-slate-100 rounded-xl overflow-hidden shrink-0">
                <img 
                  v-if="item.gambar" 
                  :src="getImageUrl(item.gambar)" 
                  :alt="item.judul" 
                  class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200" 
                />
                <div v-else class="w-full h-full flex items-center justify-center text-slate-300">
                  <Newspaper class="w-6 h-6" />
                </div>
              </div>
              <div class="space-y-1">
                <p class="text-[10px] text-gray-400 font-semibold">{{ new Date(item.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'short' }) }}</p>
                <h4 class="font-bold text-slate-700 text-sm leading-snug group-hover:text-[#0a5c36] transition-colors line-clamp-2">
                  <NuxtLink :to="`/berita/${item.id}`">{{ item.judul }}</NuxtLink>
                </h4>
              </div>
            </div>
          </div>
          
          <div v-else class="text-center py-6 text-gray-400 text-sm font-semibold">
            Belum ada berita terkait lainnya.
          </div>
        </div>

        <!-- Safe Space Info widget -->
        <div class="bg-gradient-to-br from-[#074026] to-[#0a5c36] text-white p-6 space-y-4 shadow-sm">
          <h3 class="font-bold text-yellow-300 text-base leading-tight">Keamanan & Kerahasiaan</h3>
          <p class="text-gray-300 text-xs sm:text-sm leading-relaxed">
            Menghadapi tindakan kekerasan memerlukan keberanian besar. SATGAS PPKS menjamin kerahasiaan identitas dan data laporan Anda 100%. Jangan ragu untuk melapor jika Anda atau rekan Anda membutuhkan perlindungan.
          </p>
          <NuxtLink 
            to="/lapor-kekerasan" 
            class="block text-center py-2.5 bg-yellow-400 hover:bg-yellow-500 text-slate-900 font-bold rounded-xl text-xs sm:text-sm shadow-sm transition-colors"
          >
            Hubungi / Lapor Sekarang
          </NuxtLink>
        </div>

      </aside>

    </div>
    
    <div v-else class="text-center py-24 bg-white border border-gray-100 rounded-3xl">
      <Newspaper class="w-16 h-16 text-slate-300 mx-auto mb-4" />
      <p class="text-slate-600 font-bold text-lg">Berita Tidak Ditemukan</p>
      <p class="text-slate-400 text-sm mt-1">Halaman berita yang Anda cari tidak tersedia atau sudah dihapus.</p>
    </div>
  </div>
</template>
