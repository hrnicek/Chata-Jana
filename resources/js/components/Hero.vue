<script setup>
import HeroContent from "./HeroContent.vue";
import { ref, onMounted, onUnmounted } from "vue";
import { gsap } from "gsap";

const heroImg = ref();
let tween;

onMounted(() => {
  tween = gsap.to(heroImg.value, {
    scale: 1.06,
    duration: 3,
    repeat: -1,
    yoyo: true,
    ease: "sine.inOut",
  });
});

onUnmounted(() => {
  if (tween) tween.kill();
});
</script>

<template>
  <div class="hero-font bg-gray-900 text-white -mt-24">
    <div class="relative min-h-screen w-full overflow-hidden">
      <div class="absolute inset-0 z-0">
        <img
          alt="Luxusní horská chata s wellness za západu slunce"
          class="h-full w-full object-cover will-change-transform"
          src="/img/hero4.png"
          ref="heroImg"
        />
        <div class="absolute inset-0 bg-linear-to-t from-black/60 via-black/30 to-black/10"></div>
        <div
          class="absolute inset-0 bg-linear-to-r from-black/50 via-transparent to-black/20"
        ></div>
      </div>

      <div class="relative z-10 flex min-h-screen flex-col pt-24">
        <HeroContent />
      </div>
    </div>
  </div>
</template>
