<script setup lang="ts">
import { ref } from 'vue'
import { 
  BookOpen, 
  Plus, 
  Trash2, 
  Edit2, 
  X, 
  FileText, 
  Save, 
  RefreshCw,
  AlertCircle,
  CheckCircle2
} from 'lucide-vue-next'
import type { Edukasi } from '~/types/database'

definePageMeta({
  middleware: 'auth',
  layout: 'admin'
})

const supabase = useSupabaseClient()

// Status states
const successMsg = ref('')
const errorMsg = ref('')
const isLoading = ref(false)
const isModalOpen = ref(false)
const modalMode = ref<'create' | 'edit'>('create')

// Form model
const formId = ref<number | null>(null)
const formTitle = ref('')
const formContent = ref('') // stores current/existing PDF path
const selectedFile = ref<File | null>(null)

// Fetch educational materials
const { data: edukasis, pending, refresh } = useLazyAsyncData<Edukasi[]>('admin-edukasis-list', async () => {
  const { data } = await supabase
    .from('edukasis')
    .select('*')
    .order('created_at', { ascending: false })
  return (data as Edukasi[]) || []
}, { default: () => [] })

// PDF URL Helper
const getPdfUrl = (path: string | null) => {
  if (!path) return ''
  if (path.startsWith('http://') || path.startsWith('https://')) {
    return path
  }
  const { data } = supabase.storage.from('public-assets').getPublicUrl(path)
  return data.publicUrl
}

const handleFileChange = (e: Event) => {
  const target = e.target as HTMLInputElement
  if (target.files && target.files[0]) {
    const file = target.files[0]
    if (file.type !== 'application/pdf') {
      alert('Format berkas harus PDF')
      return
    }
    if (file.size > 5 * 1024 * 1024) {
      alert('Ukuran berkas PDF maksimal 5MB')
      return
    }
    selectedFile.value = file
  }
}

// Open modals
const openCreateModal = () => {
  modalMode.value = 'create'
  formId.value = null
  formTitle.value = ''
  formContent.value = ''
  selectedFile.value = null
  isModalOpen.value = true
}

const openEditModal = (edu: Edukasi) => {
  modalMode.value = 'edit'
  formId.value = edu.id
  formTitle.value = edu.judul
  formContent.value = edu.konten
  selectedFile.value = null
  isModalOpen.value = true
}

const closeModal = () => {
  isModalOpen.value = false
}

// Upload PDF to public-assets bucket
const uploadPdf = async (): Promise<string | null> => {
  if (!selectedFile.value) return null
  
  const path = `education/edu_${Date.now()}.pdf`
  
  const { data, error } = await supabase.storage
    .from('public-assets')
    .upload(path, selectedFile.value)

  if (error) throw error
  return data.path
}

// Save Education (Create/Update)
const saveEdukasi = async () => {
  if (!formTitle.value.trim()) {
    errorMsg.value = 'Judul materi wajib diisi.'
    return
  }
  if (modalMode.value === 'create' && !selectedFile.value) {
    errorMsg.value = 'Berkas PDF wajib diunggah.'
    return
  }

  isLoading.value = true
  successMsg.value = ''
  errorMsg.value = ''

  try {
    let pdfPath = formContent.value

    if (selectedFile.value) {
      const uploaded = await uploadPdf()
      if (uploaded) pdfPath = uploaded
    }

    if (modalMode.value === 'create') {
      const { error } = await supabase
        .from('edukasis')
        .insert({
          judul: formTitle.value,
          konten: pdfPath,
          gambar: null
        })
      if (error) throw error
      successMsg.value = 'Materi edukasi berhasil diterbitkan!'
    } else {
      const { error } = await supabase
        .from('edukasis')
        .update({
          judul: formTitle.value,
          konten: pdfPath,
          gambar: null,
          updated_at: new Date().toISOString()
        })
        .eq('id', formId.value)
      if (error) throw error
      successMsg.value = 'Materi edukasi berhasil diperbarui!'
    }

    closeModal()
    await refresh()
  } catch (err: any) {
    console.error(err)
    errorMsg.value = err.message || 'Terjadi kesalahan sistem.'
  } finally {
    isLoading.value = false
  }
}

// Delete Education
const deleteEdukasi = async (id: number) => {
  if (!confirm('Apakah Anda yakin ingin menghapus materi edukasi ini?')) return

  isLoading.value = true
  successMsg.value = ''
  errorMsg.value = ''

  try {
    const { error } = await supabase
      .from('edukasis')
      .delete()
      .eq('id', id)

    if (error) throw error
    successMsg.value = 'Materi edukasi berhasil dihapus!'
    await refresh()
  } catch (err: any) {
    console.error(err)
    errorMsg.value = err.message || 'Gagal menghapus materi edukasi.'
  } finally {
    isLoading.value = false
  }
}
</script>

<template>
  <div class="space-y-6">
    <!-- Top Header -->
    <div class="flex items-center justify-between">
      <div>
        <h1 class="text-2xl font-black text-slate-800">Kelola Materi Edukasi</h1>
        <p class="text-sm text-gray-500">Buat, perbarui, dan bagikan materi edukasi pencegahan kekerasan seksual.</p>
      </div>
      <button 
        @click="openCreateModal"
        class="px-3 py-2.5 sm:px-4 sm:py-2.5 bg-green-700 hover:bg-green-600 text-white font-bold rounded-xl text-sm transition-colors shadow-md inline-flex items-center justify-center gap-1.5 shrink-0"
        title="Buat Materi Baru"
      >
        <Plus class="w-4 h-4" />
        <span class="hidden sm:inline">Buat Materi Baru</span>
      </button>
    </div>

    <!-- Alert Notifications -->
    <div v-if="successMsg" class="bg-green-50 border border-green-200 text-green-800 p-4 rounded-xl flex items-start space-x-2 text-sm font-semibold">
      <CheckCircle2 class="w-5 h-5 shrink-0 text-green-600" />
      <span>{{ successMsg }}</span>
    </div>
    <div v-if="errorMsg" class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-xl flex items-start space-x-2 text-sm font-semibold">
      <AlertCircle class="w-5 h-5 shrink-0 text-red-600" />
      <span>{{ errorMsg }}</span>
    </div>

    <!-- Education List -->
    <div v-if="pending" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 animate-pulse">
      <div v-for="n in 3" :key="n" class="bg-white border border-gray-100 rounded-2xl p-6 space-y-4">
        <div class="h-40 bg-slate-100 rounded-xl"></div>
        <div class="h-6 bg-slate-100 rounded w-3/4"></div>
        <div class="h-10 bg-slate-100 rounded"></div>
      </div>
    </div>

    <div v-else>
      <div v-if="edukasis && edukasis.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div 
          v-for="item in edukasis" 
          :key="item.id"
          class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden flex flex-col justify-between"
        >
          <div>
            <div class="h-40 bg-slate-50 flex items-center justify-center border-b border-slate-100 relative">
              <div class="text-center space-y-2">
                <FileText class="w-12 h-12 text-red-600 mx-auto" />
                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Dokumen PDF</span>
              </div>
            </div>
            
            <div class="p-5 space-y-2">
              <span class="inline-block px-2.5 py-1 bg-green-50 text-green-800 text-[10px] font-bold rounded-md uppercase tracking-wider">Materi Edukasi</span>
              <h3 class="font-bold text-slate-800 text-base line-clamp-2">{{ item.judul }}</h3>
              <a 
                v-if="item.konten"
                :href="getPdfUrl(item.konten)" 
                target="_blank" 
                class="inline-flex items-center space-x-1 text-xs text-blue-600 hover:text-blue-850 hover:underline font-semibold"
              >
                <span>Buka Berkas PDF</span>
              </a>
            </div>
          </div>

          <!-- Actions -->
          <div class="px-5 pb-5 pt-3 border-t border-gray-50 flex items-center justify-end space-x-2">
            <button 
              @click="openEditModal(item)"
              class="p-2 border border-gray-200 hover:bg-slate-50 text-slate-600 rounded-lg transition-colors flex items-center space-x-1 text-xs font-semibold"
            >
              <Edit2 class="w-3.5 h-3.5" />
              <span>Edit</span>
            </button>
            <button 
              @click="deleteEdukasi(item.id)"
              class="p-2 border border-red-200 hover:bg-red-50 text-red-600 rounded-lg transition-colors flex items-center space-x-1 text-xs font-semibold"
            >
              <Trash2 class="w-3.5 h-3.5" />
              <span>Hapus</span>
            </button>
          </div>
        </div>
      </div>
      
      <div v-else class="text-center py-20 bg-white border border-gray-100 rounded-2xl">
        <BookOpen class="w-16 h-16 text-slate-300 mx-auto mb-4" />
        <p class="text-slate-600 font-semibold">Belum ada materi edukasi yang diterbitkan.</p>
        <p class="text-slate-400 text-xs mt-1">Mulai terbitkan modul atau artikel edukasi baru.</p>
      </div>
    </div>

    <!-- Create/Edit Modal dialog -->
    <div 
      v-if="isModalOpen"
      class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
    >
      <div class="bg-white rounded-3xl max-w-2xl w-full p-6 sm:p-8 space-y-6 shadow-2xl relative max-h-[90vh] overflow-y-auto">
        <button 
          @click="closeModal"
          class="absolute top-4 right-4 p-2 text-gray-400 hover:text-gray-600 hover:bg-slate-100 rounded-full"
        >
          <X class="w-5 h-5" />
        </button>

        <h2 class="text-xl font-black text-slate-800">
          {{ modalMode === 'create' ? 'Buat Materi Baru' : 'Edit Materi Edukasi' }}
        </h2>

        <form @submit.prevent="saveEdukasi" class="space-y-4 text-sm">
          <div class="space-y-1.5">
            <label class="block font-bold text-gray-700">Judul Materi</label>
            <input 
              type="text" 
              v-model="formTitle" 
              placeholder="Masukkan judul materi"
              class="w-full p-3 border border-gray-200 rounded-xl text-slate-800 focus:outline-none focus:border-green-600 transition-colors"
              required 
            />
          </div>

          <!-- PDF Selector -->
          <div class="space-y-2">
            <label class="block font-bold text-gray-700">Berkas PDF Materi (Max 5MB)</label>
            <div class="flex items-center space-x-4">
              <div class="w-16 h-16 bg-red-50 border border-red-100 rounded-xl flex items-center justify-center shrink-0">
                <FileText class="w-8 h-8 text-red-600" />
              </div>
              <div class="space-y-1">
                <input 
                  type="file" 
                  id="pdf-input-edu"
                  accept="application/pdf"
                  class="hidden"
                  @change="handleFileChange"
                />
                <label 
                  for="pdf-input-edu"
                  class="px-4 py-2 border border-gray-200 rounded-xl hover:bg-slate-50 text-xs font-semibold text-slate-700 transition-all cursor-pointer inline-block"
                >
                  {{ selectedFile ? 'Ganti Berkas PDF' : 'Pilih Berkas PDF' }}
                </label>
                <p class="text-[10px] text-gray-400">
                  <span v-if="selectedFile" class="text-green-600 font-semibold block">Terpilih: {{ selectedFile.name }}</span>
                  <span v-else-if="formContent" class="text-slate-600 font-semibold block">Sudah ada berkas terunggah</span>
                  Format berkas wajib PDF. Ukuran maksimal 5MB.
                </p>
              </div>
            </div>
          </div>

          <!-- Footer Actions -->
          <div class="flex items-center justify-end space-x-2 pt-4 border-t border-gray-100">
            <button 
              type="button" 
              @click="closeModal"
              class="px-4 py-2 border border-gray-200 rounded-xl hover:bg-slate-50 font-semibold"
            >
              Batal
            </button>
            <button 
              type="submit" 
              :disabled="isLoading"
              class="px-5 py-2 bg-green-700 hover:bg-green-600 disabled:opacity-50 text-white font-bold rounded-xl shadow-md transition-colors flex items-center space-x-1.5"
            >
              <RefreshCw v-if="isLoading" class="w-4 h-4 animate-spin" />
              <Save v-else class="w-4 h-4" />
              <span>Simpan Materi</span>
            </button>
          </div>
        </form>
      </div>
    </div>

  </div>
</template>
