<script setup>
const props = defineProps({
  title: {
    type: String,
    required: true
  },
  subtitle: {
    type: String,
    required: true
  },
  badge: {
    type: String,
    default: null
  },
  image: {
    type: String,
    default: '/img/hero.jpg'
  }
});
</script>

<template>
  <div class="relative overflow-hidden pt-48 pb-32 -z-10">
    <!-- Background Image -->
    <div class="absolute inset-0 bg-cover bg-center opacity-100" :style="{ backgroundImage: `url(${image})` }"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-gray-900/50 to-gray-900"></div>
    
    <div class="container relative mx-auto px-6 text-center">
      <!-- Badge -->
      <div v-if="badge" class="mb-6 inline-flex items-center gap-2 rounded-full border border-white/30 bg-white/10 px-4 py-1.5 text-sm font-medium text-white">
        <span>{{ badge }}</span>
      </div>
      
      <!-- Title -->
      <h1 class="text-5xl font-bold tracking-tight text-white md:text-6xl lg:text-7xl">
        {{ title }}
      </h1>
      
      <!-- Subtitle -->
      <p class="mx-auto mt-6 max-w-2xl text-xl text-white/80">
        {{ subtitle }}
      </p>
    </div>
  </div>
</template>
