<script setup lang="ts">
import { ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { 
  ChevronLeft, 
  User, 
  Users, 
  HelpCircle, 
  Calendar,
  FileCheck2,
  Clock,
  CheckCircle,
  XCircle,
  FileText,
  Download,
  AlertCircle
} from 'lucide-vue-next'
import type { ViolenceReport } from '~/types/database'

definePageMeta({
  middleware: 'auth',
  layout: 'admin'
})

const route = useRoute()
const router = useRouter()
const supabase = useSupabaseClient()
const reportId = route.params.id

const activeTab = ref('korban')
const updateStatusLoading = ref(false)
const successMsg = ref('')
const errorMsg = ref('')

// Fetch report data
const { data: report, refresh } = await useAsyncData<ViolenceReport>(`admin-report-${reportId}`, async () => {
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
    .eq('id', reportId)
    .single()
  return data as unknown as ViolenceReport
})

// Update status
const changeStatus = async (newStatus: 'terlapor' | 'diproses' | 'ditolak' | 'selesai') => {
  updateStatusLoading.value = true
  successMsg.value = ''
  errorMsg.value = ''

  try {
    const { error } = await supabase
      .from('violence_reports')
      .update({ status: newStatus })
      .eq('id', reportId)

    if (error) throw error
    
    successMsg.value = `Status laporan berhasil diperbarui menjadi "${newStatus}"`
    await refresh()
  } catch (err: any) {
    console.error(err)
    errorMsg.value = 'Gagal memperbarui status laporan. Silakan coba kembali.'
  } finally {
    updateStatusLoading.value = false
  }
}

// Helper to resolve evidence files URLs
const getEvidenceFiles = computed(() => {
  const raw = report.value?.perpetrator?.upload_bukti
  if (!raw) return []
  
  // Stored either as a JSON string array or raw array
  let files: string[] = []
  if (typeof raw === 'string') {
    try {
      files = JSON.parse(raw)
    } catch {
      files = [raw]
    }
  } else if (Array.isArray(raw)) {
    files = raw
  }
  
  return files.map(file => {
    const { data } = supabase.storage.from('evidence').getPublicUrl(file)
    return {
      name: file.split('/').pop() || 'File Bukti',
      url: data.publicUrl
    }
  })
})
</script>

<template>
  <div class="space-y-6">
    <!-- Back Link & Header -->
    <div class="space-y-4">
      <NuxtLink 
        to="/admin/violence-reports" 
        class="inline-flex items-center space-x-1.5 text-green-700 hover:text-green-800 text-sm font-semibold transition-colors"
      >
        <ChevronLeft class="w-4 h-4" />
        <span>Kembali ke Daftar Laporan</span>
      </NuxtLink>

      <div v-if="report" class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
          <h1 class="text-2xl font-black text-slate-800 flex items-center space-x-3">
            <span>Detail Laporan</span>
            <span class="font-mono text-lg font-bold text-slate-400 bg-slate-100 px-2.5 py-0.5 rounded-lg border border-slate-200">{{ report.code }}</span>
          </h1>
          <p class="text-xs text-gray-400 font-semibold mt-1">Masuk pada: {{ new Date(report.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' }) }} WIB</p>
        </div>

        <!-- Status Controller -->
        <div class="flex items-center space-x-2 shrink-0">
          <span class="text-xs font-bold text-slate-500 uppercase mr-1">Ubah Status:</span>
          
          <button 
            @click="changeStatus('terlapor')"
            :disabled="updateStatusLoading || report.status === 'terlapor'"
            class="px-3 py-1.5 rounded-lg text-xs font-bold border transition-all"
            :class="report.status === 'terlapor' ? 'bg-yellow-100 border-yellow-200 text-yellow-800' : 'bg-white border-gray-200 hover:bg-yellow-50 text-yellow-700'"
          >
            Terlapor
          </button>
          
          <button 
            @click="changeStatus('diproses')"
            :disabled="updateStatusLoading || report.status === 'diproses'"
            class="px-3 py-1.5 rounded-lg text-xs font-bold border transition-all"
            :class="report.status === 'diproses' ? 'bg-blue-100 border-blue-200 text-blue-800' : 'bg-white border-gray-200 hover:bg-blue-50 text-blue-700'"
          >
            Diproses
          </button>

          <button 
            @click="changeStatus('selesai')"
            :disabled="updateStatusLoading || report.status === 'selesai'"
            class="px-3 py-1.5 rounded-lg text-xs font-bold border transition-all"
            :class="report.status === 'selesai' ? 'bg-green-100 border-green-200 text-green-800' : 'bg-white border-gray-200 hover:bg-green-50 text-green-700'"
          >
            Selesai
          </button>

          <button 
            @click="changeStatus('ditolak')"
            :disabled="updateStatusLoading || report.status === 'ditolak'"
            class="px-3 py-1.5 rounded-lg text-xs font-bold border transition-all"
            :class="report.status === 'ditolak' ? 'bg-red-100 border-red-200 text-red-800' : 'bg-white border-gray-200 hover:bg-red-50 text-red-700'"
          >
            Ditolak
          </button>
        </div>
      </div>
    </div>

    <!-- Alert notifications -->
    <div v-if="successMsg" class="bg-green-50 border border-green-200 text-green-800 p-4 rounded-xl flex items-start space-x-2 text-sm font-semibold">
      <CheckCircle class="w-5 h-5 shrink-0 text-green-600" />
      <span>{{ successMsg }}</span>
    </div>
    <div v-if="errorMsg" class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-xl flex items-start space-x-2 text-sm font-semibold">
      <AlertCircle class="w-5 h-5 shrink-0 text-red-600" />
      <span>{{ errorMsg }}</span>
    </div>

    <!-- Main View content tabs -->
    <div v-if="report" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
      
      <!-- Left: Navigation Tab Content (Span 8) -->
      <div class="lg:col-span-8 space-y-6">
        
        <!-- Tab Select buttons -->
        <div class="flex border-b border-gray-200">
          <button 
            @click="activeTab = 'korban'"
            class="px-5 py-3 text-sm font-bold border-b-2 -mb-px flex items-center space-x-2 transition-all"
            :class="activeTab === 'korban' ? 'border-green-700 text-green-850' : 'border-transparent text-gray-400 hover:text-gray-600'"
          >
            <User class="w-4 h-4" />
            <span>Klien (Korban)</span>
          </button>
          
          <button 
            @click="activeTab = 'pelapor'"
            class="px-5 py-3 text-sm font-bold border-b-2 -mb-px flex items-center space-x-2 transition-all"
            :class="activeTab === 'pelapor' ? 'border-green-700 text-green-850' : 'border-transparent text-gray-400 hover:text-gray-600'"
          >
            <Users class="w-4 h-4" />
            <span>Pelapor</span>
          </button>

          <button 
            @click="activeTab = 'pelaku'"
            class="px-5 py-3 text-sm font-bold border-b-2 -mb-px flex items-center space-x-2 transition-all"
            :class="activeTab === 'pelaku' ? 'border-green-700 text-green-850' : 'border-transparent text-gray-400 hover:text-gray-600'"
          >
            <HelpCircle class="w-4 h-4" />
            <span>Terlapor (Pelaku)</span>
          </button>

          <button 
            @click="activeTab = 'kejadian'"
            class="px-5 py-3 text-sm font-bold border-b-2 -mb-px flex items-center space-x-2 transition-all"
            :class="activeTab === 'kejadian' ? 'border-green-700 text-green-850' : 'border-transparent text-gray-400 hover:text-gray-600'"
          >
            <Calendar class="w-4 h-4" />
            <span>Rincian Kejadian</span>
          </button>
        </div>

        <!-- Render active tab details -->
        <div class="bg-white border border-gray-100 rounded-3xl p-6 sm:p-8 shadow-sm">
          
          <!-- Tab Korban -->
          <div v-if="activeTab === 'korban'" class="space-y-6">
            <h3 class="font-extrabold text-slate-800 text-lg flex items-center space-x-2">
              <User class="w-5 h-5 text-green-700" />
              <span>Detail Korban</span>
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
              <div class="space-y-1">
                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Nama Lengkap</p>
                <p class="text-slate-800 font-semibold">{{ report.client?.nama_lengkap }}</p>
              </div>
              <div class="space-y-1">
                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Jenis Kelamin</p>
                <p class="text-slate-800 font-semibold">{{ report.client?.jenis_kelamin }}</p>
              </div>
              <div class="space-y-1">
                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Status Korban</p>
                <p class="text-slate-800 font-semibold">{{ report.client?.status }}</p>
              </div>
              <div class="space-y-1">
                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Disabilitas</p>
                <p class="text-slate-800 font-semibold">
                  {{ report.client?.status_korban === 'Disable' ? `Ya (${report.client?.kategori_disable})` : 'Tidak' }}
                </p>
              </div>
              <div class="sm:col-span-2 space-y-1">
                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Sumber Informasi</p>
                <p class="text-slate-700 italic bg-slate-50 p-4 rounded-xl border border-slate-100">{{ report.client?.sumber_informasi || 'Tidak disediakan.' }}</p>
              </div>
            </div>
          </div>

          <!-- Tab Pelapor -->
          <div v-else-if="activeTab === 'pelapor'" class="space-y-6">
            <h3 class="font-extrabold text-slate-800 text-lg flex items-center space-x-2">
              <Users class="w-5 h-5 text-green-700" />
              <span>Detail Pelapor</span>
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
              <div class="space-y-1">
                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Hubungan dengan Pelaku</p>
                <p class="text-slate-800 font-semibold">{{ report.reporter?.hubungan_pelapor_dengan_pelaku }}</p>
              </div>
              <div class="space-y-1">
                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Nama Lengkap</p>
                <p class="text-slate-800 font-semibold">{{ report.reporter?.nama_lengkap }}</p>
              </div>
              <div class="space-y-1">
                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">TTL</p>
                <p class="text-slate-800 font-semibold">{{ report.reporter?.tempat_lahir }}, {{ report.reporter?.tanggal_lahir ? new Date(report.reporter.tanggal_lahir).toLocaleDateString('id-ID') : '-' }}</p>
              </div>
              <div class="space-y-1">
                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Usia / Gender</p>
                <p class="text-slate-800 font-semibold">{{ report.reporter?.usia }} Tahun / {{ report.reporter?.jenis_kelamin }}</p>
              </div>
              <div class="space-y-1">
                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Status Pelapor</p>
                <p class="text-slate-800 font-semibold">{{ report.reporter?.status_pelapor }}</p>
              </div>
              <div class="space-y-1">
                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">No. Telepon / Email</p>
                <p class="text-slate-800 font-semibold">{{ report.reporter?.no_telepon }} / {{ report.reporter?.email }}</p>
              </div>
              <div class="sm:col-span-2 space-y-1">
                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Alamat</p>
                <p class="text-slate-800 bg-slate-50 p-4 rounded-xl border border-slate-100">{{ report.reporter?.alamat }}</p>
              </div>
              <div class="sm:col-span-2 space-y-1">
                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Keterangan Tambahan Kontak</p>
                <p class="text-slate-800 bg-slate-50 p-4 rounded-xl border border-slate-100">{{ report.reporter?.keterangan_tambahan || 'Tidak ada.' }}</p>
              </div>
            </div>
          </div>

          <!-- Tab Pelaku -->
          <div v-else-if="activeTab === 'pelaku'" class="space-y-6">
            <h3 class="font-extrabold text-slate-800 text-lg flex items-center space-x-2">
              <HelpCircle class="w-5 h-5 text-green-700" />
              <span>Detail Terlapor (Pelaku)</span>
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
              <div class="space-y-1">
                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Hubungan dengan Korban</p>
                <p class="text-slate-800 font-semibold">{{ report.perpetrator?.hubungan_dengan_korban }}</p>
              </div>
              <div class="space-y-1">
                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Nama Pelaku</p>
                <p class="text-slate-800 font-semibold">{{ report.perpetrator?.nama }}</p>
              </div>
              <div class="space-y-1">
                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">No. Telepon</p>
                <p class="text-slate-800 font-semibold">{{ report.perpetrator?.telepon || 'Tidak diketahui' }}</p>
              </div>
              <div class="space-y-1">
                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Jenis Kelamin</p>
                <p class="text-slate-800 font-semibold">{{ report.perpetrator?.jenis_kelamin }}</p>
              </div>
              <div class="sm:col-span-2 space-y-1">
                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Ciri Fisik & Keterangan</p>
                <p class="text-slate-800 bg-slate-50 p-4 rounded-xl border border-slate-100 whitespace-pre-line">{{ report.perpetrator?.keterangan }}</p>
              </div>
            </div>
          </div>

          <!-- Tab Kejadian -->
          <div v-else-if="activeTab === 'kejadian'" class="space-y-6">
            <h3 class="font-extrabold text-slate-800 text-lg flex items-center space-x-2">
              <Calendar class="w-5 h-5 text-green-700" />
              <span>Detail Kejadian</span>
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
              <div class="space-y-1">
                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Kategori Kekerasan</p>
                <p class="text-slate-800 font-semibold">{{ report.violence?.bentuk_kekerasan?.join(', ') || '-' }}</p>
              </div>
              <div class="space-y-1">
                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Jenis Kekerasan Spesifik</p>
                <p class="text-slate-800 font-semibold text-xs leading-relaxed">
                  {{ report.violence?.jenis_kekerasan?.join(', ') || '-' }}
                </p>
              </div>
              <div class="space-y-1">
                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Lokasi Kejadian</p>
                <p class="text-slate-800 font-semibold">{{ report.violence?.lokasi_kejadian }}</p>
              </div>
              <div class="space-y-1">
                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Waktu Kejadian</p>
                <p class="text-slate-800 font-semibold">
                  {{ report.violence?.waktu_kejadian ? new Date(report.violence.waktu_kejadian).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) : '-' }}
                </p>
              </div>
              <div class="sm:col-span-2 space-y-1">
                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Deskripsi & Kronologi Lengkap</p>
                <p class="text-slate-800 bg-slate-50 p-4 rounded-xl border border-slate-100 whitespace-pre-line leading-relaxed text-xs">{{ report.violence?.deskripsi_kekerasan }}</p>
              </div>
            </div>
          </div>

        </div>

      </div>

      <!-- Right: Action files & Status updates logs (Span 4) -->
      <div class="lg:col-span-4 space-y-6">
        
        <!-- Files Upload Evidence Widget -->
        <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm space-y-4">
          <h3 class="font-bold text-slate-800 text-sm border-b border-gray-100 pb-2 flex items-center space-x-2">
            <FileText class="w-4 h-4 text-green-700" />
            <span>Berkas Bukti ({{ getEvidenceFiles.length }})</span>
          </h3>

          <div v-if="getEvidenceFiles.length > 0" class="space-y-2">
            <a 
              v-for="(file, idx) in getEvidenceFiles" 
              :key="idx"
              :href="file.url"
              target="_blank"
              download
              class="flex items-center justify-between p-3 bg-slate-50 hover:bg-green-50/20 hover:border-green-300 rounded-xl border border-slate-100 transition-all text-xs group"
            >
              <span class="text-slate-700 font-medium truncate max-w-[200px]">{{ file.name }}</span>
              <Download class="w-4 h-4 text-slate-400 group-hover:text-green-700 shrink-0 ml-2" />
            </a>
          </div>
          
          <div v-else class="text-center py-8 text-gray-400 text-xs font-semibold">
            Tidak ada berkas bukti diunggah.
          </div>
        </div>

        <!-- Secure administration notes -->
        <div class="bg-slate-900 text-white rounded-3xl p-6 space-y-3.5 shadow-md">
          <h4 class="font-bold text-yellow-300 text-xs tracking-wider uppercase">Jaminan Kerahasiaan</h4>
          <p class="text-[11px] text-gray-300 leading-relaxed">
            Sesuai peraturan menteri, seluruh isi berkas investigasi ini bersifat sangat rahasia. Jangan menduplikasi atau mendistribusikan data tanpa izin ketua SATGAS PPKS.
          </p>
        </div>

      </div>

    </div>
  </div>
</template>
