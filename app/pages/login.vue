<script setup lang="ts">
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { Eye, EyeOff, Loader2, ArrowLeft, X } from 'lucide-vue-next'

// Disable layout (removes HeaderApp and FooterApp)
definePageMeta({
  layout: false
})

const supabase = useSupabaseClient()
const router = useRouter()

const email = ref('')
const password = ref('')
const showPassword = ref(false)
const errorMsg = ref('')
const isLoading = ref(false)

// Fallback Login Credentials for Local Development/Assessment
const FALLBACK_EMAIL = 'admin@satgas.ppks'
const FALLBACK_PASSWORD = 'admin123'

const handleLogin = async () => {
  isLoading.value = true
  errorMsg.value = ''

  // Fallback Check
  if (email.value === FALLBACK_EMAIL && password.value === FALLBACK_PASSWORD) {
    const authFallback = useCookie('auth_fallback')
    authFallback.value = 'true'
    isLoading.value = false
    router.push('/admin/dashboard')
    return
  }

  try {
    const { error } = await supabase.auth.signInWithPassword({
      email: email.value,
      password: password.value
    })

    if (error) {
      errorMsg.value = 'Email atau password salah. Silakan coba kembali.'
    } else {
      const authFallback = useCookie('auth_fallback')
      authFallback.value = null
      router.push('/admin/dashboard')
    }
  } catch (err: any) {
    console.error(err)
    // If Supabase fails due to network/placeholder URL, suggest backup developer login
    errorMsg.value = 'Terjadi kesalahan sistem. Silakan masuk menggunakan kredensial cadangan developer.'
  } finally {
    isLoading.value = false
  }
}

// Reset Password Modal State
const isResetModalOpen = ref(false)
const resetEmail = ref('')
const isResetLoading = ref(false)
const resetSuccessMsg = ref('')
const resetErrorMsg = ref('')

const openResetModal = () => {
  isResetModalOpen.value = true
  resetEmail.value = ''
  resetSuccessMsg.value = ''
  resetErrorMsg.value = ''
}

const closeResetModal = () => {
  isResetModalOpen.value = false
}

const handleResetPassword = async () => {
  isResetLoading.value = true
  resetSuccessMsg.value = ''
  resetErrorMsg.value = ''

  try {
    // If it's a fallback reset, simulate it
    if (resetEmail.value === FALLBACK_EMAIL) {
      setTimeout(() => {
        resetSuccessMsg.value = `Instruksi pemulihan simulasi telah dikirim untuk ${FALLBACK_EMAIL}. Silakan gunakan password '${FALLBACK_PASSWORD}' untuk login.`
        isResetLoading.value = false
      }, 1000)
      return
    }

    const { error } = await supabase.auth.resetPasswordForEmail(resetEmail.value, {
      redirectTo: window.location.origin + '/reset-password'
    })

    if (error) {
      resetErrorMsg.value = error.message || 'Gagal mengirim instruksi pemulihan.'
    } else {
      resetSuccessMsg.value = 'Instruksi pemulihan kata sandi telah dikirim ke email Anda. Silakan periksa kotak masuk (atau spam).'
      resetEmail.value = ''
    }
  } catch (err: any) {
    console.error(err)
    resetErrorMsg.value = 'Terjadi kesalahan sistem. Silakan coba kembali beberapa saat lagi.'
  } finally {
    isResetLoading.value = false
  }
}
</script>

<template>
  <div 
    class="min-h-screen bg-cover bg-center flex items-center justify-center p-4 sm:p-8 md:p-16 relative overflow-hidden font-sans"
    style="background-image: url('/image/gedung-unujogja.jpg')"
  >
    <!-- Light background shadow overlay, no blur, no heavy filters -->
    <div class="absolute inset-0 bg-slate-950/40 pointer-events-none"></div>

    <!-- Back to Home floating link -->
    <NuxtLink 
      to="/" 
      class="absolute top-6 left-6 inline-flex items-center space-x-2 text-xs font-semibold text-white/80 hover:text-white transition-colors z-20"
    >
      <ArrowLeft class="w-4 h-4" />
      <span>Beranda</span>
    </NuxtLink>

    <!-- Content Wrap for Split Layout using Grid -->
    <div class="w-full max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-12 gap-12 lg:gap-16 items-center relative z-10">
      
      <!-- Left Side: Floating Dark Glassmorphic Card (Login Form) -->
      <div class="w-full md:col-span-5 lg:col-span-5 bg-black/45 backdrop-blur-lg border border-white/10 rounded-[2rem] p-8 sm:p-10 shadow-2xl space-y-6 text-white shrink-0">
        
        <!-- Header & Logo -->
        <div class="text-center space-y-2">
          <div class="flex items-center justify-center space-x-4 mb-3">
            <!-- White/Inverted Logo wrapper if needed, or normal logowarna -->
            <img src="/image/unu-putih.png" alt="UNU Logo" class="h-12 w-auto object-contain brightness-0 invert" />
            <div class="h-8 w-px bg-white/20"></div>
            <img src="/image/logo-warna.png" alt="SATGAS PPKs" class="h-12 w-auto object-contain brightness-0 invert" />
          </div>
          <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-white">Selamat Datang</h2>
          <p class="text-[10px] text-white/70">Silahkan masukan email dan password anda</p>
        </div>

        <!-- Error Message -->
        <div v-if="errorMsg" class="bg-red-500/20 border-l-4 border-red-500 text-red-200 p-3 rounded-xl text-xs">
          {{ errorMsg }}
        </div>

        <!-- Form -->
        <form @submit.prevent="handleLogin" class="space-y-4">
          <!-- Email Field -->
          <div class="space-y-1.5">
            <label for="email" class="block text-[10px] font-bold uppercase tracking-wider text-white/95">Email</label>
            <input 
              type="email" 
              id="email" 
              v-model="email"
              placeholder="user@gmail.com" 
              class="w-full px-4 py-3 bg-white/10 border border-white/15 rounded-xl text-sm text-white placeholder-white/35 focus:outline-none focus:border-theme-primary focus:bg-white/15 transition-all duration-300"
              required
              autofocus
            />
          </div>

          <!-- Password Field -->
          <div class="space-y-1.5">
            <div class="flex items-center justify-between">
              <label for="password" class="block text-[10px] font-bold uppercase tracking-wider text-white/95">Password</label>
            </div>
            <div class="relative">
              <input 
                :type="showPassword ? 'text' : 'password'" 
                id="password" 
                v-model="password"
                placeholder="Masukan password anda" 
                class="w-full px-4 py-3 pr-12 bg-white/10 border border-white/15 rounded-xl text-sm text-white placeholder-white/35 focus:outline-none focus:border-theme-primary focus:bg-white/15 transition-all duration-300"
                required
              />
              <button 
                type="button" 
                class="absolute inset-y-0 right-0 pr-4 flex items-center text-white/50 hover:text-white transition-colors"
                @click="showPassword = !showPassword"
              >
                <Eye v-if="!showPassword" class="h-4 w-4" />
                <EyeOff v-else class="h-4 w-4" />
              </button>
            </div>
          </div>

          <!-- Keep Signed In & Forgot Password -->
          <div class="flex items-center justify-between text-xs pt-1.5">
            <label class="flex items-center space-x-2 text-white/80 font-medium cursor-pointer group">
              <input 
                type="checkbox" 
                class="h-3.5 w-3.5 bg-white/10 border-white/15 text-theme-primary focus:ring-theme-primary border rounded transition-colors"
              />
              <span class="group-hover:text-white transition-colors text-[11px]">Ingat Saya</span>
            </label>
            <button 
              type="button" 
              @click="openResetModal"
              class="text-[11px] text-theme-primary font-bold hover:underline transition-colors bg-transparent border-0 cursor-pointer"
            >
              Lupa Password?
            </button>
          </div>

          <!-- Submit Button -->
          <div class="pt-3">
            <button 
              type="submit" 
              :disabled="isLoading"
              class="w-full flex justify-center items-center py-3.5 px-4 rounded-xl shadow-lg shadow-theme-primary/10 text-xs font-extrabold text-white bg-amber-600 hover:bg-amber-500 active:scale-[0.98] transition-all duration-200 uppercase tracking-widest disabled:opacity-60"
            >
              <Loader2 v-if="isLoading" class="w-4 h-4 animate-spin mr-2" />
              <div v-else class="flex items-center space-x-2">
                <span class="w-5 h-5 bg-white/20 rounded-full flex items-center justify-center text-[10px]">
                  <i class="fas fa-arrow-right text-white"></i>
                </span>
                <span>Masuk</span>
              </div>
            </button>
          </div>

          <!-- Google Login & Register Placeholders matching the reference image -->
          <!-- <div class="space-y-4 pt-2">
            <div class="relative flex py-1 items-center">
              <div class="flex-grow border-t border-white/10"></div>
              <span class="flex-shrink mx-4 text-[9px] text-white/40 uppercase tracking-widest">Atau masuk dengan</span>
              <div class="flex-grow border-t border-white/10"></div>
            </div>

            <button 
              type="button" 
              class="w-full flex justify-center items-center py-3 bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold rounded-xl shadow-md transition-all duration-250 space-x-2"
              @click="errorMsg = 'Masuk menggunakan Akun Google dinonaktifkan untuk Administrator.'"
            >
              <svg class="h-4 w-4" viewBox="0 0 24 24">
                <path fill="#EA4335" d="M12.24 10.285V14.4h6.887c-.275 1.565-1.88 4.604-6.887 4.604-4.33 0-7.859-3.579-7.859-8s3.53-8 7.859-8c2.46 0 4.105 1.025 5.047 1.926l3.253-3.13C18.427 1.572 15.607 0 12.24 0 5.58 0 .193 5.373.193 12s5.387 12 12.047 12c6.96 0 11.57-4.854 11.57-11.77 0-.79-.085-1.393-.19-1.945H12.24z"/>
              </svg>
              <span>Login dengan Google</span>
            </button>

            <div class="text-center text-[11px] text-white/60">
              Belum punya akun? 
              <a 
                href="#" 
                class="text-theme-primary font-bold hover:underline"
                @click="errorMsg = 'Registrasi akun baru hanya dapat dilakukan oleh Super Admin Satgas.'"
              >
                Daftar Sekarang
              </a>
            </div>
          </div> -->
        </form>

      </div>

      <!-- Right Side: Clean Bold Headings (Adapted to Satgas PPKPT) -->
      <div class="hidden md:block md:col-span-7 lg:col-span-6 lg:col-start-7 text-white text-left space-y-6 lg:pl-4">
        
        <!-- Action Tag/Badge -->
        <div>
          <span class="inline-block bg-black/40 border border-white/10 px-4 py-1.5 rounded-full text-[10px] font-bold text-white tracking-widest uppercase shadow-sm">
            Sistem Informasi Satgas PPKPT
          </span>
        </div>

        <!-- Headline -->
        <h1 class="text-4xl lg:text-5xl font-black leading-[1.1] text-white uppercase tracking-tight">
          Mewujudkan<br>
          Kampus Aman &<br>
          Bebas Kekerasan.
        </h1>

        <!-- Subheading -->
        <p class="text-xs opacity-90 leading-relaxed max-w-lg">
          Lembaga garda terdepan Universitas Nahdlatul Ulama Yogyakarta yang berkomitmen penuh dalam melakukan pencegahan dan penanganan kekerasan seksual demi kenyamanan serta keselamatan seluruh civitas akademika.
        </p>

        <!-- Social Proof / Assurances -->
        <div class="flex items-center space-x-4 pt-4 border-t border-white/10 max-w-lg">
          <div class="flex items-center shrink-0">
            <!-- 100% Secure Yellow badge -->
            <div class="w-10 h-10 rounded-full bg-theme-primary text-slate-950 font-extrabold flex items-center justify-center text-[10px] border-2 border-slate-950 z-20 shadow-md">
              100%
            </div>
            <!-- Overlapping avatars / security badges -->
            <div class="w-10 h-10 rounded-full bg-slate-800 border-2 border-slate-950 -ml-3 z-10 flex items-center justify-center">
              <i class="fas fa-shield-alt text-slate-400 text-xs"></i>
            </div>
            <div class="w-10 h-10 rounded-full bg-slate-700 border-2 border-slate-950 -ml-3 z-0 flex items-center justify-center">
              <i class="fas fa-lock text-slate-400 text-xs"></i>
            </div>
          </div>
          <div class="space-y-0.5">
            <h4 class="font-bold text-xs text-white">Jaminan Kerahasiaan Identitas</h4>
            <p class="text-[9px] text-theme-primary uppercase font-extrabold tracking-wider">Laporan Anda dilindungi sepenuhnya oleh kebijakan privasi & hukum</p>
          </div>
        </div>

      </div>

    </div>

    <!-- Reset Password Modal Overlay -->
    <div 
      v-if="isResetModalOpen" 
      class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm z-50 flex items-center justify-center p-4"
    >
      <div class="bg-slate-900 border border-slate-800 rounded-3xl w-full max-w-md p-6 sm:p-8 space-y-6 relative text-white shadow-2xl">
        <button 
          type="button" 
          @click="closeResetModal" 
          class="absolute top-4 right-4 text-slate-400 hover:text-white transition-colors"
        >
          <X class="w-5 h-5" />
        </button>

        <div class="space-y-2">
          <h3 class="text-xl font-bold">Lupa Kata Sandi?</h3>
          <p class="text-xs text-slate-400">Masukkan email Anda untuk menerima instruksi pemulihan kata sandi.</p>
        </div>

        <div v-if="resetSuccessMsg" class="bg-green-500/10 border-l-4 border-green-500 text-green-300 p-3.5 rounded-r-xl text-xs">
          {{ resetSuccessMsg }}
        </div>

        <div v-if="resetErrorMsg" class="bg-red-500/10 border-l-4 border-red-500 text-red-300 p-3.5 rounded-r-xl text-xs">
          {{ resetErrorMsg }}
        </div>

        <form @submit.prevent="handleResetPassword" class="space-y-4" v-if="!resetSuccessMsg">
          <div class="space-y-1.5">
            <label for="resetEmail" class="block text-[10px] font-bold uppercase tracking-wider text-slate-400">Email Administrator</label>
            <input 
              type="email" 
              id="resetEmail" 
              v-model="resetEmail"
              placeholder="admin@satgas.ppks" 
              class="w-full px-4 py-3 bg-white/5 border border-slate-800 rounded-xl text-sm text-white placeholder-white/35 focus:outline-none focus:border-theme-primary focus:bg-white/10 transition-all duration-300"
              required
            />
          </div>

          <button 
            type="submit" 
            :disabled="isResetLoading"
            class="w-full flex justify-center items-center py-3 px-4 rounded-xl shadow-lg text-xs font-extrabold text-slate-950 bg-theme-primary hover:bg-amber-400 active:scale-[0.98] transition-all duration-200 uppercase tracking-widest disabled:opacity-60"
          >
            <Loader2 v-if="isResetLoading" class="w-4 h-4 animate-spin mr-2" />
            <span>Kirim Instruksi</span>
          </button>
        </form>

        <div class="text-center pt-2" v-else>
          <button 
            type="button" 
            @click="closeResetModal" 
            class="text-xs font-bold text-theme-primary hover:underline"
          >
            Kembali ke Login
          </button>
        </div>
      </div>
    </div>

  </div>
</template>
