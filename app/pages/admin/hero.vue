<script setup lang="ts">
import { ref } from 'vue'
import { 
  Image as ImageIcon, 
  Plus, 
  Trash2, 
  Edit2, 
  X, 
  Save, 
  RefreshCw,
  AlertCircle,
  CheckCircle2
} from 'lucide-vue-next'
import type { Hero } from '~/types/database'

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
const formName = ref('')
const selectedFile = ref<File | null>(null)
const imagePreview = ref('')
const existingImage = ref<string | null>(null)

// Fetch hero banners list
const { data: heroes, pending, refresh } = useLazyAsyncData<Hero[]>('admin-heroes-list', async () => {
  const { data } = await supabase
    .from('heroes')
    .select('*')
    .order('id', { ascending: true })
  return (data as Hero[]) || []
}, { default: () => [] })

// Image helper
const getImageUrl = (path: string | null) => {
  if (!path) return '/images/placeholder.jpg'
  if (path.startsWith('http://') || path.startsWith('https://') || path.startsWith('images/') || path.startsWith('image/')) {
    return path
  }
  const { data } = supabase.storage.from('public-assets').getPublicUrl(path)
  return data.publicUrl
}

const handleFileChange = (e: Event) => {
  const target = e.target as HTMLInputElement
  if (target.files && target.files[0]) {
    const file = target.files[0]
    if (file.size > 5 * 1024 * 1024) {
      alert('Ukuran banner maksimal 5MB')
      return
    }
    selectedFile.value = file
    imagePreview.value = URL.createObjectURL(file)
  }
}

// Open modals
const openCreateModal = () => {
  modalMode.value = 'create'
  formId.value = null
  formName.value = ''
  selectedFile.value = null
  imagePreview.value = ''
  existingImage.value = null
  isModalOpen.value = true
}

const openEditModal = (hero: Hero) => {
  modalMode.value = 'edit'
  formId.value = hero.id
  formName.value = hero.nama_gambar
  selectedFile.value = null
  imagePreview.value = ''
  existingImage.value = hero.gambar
  isModalOpen.value = true
}

const closeModal = () => {
  isModalOpen.value = false
}

// Upload photo to public-assets bucket
const uploadBanner = async (): Promise<string | null> => {
  if (!selectedFile.value) return null
  
  const ext = selectedFile.value.name.split('.').pop()
  const path = `heroes/banner_${Date.now()}.${ext}`
  
  const { data, error } = await supabase.storage
    .from('public-assets')
    .upload(path, selectedFile.value)

  if (error) throw error
  return data.path
}

// Save Hero (Create/Update)
const saveHero = async () => {
  if (!formName.value.trim()) {
    errorMsg.value = 'Nama gambar banner wajib diisi.'
    return
  }

  if (modalMode.value === 'create' && !selectedFile.value) {
    errorMsg.value = 'File gambar banner wajib diunggah.'
    return
  }

  isLoading.value = true
  successMsg.value = ''
  errorMsg.value = ''

  try {
    let bannerPath = existingImage.value

    if (selectedFile.value) {
      const uploaded = await uploadBanner()
      if (uploaded) bannerPath = uploaded
    }

    if (modalMode.value === 'create') {
      const { error } = await supabase
        .from('heroes')
        .insert({
          nama_gambar: formName.value,
          gambar: bannerPath
        })
      if (error) throw error
      successMsg.value = 'Banner slider baru berhasil ditambahkan!'
    } else {
      const { error } = await supabase
        .from('heroes')
        .update({
          nama_gambar: formName.value,
          gambar: bannerPath,
          updated_at: new Date().toISOString()
        })
        .eq('id', formId.value)
      if (error) throw error
      successMsg.value = 'Banner slider berhasil diperbarui!'
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

// Delete Hero
const deleteHero = async (id: number) => {
  if (!confirm('Apakah Anda yakin ingin menghapus banner slider ini?')) return

  isLoading.value = true
  successMsg.value = ''
  errorMsg.value = ''

  try {
    const { error } = await supabase
      .from('heroes')
      .delete()
      .eq('id', id)

    if (error) throw error
    successMsg.value = 'Banner slider berhasil dihapus!'
    await refresh()
  } catch (err: any) {
    console.error(err)
    errorMsg.value = err.message || 'Gagal menghapus banner.'
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
        <h1 class="text-2xl font-black text-slate-800">Kelola Hero Banner</h1>
        <p class="text-sm text-gray-500">Kelola foto-foto slide background landing page utama.</p>
      </div>
      <button 
        @click="openCreateModal"
        class="px-4 py-2.5 bg-green-700 hover:bg-green-600 text-white font-bold rounded-xl text-sm transition-colors shadow-md inline-flex items-center space-x-1.5"
      >
        <Plus class="w-4 h-4" />
        <span>Tambah Banner Baru</span>
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

    <!-- Hero Banners List -->
    <div v-if="pending" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 animate-pulse">
      <div v-for="n in 3" :key="n" class="bg-white border border-gray-100 rounded-2xl p-6 space-y-4">
        <div class="h-48 bg-slate-100 rounded-xl"></div>
        <div class="h-6 bg-slate-100 rounded w-1/2"></div>
      </div>
    </div>

    <div v-else>
      <div v-if="heroes && heroes.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div 
          v-for="item in heroes" 
          :key="item.id"
          class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden flex flex-col justify-between"
        >
          <div>
            <div class="h-48 bg-slate-100 overflow-hidden relative">
              <img 
                :src="getImageUrl(item.gambar)" 
                :alt="item.nama_gambar" 
                class="w-full h-full object-cover" 
              />
            </div>
            
            <div class="p-5">
              <h3 class="font-bold text-slate-800 text-sm leading-tight truncate">Nama File/Judul: {{ item.nama_gambar }}</h3>
            </div>
          </div>

          <!-- Actions -->
          <div class="px-5 pb-5 pt-3 border-t border-gray-50 flex items-center justify-end space-x-2">
            <button 
              @click="openEditModal(item)"
              class="p-2 border border-gray-200 hover:bg-slate-50 text-slate-600 rounded-lg transition-colors flex items-center space-x-1 text-xs font-semibold"
            >
              <Edit2 class="w-3.5 h-3.5" />
              <span>Ganti</span>
            </button>
            <button 
              @click="deleteHero(item.id)"
              class="p-2 border border-red-200 hover:bg-red-50 text-red-600 rounded-lg transition-colors flex items-center space-x-1 text-xs font-semibold"
            >
              <Trash2 class="w-3.5 h-3.5" />
              <span>Hapus</span>
            </button>
          </div>
        </div>
      </div>
      
      <div v-else class="text-center py-20 bg-white border border-gray-100 rounded-2xl">
        <ImageIcon class="w-16 h-16 text-slate-300 mx-auto mb-4" />
        <p class="text-slate-600 font-semibold">Belum ada banner slider terpasang.</p>
        <p class="text-slate-400 text-xs mt-1">Situs akan menampilkan background default gedung kampus UNU Yogyakarta.</p>
      </div>
    </div>

    <!-- Create/Edit Modal dialog -->
    <div 
      v-if="isModalOpen"
      class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
    >
      <div class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-8 space-y-6 shadow-2xl relative max-h-[90vh] overflow-y-auto">
        <button 
          @click="closeModal"
          class="absolute top-4 right-4 p-2 text-gray-400 hover:text-gray-600 hover:bg-slate-100 rounded-full"
        >
          <X class="w-5 h-5" />
        </button>

        <h2 class="text-xl font-black text-slate-800">
          {{ modalMode === 'create' ? 'Tambah Banner Slider' : 'Ganti Gambar Slider' }}
        </h2>

        <form @submit.prevent="saveHero" class="space-y-4 text-sm">
          <div class="space-y-1.5">
            <label class="block font-bold text-gray-700">Nama / Judul Gambar</label>
            <input 
              type="text" 
              v-model="formName" 
              placeholder="Contoh: Gedung Kampus / Sosialisasi PPKS"
              class="w-full p-3 border border-gray-200 rounded-xl text-slate-800 focus:outline-none focus:border-green-600 transition-colors"
              required 
            />
          </div>

          <!-- Banner Image selector -->
          <div class="space-y-2">
            <label class="block font-bold text-gray-700">File Banner</label>
            <div class="flex items-center space-x-4">
              <!-- Preview -->
              <div class="w-24 h-24 bg-slate-100 border border-gray-200 rounded-xl overflow-hidden flex items-center justify-center shrink-0">
                <img v-if="imagePreview" :src="imagePreview" alt="Preview" class="w-full h-full object-cover" />
                <img v-else-if="existingImage" :src="getImageUrl(existingImage)" alt="Banner" class="w-full h-full object-cover" />
                <ImageIcon class="w-8 h-8 text-gray-300" />
              </div>
              <div class="space-y-1">
                <input 
                  type="file" 
                  id="banner-input"
                  accept="image/*"
                  class="hidden"
                  @change="handleFileChange"
                />
                <label 
                  for="banner-input"
                  class="px-4 py-2 border border-gray-200 rounded-xl hover:bg-slate-50 text-xs font-semibold text-slate-700 transition-all cursor-pointer inline-block"
                >
                  Pilih Gambar
                </label>
                <p class="text-[10px] text-gray-400">JPG, PNG atau WEBP. Maksimal 5MB.</p>
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
              <span>Simpan Banner</span>
            </button>
          </div>
        </form>
      </div>
    </div>

  </div>
</template>
