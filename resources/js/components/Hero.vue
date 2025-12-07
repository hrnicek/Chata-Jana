<script setup>
import { onMounted, ref } from 'vue';
import HeroContent from "./HeroContent.vue";
import gsap from 'gsap';

const heroImage = ref(null);

onMounted(() => {
  gsap.fromTo(heroImage.value, 
    { scale: 1 }, 
    { scale: 1.1, duration: 20, ease: "none", repeat: -1, yoyo: true }
  );
});
</script>

<template>
  <div class="hero-font bg-gray-900 text-white">
    <div class="relative min-h-screen w-full overflow-hidden">
      <div class="absolute inset-0 z-0">
        <img
          ref="heroImage"
          src="/img/hero.webp"
          alt="Luxusní horská chata s wellness za západu slunce"
          class="h-full w-full object-cover"
        />
        <div class="absolute inset-0 bg-black/40"></div>
      </div>

      <div class="relative z-10 flex min-h-screen flex-col pt-24">
        <HeroContent />
      </div>
    </div>
  </div>
</template>
