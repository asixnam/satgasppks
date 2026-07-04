<script setup lang="ts">
import { ref } from 'vue'
import { 
  FileText, 
  RefreshCw, 
  CheckCircle2, 
  XCircle, 
  Users, 
  FileWarning, 
  Calendar,
  Eye
} from 'lucide-vue-next'
import type { ViolenceReport } from '~/types/database'

definePageMeta({
  middleware: 'auth',
  layout: 'admin'
})

const supabase = useSupabaseClient()

// Fetch reports with relationships for client-side stats calculation
const { data: reports, pending, refresh } = useLazyAsyncData<ViolenceReport[]>('admin-dashboard-stats', async () => {
  const { data } = await supabase
    .from('violence_reports')
    .select(`
      id,
      status,
      code,
      created_at,
      client:id_client(*),
      violence:id_violence(*)
    `)
    .order('created_at', { ascending: false })
  return (data as unknown as ViolenceReport[]) || []
}, { default: () => [] })

// Stats computation
const totalReports = computed(() => reports.value?.length || 0)
const statusCounts = computed(() => {
  const counts = { terlapor: 0, diproses: 0, ditolak: 0, selesai: 0 }
  reports.value?.forEach(r => {
    if (r.status in counts) {
      counts[r.status as keyof typeof counts]++
    }
  })
  return counts
})

const recentReports = computed(() => {
  return reports.value?.slice(0, 5) || []
})

// Demographic stats
const genderStats = computed(() => {
  const stats = { 'Laki-laki': 0, 'Perempuan': 0 }
  reports.value?.forEach(r => {
    const gk = r.client?.jenis_kelamin
    if (gk && gk in stats) {
      stats[gk as keyof typeof stats]++
    }
  })
  return stats
})

const statusDemographics = computed(() => {
  const stats: Record<string, number> = {}
  reports.value?.forEach(r => {
    const s = r.client?.status
    if (s) {
      stats[s] = (stats[s] || 0) + 1
    }
  })
  return stats
})

const typeStats = computed(() => {
  const stats: Record<string, number> = {}
  reports.value?.forEach(r => {
    const shapes = r.violence?.bentuk_kekerasan
    if (shapes) {
      shapes.forEach(shape => {
        stats[shape] = (stats[shape] || 0) + 1
      })
    }
  })
  return stats
})
</script>

<template>
  <div class="space-y-8">
    
    <!-- Top Header -->
    <div class="flex items-center justify-between">
      <div>
        <h1 class="text-2xl font-black text-slate-800">Dashboard Statistik</h1>
        <p class="text-sm text-gray-500">Ringkasan data laporan masuk dan pemantauan kasus secara langsung.</p>
      </div>
      <button 
        @click="refresh()" 
        :disabled="pending"
        class="px-3 py-2 sm:px-4 sm:py-2 border border-gray-200 rounded-xl hover:bg-white text-sm font-semibold transition-colors flex items-center justify-center gap-1.5 disabled:opacity-50 shrink-0"
        title="Refresh Data"
      >
        <RefreshCw class="w-4 h-4" :class="{ 'animate-spin': pending }" />
        <span class="hidden sm:inline">Refresh Data</span>
      </button>
    </div>

    <!-- Summary Count Cards -->
    <div class="grid grid-cols-6 sm:grid-cols-2 lg:grid-cols-5 gap-6">
      
      <!-- Total Laporan -->
      <div class="bg-white border border-gray-100 p-4 sm:p-6 rounded-2xl shadow-sm flex items-center justify-between col-span-3 sm:col-span-1 lg:col-span-1">
        <div class="space-y-1 min-w-0">
          <p class="text-[10px] sm:text-xs font-bold text-gray-400 uppercase tracking-wider truncate">Total Laporan</p>
          <p class="text-2xl sm:text-3xl font-black text-slate-800">{{ totalReports }}</p>
        </div>
        <div class="p-2 sm:p-3 bg-slate-50 text-slate-700 rounded-xl border border-slate-100 shrink-0">
          <FileText class="w-5 h-5 sm:w-6 sm:h-6" />
        </div>
      </div>

      <!-- Terlapor -->
      <div class="bg-white border border-gray-100 p-4 sm:p-6 rounded-2xl shadow-sm flex items-center justify-between col-span-3 sm:col-span-1 lg:col-span-1">
        <div class="space-y-1 min-w-0">
          <p class="text-[10px] sm:text-xs font-bold text-yellow-600 uppercase tracking-wider truncate">Terlapor (Baru)</p>
          <p class="text-2xl sm:text-3xl font-black text-slate-800">{{ statusCounts.terlapor }}</p>
        </div>
        <div class="p-2 sm:p-3 bg-yellow-50 text-yellow-600 rounded-xl border border-yellow-100 shrink-0">
          <FileWarning class="w-5 h-5 sm:w-6 sm:h-6" />
        </div>
      </div>

      <!-- Diproses -->
      <div class="bg-white border border-gray-100 p-4 sm:p-6 rounded-2xl shadow-sm flex items-center justify-between col-span-2 sm:col-span-1 lg:col-span-1">
        <div class="space-y-1 min-w-0">
          <p class="text-[10px] sm:text-xs font-bold text-blue-600 uppercase tracking-wider truncate">Diproses</p>
          <p class="text-2xl sm:text-3xl font-black text-slate-800">{{ statusCounts.diproses }}</p>
        </div>
        <div class="p-2 sm:p-3 bg-blue-50 text-blue-600 rounded-xl border border-blue-100 shrink-0">
          <RefreshCw class="w-5 h-5 sm:w-6 sm:h-6" />
        </div>
      </div>

      <!-- Selesai -->
      <div class="bg-white border border-gray-100 p-4 sm:p-6 rounded-2xl shadow-sm flex items-center justify-between col-span-2 sm:col-span-1 lg:col-span-1">
        <div class="space-y-1 min-w-0">
          <p class="text-[10px] sm:text-xs font-bold text-green-600 uppercase tracking-wider truncate">Selesai</p>
          <p class="text-2xl sm:text-3xl font-black text-slate-800">{{ statusCounts.selesai }}</p>
        </div>
        <div class="p-2 sm:p-3 bg-green-50 text-green-600 rounded-xl border border-green-100 shrink-0">
          <CheckCircle2 class="w-5 h-5 sm:w-6 sm:h-6" />
        </div>
      </div>

      <!-- Ditolak -->
      <div class="bg-white border border-gray-100 p-4 sm:p-6 rounded-2xl shadow-sm flex items-center justify-between col-span-2 sm:col-span-1 lg:col-span-1">
        <div class="space-y-1 min-w-0">
          <p class="text-[10px] sm:text-xs font-bold text-red-600 uppercase tracking-wider truncate">Ditolak</p>
          <p class="text-2xl sm:text-3xl font-black text-slate-800">{{ statusCounts.ditolak }}</p>
        </div>
        <div class="p-2 sm:p-3 bg-red-50 text-red-600 rounded-xl border border-red-100 shrink-0">
          <XCircle class="w-5 h-5 sm:w-6 sm:h-6" />
        </div>
      </div>

    </div>

    <!-- Main columns -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
      
      <!-- Left side: Recent Reports & Demographic tables (Span 8) -->
      <div class="lg:col-span-8 space-y-8">
        
        <!-- Recent Reports table -->
        <div class="bg-white border border-gray-100 rounded-3xl p-6 sm:p-8 shadow-sm space-y-4">
          <h3 class="font-bold text-slate-800 text-lg border-b border-gray-100 pb-3 flex items-center space-x-2">
            <FileText class="w-5 h-5 text-green-700" />
            <span>Laporan Terbaru</span>
          </h3>

          <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
              <thead>
                <tr class="text-slate-400 text-xs font-bold border-b border-gray-100 uppercase tracking-wider">
                  <th class="pb-3 pr-2">Kode Tiket</th>
                  <th class="pb-3 pr-2">Tanggal</th>
                  <th class="pb-3 pr-2">Korban</th>
                  <th class="pb-3 pr-2">Kategori</th>
                  <th class="pb-3 pr-2">Status</th>
                  <th class="pb-3 text-center">Aksi</th>
                </tr>
              </thead>
              <tbody class="text-sm divide-y divide-gray-100">
                <tr 
                  v-for="rep in recentReports" 
                  :key="rep.id" 
                  class="hover:bg-slate-50/50"
                >
                  <td class="py-3.5 pr-2 font-mono font-bold text-slate-700">{{ rep.code }}</td>
                  <td class="py-3.5 pr-2 text-gray-500 whitespace-nowrap">
                    {{ new Date(rep.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'short' }) }}
                  </td>
                  <td class="py-3.5 pr-2 font-medium text-slate-800">{{ rep.client?.nama_lengkap }}</td>
                  <td class="py-3.5 pr-2 text-gray-600 truncate max-w-[150px]">
                    {{ rep.violence?.bentuk_kekerasan?.join(', ') || '-' }}
                  </td>
                  <td class="py-3.5 pr-2">
                    <span 
                      class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider"
                      :class="{
                        'bg-yellow-100 text-yellow-800': rep.status === 'terlapor',
                        'bg-blue-100 text-blue-800': rep.status === 'diproses',
                        'bg-green-100 text-green-800': rep.status === 'selesai',
                        'bg-red-100 text-red-800': rep.status === 'ditolak',
                      }"
                    >
                      {{ rep.status }}
                    </span>
                  </td>
                  <td class="py-3.5 text-center">
                    <NuxtLink 
                      :to="`/admin/violence-reports/${rep.id}`"
                      class="p-1.5 hover:bg-slate-100 rounded-lg text-slate-600 inline-flex items-center"
                      title="Lihat Detail"
                    >
                      <Eye class="w-4 h-4 text-green-700" />
                    </NuxtLink>
                  </td>
                </tr>
                <tr v-if="recentReports.length === 0">
                  <td colspan="6" class="text-center py-10 text-gray-400 font-semibold">
                    Belum ada data laporan masuk.
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Demographic breakdowns -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          
          <!-- Gender Statistics -->
          <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm space-y-4">
            <h4 class="font-bold text-slate-800 text-sm border-b border-gray-100 pb-2">Demografi Gender Korban</h4>
            <div class="space-y-3">
              <div v-for="(count, gender) in genderStats" :key="gender" class="space-y-1">
                <div class="flex items-center justify-between text-xs font-semibold">
                  <span class="text-slate-600">{{ gender }}</span>
                  <span class="text-slate-800 font-bold">{{ count }} ({{ totalReports > 0 ? Math.round(count / totalReports * 100) : 0 }}%)</span>
                </div>
                <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                  <div 
                    class="bg-green-600 h-full rounded-full transition-all duration-500" 
                    :style="{ width: (totalReports > 0 ? (count / totalReports * 100) : 0) + '%' }"
                  ></div>
                </div>
              </div>
            </div>
          </div>

          <!-- Academic Status Statistics -->
          <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm space-y-4">
            <h4 class="font-bold text-slate-800 text-sm border-b border-gray-100 pb-2">Status Korban</h4>
            <div class="space-y-3 max-h-40 overflow-y-auto pr-1">
              <div v-for="(count, status) in statusDemographics" :key="status" class="space-y-1">
                <div class="flex items-center justify-between text-xs font-semibold">
                  <span class="text-slate-600">{{ status }}</span>
                  <span class="text-slate-800 font-bold">{{ count }}</span>
                </div>
                <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                  <div 
                    class="bg-blue-600 h-full rounded-full transition-all duration-500" 
                    :style="{ width: (totalReports > 0 ? (count / totalReports * 100) : 0) + '%' }"
                  ></div>
                </div>
              </div>
              <div v-if="Object.keys(statusDemographics).length === 0" class="text-center text-xs text-gray-400">
                Tidak ada data demografi.
              </div>
            </div>
          </div>

        </div>

      </div>

      <!-- Right side: Violence Categories stats (Span 4) -->
      <div class="lg:col-span-4 space-y-8">
        
        <!-- Violence Type breakdown -->
        <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm space-y-4">
          <h3 class="font-bold text-slate-800 text-base border-b border-gray-100 pb-3 flex items-center space-x-2">
            <FileWarning class="w-5 h-5 text-green-700" />
            <span>Kategori Kekerasan</span>
          </h3>

          <div class="space-y-4">
            <div v-for="(count, type) in typeStats" :key="type" class="space-y-1.5">
              <div class="flex items-center justify-between text-xs font-bold">
                <span class="text-slate-700">{{ type }}</span>
                <span class="text-slate-800 bg-slate-100 px-2 py-0.5 rounded-md">{{ count }}</span>
              </div>
              <div class="w-full bg-slate-100 h-2.5 rounded-full overflow-hidden">
                <div 
                  class="bg-amber-500 h-full rounded-full transition-all duration-500" 
                  :style="{ width: (totalReports > 0 ? (count / totalReports * 100) : 0) + '%' }"
                ></div>
              </div>
            </div>
            
            <div v-if="Object.keys(typeStats).length === 0" class="text-center py-6 text-xs text-gray-400 font-semibold">
              Belum ada data kekerasan.
            </div>
          </div>
        </div>

        <!-- Quick tips / instructions -->
        <div class="bg-gradient-to-br from-slate-800 to-slate-950 text-white rounded-3xl p-6 space-y-3.5 shadow-md">
          <h4 class="font-bold text-yellow-300 text-sm tracking-wider uppercase">Panduan Penanganan</h4>
          <ul class="text-xs text-gray-300 space-y-2 list-disc pl-4 leading-relaxed">
            <li>Lakukan verifikasi berkas dan bukti yang dikirim dalam tempo 1x24 jam.</li>
            <li>Segera hubungi korban atau pendamping pelapor untuk verifikasi awal.</li>
            <li>Semua proses pemanggilan, sidang etik, dan pemberian sanksi harus tercatat.</li>
            <li>Status pemulihan psikologis korban merupakan prioritas tertinggi.</li>
          </ul>
        </div>

      </div>

    </div>

  </div>
</template>
