<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import { 
  Search, 
  AlertCircle, 
  CheckCircle2, 
  Calendar, 
  MapPin, 
  ShieldAlert,
  Clock,
  RefreshCw,
  XCircle,
  FileCheck2
} from 'lucide-vue-next'
import type { ViolenceReport } from '~/types/database'

const route = useRoute()
const supabase = useSupabaseClient()

const ticketInput = ref('')
const searchError = ref('')
const isSearching = ref(false)
const report = ref<ViolenceReport | null>(null)

const queryTicketStatus = async () => {
  const code = ticketInput.value.trim()
  if (!code) return

  // Validate format: PPKS-YYYY-XXXXXXXXXX (case-insensitive regex)
  if (!/^PPKS-\d{4}-[A-Z0-9]{10}$/i.test(code)) {
    searchError.value = 'Format nomor tiket tidak valid. Gunakan format PPKS-YYYY-XXXXXXXXXX.'
    report.value = null
    return
  }

  isSearching.value = true
  searchError.value = ''
  
  try {
    const { data, error } = await supabase
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
      .ilike('code', code)
      .maybeSingle()

    if (error) throw error

    if (!data) {
      searchError.value = 'Laporan tidak ditemukan. Pastikan nomor tiket yang Anda masukkan sudah benar.'
      report.value = null
    } else {
      report.value = data as unknown as ViolenceReport
    }
  } catch (err: any) {
    console.error(err)
    searchError.value = 'Gagal memuat status laporan. Silakan coba sesaat lagi.'
    report.value = null
  } finally {
    isSearching.value = false
  }
}

onMounted(() => {
  const ticket = route.query.ticket as string
  if (ticket) {
    ticketInput.value = ticket
    queryTicketStatus()
  }
})
</script>

<template>
  <div class="max-w-4xl mx-auto px-4 py-10 space-y-10">
    <div class="text-center max-w-2xl mx-auto space-y-2">
      <h1 class="text-3xl font-extrabold text-slate-900">Cek Status Laporan</h1>
      <p class="text-gray-500 text-sm">
        Masukkan nomor tiket laporan Anda untuk memantau proses tindak lanjut yang dilakukan oleh tim SATGAS PPKS.
      </p>
    </div>

    <!-- Search ticket card -->
    <div class="bg-white border border-gray-100 rounded-3xl p-6 sm:p-8 shadow-sm max-w-2xl mx-auto">
      <form @submit.prevent="queryTicketStatus" class="space-y-4">
        <div class="space-y-1.5">
          <label class="block text-sm font-bold text-gray-700">Nomor Tiket Laporan</label>
          <div class="flex flex-col sm:flex-row gap-3">
            <div class="relative flex-1">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <Search class="h-5 w-5 text-gray-400" />
              </div>
              <input 
                type="text" 
                v-model="ticketInput"
                placeholder="Contoh: PPKS-2026-ABC123XYZ0" 
                class="block w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:bg-white focus:border-[#0a5c36] focus:ring-1 focus:ring-[#0a5c36] transition-colors uppercase text-sm"
                required
              />
            </div>
            <button 
              type="submit"
              :disabled="isSearching"
              class="px-6 py-3 bg-[#0a5c36] hover:bg-[#074026] text-white font-bold rounded-xl transition-all shadow-sm flex items-center justify-center space-x-2 shrink-0 disabled:opacity-60 text-sm"
            >
              <RefreshCw v-if="isSearching" class="w-4 h-4 animate-spin" />
              <span>Periksa Status</span>
            </button>
          </div>
        </div>

        <p v-if="searchError" class="text-xs text-red-600 font-semibold flex items-center space-x-1.5">
          <AlertCircle class="w-4 h-4 shrink-0" />
          <span>{{ searchError }}</span>
        </p>
      </form>
    </div>

    <!-- Tracking Results details -->
    <div v-if="report" class="space-y-8 animate-fade-in">
      
      <!-- Status Progress Track -->
      <div class="bg-white border border-slate-100 rounded-3xl p-6 sm:p-8 shadow-sm space-y-6">
        <h3 class="font-bold text-slate-800 text-base border-b border-slate-50 pb-3 flex items-center space-x-2">
          <Clock class="w-5 h-5 text-[#0a5c36]" />
          <span>Tahapan Tindak Lanjut</span>
        </h3>

        <!-- Flow diagram depending on status -->
        <div class="grid grid-cols-4 gap-4 max-w-xl mx-auto text-center pt-2 relative">
          <!-- Connector line -->
          <div class="absolute h-0.5 bg-gray-200 left-8 right-8 top-5 -z-10"></div>
          
          <!-- Step 1: Terlapor -->
          <div class="flex flex-col items-center space-y-2">
            <div 
              class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm border-2"
              :class="{
                'bg-[#0a5c36] border-[#0a5c36] text-white shadow-sm': report.status === 'terlapor',
                'bg-green-50 border-[#0a5c36] text-[#0a5c36]': ['diproses', 'selesai'].includes(report.status),
                'bg-gray-100 border-gray-300 text-gray-500': report.status === 'ditolak'
              }"
            >
              <FileCheck2 class="w-4 h-4" />
            </div>
            <span class="text-[10px] sm:text-xs font-semibold text-gray-600">Terlapor</span>
          </div>

          <!-- Step 2: Diproses / Ditolak -->
          <div v-if="report.status === 'ditolak'" class="flex flex-col items-center space-y-2 col-span-2">
            <div class="w-10 h-10 rounded-full bg-red-600 border-red-600 text-white flex items-center justify-center font-bold text-sm shadow-sm">
              <XCircle class="w-4 h-4" />
            </div>
            <span class="text-[10px] sm:text-xs font-semibold text-red-600">Ditolak</span>
          </div>
          
          <template v-else>
            <!-- Step 2: Diproses -->
            <div class="flex flex-col items-center space-y-2">
              <div 
                class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm border-2"
                :class="{
                  'bg-blue-600 border-blue-600 text-white shadow-sm': report.status === 'diproses',
                  'bg-green-50 border-[#0a5c36] text-[#0a5c36]': report.status === 'selesai',
                  'bg-white border-gray-300 text-gray-400': report.status === 'terlapor'
                }"
              >
                <RefreshCw class="w-4 h-4" :class="{ 'animate-spin': report.status === 'diproses' }" />
              </div>
              <span class="text-[10px] sm:text-xs font-semibold text-gray-600">Diproses</span>
            </div>

            <!-- Step 3: Selesai -->
            <div class="flex flex-col items-center space-y-2 col-span-2">
              <div 
                class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm border-2"
                :class="{
                  'bg-[#0a5c36] border-[#0a5c36] text-white shadow-sm': report.status === 'selesai',
                  'bg-white border-gray-300 text-gray-400': report.status !== 'selesai'
                }"
              >
                <CheckCircle2 class="w-4 h-4" />
              </div>
              <span class="text-[10px] sm:text-xs font-semibold text-gray-600">Selesai</span>
            </div>
          </template>
        </div>

        <div class="bg-slate-50 border border-slate-100 p-4 rounded-2xl text-xs sm:text-sm text-slate-700 leading-relaxed">
          <p v-if="report.status === 'terlapor'">
            <strong>Status: Terlapor.</strong> Laporan Anda telah kami terima dan berada dalam antrean penelaahan awal oleh tim SATGAS PPKS. Kami akan segera menghubungi Anda untuk melakukan verifikasi informasi.
          </p>
          <p v-else-if="report.status === 'diproses'">
            <strong>Status: Diproses.</strong> Laporan Anda sedang ditindaklanjuti secara aktif. Tim SATGAS sedang melakukan investigasi, pengumpulan keterangan saksi/bukti, dan memberikan pendampingan psikologis kepada korban.
          </p>
          <p v-else-if="report.status === 'ditolak'">
            <strong>Status: Ditolak.</strong> Laporan Anda ditolak setelah melalui tahap penelaahan awal. Hal ini biasanya dikarenakan laporan tidak masuk dalam ranah kekerasan seksual regulasi PPKS, atau bukti yang diberikan tidak memadai.
          </p>
          <p v-else-if="report.status === 'selesai'">
            <strong>Status: Selesai.</strong> Proses penanganan kasus kekerasan seksual telah selesai ditangani. Sidang etik telah terlaksana, rekomendasi sanksi telah dikeluarkan untuk pelaku, dan proses pemulihan bagi korban berjalan sesuai rencana.
          </p>
        </div>
      </div>

      <!-- Report Details Card summary -->
      <div class="bg-white border border-slate-100 rounded-3xl p-6 sm:p-8 shadow-sm space-y-6">
        <h3 class="font-bold text-slate-800 text-base border-b border-slate-50 pb-3 flex items-center space-x-2">
          <ShieldAlert class="w-5 h-5 text-[#0a5c36]" />
          <span>Ringkasan Informasi Laporan</span>
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
          <div class="space-y-1">
            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Nomor Tiket</p>
            <p class="font-mono font-bold text-slate-800 text-base">{{ report.code }}</p>
          </div>
          <div class="space-y-1">
            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Tanggal Masuk Laporan</p>
            <p class="text-slate-800 font-medium flex items-center space-x-1">
              <Calendar class="w-4 h-4 text-[#0a5c36]" />
              <span>{{ new Date(report.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' }) }} WIB</span>
            </p>
          </div>
          
          <div class="space-y-1">
            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Inisial Korban</p>
            <!-- Censored for security -->
            <p class="text-slate-800 font-medium">{{ report.client?.nama_lengkap.substring(0, 1) + '***' + report.client?.nama_lengkap.substring(report.client.nama_lengkap.length - 1) }} ({{ report.client?.status }})</p>
          </div>
          <div class="space-y-1">
            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Kategori Kekerasan</p>
            <!-- shapes join -->
            <p class="text-slate-800 font-medium">
              {{ report.violence?.bentuk_kekerasan?.join(', ') || '-' }}
            </p>
          </div>

          <div class="space-y-1">
            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Lokasi Kejadian</p>
            <p class="text-slate-800 font-medium flex items-center space-x-1">
              <MapPin class="w-4 h-4 text-[#0a5c36]" />
              <span>{{ report.violence?.lokasi_kejadian }}</span>
            </p>
          </div>
          <div class="space-y-1">
            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Waktu Kejadian</p>
            <p class="text-slate-800 font-medium">
              {{ new Date(report.violence?.waktu_kejadian || '').toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) }}
            </p>
          </div>

          <div class="sm:col-span-2 space-y-1">
            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Jenis Kekerasan Spesifik</p>
            <p class="text-slate-800 font-medium">
              {{ report.violence?.jenis_kekerasan?.join(', ') || '-' }}
            </p>
          </div>

          <div class="sm:col-span-2 space-y-1">
            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Deskripsi Kejadian (Redaksi Awal)</p>
            <p class="text-slate-700 italic bg-slate-50 border border-slate-100 p-4 rounded-xl text-xs leading-relaxed whitespace-pre-line">
              {{ report.violence?.deskripsi_kekerasan }}
            </p>
          </div>
        </div>
      </div>

    </div>
  </div>
</template>
