<script setup lang="ts">
import { ref } from 'vue';
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
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Autoplay, Navigation, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

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

const virtualTourRooms = [
  {
    id: 'living',
    name: 'Společenská místnost',
    description: 'Prostorný obývací prostor',
    fullDescription: 'Stylový obývací pokoj s krbem a panoramatickými okny s výhledem do přírody.',
    images: [
      '/img/photos/spolecenska-mistnost/0Q9A0170-HDR.webp',
      '/img/photos/spolecenska-mistnost/0Q9A0212-HDR.webp',
      '/img/photos/spolecenska-mistnost/0Q9A0226-HDR.webp',
      '/img/photos/spolecenska-mistnost/0Q9A0289-HDR.webp',
      '/img/photos/spolecenska-mistnost/0Q9A0317-HDR.webp'
    ],
    icon: Users
  },
  {
    id: 'bedrooms',
    name: 'Pokoje',
    description: 'Útulné ložnice pro odpočinek',
    fullDescription: 'Elegantně zařízené pokoje s kvalitními matracemi a luxusním ložním prádlem.',
    images: [
      '/img/photos/pokoje/IMG_42.jpg',
      '/img/photos/pokoje/IMG_46.jpg',
      '/img/photos/pokoje/IMG_51.jpg',
      '/img/photos/pokoje/IMG_52.jpg',
      '/img/photos/pokoje/IMG_57.jpg',
      '/img/photos/pokoje/IMG_59.jpg',
      '/img/photos/pokoje/IMG_61.jpg'
    ],
    icon: Key
  },
  {
    id: 'kitchen',
    name: 'Kuchyně',
    description: 'Plně vybavená kuchyň',
    fullDescription: 'Moderní kuchyně se špičkovými spotřebiči a vším potřebným vybavením.',
    images: [
      '/img/photos/kuchyn/0Q9A0261-HDR.webp',
      '/img/photos/kuchyn/IMG_22.jpg',
      '/img/photos/kuchyn/IMG_34.jpg',
      '/img/photos/kuchyn/IMG_39.jpg'
    ],
    icon: Utensils
  },
  {
    id: 'wellness',
    name: 'Wellness',
    description: 'Soukromá relaxační zóna',
    fullDescription: 'Vířivka pro 6 osob s atmosférickým osvětlením a výhledem do přírody.',
    images: [
      '/img/photos/vyrivka/0Q9A0765-HDR.webp',
      '/img/photos/vyrivka/IMG_67.jpg',
      '/img/photos/vyrivka/IMG_69.jpg'
    ],
    icon: Bath
  },
  {
    id: 'other',
    name: 'Ostatní prostory',
    description: 'Chodby, šatna a další detaily',
    fullDescription: 'Každý detail chaty je navržen s důrazem na kvalitu a estetiku.',
    images: [
      '/img/photos/chodby/0Q9A0303-HDR.webp',
      '/img/photos/satna/0Q9A0813-HDR.webp',
      '/img/photos/koupelny-wc/IMG_31.jpg',
      '/img/photos/koupelny-wc/IMG_65.jpg'
    ],
    icon: Camera
  }
];

const activeRoom = ref('living');
const swiperModules = [Navigation, Pagination, Autoplay];

const openFaqIndex = ref<number | null>(null);
const toggleFaq = (index: number) => {
  openFaqIndex.value = openFaqIndex.value === index ? null : index;
};
</script>

<template>
  <WebLayout>
    <Hero />

    <!-- Ski Resorts Proximity Section -->
    <section class="bg-primary py-16">
      <div class="container mx-auto px-6">
        <div class="flex flex-col items-center gap-8 lg:flex-row lg:justify-between">
          <!-- Main Message -->
          <div class="text-center lg:text-left">
            <div class="mb-3 inline-flex items-center gap-2 rounded-full bg-gold px-4 py-1.5 text-sm font-bold text-white">
              <MountainSnow class="h-4 w-4" />
              <span>Ideální poloha pro lyžování</span>
            </div>
            <h2 class="text-3xl font-bold text-white lg:text-4xl">
              V srdci lyžařského ráje
            </h2>
            <p class="mt-3 text-lg text-white/80">
              Perfektní výchozí bod pro zimní radovánky v Jeseníkách
            </p>
          </div>

          <!-- Ski Resorts -->
          <div class="flex flex-col gap-4 sm:flex-row lg:gap-6">
            <!-- Jonas Park -->
            <div class="group rounded-2xl bg-white/10 backdrop-blur-sm p-6 transition-all hover:bg-white/20 hover:scale-105">
              <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-xl bg-gold text-white">
                  <MountainSnow class="h-6 w-6" />
                </div>
                <div>
                  <h3 class="text-lg font-bold text-white">Jonas Park Ostružná</h3>
                  <p class="mt-1 text-sm text-white/70">Lyžařský park</p>
                  <div class="mt-2 flex items-center gap-2 text-gold">
                    <MapPin class="h-4 w-4" />
                    <span class="text-sm font-bold">1 km</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Ramzová -->
            <div class="group rounded-2xl bg-white/10 backdrop-blur-sm p-6 transition-all hover:bg-white/20 hover:scale-105">
              <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-xl bg-gold text-white">
                  <MountainSnow class="h-6 w-6" />
                </div>
                <div>
                  <h3 class="text-lg font-bold text-white">Ski areál Ramzová</h3>
                  <p class="mt-1 text-sm text-white/70">Sjezdovky pro celou rodinu</p>
                  <div class="mt-2 flex items-center gap-2 text-gold">
                    <MapPin class="h-4 w-4" />
                    <span class="text-sm font-bold">1,5 km</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

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
                src="/img/photos/exterier/0Q9A0146.webp"
                alt="Chata Jana exteriér"
                class="h-full w-full object-cover"
              />
              <div class="absolute inset-0 bg-black/10"></div>
            </div>
            
            <!-- Secondary Image (Overlapping) -->
            <div class="absolute -bottom-12 -right-4 z-20 w-1/2 overflow-hidden rounded-[2.5rem] border-8 border-white shadow-none lg:-right-8 lg:bottom-12">
               <div class="aspect-square relative">
                 <img
                  src="/img/photos/spolecenska-mistnost/0Q9A0170-HDR.webp"
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
                :href="route('gallery')" 
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
          src="/img/photos/exterier/0Q9A0157.webp"
          alt="Zimní atmosféra" 
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

    <!-- Wellness Showcase Section -->
    <section class="relative overflow-hidden bg-white py-32">
      <div class="container mx-auto px-6">
        <div class="grid items-center gap-12 lg:grid-cols-2">
          <!-- Left: Main Wellness Photo with Overlay -->
          <div class="relative order-2 lg:order-1">
            <div class="relative aspect-[4/3] overflow-hidden rounded-[3rem]">
              <img
                src="/img/photos/vyrivka/0Q9A0765-HDR.webp"
                alt="Soukromá vířivka"
                class="h-full w-full object-cover"
              />
              <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
              
              <!-- Overlay Badge -->
              <div class="absolute bottom-8 left-8 right-8">
                <div class="inline-flex items-center gap-2 rounded-full bg-white/90 backdrop-blur-sm px-4 py-2 text-sm font-bold text-primary">
                  <Bath class="h-4 w-4" />
                  <span>Soukromé wellness</span>
                </div>
              </div>
            </div>

            <!-- Small Photos Grid -->
            <div class="mt-6 grid grid-cols-2 gap-6">
              <div class="aspect-[4/3] overflow-hidden rounded-2xl">
                <img
                  src="/img/photos/vyrivka/IMG_67.jpg"
                  alt="Relaxace ve vířivce"
                  class="h-full w-full object-cover transition-transform duration-500 hover:scale-110"
                />
              </div>
              <div class="aspect-[4/3] overflow-hidden rounded-2xl">
                <img
                  src="/img/photos/vyrivka/IMG_69.jpg"
                  alt="Večerní wellness"
                  class="h-full w-full object-cover transition-transform duration-500 hover:scale-110"
                />
              </div>
            </div>
          </div>

          <!-- Right: Content -->
          <div class="order-1 lg:order-2 lg:pl-12">
            <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-primary/10 bg-honey px-4 py-1.5 text-sm font-medium text-primary">
              <Bath class="h-4 w-4" />
              <span>Wellness & Relax</span>
            </div>
            
            <h2 class="text-4xl font-bold tracking-tight text-primary lg:text-5xl">
              Odpočinek, který si <span class="text-gold">zasloužíte</span>
            </h2>
            
            <p class="mt-6 text-lg leading-relaxed text-gray-600">
              Soukromá wellness zóna s vířivkou pro 6 osob je srdcem naší chaty. 
              Relaxujte pod hvězdami, užijte si klid a nechte starosti za sebou.
            </p>

            <div class="mt-8 space-y-4">
              <div class="flex items-start gap-4">
                <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-honey text-primary">
                  <Bath class="h-5 w-5" />
                </div>
                <div>
                  <h4 class="font-bold text-gray-900">Vířivka pro 6 osob</h4>
                  <p class="text-sm text-gray-600">Prostorná vířivka s výhledem do přírody</p>
                </div>
              </div>
              
              <div class="flex items-start gap-4">
                <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-honey text-primary">
                  <Users class="h-5 w-5" />
                </div>
                <div>
                  <h4 class="font-bold text-gray-900">100% soukromí</h4>
                  <p class="text-sm text-gray-600">Wellness jen pro vás a vaše blízké</p>
                </div>
              </div>

              <div class="flex items-start gap-4">
                <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-honey text-primary">
                  <CloudSun class="h-5 w-5" />
                </div>
                <div>
                  <h4 class="font-bold text-gray-900">Celoroční provoz</h4>
                  <p class="text-sm text-gray-600">Užijte si relax v každém ročním období</p>
                </div>
              </div>
            </div>

            <div class="mt-10 flex flex-wrap gap-4">
              <Button
                :as="Link"
                :href="route('home')"
                variant="default"
                class="group px-8 py-6 text-lg"
              >
                Rezervovat pobyt
                <ArrowRight class="ml-2 h-5 w-5 transition-transform group-hover:translate-x-1" />
              </Button>
              <Button 
                :as="Link"
                :href="route('gallery')" 
                variant="outline"
                class="px-8 py-6 text-lg"
              >
                Zobrazit fotky
              </Button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Pricing Overview Section -->
    <section class="bg-honey py-24">
      <div class="container mx-auto px-6">
        <div class="mb-16 text-center">
          <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-primary/10 bg-white px-4 py-1.5 text-sm font-medium text-primary">
            <CreditCard class="h-4 w-4" />
            <span>Ceník</span>
          </div>
          <h2 class="text-4xl font-bold text-primary md:text-5xl">Ceník</h2>
          <p class="mt-4 text-lg text-gray-600">Jednoduché a přehledné ceníky pro každé roční období</p>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
          <!-- Léto -->
          <div class="group rounded-3xl border-2 border-white bg-white p-8 transition-all hover:border-gold hover:shadow-xl">
            <div class="mb-6">
              <h3 class="mb-2 text-sm font-bold uppercase tracking-wider text-primary">Léto</h3>
              <div class="text-4xl font-bold text-gray-900">5 500 Kč</div>
              <div class="text-sm text-gray-500">/ noc</div>
            </div>
            <div class="text-xs font-medium uppercase tracking-wide text-gray-400">
              Týdenní pobyt 38 500 Kč
            </div>
          </div>

          <!-- Zima -->
          <div class="group rounded-3xl border-2 border-primary bg-primary p-8 text-white transition-all hover:shadow-xl">
            <div class="mb-6">
              <h3 class="mb-2 text-sm font-bold uppercase tracking-wider text-gold">Zima</h3>
              <div class="text-4xl font-bold">6 000 Kč</div>
              <div class="text-sm text-white/70">/ noc</div>
            </div>
            <div class="text-xs font-medium uppercase tracking-wide text-white/60">
              Týdenní pobyt 42 000 Kč
            </div>
          </div>

          <!-- Mimosezona -->
          <div class="group rounded-3xl border-2 border-white bg-white p-8 transition-all hover:border-gold hover:shadow-xl">
            <div class="mb-6">
              <h3 class="mb-2 text-sm font-bold uppercase tracking-wider text-primary">Mimosezona</h3>
              <div class="text-4xl font-bold text-gray-900">5 000 Kč</div>
              <div class="text-sm text-gray-500">/ noc</div>
            </div>
            <div class="text-xs font-medium uppercase tracking-wide text-gray-400">
              Týdenní pobyt 35 000 Kč
            </div>
          </div>

          <!-- Silvestr -->
          <div class="group rounded-3xl border-2 border-white bg-white p-8 transition-all hover:border-gold hover:shadow-xl">
            <div class="mb-6">
              <h3 class="mb-2 text-sm font-bold uppercase tracking-wider text-primary">Silvestr</h3>
              <div class="text-4xl font-bold text-gray-900">85 000 Kč</div>
              <div class="text-sm text-gray-500">/ 28.12-2.1.</div>
            </div>
            <div class="text-xs font-medium uppercase tracking-wide text-gray-400">
              Fixní cena
            </div>
          </div>
        </div>

        <div class="mt-12 text-center">
          <Button 
            :as="Link"
            :href="route('pricing')" 
            variant="default"
            class="px-8 py-6 text-lg"
          >
            Zobrazit kompletní ceník
          </Button>
          <p class="mt-4 text-sm text-gray-600">
            Záloha 30 % • Doplatek 14 dní před příjezdem • Elektřina dle spotřeby
          </p>
        </div>
      </div>
    </section>

    <!-- Virtual Tour Section -->
    <section class="bg-white py-32">
      <div class="container mx-auto px-6">
        <div class="mb-16 text-center">
          <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-primary/10 bg-honey px-4 py-1.5 text-sm font-medium text-primary">
            <Camera class="h-4 w-4" />
            <span>Virtuální prohlídka</span>
          </div>
          <h2 class="text-4xl font-bold text-primary md:text-5xl">Luxusní interiér</h2>
          <p class="mt-4 text-lg text-gray-600">Prohlédněte si každý kout naší chaty</p>
        </div>

        <div class="grid gap-8 lg:grid-cols-12">
          <!-- Room Selector (Left) -->
          <div class="lg:col-span-4">
            <div class="space-y-3">
              <button
                v-for="(room, index) in virtualTourRooms"
                :key="room.id"
                @click="activeRoom = room.id"
                :class="[
                  'group w-full text-left rounded-2xl border-2 p-6 transition-all',
                  activeRoom === room.id
                    ? 'border-gold bg-gold text-white shadow-lg'
                    : 'border-gray-200 bg-white hover:border-gold/50 hover:shadow-md'
                ]"
              >
                <div class="flex items-start gap-4">
                  <div :class="[
                    'flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-xl transition-colors',
                    activeRoom === room.id
                      ? 'bg-white/20 text-white'
                      : 'bg-honey text-primary group-hover:bg-gold group-hover:text-white'
                  ]">
                    <component :is="room.icon" class="h-6 w-6" />
                  </div>
                  <div class="flex-1">
                    <h3 :class="[
                      'text-lg font-bold mb-1',
                      activeRoom === room.id ? 'text-white' : 'text-gray-900'
                    ]">
                      {{ room.name }}
                    </h3>
                    <p :class="[
                      'text-sm',
                      activeRoom === room.id ? 'text-white/80' : 'text-gray-600'
                    ]">
                      {{ room.description }}
                    </p>
                  </div>
                </div>
              </button>
            </div>
          </div>

          <!-- Photo Display (Right) -->
          <div class="lg:col-span-8">
            <div class="relative aspect-[16/10] overflow-hidden rounded-[3rem] bg-gray-100">
              <TransitionGroup name="fade">
                <div
                  v-for="room in virtualTourRooms"
                  v-show="activeRoom === room.id"
                  :key="room.id"
                  class="absolute inset-0"
                >
                  <!-- Swiper for multiple photos -->
                  <Swiper
                    :modules="swiperModules"
                    :navigation="true"
                    :pagination="{ clickable: true }"
                    :autoplay="{ delay: 4000, disableOnInteraction: false }"
                    loop
                    class="h-full w-full"
                  >
                    <SwiperSlide v-for="(image, index) in room.images" :key="index">
                      <img
                        :src="image"
                        :alt="`${room.name} - foto ${index + 1}`"
                        class="h-full w-full object-cover"
                      />
                    </SwiperSlide>
                  </Swiper>
                  
                  <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent pointer-events-none"></div>
                  
                  <!-- Photo Label -->
                  <div class="absolute bottom-8 left-8 right-8 pointer-events-none">
                    <div class="rounded-2xl bg-white/95 backdrop-blur-sm p-6">
                      <h4 class="text-2xl font-bold text-primary mb-2">{{ room.name }}</h4>
                      <p class="text-gray-700">{{ room.fullDescription }}</p>
                    </div>
                  </div>
                </div>
              </TransitionGroup>
            </div>
          </div>
        </div>

        <div class="mt-12 text-center">
          <Button 
            :as="Link"
            :href="route('gallery')" 
            variant="default"
            class="px-8 py-6 text-lg"
          >
            Zobrazit celou galerii
          </Button>
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
              src="/img/photos/exterier/0Q9A0157.webp" 
              alt="Zimní atmosféra" 
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
            <li v-for="(item, i) in faqs" :key="i" class="transition-colors hover:bg-honey/20">
              <button
                @click="toggleFaq(i)"
                class="w-full p-6 text-left transition-all"
              >
                <div class="flex items-start justify-between gap-4">
                  <div class="text-lg font-semibold text-gray-900">{{ item.q }}</div>
                  <div class="flex-shrink-0 transition-transform duration-300" :class="{ 'rotate-180': openFaqIndex === i }">
                    <svg class="h-5 w-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </div>
                </div>
                <Transition name="faq">
                  <div v-show="openFaqIndex === i" class="mt-4 text-gray-700 leading-relaxed">
                    {{ item.a }}
                  </div>
                </Transition>
              </button>
            </li>
          </ul>
        </div>
      </div>
    </section>
  </WebLayout>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

/* Swiper Navigation Arrows */
:deep(.swiper-button-next),
:deep(.swiper-button-prev) {
  color: #C5A059; /* gold */
  background: rgba(255, 255, 255, 0.9);
  width: 44px;
  height: 44px;
  border-radius: 50%;
  backdrop-filter: blur(8px);
  transition: all 0.3s ease;
  padding: 12px;
}

:deep(.swiper-button-next:after),
:deep(.swiper-button-prev:after) {
  font-size: 18px;
  font-weight: bold;
}

:deep(.swiper-button-next:hover),
:deep(.swiper-button-prev:hover) {
  background: #C5A059; /* gold */
  color: white;
  transform: scale(1.1);
}

/* Swiper Pagination Bullets */
:deep(.swiper-pagination-bullet) {
  width: 12px;
  height: 12px;
  background: rgba(255, 255, 255, 0.5);
  opacity: 1;
  transition: all 0.3s ease;
}

:deep(.swiper-pagination-bullet-active) {
  background: #C5A059; /* gold */
  width: 32px;
  border-radius: 6px;
}

:deep(.swiper-pagination) {
  bottom: 24px !important;
}

/* FAQ Accordion Transition */
.faq-enter-active,
.faq-leave-active {
  transition: all 0.3s ease;
  max-height: 500px;
  overflow: hidden;
}

.faq-enter-from,
.faq-leave-to {
  max-height: 0;
  opacity: 0;
}
</style>
