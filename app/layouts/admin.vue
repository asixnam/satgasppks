<script setup lang="ts">
import { ref } from 'vue'
import { useRouter } from 'vue-router'
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
const isSidebarOpen = ref(true)

const handleLogout = async () => {
  const { error } = await supabase.auth.signOut()
  if (!error) {
    router.push('/')
  }
}

const toggleSidebar = () => {
  isSidebarOpen.value = !isSidebarOpen.value
}
</script>

<template>
  <div class="min-h-screen bg-slate-50 flex">
    
    <!-- Sidebar -->
    <aside 
      class="bg-slate-900 text-white transition-all duration-300 flex flex-col justify-between shrink-0 relative z-40 border-r border-slate-800"
      :class="{ 'w-64': isSidebarOpen, 'w-20': !isSidebarOpen }"
    >
      <div>
        <!-- Sidebar Brand Header -->
        <div class="h-16 flex items-center px-4 justify-between border-b border-slate-800">
          <div class="flex items-center space-x-3 overflow-hidden" v-if="isSidebarOpen">
            <div class="w-8 h-8 bg-green-700 text-yellow-300 font-bold rounded-lg flex items-center justify-center shrink-0">
              P
            </div>
            <span class="font-extrabold text-sm tracking-wider uppercase">SATGAS ADMIN</span>
          </div>
          <div v-else class="w-full flex justify-center">
            <div class="w-8 h-8 bg-green-700 text-yellow-300 font-bold rounded-lg flex items-center justify-center shrink-0">
              P
            </div>
          </div>
        </div>

        <!-- Navigation items -->
        <nav class="p-3 space-y-1">
          <NuxtLink 
            to="/admin/dashboard" 
            class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition-colors"
            active-class="bg-green-800 hover:bg-green-700 font-semibold"
            :title="!isSidebarOpen ? 'Dashboard' : ''"
          >
            <LayoutDashboard class="w-5 h-5 shrink-0" />
            <span v-if="isSidebarOpen" class="text-sm">Dashboard</span>
          </NuxtLink>
          
          <NuxtLink 
            to="/admin/violence-reports" 
            class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition-colors"
            active-class="bg-green-800 hover:bg-green-700 font-semibold"
            :title="!isSidebarOpen ? 'Laporan Kekerasan' : ''"
          >
            <FileWarning class="w-5 h-5 shrink-0" />
            <span v-if="isSidebarOpen" class="text-sm">Laporan Kekerasan</span>
          </NuxtLink>

          <NuxtLink 
            to="/admin/beritas" 
            class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition-colors"
            active-class="bg-green-800 hover:bg-green-700 font-semibold"
            :title="!isSidebarOpen ? 'Kelola Berita' : ''"
          >
            <Newspaper class="w-5 h-5 shrink-0" />
            <span v-if="isSidebarOpen" class="text-sm">Kelola Berita</span>
          </NuxtLink>

          <NuxtLink 
            to="/admin/edukasis" 
            class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition-colors"
            active-class="bg-green-800 hover:bg-green-700 font-semibold"
            :title="!isSidebarOpen ? 'Kelola Edukasi' : ''"
          >
            <BookOpen class="w-5 h-5 shrink-0" />
            <span v-if="isSidebarOpen" class="text-sm">Kelola Edukasi</span>
          </NuxtLink>

          <NuxtLink 
            to="/admin/tims" 
            class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition-colors"
            active-class="bg-green-800 hover:bg-green-700 font-semibold"
            :title="!isSidebarOpen ? 'Kelola Tim' : ''"
          >
            <Users class="w-5 h-5 shrink-0" />
            <span v-if="isSidebarOpen" class="text-sm">Kelola Tim</span>
          </NuxtLink>

          <NuxtLink 
            to="/admin/visi-misi" 
            class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition-colors"
            active-class="bg-green-800 hover:bg-green-700 font-semibold"
            :title="!isSidebarOpen ? 'Kelola Visi Misi' : ''"
          >
            <Eye class="w-5 h-5 shrink-0" />
            <span v-if="isSidebarOpen" class="text-sm">Visi Misi</span>
          </NuxtLink>

          <NuxtLink 
            to="/admin/hero" 
            class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition-colors"
            active-class="bg-green-800 hover:bg-green-700 font-semibold"
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
        
        <div class="text-sm font-semibold text-slate-600">
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
