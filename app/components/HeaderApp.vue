<script setup lang="ts">
import { ref, onMounted, onUnmounted, computed } from 'vue'

const user = useSupabaseUser()
const route = useRoute()
const isScrolled = ref(false)
const isMobileMenuOpen = ref(false)

const isHeaderTransparent = computed(() => {
  return route.path === '/' && !isScrolled.value
})

const handleScroll = () => {
  isScrolled.value = window.scrollY > 10
}

onMounted(() => {
  window.addEventListener('scroll', handleScroll)
  handleScroll()
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
})

const toggleMobileMenu = () => {
  isMobileMenuOpen.value = !isMobileMenuOpen.value
  if (isMobileMenuOpen.value) {
    document.body.style.overflow = 'hidden'
  } else {
    document.body.style.overflow = ''
  }
}
</script>

<template>
  <div>
    <!-- Mobile Menu Overlay -->
    <div 
      v-if="isMobileMenuOpen"
      class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-40 transition-opacity duration-300"
      @click="toggleMobileMenu"
    ></div>

    <!-- Header Navigation -->
    <header 
      class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 border-b"
      :class="isHeaderTransparent ? 'bg-transparent border-transparent py-3.5' : 'bg-white border-slate-100 shadow-sm py-2'"
    >
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-14">
          
          <!-- Logo Brand -->
          <NuxtLink to="/" class="flex items-center space-x-3 shrink-0">
            <img 
              src="/image/unu-putih.png" 
              alt="logo unu" 
              class="h-10 sm:h-11 w-auto object-contain transition-all duration-300"
              :class="isHeaderTransparent ? 'logo-white' : 'logo-gold'"
            >
            <img 
              src="/image/logo-warna.png" 
              alt="SATGAS PPKS Logo" 
              class="h-10 sm:h-11 w-auto object-contain transition-all duration-300"
              :class="isHeaderTransparent ? 'logo-white' : 'logo-gold'"
            />
            
            <!-- <div class="flex flex-col leading-none transition-colors duration-300" :class="isHeaderTransparent ? 'text-white' : 'text-slate-800'">
              <span class="font-extrabold text-sm sm:text-base uppercase tracking-tight">SATGAS PPKS</span>
              <span class="text-[10px] sm:text-xs font-semibold mt-0.5 transition-colors duration-300" :class="isHeaderTransparent ? 'text-white/80' : 'text-slate-400'">UNU Yogyakarta</span>
            </div> -->
          </NuxtLink>

          <!-- Desktop Navigation -->
          <nav class="hidden lg:flex items-center space-x-6 xl:space-x-8">
            <NuxtLink 
              to="/" 
              class="text-sm font-semibold transition-colors duration-300 py-2"
              :class="isHeaderTransparent ? 'text-white/90 hover:text-white' : 'text-black hover:text-black'"
              :active-class="isHeaderTransparent ? 'text-white font-bold border-b-2 border-white' : 'text-black font-bold border-b-2 border-black'"
            >
              Beranda
            </NuxtLink>
            <NuxtLink 
              to="/cek-status" 
              class="text-sm font-semibold transition-colors duration-300 py-2"
              :class="isHeaderTransparent ? 'text-white/90 hover:text-white' : 'text-black hover:text-black'"
              :active-class="isHeaderTransparent ? 'text-white font-bold border-b-2 border-white' : 'text-black font-bold border-b-2 border-black'"
            >
              Cek Status
            </NuxtLink>
            <NuxtLink 
              to="/berita" 
              class="text-sm font-semibold transition-colors duration-300 py-2"
              :class="isHeaderTransparent ? 'text-white/90 hover:text-white' : 'text-black hover:text-black'"
              :active-class="isHeaderTransparent ? 'text-white font-bold border-b-2 border-white' : 'text-black font-bold border-b-2 border-black'"
            >
              Berita
            </NuxtLink>
            <NuxtLink 
              to="/edukasi" 
              class="text-sm font-semibold transition-colors duration-300 py-2"
              :class="isHeaderTransparent ? 'text-white/90 hover:text-white' : 'text-black hover:text-black'"
              :active-class="isHeaderTransparent ? 'text-white font-bold border-b-2 border-white' : 'text-black font-bold border-b-2 border-black'"
            >
              Edukasi
            </NuxtLink>
            <NuxtLink 
              to="/tentang-kami" 
              class="text-sm font-semibold transition-colors duration-300 py-2 mr-2"
              :class="isHeaderTransparent ? 'text-white/90 hover:text-white' : 'text-black hover:text-black'"
              :active-class="isHeaderTransparent ? 'text-white font-bold border-b-2 border-white' : 'text-black font-bold border-b-2 border-black'"
            >
              Tentang
            </NuxtLink>
            <NuxtLink 
              to="/lapor-kekerasan" 
              class="px-4 py-2 border text-xs font-bold rounded-xl transition-all duration-300 transform hover:scale-105 inline-flex items-center uppercase tracking-wider"
              :class="isHeaderTransparent ? 'border-white text-white bg-transparent hover:bg-white hover:text-slate-900' : 'border-theme-primary text-theme-primary bg-transparent hover-bg-theme-primary hover:text-white'"
            >
              <i class="fas fa-exclamation-triangle mr-1.5"></i>
              Lapor
            </NuxtLink>

            <!-- Dashboard Admin access -->
            <NuxtLink 
              v-if="user" 
              to="/admin/dashboard" 
              class="px-4 py-2 bg-theme-primary hover-bg-theme-primary text-white text-xs font-bold rounded-xl shadow-sm transition-colors uppercase tracking-wider"
            >
              Dashboard
            </NuxtLink>
          </nav>

          <!-- Mobile navigation menu trigger -->
          <button 
            @click="toggleMobileMenu" 
            class="lg:hidden p-2 rounded-xl transition-all duration-300"
            :class="isHeaderTransparent ? 'text-white hover:bg-white/10' : 'text-slate-600 hover:bg-slate-50'"
            aria-label="Toggle Menu"
          >
            <i class="fas" :class="isMobileMenuOpen ? 'fa-times text-lg' : 'fa-bars text-lg'"></i>
          </button>

        </div>
      </div>
    </header>

    <!-- Mobile Navigation Drawer -->
    <div 
      class="fixed top-0 bottom-0 left-0 w-72 bg-white shadow-2xl z-50 transform transition-transform duration-300 ease-in-out lg:hidden flex flex-col justify-between"
      :class="isMobileMenuOpen ? 'translate-x-0' : '-translate-x-full'"
    >
      <div class="p-6 space-y-6">
        <!-- Brand Header inside Mobile menu -->
        <div class="flex items-center justify-between border-b border-slate-50 pb-4">
          <div class="flex items-center space-x-2.5">
            <img src="/image/logo-warna.png" alt="SATGAS PPKS" class="h-8 w-auto" />
          </div>
          <button @click="toggleMobileMenu" class="text-slate-400 hover:text-slate-600 p-1">
            <i class="fas fa-times"></i>
          </button>
        </div>

        <!-- Menu Links -->
        <nav class="flex flex-col space-y-4">
          <NuxtLink 
            to="/" 
            @click="toggleMobileMenu"
            class="text-sm font-semibold text-slate-600 hover-text-theme-primary transition-colors py-1.5"
            active-class="text-theme-primary font-bold"
          >
            Beranda
          </NuxtLink>
          <NuxtLink 
            to="/lapor-kekerasan" 
            @click="toggleMobileMenu"
            class="text-sm font-semibold text-slate-600 hover-text-theme-primary transition-colors py-1.5"
            active-class="text-theme-primary font-bold"
          >
            Lapor Kasus
          </NuxtLink>
          <NuxtLink 
            to="/cek-status" 
            @click="toggleMobileMenu"
            class="text-sm font-semibold text-slate-600 hover-text-theme-primary transition-colors py-1.5"
            active-class="text-theme-primary font-bold"
          >
            Cek Status
          </NuxtLink>
          <NuxtLink 
            to="/berita" 
            @click="toggleMobileMenu"
            class="text-sm font-semibold text-slate-600 hover-text-theme-primary transition-colors py-1.5"
            active-class="text-theme-primary font-bold"
          >
            Berita
          </NuxtLink>
          <NuxtLink 
            to="/edukasi" 
            @click="toggleMobileMenu"
            class="text-sm font-semibold text-slate-600 hover-text-theme-primary transition-colors py-1.5"
            active-class="text-theme-primary font-bold"
          >
            Edukasi
          </NuxtLink>
          <NuxtLink 
            to="/tentang-kami" 
            @click="toggleMobileMenu"
            class="text-sm font-semibold text-slate-600 hover-text-theme-primary transition-colors py-1.5"
            active-class="text-theme-primary font-bold"
          >
            Tentang Kami
          </NuxtLink>
        </nav>
      </div>

      <!-- Footer in Mobile Drawer -->
      <div class="p-6 border-t border-slate-50" v-if="user">
        <NuxtLink 
          to="/admin/dashboard" 
          @click="toggleMobileMenu"
          class="w-full py-2.5 bg-theme-primary hover-bg-theme-primary-dark text-white text-xs font-bold rounded-xl flex items-center justify-center space-x-2 transition-colors uppercase tracking-wider"
        >
          <i class="fas fa-gauge"></i>
          <span>Dashboard Admin</span>
        </NuxtLink>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Scored transition helper */
nav.flex-col .router-link-exact-active {
  color: #FF6B18;
  font-weight: bold;
}

.logo-gold {
  filter: brightness(0);
  transition: filter 0.3s ease;
}

.logo-white {
  filter: brightness(0) invert(1);
  transition: filter 0.3s ease;
}
</style>
