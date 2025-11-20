<script setup>
import WebLayout from "../layouts/WebLayout.vue";
import PageHeader from "../components/PageHeader.vue";
import { Heart, Home, Users, Leaf } from "lucide-vue-next";

const highlights = [
  { icon: Home, title: "Komfortní zázemí", text: "Moderní interiér, soukromé wellness a plně vybavená kuchyně." },
  { icon: Users, title: "Rodinná atmosféra", text: "Přátelský přístup a osobní péče o každý detail vašeho pobytu." },
  { icon: Leaf, title: "Blízkost přírody", text: "Klidná lokalita v Ostružné s krásnými výhledy na Jeseníky." },
];
</script>

<template>
  <WebLayout>
    <PageHeader 
      badge="O nás"
      title="Poznejte Chatu Jana"
      subtitle="Rodinné ubytování v srdci Jeseníků. Dbáme na pohodlí, klid a poctivou péči o hosty."
      image="/img/hero2.jpg"
    />

    <section class="relative -mt-20 pb-24">
      <div class="container mx-auto px-6">
        <div class="grid gap-8 md:grid-cols-2">
          <div class="light-card p-10">
            <div class="mb-6 inline-flex items-center gap-2 rounded-full bg-honey px-4 py-1.5 text-sm font-medium text-primary">
              <Heart class="h-4 w-4" />
              <span>Náš příběh</span>
            </div>
            <h2 class="mb-4 text-3xl font-bold text-gray-900">Od srdce pro hosty</h2>
            <p class="text-gray-700 leading-relaxed">
              Chata Jana je místo pro odpočinek, rodinná setkání a radost z horské přírody.
              Navrhli jsme ji tak, aby spojovala komfort, estetiku a praktičnost pro každý den pobytu.
            </p>
          </div>
          <div class="light-card p-10">
            <h3 class="mb-4 text-xl font-bold text-gray-900">Proč si vybrat právě nás</h3>
            <div class="grid gap-6 sm:grid-cols-2">
              <div v-for="(h, i) in highlights" :key="i" class="space-y-2">
                <div class="light-icon"><component :is="h.icon" class="h-6 w-6" /></div>
                <div class="text-gray-900 font-semibold">{{ h.title }}</div>
                <div class="text-gray-700">{{ h.text }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </WebLayout>
</template>