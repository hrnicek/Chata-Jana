<script setup lang="ts">
import Hero from "../components/Hero.vue";
import WebLayout from "../layouts/WebLayout.vue";
import Button from "../components/ui/button.vue";
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
  CreditCard,
  Key,
  Users,
  ShieldCheck,
  CloudSun,
  Wind,
  MountainSnow,
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

const faqs = [
  {
    q: "Jaká je kapacita a dispozice pokojů?",
    a: "Kapacita je 12 osob v pěti pokojích: 2× dvojlůžko s přistýlkou, 2× dvojlůžko a 1× pokoj se dvěma samostatnými lůžky.",
  },
  {
    q: "Je wellness soukromé a co obsahuje?",
    a: "Ano, wellness je soukromé: vířivka pro 6 osob, odpočinková kuchyňka, WC a prostorný obývací pokoj v přízemí.",
  },
  {
    q: "Jaké jsou ceny a sezóny?",
    a: "Ceny se liší podle sezóny (Léto 5 500 Kč/noc, Zima 6 000 Kč/noc, Mimo sezónu 5 000 Kč/noc, Silvestr fixně 85 000 Kč). Kompletní přehled najdete v sekci Ceník.",
  },
  {
    q: "Jak probíhá platba a záloha?",
    a: "Záloha 30 % potvrzuje rezervaci, doplatek 70 % nejpozději 14 dní před příjezdem. U last minute pod 14 dní se hradí 100 % ihned.",
  },
  {
    q: "Jsou povoleni psi a jaké jsou poplatky?",
    a: "Ano, pes je povolen za 350 Kč/den. Rekreační poplatek je 20 Kč za dospělou osobu/den.",
  },
  {
    q: "Jak se účtuje elektřina?",
    a: "Hradí se dle skutečné spotřeby na místě: VT 9 Kč/kWh, NT 8 Kč/kWh.",
  },
  {
    q: "Časy příjezdu a odjezdu?",
    a: "Check‑in od 14:00, check‑out do 10:00.",
  },
];

const howItWorks = [
  {
    icon: CalendarDays,
    title: "Vyberte termín",
    desc: "V našem online kalendáři snadno zjistíte volné kapacity.",
  },
  {
    icon: CreditCard,
    title: "Potvrďte rezervaci",
    desc: "Uhrazením 30% zálohy se váš termín stává závazným.",
  },
  {
    icon: Key,
    title: "Užijte si pobyt",
    desc: "Příjezd je bezstarostný díky self-check-in systému.",
  },
];

const stats = [
  { value: "1200+", label: "Spokojených hostů", icon: Users },
  { value: "4.9/5", label: "Průměrné hodnocení", icon: Star },
  { value: "100%", label: "Soukromí a klid", icon: ShieldCheck },
  { value: "800m", label: "Nadmořská výška", icon: CloudSun },
];
</script>

<template>
  <WebLayout>
    <Hero />

            <!-- Amenities Marquee/Grid -->
    <section class="bg-honey py-32">
      <div class="container mx-auto px-6">
        <div class="mb-16 text-center">
          <h3 class="text-3xl font-bold text-primary">Prvotřídní vybavení</h3>
          <p class="mt-4 text-gray-600">Vše pro vaše maximální pohodlí</p>
        </div>
        
        <div class="grid grid-cols-2 gap-6 md:grid-cols-4 lg:grid-cols-7">
          <div 
            v-for="(item, index) in amenities" 
            :key="index"
            class="group flex flex-col items-center justify-center gap-4 rounded-3xl bg-white p-8 text-center transition-colors hover:bg-primary hover:text-white"
          >
            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-honey text-primary group-hover:bg-white/10 group-hover:text-white">
              <component :is="item.icon" class="h-7 w-7" />
            </div>
            <span class="text-sm font-medium text-gray-900 group-hover:text-white">{{ item.label }}</span>
          </div>
        </div>
      </div>
    </section>

    <!-- Intro Section -->
    <section class="relative overflow-hidden bg-white py-32 lg:py-40">
      <div class="container mx-auto px-6">
        <div class="grid items-center gap-16 lg:grid-cols-12">
          <!-- Image Composition -->
          <div class="relative order-2 lg:col-span-7 lg:order-1">
            <!-- Main Image -->
            <div class="relative z-10 aspect-[4/3] w-5/6 overflow-hidden rounded-[3rem]">
              <img
                src="/img/hero2.jpg"
                alt="Chata Jana exteriér"
                class="h-full w-full object-cover"
              />
              <div class="absolute inset-0 bg-black/10"></div>
            </div>
            
            <!-- Secondary Image (Overlapping) -->
            <div class="absolute -bottom-12 -right-4 z-20 w-1/2 overflow-hidden rounded-[2.5rem] border-8 border-white shadow-none lg:-right-8 lg:bottom-12">
               <div class="aspect-square relative">
                 <img
                  src="/img/hero3.jpg"
                  alt="Interiér detail"
                  class="h-full w-full object-cover"
                />
               </div>
            </div>

            <!-- Decorative Circle -->
            <div class="absolute -left-12 -top-12 z-0 h-64 w-64 rounded-full bg-honey opacity-50 blur-3xl"></div>
          </div>

          <!-- Text Content -->
          <div class="order-1 lg:col-span-5 lg:order-2 lg:pl-12">
            <div class="mb-8 inline-flex items-center gap-2 rounded-full border border-primary/10 bg-honey px-4 py-1.5 text-sm font-medium text-primary">
              <Mountain class="h-4 w-4" />
              <span>O místě</span>
            </div>
            <h2 class="text-4xl font-bold tracking-tight text-primary lg:text-6xl">
              Vaše horské <span class="text-secondary">útočiště</span> v Jeseníkách
            </h2>
            <p class="mt-8 text-xl leading-relaxed text-gray-600">
              Chata Jana spojuje komfort, soukromé wellness a kouzlo Jeseníků. 
              Ať už míříte za sportem, nebo klidem s rodinou, čeká vás pohodlí i zážitky.
            </p>
            
            <div class="mt-12 flex flex-wrap items-center gap-6">
              <Button
                :as="Link"
                :href="route('home')"
                variant="default"
                class="group px-8 py-6 text-lg"
              >
                Rezervovat termín
                <ArrowRight class="ml-2 h-5 w-5" />
              </Button>
              <Button 
                :as="Link"
                href="#galerie" 
                variant="outline"
                class="px-8 py-6 text-lg"
              >
                Prohlédnout galerii
              </Button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Philosophy of Silence Section -->
    <section class="relative overflow-hidden bg-primary py-40 text-white">
      <!-- Background Texture -->
      <div class="absolute inset-0">
        <img 
          src="/img/hero4.png" 
          alt="Hory v mlze" 
          class="h-full w-full object-cover opacity-40 mix-blend-overlay"
        />
        <div class="absolute inset-0 bg-primary/40"></div>
      </div>
      
      <div class="absolute top-0 left-0 right-0 h-16 bg-white" style="clip-path: polygon(0 0, 100% 0, 100% 100%, 0 0);"></div>
      
      <div class="container relative z-10 mx-auto px-6 text-center">
        <Wind class="mx-auto mb-8 h-12 w-12 text-white/60" />
        <h2 class="mx-auto max-w-4xl text-3xl font-light leading-tight text-white md:text-5xl">
          "Ticho není prázdno. Je to prostor, kde se můžete znovu nadechnout."
        </h2>
        <div class="mx-auto mt-12 h-px w-24 bg-white/30"></div>
        <p class="mx-auto mt-12 max-w-2xl text-lg text-white/80">
          Věříme, že skutečný odpočinek přichází, když se zastaví čas. Naše chata je navržena tak, aby vás obklopila klidem hor a nechala starosti v údolí.
        </p>
      </div>
      <div class="absolute bottom-0 left-0 right-0 h-16 bg-white" style="clip-path: polygon(0 100%, 100% 0, 100% 100%, 0 100%);"></div>
    </section>

    <!-- How It Works Section -->
    <section class="bg-white py-32">
      <div class="container mx-auto px-6">
        <div class="mb-16 text-center">
          <h2 class="text-3xl font-bold text-gray-900">Jak to u nás funguje?</h2>
          <p class="mt-4 text-gray-600">Jednoduchá cesta k vašemu odpočinku</p>
        </div>

        <div class="grid gap-8 md:grid-cols-3">
          <div 
            v-for="(step, index) in howItWorks" 
            :key="index"
            class="group relative flex flex-col items-center text-center"
          >
            <div class="mb-6 flex h-20 w-20 items-center justify-center rounded-full border-2 border-gray-100 bg-white text-primary transition-colors group-hover:border-primary group-hover:bg-honey">
              <component :is="step.icon" class="h-8 w-8" />
            </div>
            <h3 class="mb-3 text-xl font-bold text-gray-900">{{ step.title }}</h3>
            <p class="text-gray-600">{{ step.desc }}</p>
            
            <!-- Connector Line (Desktop only) -->
            <div v-if="index < 2" class="absolute top-10 -right-1/2 hidden h-0.5 w-full bg-gray-100 lg:block"></div>
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
            class="light-card transition-colors hover:border-primary"
          >
            <div class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-honey text-primary">
              <component :is="feature.icon" class="h-6 w-6" />
            </div>
            <h3 class="mb-3 text-xl font-bold text-gray-900">{{ feature.title }}</h3>
            <p class="text-gray-700">{{ feature.description }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Gallery Section -->
    <section id="galerie" class="bg-white py-32">
      <div class="container mx-auto px-6">
        <div class="mb-20 flex flex-col items-center text-center">
          <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-primary/10 bg-honey px-4 py-1.5 text-sm font-medium text-primary">
            <Camera class="h-4 w-4" />
            <span>Fotogalerie</span>
          </div>
          <h2 class="text-4xl font-bold text-primary md:text-5xl">Okna do ticha</h2>
          <p class="mt-6 max-w-2xl text-lg text-gray-600">
            Každý kout naší chaty je navržen pro vaše pohodlí. 
            Prohlédněte si místa, kde budete trávit společné chvíle.
          </p>
        </div>

        <div class="grid gap-8 md:grid-cols-12">
          <!-- Item 1: Large (Wellness) -->
          <div class="group md:col-span-8">
            <div class="relative aspect-[16/10] overflow-hidden rounded-[2.5rem]">
              <img src="/img/hero.jpg" alt="Wellness zóna" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" />
            </div>
            <div class="mt-4 flex items-center justify-between px-2">
              <h3 class="text-xl font-semibold text-primary">Wellness zóna</h3>
              <span class="text-sm text-secondary">Vířivka & Relax</span>
            </div>
          </div>

          <!-- Item 2: Tall (Interior) -->
          <div class="group md:col-span-4">
            <div class="relative aspect-[4/5] overflow-hidden rounded-[2.5rem]">
              <img src="/img/hero3.jpg" alt="Obývací prostor" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" />
            </div>
            <div class="mt-4 flex items-center justify-between px-2">
              <h3 class="text-xl font-semibold text-primary">Obývací prostor</h3>
              <span class="text-sm text-secondary">Společné chvíle</span>
            </div>
          </div>

          <!-- Item 3: Wide (Exterior) -->
          <div class="group md:col-span-6">
            <div class="relative aspect-[16/9] overflow-hidden rounded-[2.5rem]">
              <img src="/img/hero2.jpg" alt="Exteriér chaty" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" />
            </div>
            <div class="mt-4 flex items-center justify-between px-2">
              <h3 class="text-xl font-semibold text-primary">Exteriér chaty</h3>
              <span class="text-sm text-secondary">V srdci přírody</span>
            </div>
          </div>

          <!-- Item 4: Wide (Surroundings) -->
          <div class="group md:col-span-6">
            <div class="relative aspect-[16/9] overflow-hidden rounded-[2.5rem]">
              <img src="/img/hero4.png" alt="Zimní atmosféra" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" />
            </div>
            <div class="mt-4 flex items-center justify-between px-2">
              <h3 class="text-xl font-semibold text-primary">Zimní atmosféra</h3>
              <span class="text-sm text-secondary">Kouzlo hor</span>
            </div>
          </div>
        </div>
        
        <div class="mt-16 text-center">
           <Button 
            :as="Link"
            href="#" 
            variant="outline"
            class="px-8 py-6 text-lg"
          >
            Zobrazit celou galerii
          </Button>
        </div>
      </div>
    </section>

    <!-- Stats Section -->
    <section class="border-y border-gray-100 bg-white py-20">
      <div class="container mx-auto px-6">
        <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
          <div 
            v-for="(stat, index) in stats" 
            :key="index"
            class="text-center"
          >
            <div class="mb-4 flex justify-center text-primary/20">
              <component :is="stat.icon" class="h-10 w-10" />
            </div>
            <div class="text-3xl font-bold text-primary md:text-4xl">{{ stat.value }}</div>
            <div class="mt-2 text-sm font-medium uppercase tracking-wider text-gray-500">{{ stat.label }}</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Reviews Section -->
    <section class="py-24">
      <div class="container mx-auto px-6">
        <div class="mb-16 text-center">
          <Quote class="mx-auto mb-4 h-8 w-8 text-primary/30" />
          <h2 class="text-3xl font-bold text-gray-900">Co o nás říkají hosté</h2>
        </div>

        <div class="grid gap-8 md:grid-cols-3">
          <div 
            v-for="(review, index) in reviews" 
            :key="index"
            class="light-card transition-colors hover:border-primary"
          >
            <div>
              <div class="mb-4 flex gap-1">
                <Star v-for="i in 5" :key="i" class="h-4 w-4 fill-secondary text-secondary" />
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
    <section class="pb-32 pt-12">
      <div class="container mx-auto px-6">
        <div class="relative overflow-hidden rounded-[3rem] bg-primary px-6 py-32 text-center sm:px-12 lg:py-40">
          <!-- Background Image -->
          <div class="absolute inset-0">
            <img 
              src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?q=80&w=2000&auto=format&fit=crop" 
              alt="Hory v mlze" 
              class="h-full w-full object-cover opacity-40 mix-blend-overlay"
            />
            <div class="absolute inset-0 bg-primary/60"></div>
          </div>

          <div class="relative z-10 mx-auto max-w-3xl">
            <MountainSnow class="mx-auto mb-8 h-16 w-16 text-white/80" />
            <h2 class="text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl">
              Hory volají. <br/>
              <span class="text-white/70">Kdy vyrazíte vy?</span>
            </h2>
            <p class="mx-auto mt-8 max-w-xl text-xl text-white/80">
              Rezervujte si svůj termín včas a zažijte neopakovatelnou atmosféru Jeseníků.
            </p>
            <div class="mt-12 flex flex-col items-center justify-center gap-6 sm:flex-row">
              <Button
                :as="Link"
                :href="route('home')"
                variant="cta-primary"
                class="w-full min-w-[200px] py-6 text-lg sm:w-auto"
              >
                Rezervovat nyní
              </Button>
              <Button
                :as="Link"
                href="#galerie"
                variant="cta-secondary"
                class="w-full min-w-[200px] py-6 text-lg sm:w-auto"
              >
                Prohlédnout chatu
              </Button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ Section -->
    <section class="bg-white py-24">
      <div class="container mx-auto px-6">
        <div class="mb-10 text-center">
          <div class="inline-flex items-center gap-2 text-sm font-bold uppercase tracking-wider text-primary">
            <span>Časté otázky</span>
          </div>
          <h2 class="mt-2 text-3xl font-bold text-gray-900">Nejčastější dotazy</h2>
        </div>
        <div class="mx-auto max-w-3xl rounded-[2.5rem] border border-gray-200 bg-white">
          <ul class="divide-y divide-gray-200">
            <li v-for="(item, i) in faqs" :key="i" class="p-6">
              <div class="text-lg font-semibold text-gray-900">{{ item.q }}</div>
              <div class="mt-2 text-gray-700">{{ item.a }}</div>
            </li>
          </ul>
        </div>
      </div>
    </section>
  </WebLayout>
</template>