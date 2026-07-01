<script setup lang="ts">
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { Eye, EyeOff, Loader2, ArrowLeft } from 'lucide-vue-next'

// Disable layout (removes HeaderApp and FooterApp)
definePageMeta({
  layout: false
})

const supabase = useSupabaseClient()
const router = useRouter()

const password = ref('')
const confirmPassword = ref('')
const showPassword = ref(false)
const errorMsg = ref('')
const successMsg = ref('')
const isLoading = ref(false)

const handleUpdatePassword = async () => {
  if (password.value !== confirmPassword.value) {
    errorMsg.value = 'Kata sandi baru dan konfirmasi kata sandi tidak cocok.'
    return
  }

  isLoading.value = true
  errorMsg.value = ''
  successMsg.value = ''

  try {
    const { error } = await supabase.auth.updateUser({
      password: password.value
    })

    if (error) {
      errorMsg.value = error.message || 'Gagal mengatur ulang kata sandi.'
    } else {
      successMsg.value = 'Kata sandi berhasil diperbarui. Mengalihkan Anda ke halaman login...'
      setTimeout(() => {
        router.push('/login')
      }, 2500)
    }
  } catch (err: any) {
    console.error(err)
    errorMsg.value = 'Terjadi kesalahan sistem. Silakan coba kembali beberapa saat lagi.'
  } finally {
    isLoading.value = false
  }
}
</script>

<template>
  <div 
    class="min-h-screen bg-cover bg-center flex items-center justify-center p-4 sm:p-6 relative overflow-hidden font-sans"
    style="background-image: url('/image/gedung-unujogja.jpg')"
  >
    <!-- Dark tint overlay -->
    <div class="absolute inset-0 bg-slate-950/70 backdrop-blur-[3px] pointer-events-none"></div>

    <!-- Back to Login floating link -->
    <NuxtLink 
      to="/login" 
      class="absolute top-6 left-6 inline-flex items-center space-x-2 text-xs font-semibold text-white/80 hover:text-white transition-colors z-20"
    >
      <ArrowLeft class="w-4 h-4" />
      <span>Kembali ke Login</span>
    </NuxtLink>

    <!-- Floating Glassmorphic Card -->
    <div class="w-full max-w-md bg-white/95 backdrop-blur-md border border-white/20 shadow-2xl rounded-[2rem] p-8 sm:p-10 relative z-10 space-y-6">
      
      <!-- Header -->
      <div class="text-center space-y-2">
        <div class="flex justify-center mb-3">
          <img src="/image/logo-warna.png" alt="SATGAS PPKS Logo" class="h-16 w-auto object-contain" />
        </div>
        <h2 class="text-xl sm:text-2xl font-bold text-slate-800 tracking-tight">Atur Ulang Kata Sandi</h2>
        <p class="text-xs text-slate-500 font-medium">Buat kata sandi baru untuk akun administrator Anda</p>
      </div>

      <!-- Success Message -->
      <div v-if="successMsg" class="bg-green-50 border-l-4 border-green-500 text-green-700 p-3.5 rounded-r-xl text-xs font-medium">
        {{ successMsg }}
      </div>

      <!-- Error Message -->
      <div v-if="errorMsg" class="bg-red-50 border-l-4 border-red-500 text-red-700 p-3.5 rounded-r-xl text-xs font-medium">
        <p class="font-bold">Gagal Memperbarui</p>
        <p class="opacity-90 mt-0.5">{{ errorMsg }}</p>
      </div>

      <!-- Form -->
      <form @submit.prevent="handleUpdatePassword" class="space-y-4" v-if="!successMsg">
        
        <!-- Password Baru -->
        <div class="space-y-1.5">
          <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-widest">Kata Sandi Baru</label>
          <div class="relative">
            <input 
              :type="showPassword ? 'text' : 'password'" 
              id="password" 
              v-model="password"
              placeholder="Minimal 6 karakter" 
              class="block w-full px-4 py-3 pr-12 border border-slate-200 rounded-xl bg-slate-50 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:bg-white focus:border-theme-primary focus:ring-2 focus:ring-theme-primary/20 transition-all duration-300"
              required
            />
            <button 
              type="button" 
              class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-650 transition-colors"
              @click="showPassword = !showPassword"
            >
              <Eye v-if="!showPassword" class="h-4.5 w-4.5" />
              <EyeOff v-else class="h-4.5 w-4.5" />
            </button>
          </div>
        </div>

        <!-- Konfirmasi Password -->
        <div class="space-y-1.5">
          <label for="confirmPassword" class="block text-xs font-bold text-slate-700 uppercase tracking-widest">Konfirmasi Kata Sandi</label>
          <input 
            :type="showPassword ? 'text' : 'password'" 
            id="confirmPassword" 
            v-model="confirmPassword"
            placeholder="Ketik ulang kata sandi baru" 
            class="block w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:bg-white focus:border-theme-primary focus:ring-2 focus:ring-theme-primary/20 transition-all duration-300"
            required
          />
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
          <button 
            type="submit" 
            :disabled="isLoading"
            class="w-full flex justify-center items-center py-3 px-4 rounded-xl shadow-lg shadow-theme-primary/10 text-xs font-bold text-slate-900 bg-theme-primary hover:bg-amber-450 transition-all duration-200 uppercase tracking-widest disabled:opacity-60"
          >
            <Loader2 v-if="isLoading" class="w-4 h-4 animate-spin mr-2" />
            <span v-else>Perbarui Kata Sandi</span>
          </button>
        </div>
      </form>

    </div>
  </div>
</template>
