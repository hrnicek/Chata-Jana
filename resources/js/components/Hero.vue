<script setup>
import HeroContent from "./HeroContent.vue";
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Autoplay } from 'swiper/modules';
import 'swiper/css';

const images = ['/img/hero.webp', '/img/hero2.webp', '/img/hero3.webp', '/img/hero4.webp'];
</script>

<template>
  <div class="hero-font bg-gray-900 text-white">
    <div class="relative min-h-screen w-full overflow-hidden">
      <div class="absolute inset-0 z-0">
        <Swiper :modules="[Autoplay]" :autoplay="{ delay: 5000, disableOnInteraction: false }" loop class="h-full w-full">
          <SwiperSlide v-for="image in images" :key="image">
            <img
              :src="image"
              alt="Luxusní horská chata s wellness za západu slunce"
              class="h-full w-full object-cover"
            />
          </SwiperSlide>
        </Swiper>
        <div class="absolute inset-0 bg-black/40"></div>
      </div>

      <div class="relative z-10 flex min-h-screen flex-col pt-24">
        <HeroContent />
      </div>
    </div>
  </div>
</template>
