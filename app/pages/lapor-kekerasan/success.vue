<script setup lang="ts">
import { useRoute } from 'vue-router'
import { ref } from 'vue'
import { CheckCircle2, Copy, Check, Search, ExternalLink } from 'lucide-vue-next'

const route = useRoute()
const ticketCode = computed(() => (route.query.ticket as string) || 'PPKS-XXXX-XXXXXXXXXX')

const copied = ref(false)

const copyTicket = () => {
  if (navigator.clipboard) {
    navigator.clipboard.writeText(ticketCode.value)
    copied.value = true
    setTimeout(() => {
      copied.value = false
    }, 2000)
  }
}
</script>

<template>
  <div class="max-w-xl mx-auto px-4 py-16 text-center">
    <div class="bg-white border border-gray-100 rounded-3xl p-8 sm:p-12 shadow-sm space-y-8">
      
      <!-- Check Icon -->
      <div class="inline-flex p-4 bg-green-50 text-green-700 rounded-full border border-green-100">
        <CheckCircle2 class="w-16 h-16" />
      </div>

      <!-- Header messages -->
      <div class="space-y-2">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Laporan Berhasil Terkirim</h1>
        <p class="text-gray-500 text-sm">
          Terima kasih atas keberanian Anda melapor. Kasus Anda telah masuk ke antrean investigasi SATGAS PPKS.
        </p>
      </div>

      <!-- Ticket Code box -->
      <div class="bg-slate-50 border border-slate-100 rounded-2xl p-6 space-y-3">
        <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">NOMOR TIKET LAPORAN ANDA</p>
        
        <div class="flex items-center justify-center space-x-3">
          <span class="text-lg sm:text-2xl font-mono font-black text-slate-800 tracking-wider">
            {{ ticketCode }}
          </span>
          <button 
            @click="copyTicket"
            class="p-2 bg-white border border-gray-200 rounded-xl hover:bg-slate-100 text-slate-600 active:scale-95 transition-all"
            title="Salin Nomor Tiket"
          >
            <Check v-if="copied" class="w-4 h-4 text-green-700" />
            <Copy v-else class="w-4 h-4" />
          </button>
        </div>
        
        <p class="text-xs text-gray-500">
          Simpan nomor tiket di atas dengan baik. Nomor ini digunakan untuk memeriksa status perkembangan laporan Anda.
        </p>
      </div>

      <!-- What to do next -->
      <div class="text-left space-y-4 pt-2">
        <h3 class="font-bold text-slate-800 text-sm uppercase tracking-wide">Langkah Selanjutnya:</h3>
        <ol class="list-decimal pl-5 text-xs sm:text-sm text-gray-600 space-y-2">
          <li>Tim pendamping SATGAS PPKPT akan memverifikasi berkas laporan Anda.</li>
          <li>Kami akan menghubungi Anda atau Pelapor via Email/WhatsApp dalam waktu 1x24 jam untuk proses konseling & verifikasi data.</li>
          <li>Anda dapat memantau status penanganan kasus ini kapan saja menggunakan fitur "Cek Status".</li>
        </ol>
      </div>

      <!-- Actions -->
      <div class="pt-4 flex flex-col sm:flex-row gap-3 justify-center">
        <NuxtLink 
          :to="`/cek-status?ticket=${ticketCode}`" 
          class="px-6 py-3 bg-green-700 hover:bg-green-600 text-white font-bold rounded-xl text-sm shadow-md transition-colors inline-flex items-center justify-center space-x-2"
        >
          <Search class="w-4 h-4" />
          <span>Cek Status Laporan</span>
        </NuxtLink>
        <NuxtLink 
          to="/" 
          class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 border border-gray-200 rounded-xl text-sm font-bold transition-colors inline-flex items-center justify-center space-x-2"
        >
          <span>Kembali ke Beranda</span>
        </NuxtLink>
      </div>

    </div>
  </div>
</template>
