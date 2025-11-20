<script setup lang="ts">
import Hero from "../components/Hero.vue";
import WebLayout from "../layouts/WebLayout.vue";
import { Link } from "@inertiajs/vue3";
import {
  Mountain,
  Bath,
  Trees,
  Quote,
  Camera,
  CalendarDays,
  Wifi,
  Tv,
  Utensils,
  Car,
  Baby,
  Bike,
  Snowflake,
  ArrowRight,
  Star,
  MapPin,
} from "lucide-vue-next";

const amenities = [
  { icon: Wifi, label: "Wifi zdarma" },
  { icon: Tv, label: "Smart TV" },
  { icon: Utensils, label: "Plně vybavená kuchyň" },
  { icon: Car, label: "Parkování u chaty" },
  { icon: Baby, label: "Vybavení pro děti" },
  { icon: Bike, label: "Kolárna" },
  { icon: Snowflake, label: "Lyžárna" },
];

const features = [
  {
    icon: Bath,
    title: "Soukromé wellness",
    description: "Vířivka pro 6 osob a relaxační zóna pro dokonalý odpočinek po náročném dni.",
  },
  {
    icon: Trees,
    title: "V srdci přírody",
    description: "Nacházíme se v klidné části Ostružné, obklopeni lesy a horskými loukami.",
  },
  {
    icon: CalendarDays,
    title: "Flexibilní rezervace",
    description: "Jednoduchý rezervační systém s okamžitým potvrzením vašeho termínu.",
  },
];

const reviews = [
  {
    text: "Nejlepší wellness pobyt, který jsme zažili. Chata je nádherná, čistá a majitelé jsou velmi vstřícní.",
    author: "Petra",
    rating: 5,
  },
  {
    text: "Skvělá lokalita, perfektní vybavení. Děti byly nadšené z herny i okolí. Určitě se vrátíme.",
    author: "Martin",
    rating: 5,
  },
  {
    text: "Úžasný klid a pohoda. Vířivka pod hvězdami neměla chybu. Doporučuji všem!",
    author: "Jana",
    rating: 5,
  },
];
</script>

<template>
  <WebLayout>
    <Hero />

    <!-- Intro Section -->
    <section class="relative overflow-hidden bg-white py-24 lg:py-32">
      <div class="container mx-auto px-6">
        <div class="grid items-center gap-16 lg:grid-cols-2">
          <div class="order-2 lg:order-1">
            <div class="relative aspect-[4/3] overflow-hidden rounded-[2.5rem]">
              <img
                src="/img/hero2.jpg"
                alt="Chata Jana exteriér"
                class="h-full w-full object-cover transition-transform duration-700 hover:scale-105"
              />
              <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
            </div>
          </div>
          <div class="order-1 lg:order-2">
            <div class="mb-6 inline-flex items-center gap-2 rounded-full bg-[--color-honey] px-4 py-1.5 text-sm font-medium text-[--color-primary]">
              <Mountain class="h-4 w-4" />
              <span>O místě</span>
            </div>
            <h2 class="text-4xl font-bold tracking-tight text-gray-900 lg:text-5xl">
              Vaše horské <span class="text-[--color-primary]">útočiště</span>
            </h2>
            <p class="mt-6 text-lg leading-relaxed text-gray-600">
              Chata Jana nabízí unikátní spojení komfortu, soukromého wellness a divoké přírody Jeseníků. 
              Ať už hledáte aktivní dovolenou na lyžích nebo klidný víkend s rodinou, u nás najdete 
              vše potřebné pro nezapomenutelné zážitky.
            </p>
            
            <div class="mt-10 flex flex-wrap items-center gap-4">
              <Link
                :href="route('bookings.calendar')"
                class="group inline-flex items-center gap-2 rounded-full bg-[--color-primary] px-8 py-4 font-medium text-white transition-all hover:bg-[#1a3f2a] hover:shadow-lg hover:shadow-[--color-primary]/20"
              >
                Rezervovat termín
                <ArrowRight class="h-4 w-4 transition-transform group-hover:translate-x-1" />
              </Link>
              <Link 
                href="#galerie" 
                class="inline-flex items-center gap-2 rounded-full border border-gray-200 px-8 py-4 font-medium text-gray-700 transition-colors hover:bg-gray-50 hover:text-gray-900"
              >
                Prohlédnout galerii
              </Link>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Amenities Marquee/Grid -->
    <section class="bg-gray-50 py-20">
      <div class="container mx-auto px-6">
        <div class="mb-12 text-center">
          <h3 class="text-2xl font-bold text-gray-900">Prvotřídní vybavení</h3>
          <p class="mt-2 text-gray-600">Vše pro vaše maximální pohodlí</p>
        </div>
        
        <div class="grid grid-cols-2 gap-4 md:grid-cols-4 lg:grid-cols-7">
          <div 
            v-for="(item, index) in amenities" 
            :key="index"
            class="group flex flex-col items-center justify-center gap-3 rounded-3xl bg-white p-6 text-center shadow-sm transition-all hover:-translate-y-1 hover:shadow-md"
          >
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[--color-honey] text-[--color-primary] transition-colors group-hover:bg-[--color-primary] group-hover:text-white">
              <component :is="item.icon" class="h-6 w-6" />
            </div>
            <span class="text-sm font-medium text-gray-900">{{ item.label }}</span>
          </div>
        </div>
      </div>
    </section>

    <!-- Features Section -->
    <section class="py-24">
      <div class="container mx-auto px-6">
        <div class="grid gap-8 md:grid-cols-3">
          <div 
            v-for="(feature, index) in features" 
            :key="index"
            class="relative overflow-hidden rounded-[2.5rem] bg-gray-900 p-10 text-white transition-transform hover:scale-[1.02]"
          >
            <div class="absolute right-0 top-0 -mr-16 -mt-16 h-64 w-64 rounded-full bg-white/5 blur-3xl"></div>
            <component :is="feature.icon" class="relative mb-6 h-10 w-10 text-[--color-secondary]" />
            <h3 class="relative mb-3 text-xl font-bold">{{ feature.title }}</h3>
            <p class="relative text-gray-300">{{ feature.description }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Gallery Section -->
    <section id="galerie" class="bg-gray-50 py-24">
      <div class="container mx-auto px-6">
        <div class="mb-12 flex items-end justify-between">
          <div>
            <div class="mb-4 inline-flex items-center gap-2 text-sm font-bold uppercase tracking-wider text-[--color-primary]">
              <Camera class="h-4 w-4" />
              <span>Galerie</span>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 md:text-4xl">Nahlédněte dovnitř</h2>
          </div>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
          <div class="group relative overflow-hidden rounded-3xl md:col-span-2">
            <img src="/img/hero.jpg" alt="Wellness" class="h-80 w-full object-cover transition-transform duration-700 group-hover:scale-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100">
              <div class="absolute bottom-6 left-6 text-white">
                <p class="font-medium">Wellness zóna</p>
              </div>
            </div>
          </div>
          <div class="group relative overflow-hidden rounded-3xl">
            <img src="/img/hero3.jpg" alt="Interiér" class="h-80 w-full object-cover transition-transform duration-700 group-hover:scale-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100">
              <div class="absolute bottom-6 left-6 text-white">
                <p class="font-medium">Obývací prostor</p>
              </div>
            </div>
          </div>
          <div class="group relative overflow-hidden rounded-3xl">
            <img src="/img/hero2.jpg" alt="Exteriér" class="h-80 w-full object-cover transition-transform duration-700 group-hover:scale-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100">
              <div class="absolute bottom-6 left-6 text-white">
                <p class="font-medium">Exteriér chaty</p>
              </div>
            </div>
          </div>
          <div class="group relative overflow-hidden rounded-3xl md:col-span-2">
            <img src="/img/hero4.png" alt="Okolí" class="h-80 w-full object-cover transition-transform duration-700 group-hover:scale-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100">
              <div class="absolute bottom-6 left-6 text-white">
                <p class="font-medium">Zimní atmosféra</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Reviews Section -->
    <section class="py-24">
      <div class="container mx-auto px-6">
        <div class="mb-16 text-center">
          <Quote class="mx-auto mb-4 h-8 w-8 text-[--color-primary]/30" />
          <h2 class="text-3xl font-bold text-gray-900">Co o nás říkají hosté</h2>
        </div>

        <div class="grid gap-8 md:grid-cols-3">
          <div 
            v-for="(review, index) in reviews" 
            :key="index"
            class="flex flex-col justify-between rounded-3xl border border-gray-100 bg-white p-8 shadow-lg shadow-gray-200/50"
          >
            <div>
              <div class="mb-4 flex gap-1">
                <Star v-for="i in 5" :key="i" class="h-4 w-4 fill-[--color-secondary] text-[--color-secondary]" />
              </div>
              <p class="text-gray-700 leading-relaxed">"{{ review.text }}"</p>
            </div>
            <div class="mt-6 flex items-center gap-3 border-t border-gray-100 pt-6">
              <div class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 font-bold text-gray-600">
                {{ review.author[0] }}
              </div>
              <div class="font-medium text-gray-900">{{ review.author }}</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="pb-24 pt-12">
      <div class="container mx-auto px-6">
        <div class="relative overflow-hidden rounded-[3rem] bg-[--color-primary] px-6 py-20 text-center sm:px-12 lg:py-32">
          <!-- Decorative elements -->
          <div class="absolute left-0 top-0 -ml-24 -mt-24 h-96 w-96 rounded-full bg-white/5 blur-3xl"></div>
          <div class="absolute bottom-0 right-0 -mb-24 -mr-24 h-96 w-96 rounded-full bg-[--color-secondary]/10 blur-3xl"></div>
          
          <div class="relative z-10 mx-auto max-w-2xl">
            <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl lg:text-5xl">
              Připraveni na nezapomenutelný pobyt?
            </h2>
            <p class="mx-auto mt-6 max-w-xl text-lg text-white/80">
              Rezervujte si svůj termín včas. Těšíme se na vaši návštěvu v Chatě Jana.
            </p>
            <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row">
              <Link
                :href="route('bookings.calendar')"
                class="w-full rounded-full bg-white px-8 py-4 font-bold text-[--color-primary] transition-transform hover:scale-105 sm:w-auto"
              >
                Rezervovat nyní
              </Link>
              <Link
                href="#galerie"
                class="w-full rounded-full border border-white/30 bg-white/10 px-8 py-4 font-bold text-white backdrop-blur-sm transition-colors hover:bg-white/20 sm:w-auto"
              >
                Prohlédnout chatu
              </Link>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-gray-100 bg-white py-16">
      <div class="container mx-auto px-6">
        <div class="flex flex-col items-center justify-between gap-8 md:flex-row">
          <div class="flex items-center gap-4">
            <img src="/img/logo.png" alt="Logo" class="h-12" />
            <div class="flex flex-col">
              <span class="font-bold text-gray-900">Chata Jana</span>
              <span class="text-sm text-gray-500">Ostružná, Jeseníky</span>
            </div>
          </div>
          
          <div class="flex gap-8 text-sm font-medium text-gray-600">
            <Link :href="route('bookings.calendar')" class="hover:text-[--color-primary]">Rezervace</Link>
            <a href="#" class="hover:text-[--color-primary]">Obchodní podmínky</a>
            <a href="#" class="hover:text-[--color-primary]">Kontakt</a>
          </div>
          
          <div class="text-sm text-gray-400">
            © {{ new Date().getFullYear() }} Chata Jana. Všechna práva vyhrazena.
          </div>
        </div>
      </div>
    </footer>
  </WebLayout>
</template>
