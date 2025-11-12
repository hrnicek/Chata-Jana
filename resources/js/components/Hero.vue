<script setup>
import AppHeader from "./AppHeader.vue";
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
        <div class="absolute inset-0 bg-linear-to-t from-black/60 via-black/30 to-black/10"></div>
        <div
          class="absolute inset-0 bg-linear-to-r from-black/50 via-transparent to-black/20"
        ></div>
      </div>

      <div class="relative z-10 flex min-h-screen flex-col">
        <AppHeader />
        <HeroContent />
      </div>
    </div>
  </div>
</template>
