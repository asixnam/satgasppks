<script setup lang="ts">
import { ref } from 'vue'
import { 
  Users, 
  Plus, 
  Trash2, 
  Edit2, 
  X, 
  User as UserIcon, 
  Save, 
  RefreshCw,
  AlertCircle,
  CheckCircle2
} from 'lucide-vue-next'
import type { Tim } from '~/types/database'

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
const formPosition = ref('')
const formDesc = ref('')
const selectedFile = ref<File | null>(null)
const imagePreview = ref('')
const existingImage = ref<string | null>(null)

// Fetch team members list
const { data: tims, pending, refresh } = await useAsyncData<Tim[]>('admin-tims-list', async () => {
  const { data } = await supabase
    .from('tims')
    .select('*')
    .order('id', { ascending: true })
  return (data as Tim[]) || []
})

// Image helper
const getImageUrl = (path: string | null) => {
  if (!path) return '/images/avatar-placeholder.jpg'
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
    if (file.size > 2 * 1024 * 1024) {
      alert('Ukuran foto maksimal 2MB')
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
  formPosition.value = ''
  formDesc.value = ''
  selectedFile.value = null
  imagePreview.value = ''
  existingImage.value = null
  isModalOpen.value = true
}

const openEditModal = (tim: Tim) => {
  modalMode.value = 'edit'
  formId.value = tim.id
  formName.value = tim.nama
  formPosition.value = tim.jabatan
  formDesc.value = tim.deskripsi || ''
  selectedFile.value = null
  imagePreview.value = ''
  existingImage.value = tim.foto
  isModalOpen.value = true
}

const closeModal = () => {
  isModalOpen.value = false
}

// Upload photo to public-assets bucket
const uploadPhoto = async (): Promise<string | null> => {
  if (!selectedFile.value) return null
  
  const ext = selectedFile.value.name.split('.').pop()
  const path = `team/member_${Date.now()}.${ext}`
  
  const { data, error } = await supabase.storage
    .from('public-assets')
    .upload(path, selectedFile.value)

  if (error) throw error
  return data.path
}

// Save Member (Create/Update)
const saveMember = async () => {
  if (!formName.value.trim() || !formPosition.value.trim()) {
    errorMsg.value = 'Nama lengkap dan jabatan wajib diisi.'
    return
  }

  isLoading.value = true
  successMsg.value = ''
  errorMsg.value = ''

  try {
    let photoPath = existingImage.value

    if (selectedFile.value) {
      const uploaded = await uploadPhoto()
      if (uploaded) photoPath = uploaded
    }

    if (modalMode.value === 'create') {
      const { error } = await supabase
        .from('tims')
        .insert({
          nama: formName.value,
          jabatan: formPosition.value,
          deskripsi: formDesc.value || null,
          foto: photoPath
        })
      if (error) throw error
      successMsg.value = 'Anggota tim berhasil ditambahkan!'
    } else {
      const { error } = await supabase
        .from('tims')
        .update({
          nama: formName.value,
          jabatan: formPosition.value,
          deskripsi: formDesc.value || null,
          foto: photoPath,
          updated_at: new Date().toISOString()
        })
        .eq('id', formId.value)
      if (error) throw error
      successMsg.value = 'Data anggota tim berhasil diperbarui!'
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

// Delete Member
const deleteMember = async (id: number) => {
  if (!confirm('Apakah Anda yakin ingin menghapus anggota tim ini?')) return

  isLoading.value = true
  successMsg.value = ''
  errorMsg.value = ''

  try {
    const { error } = await supabase
      .from('tims')
      .delete()
      .eq('id', id)

    if (error) throw error
    successMsg.value = 'Anggota tim berhasil dihapus!'
    await refresh()
  } catch (err: any) {
    console.error(err)
    errorMsg.value = err.message || 'Gagal menghapus anggota tim.'
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
        <h1 class="text-2xl font-black text-slate-800">Kelola Anggota Tim</h1>
        <p class="text-sm text-gray-500">Kelola profil anggota komite independen pendamping SATGAS PPKS.</p>
      </div>
      <button 
        @click="openCreateModal"
        class="px-4 py-2.5 bg-green-700 hover:bg-green-600 text-white font-bold rounded-xl text-sm transition-colors shadow-md inline-flex items-center space-x-1.5"
      >
        <Plus class="w-4 h-4" />
        <span>Tambah Anggota Baru</span>
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

    <!-- Team List -->
    <div v-if="pending" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 animate-pulse">
      <div v-for="n in 4" :key="n" class="bg-white border border-gray-100 rounded-2xl p-6 space-y-4">
        <div class="w-24 h-24 bg-slate-100 rounded-full mx-auto"></div>
        <div class="h-6 bg-slate-100 rounded w-3/4 mx-auto"></div>
        <div class="h-4 bg-slate-100 rounded w-1/2 mx-auto"></div>
      </div>
    </div>

    <div v-else>
      <div v-if="tims && tims.length > 0" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <div 
          v-for="item in tims" 
          :key="item.id"
          class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden flex flex-col justify-between"
        >
          <div class="p-6 text-center space-y-4">
            <div class="w-24 h-24 bg-slate-100 rounded-full overflow-hidden mx-auto border border-gray-100">
              <img 
                :src="getImageUrl(item.foto)" 
                :alt="item.nama" 
                class="w-full h-full object-cover" 
              />
            </div>
            
            <div class="space-y-1">
              <h3 class="font-bold text-slate-800 text-base leading-tight">{{ item.nama }}</h3>
              <p class="text-green-700 text-xs font-bold uppercase tracking-wider">{{ item.jabatan }}</p>
              <p v-if="item.deskripsi" class="text-gray-500 text-xs leading-relaxed pt-2">
                {{ item.deskripsi }}
              </p>
            </div>
          </div>

          <!-- Actions -->
          <div class="px-5 pb-5 pt-3 border-t border-gray-50 flex items-center justify-center space-x-2">
            <button 
              @click="openEditModal(item)"
              class="p-2 border border-gray-200 hover:bg-slate-50 text-slate-600 rounded-lg transition-colors flex items-center space-x-1 text-xs font-semibold"
            >
              <Edit2 class="w-3.5 h-3.5" />
              <span>Edit</span>
            </button>
            <button 
              @click="deleteMember(item.id)"
              class="p-2 border border-red-200 hover:bg-red-50 text-red-600 rounded-lg transition-colors flex items-center space-x-1 text-xs font-semibold"
            >
              <Trash2 class="w-3.5 h-3.5" />
              <span>Hapus</span>
            </button>
          </div>
        </div>
      </div>
      
      <div v-else class="text-center py-20 bg-white border border-gray-100 rounded-2xl">
        <Users class="w-16 h-16 text-slate-300 mx-auto mb-4" />
        <p class="text-slate-600 font-semibold">Belum ada anggota tim terdaftar.</p>
        <p class="text-slate-400 text-xs mt-1">Mulai tambahkan profil anggota komite PPKS.</p>
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
          {{ modalMode === 'create' ? 'Tambah Anggota Tim' : 'Edit Anggota Tim' }}
        </h2>

        <form @submit.prevent="saveMember" class="space-y-4 text-sm">
          <div class="space-y-1.5">
            <label class="block font-bold text-gray-700">Nama Lengkap</label>
            <input 
              type="text" 
              v-model="formName" 
              placeholder="Contoh: Dr. Budi Santoso, M.Hum"
              class="w-full p-3 border border-gray-200 rounded-xl text-slate-800 focus:outline-none focus:border-green-600 transition-colors"
              required 
            />
          </div>

          <div class="space-y-1.5">
            <label class="block font-bold text-gray-700">Jabatan / Peran</label>
            <input 
              type="text" 
              v-model="formPosition" 
              placeholder="Contoh: Ketua Satgas / Tim Psikolog"
              class="w-full p-3 border border-gray-200 rounded-xl text-slate-800 focus:outline-none focus:border-green-600 transition-colors"
              required 
            />
          </div>

          <div class="space-y-1.5">
            <label class="block font-bold text-gray-700">Deskripsi Ringkas</label>
            <textarea 
              v-model="formDesc" 
              placeholder="Masukkan latar belakang atau program studi/unit (opsional)..."
              rows="3"
              class="w-full p-3 border border-gray-200 rounded-xl text-slate-800 focus:outline-none focus:border-green-600 transition-colors"
            ></textarea>
          </div>

          <!-- Photo selector -->
          <div class="space-y-2">
            <label class="block font-bold text-gray-700">Foto Profil</label>
            <div class="flex items-center space-x-4">
              <!-- Preview -->
              <div class="w-20 h-20 bg-slate-100 border border-gray-200 rounded-full overflow-hidden flex items-center justify-center shrink-0">
                <img v-if="imagePreview" :src="imagePreview" alt="Preview" class="w-full h-full object-cover" />
                <img v-else-if="existingImage" :src="getImageUrl(existingImage)" alt="Photo" class="w-full h-full object-cover" />
                <UserIcon class="w-8 h-8 text-gray-300" />
              </div>
              <div class="space-y-1">
                <input 
                  type="file" 
                  id="photo-input"
                  accept="image/*"
                  class="hidden"
                  @change="handleFileChange"
                />
                <button 
                  type="button"
                  @click="() => document.getElementById('photo-input')?.click()"
                  class="px-4 py-2 border border-gray-200 rounded-xl hover:bg-slate-50 text-xs font-semibold text-slate-700 transition-all"
                >
                  Pilih Foto
                </button>
                <p class="text-[10px] text-gray-400">JPG, PNG atau WEBP. Maksimal 2MB.</p>
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
              <span>Simpan Anggota</span>
            </button>
          </div>
        </form>
      </div>
    </div>

  </div>
</template>
