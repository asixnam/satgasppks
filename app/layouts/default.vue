<script setup lang="ts">
import { computed } from 'vue'

const route = useRoute()
const isHome = computed(() => route.path === '/')
</script>

<template>
  <div class="min-h-screen flex flex-col">
    <!-- Top loading progress bar for page transitions -->
    <NuxtLoadingIndicator color="#f1c40f" :height="3" />

    <!-- Header -->
    <HeaderApp />

    <!-- Main Content Slot -->
    <main class="flex-grow" :class="{ 'pt-16 sm:pt-20': !isHome }">
      <slot />
    </main>

    <!-- Footer -->
    <FooterApp />
  </div>
</template>
