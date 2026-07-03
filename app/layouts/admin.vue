<script setup lang="ts">
import { ref, onMounted, watch } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { 
  LayoutDashboard, 
  FileWarning, 
  Newspaper, 
  BookOpen, 
  Users, 
  Eye, 
  Image, 
  LogOut,
  ChevronLeft,
  ChevronRight,
  Menu,
  Home
} from 'lucide-vue-next'

const supabase = useSupabaseClient()
const router = useRouter()
const route = useRoute()
const isSidebarOpen = ref(false)

onMounted(() => {
  if (typeof window !== 'undefined') {
    isSidebarOpen.value = window.innerWidth >= 768
  }
})

// Auto-close sidebar on mobile after navigating
watch(() => route.path, () => {
  if (typeof window !== 'undefined' && window.innerWidth < 768) {
    isSidebarOpen.value = false
  }
})

const handleLogout = async () => {
  const authFallback = useCookie('auth_fallback')
  authFallback.value = null
  
  try {
    await supabase.auth.signOut()
  } catch (e) {
    console.error('Supabase signout bypassed:', e)
  }
  router.push('/')
}

const toggleSidebar = () => {
  isSidebarOpen.value = !isSidebarOpen.value
}
</script>

<template>
  <div class="min-h-screen bg-white flex relative">
    
    <!-- Mobile Sidebar Overlay -->
    <div 
      v-if="isSidebarOpen" 
      @click="isSidebarOpen = false" 
      class="fixed inset-0 bg-black/50 z-40 md:hidden"
    ></div>

    <!-- Sidebar -->
    <aside 
      class="bg-black text-white transition-all duration-300 flex flex-col justify-between shrink-0 fixed inset-y-0 left-0 z-50 border-r border-slate-800 md:relative md:translate-x-0"
      :class="{ 
        'w-64 translate-x-0': isSidebarOpen, 
        'w-64 -translate-x-full md:w-20 md:translate-x-0': !isSidebarOpen 
      }"
    >
      <div>
        <!-- Sidebar Brand Header -->
        <div class="h-16 flex items-center px-4 justify-between border-b border-black-800">
          <div class="flex items-center space-x-3 overflow-hidden" v-if="isSidebarOpen">
            <img src="/image/logo-warna.png" alt="SATGAS PPKS Logo" class="h-8 w-auto object-contain shrink-0 brightness-0 invert" />
            <span class="font-extrabold text-sm tracking-wider uppercase">SATGAS ADMIN</span>
          </div>
          <div v-else class="w-full flex justify-center">
            <img src="/image/logo-warna.png" alt="SATGAS PPKS Logo" class="h-8 w-auto object-contain shrink-0 brightness-0 invert" />
          </div>
        </div>

        <!-- Navigation items -->
        <nav class="p-3 space-y-1">
          <NuxtLink 
            to="/admin/dashboard" 
            class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition-colors"
            active-class="bg-theme-primary text-white font-semibold"
            :title="!isSidebarOpen ? 'Dashboard' : ''"
          >
            <LayoutDashboard class="w-5 h-5 shrink-0" />
            <span v-if="isSidebarOpen" class="text-sm">Dashboard</span>
          </NuxtLink>
          
          <NuxtLink 
            to="/admin/violence-reports" 
            class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition-colors"
            active-class="bg-theme-primary text-white font-semibold"
            :title="!isSidebarOpen ? 'Laporan Kekerasan' : ''"
          >
            <FileWarning class="w-5 h-5 shrink-0" />
            <span v-if="isSidebarOpen" class="text-sm">Laporan Kekerasan</span>
          </NuxtLink>

          <NuxtLink 
            to="/admin/beritas" 
            class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition-colors"
            active-class="bg-theme-primary text-white font-semibold"
            :title="!isSidebarOpen ? 'Kelola Berita' : ''"
          >
            <Newspaper class="w-5 h-5 shrink-0" />
            <span v-if="isSidebarOpen" class="text-sm">Kelola Berita</span>
          </NuxtLink>

          <NuxtLink 
            to="/admin/edukasis" 
            class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition-colors"
            active-class="bg-theme-primary text-white font-semibold"
            :title="!isSidebarOpen ? 'Kelola Edukasi' : ''"
          >
            <BookOpen class="w-5 h-5 shrink-0" />
            <span v-if="isSidebarOpen" class="text-sm">Kelola Edukasi</span>
          </NuxtLink>

          <NuxtLink 
            to="/admin/tims" 
            class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition-colors"
            active-class="bg-theme-primary text-white font-semibold"
            :title="!isSidebarOpen ? 'Kelola Tim' : ''"
          >
            <Users class="w-5 h-5 shrink-0" />
            <span v-if="isSidebarOpen" class="text-sm">Kelola Tim</span>
          </NuxtLink>

          <NuxtLink 
            to="/admin/visi-misi" 
            class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition-colors"
            active-class="bg-theme-primary text-white font-semibold"
            :title="!isSidebarOpen ? 'Kelola Visi Misi' : ''"
          >
            <Eye class="w-5 h-5 shrink-0" />
            <span v-if="isSidebarOpen" class="text-sm">Visi Misi</span>
          </NuxtLink>

          <NuxtLink 
            to="/admin/hero" 
            class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition-colors"
            active-class="bg-theme-primary text-white font-semibold"
            :title="!isSidebarOpen ? 'Kelola Banner Slider' : ''"
          >
            <Image class="w-5 h-5 shrink-0" />
            <span v-if="isSidebarOpen" class="text-sm">Hero Banner</span>
          </NuxtLink>
        </nav>
      </div>

      <!-- Sidebar footer / log out -->
      <div class="p-3 border-t border-slate-800 space-y-1">
        <NuxtLink 
          to="/" 
          class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-white transition-colors"
          :title="!isSidebarOpen ? 'Ke Portal Publik' : ''"
        >
          <Home class="w-5 h-5 shrink-0" />
          <span v-if="isSidebarOpen" class="text-sm">Portal Publik</span>
        </NuxtLink>
        
        <button 
          @click="handleLogout" 
          class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-red-950 hover:text-red-300 text-slate-400 transition-colors w-full text-left"
          :title="!isSidebarOpen ? 'Log Out' : ''"
        >
          <LogOut class="w-5 h-5 shrink-0 text-red-500" />
          <span v-if="isSidebarOpen" class="text-sm">Log Out</span>
        </button>
      </div>
    </aside>

    <!-- Content area -->
    <div class="flex-1 flex flex-col min-w-0">
      
      <!-- Top header navbar -->
      <header class="h-16 bg-white border-b border-gray-100 flex items-center px-6 justify-between shadow-sm relative z-30">
        <button 
          @click="toggleSidebar"
          class="p-2 hover:bg-gray-100 rounded-lg text-slate-600 transition-colors"
        >
          <Menu class="w-5 h-5" />
        </button>
        
        <div class="text-xs sm:text-sm font-semibold text-slate-600 truncate max-w-[200px] sm:max-w-none">
          Sistem Informasi Administrasi SATGAS PPKS
        </div>
      </header>

      <!-- Main Slot -->
      <main class="flex-grow p-6 overflow-y-auto">
        <slot />
      </main>

    </div>
  </div>
</template>
