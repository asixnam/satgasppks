<script setup lang="ts">
import { ref, computed } from 'vue'
import { 
  Search, 
  Filter, 
  Download, 
  ChevronLeft, 
  ChevronRight, 
  Eye, 
  FileSpreadsheet,
  AlertCircle
} from 'lucide-vue-next'
import type { ViolenceReport } from '~/types/database'

definePageMeta({
  middleware: 'auth',
  layout: 'admin'
})

const supabase = useSupabaseClient()

// Filter states
const search = ref('')
const statusFilter = ref('')
const genderFilter = ref('')
const typeFilter = ref('')
const startDate = ref('')
const endDate = ref('')

const page = ref(1)
const itemsPerPage = 10

// Fetch reports
const { data: reports, pending, refresh } = await useAsyncData<ViolenceReport[]>('admin-reports-list', async () => {
  const { data } = await supabase
    .from('violence_reports')
    .select(`
      id,
      status,
      code,
      created_at,
      client:id_client(*),
      reporter:id_reporter(*),
      perpetrator:id_perpetrator(*),
      violence:id_violence(*)
    `)
    .order('created_at', { ascending: false })
  return (data as unknown as ViolenceReport[]) || []
})

// Client-side filtering logic
const filteredReports = computed(() => {
  if (!reports.value) return []
  
  return reports.value.filter(r => {
    // 1. Text Search
    if (search.value.trim() !== '') {
      const q = search.value.toLowerCase()
      const matchesCode = r.code.toLowerCase().includes(q)
      const matchesClientName = r.client?.nama_lengkap.toLowerCase().includes(q)
      const matchesReporterName = r.reporter?.nama_lengkap.toLowerCase().includes(q)
      if (!matchesCode && !matchesClientName && !matchesReporterName) return false
    }

    // 2. Status Filter
    if (statusFilter.value && r.status !== statusFilter.value) return false

    // 3. Gender Filter
    if (genderFilter.value && r.client?.jenis_kelamin !== genderFilter.value) return false

    // 4. Type of Violence Filter
    if (typeFilter.value) {
      const shapes = r.violence?.bentuk_kekerasan || []
      if (!shapes.includes(typeFilter.value)) return false
    }

    // 5. Date Range Filter
    if (startDate.value) {
      const start = new Date(startDate.value)
      const reportDate = new Date(r.created_at)
      if (reportDate < start) return false
    }
    if (endDate.value) {
      const end = new Date(endDate.value)
      end.setHours(23, 59, 59, 999) // end of day
      const reportDate = new Date(r.created_at)
      if (reportDate > end) return false
    }

    return true
  })
})

// Pagination
const totalPages = computed(() => Math.ceil(filteredReports.value.length / itemsPerPage))
const paginatedReports = computed(() => {
  const start = (page.value - 1) * itemsPerPage
  const end = start + itemsPerPage
  return filteredReports.value.slice(start, end)
})

// Reset filters
const resetFilters = () => {
  search.value = ''
  statusFilter.value = ''
  genderFilter.value = ''
  typeFilter.value = ''
  startDate.value = ''
  endDate.value = ''
  page.value = 1
}

// CSV Export
const exportToCSV = () => {
  if (filteredReports.value.length === 0) return
  
  const headers = ['Kode Tiket', 'Tanggal Lapor', 'Nama Korban', 'Gender Korban', 'Status Akademik', 'Pelapor', 'Hubungan Pelaku', 'Nama Pelaku', 'Lokasi Kejadian', 'Waktu Kejadian', 'Kategori Kekerasan', 'Status Kasus']
  const rows = filteredReports.value.map(r => [
    r.code,
    new Date(r.created_at).toLocaleDateString('id-ID'),
    r.client?.nama_lengkap || '',
    r.client?.jenis_kelamin || '',
    r.client?.status || '',
    r.reporter?.nama_lengkap || '',
    r.perpetrator?.hubungan_dengan_korban || '',
    r.perpetrator?.nama || '',
    r.violence?.lokasi_kejadian || '',
    r.violence?.waktu_kejadian ? new Date(r.violence.waktu_kejadian).toLocaleDateString('id-ID') : '',
    r.violence?.bentuk_kekerasan?.join('; ') || '',
    r.status
  ])

  let csvContent = "data:text/csv;charset=utf-8," 
    + [headers.join(','), ...rows.map(e => e.map(val => `"${val.replace(/"/g, '""')}"`).join(','))].join('\n')
  
  const encodedUri = encodeURI(csvContent)
  const link = document.createElement('a')
  link.setAttribute('href', encodedUri)
  link.setAttribute('download', `laporan_kekerasan_export_${Date.now()}.csv`)
  document.body.appendChild(link)
  link.click()
  document.body.removeChild(link)
}
</script>

<template>
  <div class="space-y-6">
    <!-- Top Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
      <div>
        <h1 class="text-2xl font-black text-slate-800">Daftar Laporan Kekerasan</h1>
        <p class="text-sm text-gray-500">Kelola aduan kekerasan, update tahapan tindak lanjut, dan ekspor data.</p>
      </div>
      <div class="flex gap-2">
        <button 
          @click="exportToCSV"
          :disabled="filteredReports.length === 0"
          class="px-4 py-2.5 bg-green-700 hover:bg-green-600 disabled:opacity-50 text-white font-bold rounded-xl text-sm transition-colors shadow-md inline-flex items-center space-x-1.5"
        >
          <FileSpreadsheet class="w-4 h-4" />
          <span>Ekspor CSV</span>
        </button>
        <button 
          @click="resetFilters"
          class="px-4 py-2.5 border border-gray-200 rounded-xl hover:bg-white text-sm font-semibold transition-colors"
        >
          Reset Filter
        </button>
      </div>
    </div>

    <!-- Filters Section -->
    <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm space-y-4">
      <div class="flex items-center space-x-2 text-sm font-bold text-slate-700 border-b border-gray-100 pb-2">
        <Filter class="w-4 h-4 text-green-700" />
        <span>Penyaringan Data</span>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
        <!-- Search -->
        <div class="space-y-1.5 lg:col-span-2">
          <label class="block text-xs font-bold text-slate-600">Pencarian Teks</label>
          <div class="relative">
            <input 
              type="text" 
              v-model="search" 
              placeholder="Cari Tiket / Nama..." 
              class="w-full pl-8 pr-3 py-2 bg-slate-50 border border-gray-200 rounded-lg text-xs text-slate-800 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-green-600 transition-colors"
            />
            <Search class="absolute left-2.5 top-2.5 w-3.5 h-3.5 text-gray-400" />
          </div>
        </div>

        <!-- Status -->
        <div class="space-y-1.5">
          <label class="block text-xs font-bold text-slate-600">Status Kasus</label>
          <select 
            v-model="statusFilter"
            class="w-full p-2 bg-slate-50 border border-gray-200 rounded-lg text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-green-600 transition-colors"
          >
            <option value="">Semua Status</option>
            <option value="terlapor">Terlapor</option>
            <option value="diproses">Diproses</option>
            <option value="ditolak">Ditolak</option>
            <option value="selesai">Selesai</option>
          </select>
        </div>

        <!-- Gender -->
        <div class="space-y-1.5">
          <label class="block text-xs font-bold text-slate-600">Gender Korban</label>
          <select 
            v-model="genderFilter"
            class="w-full p-2 bg-slate-50 border border-gray-200 rounded-lg text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-green-600 transition-colors"
          >
            <option value="">Semua Gender</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>
        </div>

        <!-- Violence Type -->
        <div class="space-y-1.5">
          <label class="block text-xs font-bold text-slate-600">Kategori Kekerasan</label>
          <select 
            v-model="typeFilter"
            class="w-full p-2 bg-slate-50 border border-gray-200 rounded-lg text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-green-600 transition-colors"
          >
            <option value="">Semua Kategori</option>
            <option value="Fisik">Fisik</option>
            <option value="Psikis">Psikis</option>
            <option value="Seksual">Seksual</option>
            <option value="Perundungan">Perundungan</option>
            <option value="Diskriminasi">Diskriminasi</option>
          </select>
        </div>

        <!-- Start Date -->
        <div class="space-y-1.5">
          <label class="block text-xs font-bold text-slate-600">Tanggal Mulai</label>
          <input 
            type="date" 
            v-model="startDate" 
            class="w-full p-2 bg-slate-50 border border-gray-200 rounded-lg text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-green-600 transition-colors"
          />
        </div>

        <!-- End Date -->
        <div class="space-y-1.5">
          <label class="block text-xs font-bold text-slate-600">Tanggal Selesai</label>
          <input 
            type="date" 
            v-model="endDate" 
            class="w-full p-2 bg-slate-50 border border-gray-200 rounded-lg text-xs text-slate-800 focus:outline-none focus:bg-white focus:border-green-600 transition-colors"
          />
        </div>
      </div>
    </div>

    <!-- Reports Table Card -->
    <div class="bg-white border border-gray-100 rounded-3xl p-6 sm:p-8 shadow-sm">
      <div v-if="pending" class="space-y-3 py-6 animate-pulse">
        <div class="h-8 bg-slate-100 rounded w-full"></div>
        <div class="h-8 bg-slate-100 rounded w-full" v-for="i in 5" :key="i"></div>
      </div>

      <div v-else>
        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="text-slate-400 text-xs font-bold border-b border-gray-100 uppercase tracking-wider">
                <th class="pb-3 pr-2">Kode Tiket</th>
                <th class="pb-3 pr-2">Tanggal Lapor</th>
                <th class="pb-3 pr-2">Nama Korban</th>
                <th class="pb-3 pr-2">Pelapor</th>
                <th class="pb-3 pr-2">Kategori Kekerasan</th>
                <th class="pb-3 pr-2">Status</th>
                <th class="pb-3 text-center">Aksi</th>
              </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100">
              <tr 
                v-for="rep in paginatedReports" 
                :key="rep.id" 
                class="hover:bg-slate-50/50"
              >
                <td class="py-3.5 pr-2 font-mono font-bold text-slate-700">{{ rep.code }}</td>
                <td class="py-3.5 pr-2 text-gray-500 whitespace-nowrap">
                  {{ new Date(rep.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' }) }}
                </td>
                <td class="py-3.5 pr-2 font-medium text-slate-800">
                  <div class="flex flex-col">
                    <span>{{ rep.client?.nama_lengkap }}</span>
                    <span class="text-[10px] text-gray-400 font-semibold">{{ rep.client?.status }}</span>
                  </div>
                </td>
                <td class="py-3.5 pr-2 text-gray-600">
                  <div class="flex flex-col">
                    <span>{{ rep.reporter?.nama_lengkap }}</span>
                    <span class="text-[10px] text-gray-400 font-semibold">{{ rep.reporter?.status_pelapor }}</span>
                  </div>
                </td>
                <td class="py-3.5 pr-2 text-gray-600">
                  <span class="text-xs font-medium bg-slate-100 text-slate-700 px-2 py-0.5 rounded-md">
                    {{ rep.violence?.bentuk_kekerasan?.join(', ') || '-' }}
                  </span>
                </td>
                <td class="py-3.5 pr-2">
                  <span 
                    class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider"
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
                    class="p-2 hover:bg-slate-100 rounded-xl text-green-700 inline-flex items-center"
                    title="Lihat Detail Laporan"
                  >
                    <Eye class="w-4 h-4" />
                  </NuxtLink>
                </td>
              </tr>
              <tr v-if="filteredReports.length === 0">
                <td colspan="7" class="text-center py-12 text-gray-400 font-semibold">
                  Tidak ada data laporan kekerasan yang cocok dengan filter Anda.
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div v-if="totalPages > 1" class="flex justify-between items-center pt-6 border-t border-gray-100 mt-4">
          <div class="text-xs text-gray-400 font-bold">
            Menampilkan {{ (page - 1) * itemsPerPage + 1 }} - {{ Math.min(page * itemsPerPage, filteredReports.length) }} dari {{ filteredReports.length }} Laporan
          </div>

          <div class="flex items-center space-x-2">
            <button 
              @click="page--" 
              :disabled="page === 1"
              class="p-2 border border-gray-200 rounded-lg hover:bg-slate-100 disabled:opacity-50 disabled:hover:bg-transparent transition-colors"
            >
              <ChevronLeft class="w-4 h-4" />
            </button>
            
            <span class="text-xs font-semibold text-gray-700">Halaman {{ page }} dari {{ totalPages }}</span>

            <button 
              @click="page++" 
              :disabled="page === totalPages"
              class="p-2 border border-gray-200 rounded-lg hover:bg-slate-100 disabled:opacity-50 disabled:hover:bg-transparent transition-colors"
            >
              <ChevronRight class="w-4 h-4" />
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
