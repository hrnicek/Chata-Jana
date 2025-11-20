<script setup>
import WebLayout from "../layouts/WebLayout.vue";
import PageHeader from "../components/PageHeader.vue";
import { Camera } from "lucide-vue-next";

const images = [
  { src: "/img/hero.jpg", label: "Wellness zóna" },
  { src: "/img/hero2.jpg", label: "Exteriér chaty" },
  { src: "/img/hero3.jpg", label: "Interiér" },
  { src: "/img/hero4.png", label: "Zimní atmosféra" },
  { src: "/img/hero.jpg", label: "Relax u krbu" },
  { src: "/img/hero2.jpg", label: "Terasa" },
];
</script>

<template>
  <WebLayout>
    <PageHeader 
      badge="Fotogalerie"
      title="Nahlédněte dovnitř"
      subtitle="Prohlédněte si interiér, wellness i okolní přírodu."
      image="/img/hero3.jpg"
    />

    <section class="relative -mt-20 pb-24">
      <div class="container mx-auto px-6">
        <div class="mb-12 flex items-end justify-between">
          <div class="inline-flex items-center gap-2 text-sm font-bold uppercase tracking-wider text-primary">
            <Camera class="h-4 w-4" />
            <span>Galerie</span>
          </div>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
          <div 
            v-for="(img, i) in images" 
            :key="i"
            class="group relative overflow-hidden rounded-3xl"
          >
            <img :src="img.src" :alt="img.label" class="h-80 w-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100">
              <div class="absolute bottom-6 left-6 text-white">
                <p class="font-medium">{{ img.label }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </WebLayout>
</template>