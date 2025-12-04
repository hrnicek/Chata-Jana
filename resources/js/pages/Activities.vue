<script setup>
import WebLayout from "../layouts/WebLayout.vue";
import PageHeader from "../components/PageHeader.vue";
import { Mountain, Bike, Trees, Snowflake, MapPin } from "lucide-vue-next";

const activities = [
  { icon: Bike, title: "Lyžování a snowboarding", text: "Sjezdovky i běžkařské trasy v bezprostřední blízkosti." },
  { icon: Bike, title: "Cyklo a turistika", text: "Rozsáhlá síť tras pro horská kola i pěší výlety." },
  { icon: Trees, title: "Procházky přírodou", text: "Klidné lesní cesty a vyhlídky s panoramaty Jeseníků." },
  { icon: Snowflake, title: "Zimní atmosféra", text: "Kouzelná zima s možností wellness po návratu." },
  { icon: Mountain, title: "Vrcholy a rozhledny", text: "Výstupy na nejkrásnější místa regionu s působivými výhledy." },
  { icon: MapPin, title: "Okolní zajímavosti", text: "Naučné stezky, muzea a lokální dobroty v blízkém okolí." },
];
</script>

<template>
  <WebLayout>
    <PageHeader 
      badge="Aktivity & okolí"
      title="Co dělat v Ostružné"
      subtitle="Vydejte se objevovat Jeseníky – sport, příroda, kultura i lokální zážitky."
      image="/img/hero.webp"
    />

    <section class="relative -mt-20 pb-24">
      <div class="container mx-auto px-6">
        <div class="grid gap-8 md:grid-cols-3">
          <div 
            v-for="(act, i) in activities" 
            :key="i"
            class="light-card p-10"
          >
            <div class="light-icon mb-6">
              <component :is="act.icon" class="h-6 w-6" />
            </div>
            <h3 class="mb-2 text-lg font-bold text-gray-900">{{ act.title }}</h3>
            <p class="text-gray-700">{{ act.text }}</p>
          </div>
        </div>
      </div>
    </section>
  </WebLayout>
</template>