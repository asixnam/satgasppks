<script setup lang="ts">
import { ref, computed, watch } from 'vue'
import { useRouter } from 'vue-router'
import { 
  Upload, 
  Trash2, 
  AlertCircle
} from 'lucide-vue-next'

const supabase = useSupabaseClient()
const router = useRouter()

const currentStep = ref(1)
const isSubmitting = ref(false)
const errorMessage = ref('')

// Form state (matching exactly the keys in Laravel)
const clientForm = ref({
  nama_lengkap: '',
  jenis_kelamin: '',
  status_korban: '',
  kategori_disable: '',
  status: '',
  sumber_informasi: ''
})

const reporterForm = ref({
  hubungan_pelapor_dengan_pelaku: '',
  nama_lengkap: '',
  tempat_lahir: '',
  tanggal_lahir: '',
  jenis_kelamin: '',
  usia: null as number | null,
  status_pelapor: '',
  no_telepon: '',
  email: '',
  alamat: '',
  keterangan_tambahan: ''
})

// Auto-fill age from birthdate
watch(() => reporterForm.value.tanggal_lahir, (newVal) => {
  if (!newVal) {
    reporterForm.value.usia = null
    return
  }
  const birthDate = new Date(newVal)
  if (isNaN(birthDate.getTime())) {
    reporterForm.value.usia = null
    return
  }
  const today = new Date()
  let age = today.getFullYear() - birthDate.getFullYear()
  const m = today.getMonth() - birthDate.getMonth()
  if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
    age--
  }
  reporterForm.value.usia = age >= 0 ? age : null
})

const perpetratorForm = ref({
  hubungan_dengan_korban: '',
  nama: '',
  telepon: '',
  jenis_kelamin: '',
  keterangan: ''
})

const violenceForm = ref({
  bentuk_kekerasan: [] as string[],
  jenis_kekerasan: [] as string[],
  lokasi_kejadian: '',
  waktu_kejadian: '',
  deskripsi_kekerasan: ''
})

// File upload state
const selectedFiles = ref<File[]>([])
const fileError = ref('')
const fileInput = ref<HTMLInputElement | null>(null)

const triggerFileInput = () => {
  fileInput.value?.click()
}

const handleFileChange = (e: Event) => {
  const target = e.target as HTMLInputElement
  if (!target.files) return

  const files = Array.from(target.files)
  
  if (selectedFiles.value.length + files.length > 5) {
    fileError.value = 'Maksimal upload 5 file bukti.'
    return
  }

  for (const file of files) {
    if (file.size > 5 * 1024 * 1024) {
      fileError.value = `File "${file.name}" terlalu besar (maksimal 5MB).`
      return
    }
  }

  selectedFiles.value = [...selectedFiles.value, ...files]
  fileError.value = ''
}

const removeFile = (idx: number) => {
  selectedFiles.value.splice(idx, 1)
}

// Dropdown options (from Laravel)
const disableOptions = ['Tuli', 'Daksa', 'Bisu', 'Netra', 'Grahita', 'Rungu', 'Mental', 'Lainnya']
const statusOptions = ['Mahasiswa', 'Masyarakat', 'Atasan', 'Dosen', 'Tendik', 'Pegawai Lainnya']
const hubunganPelaporOptions = ['Teman', 'Masyarakat', 'Tendik', 'Rekan Kerja', 'Atasan', 'Dosen', 'Tenaga Kerja', 'Lainnya']
const hubunganPelakuOptions = ['Teman', 'Dosen', 'Rekan Kerja', 'Pacar', 'Keluarga', 'Lainnya']

// Violence sub-options
const bentukKekerasanOptions = [
  { value: 'Fisik', label: 'Kekerasan Fisik' },
  { value: 'Psikis', label: 'Kekerasan Psikis' },
  { value: 'Seksual', label: 'Kekerasan Seksual' },
  { value: 'Perundungan', label: 'Perundungan (Bullying)' },
  { value: 'Diskriminasi', label: 'Diskriminasi & Intoleransi' }
]

const jenisKekerasanMapping: Record<string, string[]> = {
  Fisik: ['Tawuran', 'Penganiayaan', 'Perkelahian', 'Ekspoitasi Ekonomi', 'Pembunuhan'],
  Psikis: ['Pengucilan Sosial', 'Penolakan', 'Penghinaan', 'Penyebaran rumor', 'Intimidasi'],
  Perundungan: ['Penolakan', 'Penghinaan'],
  Seksual: [
    'Ujaran diskriminatif', 'Ekshibisionisme', 'Ucapan seksual', 'Tatapan seksual', 'Pesan seksual',
    'Rekaman tanpa izin', 'Unggah tanpa izin', 'Sebar informasi pribadi', 'Mengintip', 'Rayuan seksual',
    'Sanksi seksual', 'Sentuhan fisik', 'Buka pakaian', 'Pemaksaan seksual', 'Budaya kampus berbahaya',
    'Percobaan perkosaan', 'Perkosaan', 'Paksa aborsi', 'Paksa hamil', 'Sterilisasi paksa',
    'Penyiksaan seksual', 'Eksploitasi seksual', 'Perbudakan seksual', 'Perdagangan orang', 'Pembiaran kekerasan'
  ],
  Diskriminasi: [
    'Penolakan', 'Intimidasi', 'Larangan berkeyakinan', 'Pemaksaan/larangan perayaan & donasi',
    'Penghalangan hak mahasiswa', 'Diskriminasi/intoleransi lainnya'
  ]
}

const availableJenisKekerasan = computed(() => {
  const result = new Set<string>()
  violenceForm.value.bentuk_kekerasan.forEach(bentuk => {
    if (jenisKekerasanMapping[bentuk]) {
      jenisKekerasanMapping[bentuk].forEach(jenis => result.add(jenis))
    }
  })
  return Array.from(result)
})

// Generate code format: PPKS-YYYY-XXXXXXXXXX
const generateTicketCode = () => {
  const year = new Date().getFullYear()
  const randomChars = Math.random().toString(36).substring(2, 12).toUpperCase()
  return `PPKS-${year}-${randomChars}`
}

// Upload evidence files to Supabase Storage
const uploadEvidenceFiles = async () => {
  const paths: string[] = []
  for (let i = 0; i < selectedFiles.value.length; i++) {
    const file = selectedFiles.value[i]
    const fileExt = file.name.split('.').pop()
    const filePath = `evidence_${Date.now()}_${i}_${Math.random().toString(36).substring(7)}.${fileExt}`
    
    const { data, error } = await supabase.storage
      .from('evidence')
      .upload(filePath, file)
      
    if (error) throw error
    paths.push(data.path)
  }
  return paths
}

// Submit Form
const submitReport = async () => {
  // Validate steps data
  if (!clientForm.value.nama_lengkap || !clientForm.value.jenis_kelamin || !clientForm.value.status_korban || !clientForm.value.status) {
    errorMessage.value = 'Mohon lengkapi semua field wajib di tab Data Klien.'
    currentStep.value = 1
    return
  }
  if (!reporterForm.value.hubungan_pelapor_dengan_pelaku || !reporterForm.value.nama_lengkap || !reporterForm.value.tempat_lahir || !reporterForm.value.tanggal_lahir || !reporterForm.value.jenis_kelamin || !reporterForm.value.usia || !reporterForm.value.status_pelapor || !reporterForm.value.no_telepon || !reporterForm.value.email || !reporterForm.value.alamat) {
    errorMessage.value = 'Mohon lengkapi semua field wajib di tab Data Pelapor.'
    currentStep.value = 2
    return
  }
  if (!perpetratorForm.value.hubungan_dengan_korban || !perpetratorForm.value.nama || !perpetratorForm.value.jenis_kelamin || !perpetratorForm.value.keterangan) {
    errorMessage.value = 'Mohon lengkapi semua field wajib di tab Data Pelaku.'
    currentStep.value = 3
    return
  }
  if (violenceForm.value.bentuk_kekerasan.length === 0 || violenceForm.value.jenis_kekerasan.length === 0 || !violenceForm.value.lokasi_kejadian || !violenceForm.value.waktu_kejadian || !violenceForm.value.deskripsi_kekerasan) {
    errorMessage.value = 'Mohon lengkapi semua field wajib di tab Data Kekerasan.'
    currentStep.value = 4
    return
  }

  isSubmitting.value = true
  errorMessage.value = ''

  try {
    // 1. Upload files if any
    let uploadedFilePaths: string[] = []
    if (selectedFiles.value.length > 0) {
      uploadedFilePaths = await uploadEvidenceFiles()
    }

    // 2. Insert Client
    const { data: client, error: clientErr } = await supabase
      .from('clients')
      .insert({
        nama_lengkap: clientForm.value.nama_lengkap,
        jenis_kelamin: clientForm.value.jenis_kelamin,
        status_korban: clientForm.value.status_korban,
        kategori_disable: clientForm.value.status_korban === 'Disable' ? clientForm.value.kategori_disable : null,
        status: clientForm.value.status,
        sumber_informasi: clientForm.value.sumber_informasi || null
      })
      .select('id')
      .single()

    if (clientErr) throw clientErr

    // 3. Insert Reporter
    const { data: reporter, error: reporterErr } = await supabase
      .from('reporters')
      .insert({
        hubungan_pelapor_dengan_pelaku: reporterForm.value.hubungan_pelapor_dengan_pelaku,
        nama_lengkap: reporterForm.value.nama_lengkap,
        tempat_lahir: reporterForm.value.tempat_lahir,
        tanggal_lahir: reporterForm.value.tanggal_lahir,
        jenis_kelamin: reporterForm.value.jenis_kelamin,
        usia: Number(reporterForm.value.usia),
        status_pelapor: reporterForm.value.status_pelapor,
        no_telepon: reporterForm.value.no_telepon,
        email: reporterForm.value.email,
        alamat: reporterForm.value.alamat,
        keterangan_tambahan: reporterForm.value.keterangan_tambahan || null
      })
      .select('id')
      .single()

    if (reporterErr) throw reporterErr

    // 4. Insert Perpetrator
    const { data: perpetrator, error: perpetratorErr } = await supabase
      .from('perpetrators')
      .insert({
        hubungan_dengan_korban: perpetratorForm.value.hubungan_dengan_korban,
        nama: perpetratorForm.value.nama,
        telepon: perpetratorForm.value.telepon || null,
        jenis_kelamin: perpetratorForm.value.jenis_kelamin,
        keterangan: perpetratorForm.value.keterangan,
        upload_bukti: uploadedFilePaths.length > 0 ? uploadedFilePaths : null
      })
      .select('id')
      .single()

    if (perpetratorErr) throw perpetratorErr

    // 5. Insert Violence details
    const { data: violence, error: violenceErr } = await supabase
      .from('violences')
      .insert({
        jenis_kekerasan: violenceForm.value.jenis_kekerasan,
        bentuk_kekerasan: violenceForm.value.bentuk_kekerasan,
        lokasi_kejadian: violenceForm.value.lokasi_kejadian,
        waktu_kejadian: new Date(violenceForm.value.waktu_kejadian).toISOString(),
        deskripsi_kekerasan: violenceForm.value.deskripsi_kekerasan
      })
      .select('id')
      .single()

    if (violenceErr) throw violenceErr

    // 6. Generate unique ticket code
    const ticketCode = generateTicketCode()

    // 7. Insert main Violence Report
    const { error: reportErr } = await supabase
      .from('violence_reports')
      .insert({
        id_client: client.id,
        id_reporter: reporter.id,
        id_perpetrator: perpetrator.id,
        id_violence: violence.id,
        status: 'terlapor',
        code: ticketCode
      })

    if (reportErr) throw reportErr

    // Redirect to success page
    router.push({
      path: '/lapor-kekerasan/success',
      query: { ticket: ticketCode }
    })

  } catch (err: any) {
    console.error('Error submitting report:', err)
    errorMessage.value = err.message || 'Terjadi kesalahan saat menyimpan laporan. Silakan coba kembali.'
  } finally {
    isSubmitting.value = false
  }
}
</script>

<template>
  <div class="container mx-auto px-4 py-8 max-w-5xl">
    <!-- Error message banner -->
    <div v-if="errorMessage" class="mb-6 bg-red-50 border border-red-200 rounded-2xl p-4 flex items-start space-x-3 text-sm">
      <AlertCircle class="w-5 h-5 shrink-0 text-red-600 mt-0.5" />
      <div>
        <h4 class="text-red-800 font-bold mb-1">Terdapat kesalahan dalam form:</h4>
        <p class="text-red-700 font-semibold">{{ errorMessage }}</p>
      </div>
    </div>

    <!-- Main Card -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
      
      <!-- Header -->
      <div class="border-b border-slate-100 px-6 py-5 flex justify-between items-center bg-slate-50/50">
        <h3 class="text-lg font-extrabold text-slate-800 tracking-tight">Buat Laporan Kekerasan Baru</h3>
        <NuxtLink to="/" class="bg-slate-200 hover:bg-slate-350 text-slate-700 px-4 py-2 rounded-xl text-xs font-bold transition flex items-center shrink-0">
          <i class="fas fa-arrow-left mr-2"></i>Kembali
        </NuxtLink>
      </div>

      <form @submit.prevent="submitReport" class="p-6 sm:p-8 space-y-6">
        
        <!-- Tab Navigation -->
        <div class="border-b border-slate-100 pb-2">
          <nav class="flex space-x-6 sm:space-x-8 overflow-x-auto">
            <button 
              type="button" 
              @click="currentStep = 1" 
              class="tab-btn py-2 px-1 border-b-2 font-bold text-xs sm:text-sm transition-all flex items-center shrink-0"
              :class="currentStep === 1 ? 'border-[#0a5c36] text-[#0a5c36]' : 'border-transparent text-slate-400 hover:text-slate-600'"
            >
              <i class="fas fa-user mr-2"></i>Data Klien
            </button>
            
            <button 
              type="button" 
              @click="currentStep = 2" 
              class="tab-btn py-2 px-1 border-b-2 font-bold text-xs sm:text-sm transition-all flex items-center shrink-0"
              :class="currentStep === 2 ? 'border-[#0a5c36] text-[#0a5c36]' : 'border-transparent text-slate-400 hover:text-slate-600'"
            >
              <i class="fas fa-user-tie mr-2"></i>Data Pelapor
            </button>

            <button 
              type="button" 
              @click="currentStep = 3" 
              class="tab-btn py-2 px-1 border-b-2 font-bold text-xs sm:text-sm transition-all flex items-center shrink-0"
              :class="currentStep === 3 ? 'border-[#0a5c36] text-[#0a5c36]' : 'border-transparent text-slate-400 hover:text-slate-600'"
            >
              <i class="fas fa-user-times mr-2"></i>Data Pelaku
            </button>

            <button 
              type="button" 
              @click="currentStep = 4" 
              class="tab-btn py-2 px-1 border-b-2 font-bold text-xs sm:text-sm transition-all flex items-center shrink-0"
              :class="currentStep === 4 ? 'border-[#0a5c36] text-[#0a5c36]' : 'border-transparent text-slate-400 hover:text-slate-600'"
            >
              <i class="fas fa-exclamation-triangle mr-2"></i>Data Kekerasan
            </button>
          </nav>
        </div>

        <!-- Tab Contents -->

        <!-- TAB 1: CLIENT DATA (KORBAN) -->
        <div v-show="currentStep === 1" class="space-y-6 animate-fade-in">
          <h5 class="text-base font-bold text-slate-800 border-l-4 border-[#0a5c36] pl-2.5">Informasi Klien (Korban)</h5>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
              <label class="form-label-clean">Nama Lengkap Korban <span class="text-red-500">*</span></label>
              <input 
                type="text" 
                v-model="clientForm.nama_lengkap" 
                class="form-input-clean" 
                placeholder="Nama lengkap korban"
                required 
              />
            </div>

            <div>
              <label class="form-label-clean">Jenis Kelamin <span class="text-red-500">*</span></label>
              <select 
                v-model="clientForm.jenis_kelamin" 
                class="form-input-clean bg-white" 
                required
              >
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>

            <div>
              <label class="form-label-clean">Status Korban (Disabilitas) <span class="text-red-500">*</span></label>
              <select 
                v-model="clientForm.status_korban" 
                class="form-input-clean bg-white" 
                required
              >
                <option value="">Pilih Status</option>
                <option value="Disable">Disable</option>
                <option value="Tidak">Tidak</option>
              </select>
            </div>

            <div>
              <label class="form-label-clean">Kategori Disable</label>
              <select 
                v-model="clientForm.kategori_disable" 
                :disabled="clientForm.status_korban !== 'Disable'"
                class="form-input-clean bg-white"
              >
                <option value="">-- Pilih Kategori --</option>
                <option v-for="opt in disableOptions" :key="opt" :value="opt">{{ opt }}</option>
              </select>
            </div>

            <div class="md:col-span-2">
              <label class="form-label-clean">Status Akademik Korban <span class="text-red-500">*</span></label>
              <select 
                v-model="clientForm.status" 
                class="form-input-clean bg-white" 
                required
              >
                <option value="">-- Pilih Status --</option>
                <option v-for="opt in statusOptions" :key="opt" :value="opt">{{ opt }}</option>
              </select>
            </div>

            <div class="md:col-span-2">
              <label class="form-label-clean">Sumber Informasi</label>
              <textarea 
                v-model="clientForm.sumber_informasi" 
                rows="3" 
                placeholder="Tuliskan dari mana informasi kekerasan diperoleh..."
                class="form-input-clean"
              ></textarea>
            </div>
          </div>
        </div>

        <!-- TAB 2: REPORTER DATA (PELAPOR) -->
        <div v-show="currentStep === 2" class="space-y-6 animate-fade-in">
          <h5 class="text-base font-bold text-slate-800 border-l-4 border-[#0a5c36] pl-2.5">Informasi Pelapor</h5>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
              <label class="form-label-clean">Hubungan Pelapor dengan Pelaku <span class="text-red-500">*</span></label>
              <select 
                v-model="reporterForm.hubungan_pelapor_dengan_pelaku" 
                class="form-input-clean bg-white" 
                required
              >
                <option value="">Pilih Hubungan</option>
                <option v-for="opt in hubunganPelaporOptions" :key="opt" :value="opt">{{ opt }}</option>
              </select>
            </div>

            <div>
              <label class="form-label-clean">Nama Lengkap Pelapor <span class="text-red-500">*</span></label>
              <input 
                type="text" 
                v-model="reporterForm.nama_lengkap" 
                class="form-input-clean" 
                placeholder="Nama lengkap pelapor"
                required 
              />
            </div>

            <div>
              <label class="form-label-clean">Tempat Lahir <span class="text-red-500">*</span></label>
              <input 
                type="text" 
                v-model="reporterForm.tempat_lahir" 
                class="form-input-clean" 
                placeholder="Kota tempat lahir"
                required 
              />
            </div>

            <div>
              <label class="form-label-clean">Tanggal Lahir <span class="text-red-500">*</span></label>
              <input 
                type="date" 
                v-model="reporterForm.tanggal_lahir" 
                class="form-input-clean" 
                required 
              />
            </div>

            <div>
              <label class="form-label-clean">Jenis Kelamin <span class="text-red-500">*</span></label>
              <select 
                v-model="reporterForm.jenis_kelamin" 
                class="form-input-clean bg-white" 
                required
              >
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>

            <div>
              <label class="form-label-clean">Usia <span class="text-red-500">*</span></label>
              <input 
                type="number" 
                v-model="reporterForm.usia" 
                class="form-input-clean" 
                placeholder="Usia (dalam tahun)"
                required 
              />
            </div>

            <div>
              <label class="form-label-clean">Status Pelapor <span class="text-red-500">*</span></label>
              <select 
                v-model="reporterForm.status_pelapor" 
                class="form-input-clean bg-white" 
                required
              >
                <option value="">-- Pilih Status --</option>
                <option v-for="opt in statusOptions" :key="opt" :value="opt">{{ opt }}</option>
              </select>
            </div>

            <div>
              <label class="form-label-clean">No. Telepon / WhatsApp <span class="text-red-500">*</span></label>
              <input 
                type="text" 
                v-model="reporterForm.no_telepon" 
                placeholder="Contoh: 08877..."
                class="form-input-clean" 
                required 
              />
            </div>

            <div class="md:col-span-2">
              <label class="form-label-clean">Email <span class="text-red-500">*</span></label>
              <input 
                type="email" 
                v-model="reporterForm.email" 
                class="form-input-clean" 
                placeholder="Contoh: nama@gmail.com"
                required 
              />
            </div>

            <div class="md:col-span-2">
              <label class="form-label-clean">Alamat Domisili <span class="text-red-500">*</span></label>
              <textarea 
                v-model="reporterForm.alamat" 
                rows="3" 
                placeholder="Alamat lengkap pelapor..."
                class="form-input-clean" 
                required
              ></textarea>
            </div>

            <div class="md:col-span-2">
              <label class="form-label-clean">Keterangan Tambahan Kontak</label>
              <textarea 
                v-model="reporterForm.keterangan_tambahan" 
                rows="3" 
                placeholder="Informasi kontak darurat lainnya..."
                class="form-input-clean"
              ></textarea>
            </div>
          </div>
        </div>

        <!-- TAB 3: PERPETRATOR DATA (PELAKU) -->
        <div v-show="currentStep === 3" class="space-y-6 animate-fade-in">
          <h5 class="text-base font-bold text-slate-800 border-l-4 border-[#0a5c36] pl-2.5">Informasi Terlapor (Pelaku)</h5>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
              <label class="form-label-clean">Hubungan dengan Korban <span class="text-red-500">*</span></label>
              <select 
                v-model="perpetratorForm.hubungan_dengan_korban" 
                class="form-input-clean bg-white" 
                required
              >
                <option value="">Pilih Hubungan</option>
                <option v-for="opt in hubunganPelakuOptions" :key="opt" :value="opt">{{ opt }}</option>
              </select>
            </div>

            <div>
              <label class="form-label-clean">Nama Terlapor <span class="text-red-500">*</span></label>
              <input 
                type="text" 
                v-model="perpetratorForm.nama" 
                class="form-input-clean" 
                placeholder="Nama pelaku/terlapor (bisa tulis inisial jika tidak tahu pasti)"
                required 
              />
            </div>

            <div>
              <label class="form-label-clean">No. Telepon Pelaku (Jika Tahu)</label>
              <input 
                type="text" 
                v-model="perpetratorForm.telepon" 
                class="form-input-clean" 
                placeholder="No. telepon pelaku"
              />
            </div>

            <div>
              <label class="form-label-clean">Jenis Kelamin <span class="text-red-500">*</span></label>
              <select 
                v-model="perpetratorForm.jenis_kelamin" 
                class="form-input-clean bg-white" 
                required
              >
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>

            <div class="md:col-span-2">
              <label class="form-label-clean">Ciri Fisik & Keterangan <span class="text-red-500">*</span></label>
              <textarea 
                v-model="perpetratorForm.keterangan" 
                rows="4" 
                placeholder="Deskripsikan penampilan fisik pelaku, seragam, kendaraan, ciri khas, dsb..."
                class="form-input-clean font-normal" 
                required
              ></textarea>
            </div>

            <!-- Upload Bukti -->
            <div class="md:col-span-2 space-y-2">
              <label class="form-label-clean">Upload Bukti Kejadian (Maks 5 File)</label>
              <div class="flex items-center space-x-3">
                <input 
                  type="file" 
                  ref="fileInput"
                  id="bukti-upload" 
                  multiple 
                  class="hidden" 
                  accept="image/*,video/*,audio/*,.pdf,.doc,.docx"
                  @change="handleFileChange" 
                />
                <button 
                  type="button" 
                  @click="triggerFileInput"
                  class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 border border-slate-200 rounded-xl text-xs font-bold text-slate-700 flex items-center space-x-1.5 transition"
                >
                  <Upload class="w-4 h-4 text-slate-500" />
                  <span>Pilih File</span>
                </button>
                <span class="text-xs text-gray-400">Gambar, Video, Audio, PDF, DOCX. Maks 5MB/file.</span>
              </div>
              <p v-if="fileError" class="text-xs text-red-650 font-bold">{{ fileError }}</p>

              <!-- Uploaded files list -->
              <div v-if="selectedFiles.length > 0" class="mt-3 space-y-2 max-w-md">
                <div 
                  v-for="(file, idx) in selectedFiles" 
                  :key="idx"
                  class="flex items-center justify-between p-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs"
                >
                  <span class="text-slate-700 font-medium truncate max-w-[200px]">{{ file.name }}</span>
                  <button 
                    type="button" 
                    @click="removeFile(idx)" 
                    class="text-red-500 hover:text-red-700 p-1"
                  >
                    <Trash2 class="w-4 h-4" />
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- TAB 4: VIOLENCE DATA (KEJADIAN) -->
        <div v-show="currentStep === 4" class="space-y-6 animate-fade-in">
          <h5 class="text-base font-bold text-slate-800 border-l-4 border-[#0a5c36] pl-2.5">Rincian Kejadian Kekerasan</h5>
          
          <div class="space-y-5">
            <!-- Bentuk Kekerasan -->
            <div class="space-y-2">
              <label class="form-label-clean">Bentuk Kekerasan <span class="text-red-500">*</span></label>
              <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                <label 
                  v-for="opt in bentukKekerasanOptions" 
                  :key="opt.value"
                  class="flex items-start space-x-2 p-3 border border-slate-150 rounded-xl hover:bg-slate-50/50 transition cursor-pointer text-xs"
                >
                  <input 
                    type="checkbox" 
                    v-model="violenceForm.bentuk_kekerasan" 
                    :value="opt.value" 
                    class="mt-0.5 rounded text-[#0a5c36] focus:ring-[#0a5c36]" 
                  />
                  <span class="font-bold text-slate-700">{{ opt.label }}</span>
                </label>
              </div>
            </div>

            <!-- Jenis Kekerasan (sub-kategori checkboxes) -->
            <div v-if="availableJenisKekerasan.length > 0" class="space-y-2 pt-4 border-t border-slate-100">
              <label class="form-label-clean">Jenis/Bentuk Spesifik Kekerasan <span class="text-red-500">*</span></label>
              <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2">
                <label 
                  v-for="jenis in availableJenisKekerasan" 
                  :key="jenis"
                  class="flex items-start space-x-2 p-2.5 border border-slate-100 rounded-xl bg-slate-50/40 hover:bg-slate-50 cursor-pointer text-xs"
                >
                  <input 
                    type="checkbox" 
                    v-model="violenceForm.jenis_kekerasan" 
                    :value="jenis" 
                    class="mt-0.5 rounded text-[#0a5c36] focus:ring-[#0a5c36]" 
                  />
                  <span class="text-slate-700 font-medium leading-tight">{{ jenis }}</span>
                </label>
              </div>
            </div>

            <!-- Lokasi dan Waktu -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label class="form-label-clean">Lokasi Kejadian <span class="text-red-500">*</span></label>
                <input 
                  type="text" 
                  v-model="violenceForm.lokasi_kejadian" 
                  placeholder="Contoh: Gedung Kampus / Ruang kelas"
                  class="form-input-clean" 
                  required 
                />
              </div>

              <div>
                <label class="form-label-clean">Waktu Kejadian <span class="text-red-500">*</span></label>
                <input 
                  type="date" 
                  v-model="violenceForm.waktu_kejadian" 
                  class="form-input-clean" 
                  required 
                />
              </div>
            </div>

            <!-- Deskripsi -->
            <div>
              <label class="form-label-clean">Deskripsi & Kronologi Kejadian <span class="text-red-500">*</span></label>
              <textarea 
                v-model="violenceForm.deskripsi_kekerasan" 
                rows="6" 
                placeholder="Ceritakan kronologi kejadian secara lengkap..."
                class="form-input-clean font-normal leading-relaxed"
                required
              ></textarea>
            </div>
          </div>
        </div>

        <!-- Footer Actions -->
        <div class="border-t border-slate-100 pt-6 mt-6 flex justify-between">
          <NuxtLink to="/" class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-6 py-2.5 rounded-xl text-xs font-bold transition flex items-center uppercase tracking-wider">
            Batal
          </NuxtLink>
          <button 
            type="submit" 
            :disabled="isSubmitting"
            class="bg-[#0a5c36] hover:bg-[#074026] text-white px-6 py-2.5 rounded-xl text-xs font-bold transition flex items-center space-x-1.5 uppercase tracking-wider shadow-sm disabled:opacity-50"
          >
            <i class="fas fa-save mr-1.5"></i>
            <span>{{ isSubmitting ? 'Mengirim...' : 'Simpan Laporan' }}</span>
          </button>
        </div>

      </form>
    </div>
  </div>
</template>
