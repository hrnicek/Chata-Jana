<script setup>
import HeroContent from "./HeroContent.vue";
</script>

<template>
  <div class="hero-font bg-gray-900 text-white">
    <div class="relative min-h-screen w-full overflow-hidden">
      <div class="absolute inset-0 z-0">
        <img
          alt="Luxusní horská chata s wellness za západu slunce"
          class="h-full w-full object-cover"
          src="/img/hero4.png"
        />
        <div class="absolute inset-0 bg-black/40"></div>
      </div>

      <div class="relative z-10 flex min-h-screen flex-col pt-24">
        <HeroContent />
      </div>
    </div>
  </div>
</template>
