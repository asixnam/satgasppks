<script setup lang="ts">
import { ref, computed } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import JSZip from 'jszip'
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
  AlertCircle,
  Loader2,
  Trash2
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

// Dropdown options for editing
const disableOptions = ['Tuli', 'Daksa', 'Bisu', 'Netra', 'Grahita', 'Rungu', 'Mental', 'Lainnya']
const statusOptions = ['Mahasiswa', 'Masyarakat', 'Atasan', 'Dosen', 'Tendik', 'Pegawai Lainnya']
const hubunganPelaporOptions = ['Teman', 'Masyarakat', 'Tendik', 'Rekan Kerja', 'Atasan', 'Dosen', 'Tenaga Kerja', 'Lainnya']
const hubunganPelakuOptions = ['Teman', 'Dosen', 'Rekan Kerja', 'Pacar', 'Keluarga', 'Lainnya']

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

// Edit Form State
const isEditing = ref(false)
const editLoading = ref(false)

const editForm = ref({
  client: {
    nama_lengkap: '',
    jenis_kelamin: 'Laki-laki',
    status: '',
    status_korban: 'Tidak',
    kategori_disable: ''
  },
  reporter: {
    hubungan_pelapor_dengan_pelaku: '',
    nama_lengkap: '',
    tempat_lahir: '',
    tanggal_lahir: '',
    jenis_kelamin: 'Laki-laki',
    usia: 0,
    status_pelapor: '',
    no_telepon: '',
    email: '',
    alamat: '',
    keterangan_tambahan: ''
  },
  perpetrator: {
    hubungan_dengan_korban: '',
    nama: '',
    telepon: '',
    jenis_kelamin: 'Laki-laki',
    keterangan: ''
  },
  violence: {
    bentuk_kekerasan: [] as string[],
    jenis_kekerasan: [] as string[],
    lokasi_kejadian: '',
    waktu_kejadian: '',
    deskripsi_kekerasan: ''
  }
})

const startEdit = () => {
  if (!report.value) return
  
  editForm.value = {
    client: {
      nama_lengkap: report.value.client?.nama_lengkap || '',
      jenis_kelamin: report.value.client?.jenis_kelamin || 'Laki-laki',
      status: report.value.client?.status || '',
      status_korban: report.value.client?.status_korban || 'Tidak',
      kategori_disable: report.value.client?.kategori_disable || ''
    },
    reporter: {
      hubungan_pelapor_dengan_pelaku: report.value.reporter?.hubungan_pelapor_dengan_pelaku || '',
      nama_lengkap: report.value.reporter?.nama_lengkap || '',
      tempat_lahir: report.value.reporter?.tempat_lahir || '',
      tanggal_lahir: report.value.reporter?.tanggal_lahir ? report.value.reporter.tanggal_lahir.substring(0, 10) : '',
      jenis_kelamin: report.value.reporter?.jenis_kelamin || 'Laki-laki',
      usia: report.value.reporter?.usia || 0,
      status_pelapor: report.value.reporter?.status_pelapor || '',
      no_telepon: report.value.reporter?.no_telepon || '',
      email: report.value.reporter?.email || '',
      alamat: report.value.reporter?.alamat || '',
      keterangan_tambahan: report.value.reporter?.keterangan_tambahan || ''
    },
    perpetrator: {
      hubungan_dengan_korban: report.value.perpetrator?.hubungan_dengan_korban || '',
      nama: report.value.perpetrator?.nama || '',
      telepon: report.value.perpetrator?.telepon || '',
      jenis_kelamin: report.value.perpetrator?.jenis_kelamin || 'Laki-laki',
      keterangan: report.value.perpetrator?.keterangan || ''
    },
    violence: {
      bentuk_kekerasan: report.value.violence?.bentuk_kekerasan ? [...report.value.violence.bentuk_kekerasan] : [],
      jenis_kekerasan: report.value.violence?.jenis_kekerasan ? [...report.value.violence.jenis_kekerasan] : [],
      lokasi_kejadian: report.value.violence?.lokasi_kejadian || '',
      waktu_kejadian: report.value.violence?.waktu_kejadian ? report.value.violence.waktu_kejadian.substring(0, 10) : '',
      deskripsi_kekerasan: report.value.violence?.deskripsi_kekerasan || ''
    }
  }
  
  isEditing.value = true
}

const cancelEdit = () => {
  isEditing.value = false
}

const availableJenisKekerasan = computed(() => {
  const result = new Set<string>()
  editForm.value.violence.bentuk_kekerasan.forEach(bentuk => {
    if (jenisKekerasanMapping[bentuk]) {
      jenisKekerasanMapping[bentuk].forEach(jenis => result.add(jenis))
    }
  })
  return Array.from(result)
})

const saveChanges = async () => {
  if (!report.value) return
  editLoading.value = true
  successMsg.value = ''
  errorMsg.value = ''

  try {
    // Run all 4 updates in parallel
    const [clientRes, reporterRes, perpetratorRes, violenceRes] = await Promise.all([
      supabase
        .from('clients')
        .update({
          nama_lengkap: editForm.value.client.nama_lengkap,
          jenis_kelamin: editForm.value.client.jenis_kelamin,
          status: editForm.value.client.status,
          status_korban: editForm.value.client.status_korban,
          kategori_disable: editForm.value.client.status_korban === 'Disable' ? editForm.value.client.kategori_disable : null
        })
        .eq('id', report.value.id_client),
      
      supabase
        .from('reporters')
        .update({
          hubungan_pelapor_dengan_pelaku: editForm.value.reporter.hubungan_pelapor_dengan_pelaku,
          nama_lengkap: editForm.value.reporter.nama_lengkap,
          tempat_lahir: editForm.value.reporter.tempat_lahir,
          tanggal_lahir: editForm.value.reporter.tanggal_lahir || null,
          jenis_kelamin: editForm.value.reporter.jenis_kelamin,
          usia: Number(editForm.value.reporter.usia),
          status_pelapor: editForm.value.reporter.status_pelapor,
          no_telepon: editForm.value.reporter.no_telepon,
          email: editForm.value.reporter.email,
          alamat: editForm.value.reporter.alamat,
          keterangan_tambahan: editForm.value.reporter.keterangan_tambahan || null
        })
        .eq('id', report.value.id_reporter),
      
      supabase
        .from('perpetrators')
        .update({
          hubungan_dengan_korban: editForm.value.perpetrator.hubungan_dengan_korban,
          nama: editForm.value.perpetrator.nama,
          telepon: editForm.value.perpetrator.telepon || null,
          jenis_kelamin: editForm.value.perpetrator.jenis_kelamin,
          keterangan: editForm.value.perpetrator.keterangan
        })
        .eq('id', report.value.id_perpetrator),
      
      supabase
        .from('violences')
        .update({
          bentuk_kekerasan: editForm.value.violence.bentuk_kekerasan,
          jenis_kekerasan: editForm.value.violence.jenis_kekerasan,
          lokasi_kejadian: editForm.value.violence.lokasi_kejadian,
          waktu_kejadian: editForm.value.violence.waktu_kejadian ? new Date(editForm.value.violence.waktu_kejadian).toISOString() : null,
          deskripsi_kekerasan: editForm.value.violence.deskripsi_kekerasan
        })
        .eq('id', report.value.id_violence)
    ])

    // Check for any errors
    if (clientRes.error) throw clientRes.error
    if (reporterRes.error) throw reporterRes.error
    if (perpetratorRes.error) throw perpetratorRes.error
    if (violenceRes.error) throw violenceRes.error

    // Optimistic UI updates
    if (report.value.client) {
      Object.assign(report.value.client, {
        nama_lengkap: editForm.value.client.nama_lengkap,
        jenis_kelamin: editForm.value.client.jenis_kelamin,
        status: editForm.value.client.status,
        status_korban: editForm.value.client.status_korban,
        kategori_disable: editForm.value.client.status_korban === 'Disable' ? editForm.value.client.kategori_disable : null
      })
    }
    if (report.value.reporter) {
      Object.assign(report.value.reporter, {
        hubungan_pelapor_dengan_pelaku: editForm.value.reporter.hubungan_pelapor_dengan_pelaku,
        nama_lengkap: editForm.value.reporter.nama_lengkap,
        tempat_lahir: editForm.value.reporter.tempat_lahir,
        tanggal_lahir: editForm.value.reporter.tanggal_lahir || null,
        jenis_kelamin: editForm.value.reporter.jenis_kelamin,
        usia: Number(editForm.value.reporter.usia),
        status_pelapor: editForm.value.reporter.status_pelapor,
        no_telepon: editForm.value.reporter.no_telepon,
        email: editForm.value.reporter.email,
        alamat: editForm.value.reporter.alamat,
        keterangan_tambahan: editForm.value.reporter.keterangan_tambahan || null
      })
    }
    if (report.value.perpetrator) {
      Object.assign(report.value.perpetrator, {
        hubungan_dengan_korban: editForm.value.perpetrator.hubungan_dengan_korban,
        nama: editForm.value.perpetrator.nama,
        telepon: editForm.value.perpetrator.telepon || null,
        jenis_kelamin: editForm.value.perpetrator.jenis_kelamin,
        keterangan: editForm.value.perpetrator.keterangan
      })
    }
    if (report.value.violence) {
      Object.assign(report.value.violence, {
        bentuk_kekerasan: editForm.value.violence.bentuk_kekerasan,
        jenis_kekerasan: editForm.value.violence.jenis_kekerasan,
        lokasi_kejadian: editForm.value.violence.lokasi_kejadian,
        waktu_kejadian: editForm.value.violence.waktu_kejadian ? new Date(editForm.value.violence.waktu_kejadian).toISOString() : null,
        deskripsi_kekerasan: editForm.value.violence.deskripsi_kekerasan
      })
    }

    successMsg.value = 'Perubahan data laporan berhasil disimpan.'
    isEditing.value = false
    
    // Refresh background silently
    refresh()
  } catch (err: any) {
    console.error('Error saving edits:', err)
    errorMsg.value = 'Gagal menyimpan perubahan: ' + (err.message || err)
  } finally {
    editLoading.value = false
  }
}

// Fetch report data
const { data: report, pending, refresh } = useLazyAsyncData<ViolenceReport>(`admin-report-${reportId}`, async () => {
  const { data } = await supabase
    .from('violence_reports')
    .select(`
      id,
      status,
      code,
      created_at,
      id_client,
      id_reporter,
      id_perpetrator,
      id_violence,
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

// Delete report function
const deleteReport = async () => {
  if (!report.value) return
  if (!confirm(`Apakah Anda yakin ingin menghapus laporan dengan kode ${report.value.code}? Semua data terkait (korban, pelapor, pelaku, rincian kejadian, dan bukti file) akan ikut terhapus secara permanen.`)) return

  updateStatusLoading.value = true
  successMsg.value = ''
  errorMsg.value = ''

  try {
    // 1. Delete files if any
    const raw = report.value.perpetrator?.upload_bukti
    let files: string[] = []
    if (raw) {
      if (typeof raw === 'string') {
        try {
          files = JSON.parse(raw)
        } catch {
          files = [raw]
        }
      } else if (Array.isArray(raw)) {
        files = raw
      }
    }

    if (files.length > 0) {
      try {
        const { error: storageError } = await supabase.storage
          .from('evidence')
          .remove(files)
        if (storageError) {
          console.warn('Failed to delete some evidence files from storage:', storageError)
        }
      } catch (storageErr) {
        console.warn('Storage deletion error:', storageErr)
      }
    }

    // 2. Delete the main report row
    const { error: reportError } = await supabase
      .from('violence_reports')
      .delete()
      .eq('id', report.value.id)

    if (reportError) throw reportError

    // 3. Delete related parents
    const rep = report.value
    if (rep.id_client) {
      await supabase.from('clients').delete().eq('id', rep.id_client)
    }
    if (rep.id_reporter) {
      await supabase.from('reporters').delete().eq('id', rep.id_reporter)
    }
    if (rep.id_perpetrator) {
      await supabase.from('perpetrators').delete().eq('id', rep.id_perpetrator)
    }
    if (rep.id_violence) {
      await supabase.from('violences').delete().eq('id', rep.id_violence)
    }

    successMsg.value = 'Laporan berhasil dihapus! Mengalihkan ke daftar laporan...'
    window.scrollTo({ top: 0, behavior: 'smooth' })
    
    // Redirect after a short delay
    setTimeout(() => {
      router.push('/admin/violence-reports')
    }, 1500)
  } catch (err: any) {
    console.error(err)
    errorMsg.value = err.message || 'Gagal menghapus laporan.'
    window.scrollTo({ top: 0, behavior: 'smooth' })
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
      path: file,
      name: file.split('/').pop() || 'File Bukti',
      url: data.publicUrl
    }
  })
})

const downloadZipLoading = ref(false)

const downloadAllBuktiAsZip = async () => {
  if (!report.value || getEvidenceFiles.value.length === 0) return
  downloadZipLoading.value = true
  successMsg.value = ''
  errorMsg.value = ''
  
  try {
    const zip = new JSZip()
    const files = getEvidenceFiles.value

    for (const file of files) {
      const { data: blob, error } = await supabase.storage
        .from('evidence')
        .download(file.path)
        
      if (error) {
        console.error(`Gagal mengunduh file ${file.path}:`, error)
        continue
      }
      
      zip.file(file.name, blob)
    }

    const content = await zip.generateAsync({ type: 'blob' })
    const clientName = report.value.client?.nama_lengkap || 'Bukti'
    const cleanName = clientName.replace(/[^a-zA-Z0-9]/g, '_')
    
    const link = document.createElement('a')
    link.href = URL.createObjectURL(content)
    link.download = `${cleanName}_Bukti.zip`
    document.body.appendChild(link)
    link.click()
    document.body.removeChild(link)
    successMsg.value = 'Berkas bukti berhasil diunduh sebagai ZIP.'
  } catch (err: any) {
    console.error('Error generating zip:', err)
    errorMsg.value = 'Gagal mengunduh bukti ZIP: ' + (err.message || err)
  } finally {
    downloadZipLoading.value = false
  }
}

const exportToWord = () => {
  if (!report.value) return

  const code = report.value.code || '-'
  const dateStr = report.value.created_at 
    ? new Date(report.value.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' }) 
    : '-'
  const statusStr = (report.value.status || '-').toUpperCase()

  // Korban
  const korbanNama = report.value.client?.nama_lengkap || '-'
  const korbanGender = report.value.client?.jenis_kelamin || '-'
  const korbanStatus = report.value.client?.status || '-'
  const korbanDisabilitas = report.value.client?.status_korban === 'Disable' 
    ? `Ya (${report.value.client?.kategori_disable || ''})` 
    : 'Tidak'
  const korbanInfo = report.value.client?.sumber_informasi || '-'

  // Pelapor
  const pelaporHubungan = report.value.reporter?.hubungan_pelapor_dengan_pelaku || '-'
  const pelaporNama = report.value.reporter?.nama_lengkap || '-'
  const pelaporTTL = `${report.value.reporter?.tempat_lahir || '-'}, ${report.value.reporter?.tanggal_lahir ? new Date(report.value.reporter.tanggal_lahir).toLocaleDateString('id-ID') : '-'}`
  const pelaporUsia = report.value.reporter?.usia ? `${report.value.reporter.usia} Tahun` : '-'
  const pelaporGender = report.value.reporter?.jenis_kelamin || '-'
  const pelaporStatus = report.value.reporter?.status_pelapor || '-'
  const pelaporTelp = report.value.reporter?.no_telepon || '-'
  const pelaporEmail = report.value.reporter?.email || '-'
  const pelaporAlamat = report.value.reporter?.alamat || '-'
  const pelaporKet = report.value.reporter?.keterangan_tambahan || '-'

  // Pelaku
  const pelakuHubungan = report.value.perpetrator?.hubungan_dengan_korban || '-'
  const pelakuNama = report.value.perpetrator?.nama || '-'
  const pelakuTelp = report.value.perpetrator?.telepon || '-'
  const pelakuGender = report.value.perpetrator?.jenis_kelamin || '-'
  const pelakuKet = report.value.perpetrator?.keterangan || '-'

  // Kejadian
  const kejadianKategori = report.value.violence?.bentuk_kekerasan?.join(', ') || '-'
  const kejadianJenis = report.value.violence?.jenis_kekerasan?.join(', ') || '-'
  const kejadianLokasi = report.value.violence?.lokasi_kejadian || '-'
  const kejadianWaktu = report.value.violence?.waktu_kejadian 
    ? new Date(report.value.violence.waktu_kejadian).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) 
    : '-'
  const kejadianKronologi = report.value.violence?.deskripsi_kekerasan || '-'

  const htmlContent = `
    <html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'>
    <head>
      <title>Laporan Kekerasan - ${code}</title>
      <style>
        body { font-family: 'Arial', sans-serif; line-height: 1.6; color: #333; }
        h1 { text-align: center; color: #0a5c36; font-size: 22px; margin-bottom: 5px; }
        h2 { text-align: center; color: #555; font-size: 14px; font-weight: normal; margin-top: 0; margin-bottom: 25px; }
        h3 { border-bottom: 2px solid #0a5c36; color: #0a5c36; font-size: 16px; padding-bottom: 4px; margin-top: 25px; margin-bottom: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th, td { padding: 8px 10px; text-align: left; vertical-align: top; border: 1px solid #ddd; }
        th { background-color: #f5f5f5; font-weight: bold; width: 30%; }
        .meta-table th { width: 20%; }
        .kronologi-box { background-color: #fafafa; border: 1px solid #ddd; padding: 12px; font-style: italic; white-space: pre-wrap; }
      </style>
    </head>
    <body>
      <h1>LAPORAN INVESTIGASI KEKERASAN</h1>
      <h2>Kode Tiket: ${code}</h2>

      <h3>1. INFORMASI UMUM LAPORAN</h3>
      <table class="meta-table">
        <tr>
          <th>Kode Tiket</th>
          <td>${code}</td>
          <th>Status Kasus</th>
          <td><strong>${statusStr}</strong></td>
        </tr>
        <tr>
          <th>Tanggal Lapor</th>
          <td colspan="3">${dateStr} WIB</td>
        </tr>
      </table>

      <h3>2. DATA KLIEN (KORBAN)</h3>
      <table>
        <tr>
          <th>Nama Lengkap</th>
          <td>${korbanNama}</td>
        </tr>
        <tr>
          <th>Jenis Kelamin</th>
          <td>${korbanGender}</td>
        </tr>
        <tr>
          <th>Status Akademik/Instansi</th>
          <td>${korbanStatus}</td>
        </tr>
        <tr>
          <th>Disabilitas</th>
          <td>${korbanDisabilitas}</td>
        </tr>
        <tr>
          <th>Sumber Informasi</th>
          <td>${korbanInfo}</td>
        </tr>
      </table>

      <h3>3. DATA PELAPOR</h3>
      <table>
        <tr>
          <th>Nama Lengkap</th>
          <td>${pelaporNama}</td>
        </tr>
        <tr>
          <th>Hubungan dengan Pelaku</th>
          <td>${pelaporHubungan}</td>
        </tr>
        <tr>
          <th>TTL & Usia</th>
          <td>${pelaporTTL} (${pelaporUsia})</td>
        </tr>
        <tr>
          <th>Jenis Kelamin</th>
          <td>${pelaporGender}</td>
        </tr>
        <tr>
          <th>Status Pelapor</th>
          <td>${pelaporStatus}</td>
        </tr>
        <tr>
          <th>No. Telepon / Email</th>
          <td>${pelaporTelp} / ${pelaporEmail}</td>
        </tr>
        <tr>
          <th>Alamat Domisili</th>
          <td>${pelaporAlamat}</td>
        </tr>
        <tr>
          <th>Keterangan Kontak Tambahan</th>
          <td>${pelaporKet}</td>
        </tr>
      </table>

      <h3>4. DATA TERLAPOR (PELAKU)</h3>
      <table>
        <tr>
          <th>Nama Lengkap / Inisial</th>
          <td>${pelakuNama}</td>
        </tr>
        <tr>
          <th>Hubungan dengan Korban</th>
          <td>${pelakuHubungan}</td>
        </tr>
        <tr>
          <th>No. Telepon (jika ada)</th>
          <td>${pelakuTelp}</td>
        </tr>
        <tr>
          <th>Jenis Kelamin</th>
          <td>${pelakuGender}</td>
        </tr>
        <tr>
          <th>Ciri Fisik & Keterangan</th>
          <td>${pelakuKet}</td>
        </tr>
      </table>

      <h3>5. RINCIAN KEJADIAN KEKERASAN</h3>
      <table>
        <tr>
          <th>Kategori Kekerasan</th>
          <td>${kejadianKategori}</td>
        </tr>
        <tr>
          <th>Jenis Kekerasan Spesifik</th>
          <td>${kejadianJenis}</td>
        </tr>
        <tr>
          <th>Lokasi Kejadian</th>
          <td>${kejadianLokasi}</td>
        </tr>
        <tr>
          <th>Waktu Kejadian</th>
          <td>${kejadianWaktu}</td>
        </tr>
      </table>

      <h3>6. KRONOLOGI LENGKAP KEJADIAN</h3>
      <div class="kronologi-box">${kejadianKronologi}</div>
    </body>
    </html>
  `

  const blob = new Blob(['\ufeff' + htmlContent], {
    type: 'application/msword;charset=utf-8'
  })

  const clientName = report.value.client?.nama_lengkap || 'Laporan'
  const cleanClientName = clientName.replace(/[^a-zA-Z0-9]/g, '_')
  const link = document.createElement('a')
  link.href = URL.createObjectURL(blob)
  link.download = `${cleanClientName}.doc`
  document.body.appendChild(link)
  link.click()
  document.body.removeChild(link)
  successMsg.value = 'Dokumen Laporan berhasil diekspor sebagai Word (.doc)'
}
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

      <!-- Loading State -->
      <div v-if="pending" class="bg-white border border-gray-100 rounded-3xl p-12 flex flex-col items-center justify-center space-y-4 shadow-sm">
        <Loader2 class="w-10 h-10 animate-spin text-green-700" />
        <p class="text-sm text-gray-500 font-bold animate-pulse">Memuat Detail Laporan...</p>
      </div>

      <div v-else-if="report" class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
          <div class="flex items-center space-x-3.5 flex-wrap gap-y-2">
            <h1 class="text-2xl font-black text-slate-800 flex items-center space-x-3">
              <span>Detail Laporan</span>
              <span class="font-mono text-lg font-bold text-slate-400 bg-slate-100 px-2.5 py-0.5 rounded-lg border border-slate-200">{{ report.code }}</span>
            </h1>
            <button
              @click="exportToWord"
              class="px-3.5 py-1.5 bg-[#eff6ff] hover:bg-blue-650 hover:text-white text-blue-700 border border-blue-200 hover:border-transparent rounded-xl text-xs font-bold transition flex items-center space-x-1.5 shadow-sm"
            >
              <i class="fas fa-file-word text-blue-500 mr-0.5"></i>
              <span>Ekspor Word (DOC)</span>
            </button>
          </div>
          <p class="text-xs text-gray-400 font-semibold mt-1.5">Masuk pada: {{ new Date(report.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' }) }} WIB</p>
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
    <div v-if="report && !pending" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
      
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
          <!-- Card Header with Edit Button -->
          <div class="flex justify-between items-center border-b border-gray-100 pb-4 mb-6">
            <h2 class="font-extrabold text-slate-800 text-lg flex items-center space-x-2">
              <User v-if="activeTab === 'korban'" class="w-5 h-5 text-green-700" />
              <Users v-else-if="activeTab === 'pelapor'" class="w-5 h-5 text-green-700" />
              <HelpCircle v-else-if="activeTab === 'pelaku'" class="w-5 h-5 text-green-700" />
              <Calendar v-else-if="activeTab === 'kejadian'" class="w-5 h-5 text-green-700" />
              
              <span v-if="activeTab === 'korban'">Detail Korban</span>
              <span v-else-if="activeTab === 'pelapor'">Detail Pelapor</span>
              <span v-else-if="activeTab === 'pelaku'">Detail Terlapor (Pelaku)</span>
              <span v-else-if="activeTab === 'kejadian'">Detail Kejadian</span>
            </h2>
            
            <div class="flex items-center space-x-2">
              <button 
                v-if="!isEditing"
                @click="startEdit"
                class="px-3.5 py-1.5 bg-slate-50 hover:bg-slate-100 border border-slate-200 rounded-xl text-xs font-bold text-slate-700 flex items-center transition"
              >
                <i class="fas fa-edit text-slate-500 mr-1.5"></i>
                <span>Edit Laporan</span>
              </button>
              <button 
                v-if="!isEditing"
                @click="deleteReport"
                class="px-3.5 py-1.5 bg-red-50 hover:bg-red-100 border border-red-200 rounded-xl text-xs font-bold text-red-700 flex items-center transition"
                :disabled="updateStatusLoading"
              >
                <Trash2 class="w-3.5 h-3.5 mr-1.5" />
                <span>Hapus Laporan</span>
              </button>
            </div>
          </div>

          <!-- Tab Korban -->
          <div v-if="activeTab === 'korban'">
            <!-- View Mode -->
            <div v-if="!isEditing" class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
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

            <!-- Edit Mode -->
            <div v-else class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm animate-fade-in">
              <div class="space-y-1">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Lengkap</label>
                <input type="text" v-model="editForm.client.nama_lengkap" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-green-600 text-sm font-semibold" />
              </div>
              <div class="space-y-1">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Jenis Kelamin</label>
                <select v-model="editForm.client.jenis_kelamin" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-green-600 text-sm font-semibold">
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>
              <div class="space-y-1">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Status Akademik</label>
                <select v-model="editForm.client.status" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-green-600 text-sm font-semibold">
                  <option v-for="opt in statusOptions" :key="opt" :value="opt">{{ opt }}</option>
                </select>
              </div>
              <div class="space-y-1">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Disabilitas</label>
                <div class="flex space-x-4 items-center h-[38px]">
                  <label class="inline-flex items-center space-x-1.5 cursor-pointer">
                    <input type="radio" v-model="editForm.client.status_korban" value="Disable" class="text-green-700 focus:ring-green-700" />
                    <span class="font-semibold text-slate-800">Ya</span>
                  </label>
                  <label class="inline-flex items-center space-x-1.5 cursor-pointer">
                    <input type="radio" v-model="editForm.client.status_korban" value="Tidak" class="text-green-700 focus:ring-green-700" />
                    <span class="font-semibold text-slate-800">Tidak</span>
                  </label>
                </div>
              </div>
              <div v-if="editForm.client.status_korban === 'Disable'" class="sm:col-span-2 space-y-1">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Kategori Disabilitas</label>
                <select v-model="editForm.client.kategori_disable" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-green-600 text-sm font-semibold">
                  <option value="">Pilih Kategori</option>
                  <option v-for="opt in disableOptions" :key="opt" :value="opt">{{ opt }}</option>
                </select>
              </div>
              <div class="sm:col-span-2 space-y-1">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Sumber Informasi</label>
                <textarea v-model="editForm.client.sumber_informasi" rows="3" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-green-600 text-sm font-normal" placeholder="Sumber informasi..."></textarea>
              </div>
            </div>
          </div>

          <!-- Tab Pelapor -->
          <div v-else-if="activeTab === 'pelapor'">
            <!-- View Mode -->
            <div v-if="!isEditing" class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
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

            <!-- Edit Mode -->
            <div v-else class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm animate-fade-in">
              <div class="space-y-1">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Hubungan dengan Pelaku</label>
                <select v-model="editForm.reporter.hubungan_pelapor_dengan_pelaku" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-green-600 text-sm font-semibold">
                  <option v-for="opt in hubunganPelaporOptions" :key="opt" :value="opt">{{ opt }}</option>
                </select>
              </div>
              <div class="space-y-1">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Lengkap</label>
                <input type="text" v-model="editForm.reporter.nama_lengkap" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-green-600 text-sm font-semibold" />
              </div>
              <div class="space-y-1">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Tempat Lahir</label>
                <input type="text" v-model="editForm.reporter.tempat_lahir" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-green-600 text-sm font-semibold" />
              </div>
              <div class="space-y-1">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Tanggal Lahir</label>
                <input type="date" v-model="editForm.reporter.tanggal_lahir" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-green-600 text-sm font-semibold" />
              </div>
              <div class="space-y-1">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Gender</label>
                <select v-model="editForm.reporter.jenis_kelamin" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-green-600 text-sm font-semibold">
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>
              <div class="space-y-1">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Usia (Tahun)</label>
                <input type="number" v-model="editForm.reporter.usia" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-green-600 text-sm font-semibold" />
              </div>
              <div class="space-y-1">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Status Pelapor</label>
                <select v-model="editForm.reporter.status_pelapor" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-green-600 text-sm font-semibold">
                  <option v-for="opt in statusOptions" :key="opt" :value="opt">{{ opt }}</option>
                </select>
              </div>
              <div class="space-y-1">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">No. Telepon / WhatsApp</label>
                <input type="text" v-model="editForm.reporter.no_telepon" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-green-600 text-sm font-semibold" />
              </div>
              <div class="sm:col-span-2 space-y-1">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Email</label>
                <input type="email" v-model="editForm.reporter.email" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-green-600 text-sm font-semibold" />
              </div>
              <div class="sm:col-span-2 space-y-1">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Alamat</label>
                <textarea v-model="editForm.reporter.alamat" rows="3" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-green-600 text-sm font-normal"></textarea>
              </div>
              <div class="sm:col-span-2 space-y-1">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Keterangan Tambahan Kontak</label>
                <textarea v-model="editForm.reporter.keterangan_tambahan" rows="3" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-green-600 text-sm font-normal"></textarea>
              </div>
            </div>
          </div>

          <!-- Tab Pelaku -->
          <div v-if="activeTab === 'pelaku'">
            <!-- View Mode -->
            <div v-if="!isEditing" class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
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

            <!-- Edit Mode -->
            <div v-else class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm animate-fade-in">
              <div class="space-y-1">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Hubungan dengan Korban</label>
                <select v-model="editForm.perpetrator.hubungan_dengan_korban" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-green-600 text-sm font-semibold">
                  <option v-for="opt in hubunganPelakuOptions" :key="opt" :value="opt">{{ opt }}</option>
                </select>
              </div>
              <div class="space-y-1">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Pelaku</label>
                <input type="text" v-model="editForm.perpetrator.nama" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-green-600 text-sm font-semibold" />
              </div>
              <div class="space-y-1">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">No. Telepon</label>
                <input type="text" v-model="editForm.perpetrator.telepon" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-green-600 text-sm font-semibold" placeholder="Tidak diketahui" />
              </div>
              <div class="space-y-1">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Jenis Kelamin</label>
                <select v-model="editForm.perpetrator.jenis_kelamin" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-green-600 text-sm font-semibold">
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>
              <div class="sm:col-span-2 space-y-1">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Ciri Fisik & Keterangan</label>
                <textarea v-model="editForm.perpetrator.keterangan" rows="4" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-green-600 text-sm font-normal"></textarea>
              </div>
            </div>
          </div>

          <!-- Tab Kejadian -->
          <div v-if="activeTab === 'kejadian'">
            <!-- View Mode -->
            <div v-if="!isEditing" class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
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

            <!-- Edit Mode -->
            <div v-else class="space-y-6 text-sm animate-fade-in">
              <div class="space-y-2">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Bentuk Kekerasan</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                  <label v-for="opt in bentukKekerasanOptions" :key="opt.value" class="flex items-start space-x-2 p-2.5 border border-slate-200 rounded-xl hover:bg-slate-50 transition cursor-pointer text-xs">
                    <input type="checkbox" v-model="editForm.violence.bentuk_kekerasan" :value="opt.value" class="mt-0.5 rounded text-green-700 focus:ring-green-700" />
                    <span class="font-bold text-slate-700">{{ opt.label }}</span>
                  </label>
                </div>
              </div>

              <div v-if="availableJenisKekerasan.length > 0" class="space-y-2 pt-4 border-t border-slate-100">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Jenis/Bentuk Spesifik Kekerasan</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2">
                  <label v-for="jenis in availableJenisKekerasan" :key="jenis" class="flex items-start space-x-2 p-2 border border-slate-150 rounded-xl bg-slate-50 hover:bg-slate-100 cursor-pointer text-xs">
                    <input type="checkbox" v-model="editForm.violence.jenis_kekerasan" :value="jenis" class="mt-0.5 rounded text-green-700 focus:ring-green-700" />
                    <span class="text-slate-700 font-medium leading-tight">{{ jenis }}</span>
                  </label>
                </div>
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1">
                  <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Lokasi Kejadian</label>
                  <input type="text" v-model="editForm.violence.lokasi_kejadian" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-green-600 text-sm font-semibold" />
                </div>
                <div class="space-y-1">
                  <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Waktu Kejadian</label>
                  <input type="date" v-model="editForm.violence.waktu_kejadian" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-green-600 text-sm font-semibold" />
                </div>
              </div>

              <div class="space-y-1">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Deskripsi & Kronologi Lengkap</label>
                <textarea v-model="editForm.violence.deskripsi_kekerasan" rows="6" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-green-600 text-sm font-normal"></textarea>
              </div>
            </div>
          </div>

          <!-- Save/Cancel edit actions -->
          <div v-if="isEditing" class="flex justify-end space-x-3 pt-6 mt-6 border-t border-slate-100 animate-fade-in">
            <button 
              @click="cancelEdit"
              :disabled="editLoading"
              class="px-4 py-2 border border-slate-200 hover:bg-slate-50 rounded-xl text-xs font-bold text-slate-700 transition"
            >
              Batal
            </button>
            <button 
              @click="saveChanges"
              :disabled="editLoading"
              class="px-5 py-2 bg-green-700 hover:bg-green-600 disabled:opacity-50 text-white font-bold rounded-xl text-xs transition flex items-center space-x-1.5 shadow-sm"
            >
              <Loader2 v-if="editLoading" class="w-3.5 h-3.5 animate-spin mr-1" />
              <span>{{ editLoading ? 'Menyimpan...' : 'Simpan Perubahan' }}</span>
            </button>
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

            <button
              @click="downloadAllBuktiAsZip"
              :disabled="downloadZipLoading"
              class="w-full mt-3 py-2.5 px-3 bg-green-50 hover:bg-green-700 hover:text-white text-green-700 border border-green-200 hover:border-transparent rounded-xl text-xs font-bold transition flex items-center justify-center space-x-1.5 disabled:opacity-50"
            >
              <Loader2 v-if="downloadZipLoading" class="w-3.5 h-3.5 animate-spin mr-1" />
              <Download v-else class="w-3.5 h-3.5 mr-1" />
              <span>{{ downloadZipLoading ? 'Mengunduh...' : 'Unduh Semua Bukti (ZIP)' }}</span>
            </button>
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
