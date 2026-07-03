<script setup lang="ts">
import { ref, watch } from 'vue'
import { 
  Eye, 
  Save, 
  RefreshCw,
  AlertCircle,
  CheckCircle2,
  FileText
} from 'lucide-vue-next'
import type { VisiMisi } from '~/types/database'

definePageMeta({
  middleware: 'auth',
  layout: 'admin'
})

const supabase = useSupabaseClient()

// Status states
const successMsg = ref('')
const errorMsg = ref('')
const isLoading = ref(false)

// Form model
const rowId = ref<number | null>(null)
const formAbout = ref('')
const formVisi = ref('')
const formMisi = ref('')

// Fetch current Vision Mission data
const { data: currentData, pending, refresh } = useLazyAsyncData<VisiMisi>('admin-visimisi-data', async () => {
  const { data } = await supabase
    .from('visi_misis')
    .select('*')
    .order('id', { ascending: true })
    .limit(1)
    .maybeSingle()
  
  return data as VisiMisi
})

// Keep form fields synchronized when data resolves
watch(currentData, (newData) => {
  if (newData) {
    rowId.value = newData.id
    formAbout.value = newData.about
    formVisi.value = newData.visi
    formMisi.value = newData.misi
  }
}, { immediate: true })

// Save Visi Misi details
const saveVisiMisi = async () => {
  if (!formAbout.value.trim() || !formVisi.value.trim() || !formMisi.value.trim()) {
    errorMsg.value = 'Seluruh bagian Profil, Visi, dan Misi wajib diisi.'
    return
  }

  isLoading.value = true
  successMsg.value = ''
  errorMsg.value = ''

  try {
    if (rowId.value) {
      // Update
      const { error } = await supabase
        .from('visi_misis')
        .update({
          about: formAbout.value,
          visi: formVisi.value,
          misi: formMisi.value,
          updated_at: new Date().toISOString()
        })
        .eq('id', rowId.value)
      
      if (error) throw error
      successMsg.value = 'Profil, Visi, dan Misi berhasil diperbarui!'
    } else {
      // Insert
      const { data, error } = await supabase
        .from('visi_misis')
        .insert({
          about: formAbout.value,
          visi: formVisi.value,
          misi: formMisi.value
        })
        .select('id')
        .single()
      
      if (error) throw error
      rowId.value = data.id
      successMsg.value = 'Profil, Visi, dan Misi berhasil disimpan!'
    }
    
    await refresh()
  } catch (err: any) {
    console.error(err)
    errorMsg.value = err.message || 'Terjadi kesalahan sistem.'
  } finally {
    isLoading.value = false
  }
}
</script>

<template>
  <div class="space-y-6 max-w-4xl">
    <!-- Top Header -->
    <div class="flex items-center justify-between">
      <div>
        <h1 class="text-2xl font-black text-slate-800">Kelola Profil & Visi Misi</h1>
        <p class="text-sm text-gray-500">Edit deskripsi profil komite, visi, serta misi lembaga SATGAS.</p>
      </div>
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

    <!-- Form Container -->
    <div class="bg-white border border-gray-100 rounded-3xl p-6 sm:p-8 shadow-sm">
      <div v-if="pending" class="space-y-4 animate-pulse py-6">
        <div class="h-6 bg-slate-100 rounded w-1/4"></div>
        <div class="h-20 bg-slate-100 rounded"></div>
        <div class="h-6 bg-slate-100 rounded w-1/4"></div>
        <div class="h-20 bg-slate-100 rounded"></div>
      </div>

      <form v-else @submit.prevent="saveVisiMisi" class="space-y-6 text-sm">
        
        <!-- About/Profil Section -->
        <div class="space-y-2">
          <label class="block font-bold text-slate-800 text-base border-b border-gray-100 pb-2 flex items-center space-x-2">
            <FileText class="w-5 h-5 text-green-700" />
            <span>Profil Lengkap SATGAS</span>
          </label>
          <p class="text-xs text-gray-400">Jelaskan latar belakang pembentukan, tugas utama, dan wewenang SATGAS PPKS.</p>
          <textarea 
            v-model="formAbout" 
            placeholder="Tulis profil lengkap satgas disini..."
            rows="6"
            class="w-full p-3 border border-gray-200 rounded-xl text-slate-800 focus:outline-none focus:border-green-600 transition-colors"
            required
          ></textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          
          <!-- Visi Section -->
          <div class="space-y-2">
            <label class="block font-bold text-slate-800 text-base border-b border-gray-100 pb-2 flex items-center space-x-2">
              <Eye class="w-5 h-5 text-green-700" />
              <span>Visi SATGAS</span>
            </label>
            <textarea 
              v-model="formVisi" 
              placeholder="Tulis visi satgas..."
              rows="6"
              class="w-full p-3 border border-gray-200 rounded-xl text-slate-800 focus:outline-none focus:border-green-600 transition-colors"
              required
            ></textarea>
          </div>

          <!-- Misi Section -->
          <div class="space-y-2">
            <label class="block font-bold text-slate-800 text-base border-b border-gray-100 pb-2 flex items-center space-x-2">
              <Eye class="w-5 h-5 text-green-700" />
              <span>Misi SATGAS</span>
            </label>
            <textarea 
              v-model="formMisi" 
              placeholder="Tulis misi satgas (pisahkan baris baru untuk penomoran)..."
              rows="6"
              class="w-full p-3 border border-gray-200 rounded-xl text-slate-800 focus:outline-none focus:border-green-600 transition-colors"
              required
            ></textarea>
          </div>

        </div>

        <!-- Action Button -->
        <div class="flex items-center justify-end pt-4 border-t border-gray-100">
          <button 
            type="submit" 
            :disabled="isLoading"
            class="px-6 py-3 bg-green-700 hover:bg-green-600 disabled:opacity-50 text-white font-bold rounded-xl shadow-md transition-all flex items-center space-x-1.5"
          >
            <RefreshCw v-if="isLoading" class="w-4 h-4 animate-spin" />
            <Save v-else class="w-4 h-4" />
            <span>Simpan Perubahan</span>
          </button>
        </div>

      </form>
    </div>
  </div>
</template>
