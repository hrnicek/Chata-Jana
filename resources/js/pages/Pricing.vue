<script setup>
import WebLayout from "../layouts/WebLayout.vue";
import PageHeader from "../components/PageHeader.vue";
import Button from "../components/ui/button.vue";
import { Check, FileDown } from "lucide-vue-next";
import { Link } from "@inertiajs/vue3";

const seasons = [
  {
    name: "LÉTO",
    price: "5 500 Kč",
    unit: "/ noc",
    weeklyPrice: "(TÝDENNÍ POBYT 38 500 KČ)",
    highlighted: true,
    features: []
  },
  {
    name: "ZIMA",
    price: "6 000 Kč",
    unit: "/ noc",
    weeklyPrice: "(TÝDENNÍ POBYT 42 000 KČ)",
    highlighted: false,
    features: []
  },
  {
    name: "MIMOSEZONA",
    price: "5 000 Kč",
    unit: "/ noc",
    weeklyPrice: "(TÝDENNÍ POBYT 35 000 KČ)",
    highlighted: false,
    features: []
  },
  {
    name: "SILVESTR",
    price: "85 000 Kč",
    unit: "/ 28.12-2.1.",
    weeklyPrice: "při zkráceném termínu se cena nemění",
    highlighted: false,
    features: []
  }
];

const reservationInfo = [
  "Rezervaci potvrzuje záloha 30 %. Doplatek 70 % nejpozději 14 dní před příjezdem.",
  "U rezervací kratších než 14 dní se hradí 100 % ceny při potvrzení.",
  "Neuhrazení doplatku do 14 dní před příjezdem znamená propadnutí 30% zálohy (storno).",
  "Při ubytování na jednu noc se účtuje jednorázový úklid 3 000 Kč (3000Kč).",
  "Děti do 3 let zdarma bez lůžka.",
  "Vratná kauce vyžadovaná na místě ve výši 5 000 Kč.",
  "Na místě se hradí spotřebovaná elektřina a rekreační poplatek."
];

const additionalPricing = [
  { name: "Elektrická energie (VT) / kWh", price: "9 Kč/kWh" },
  { name: "Elektrická energie (NT) / kWh", price: "8 Kč/kWh" },
  { name: "Rekreační poplatek za osobu 18+", price: "20 Kč/den" },
  { name: "Poplatek za psa", price: "350 Kč/den" }
];
</script>

<template>
  <WebLayout>
    <PageHeader 
      badge="Ceník"
      title="Transparentní ceník"
      subtitle="U nás se můžete ubytovat kdykoliv během celého roku. Vyberte si termín, který vám vyhovuje."
      image="/img/hero.jpg"
    />

    <!-- Pricing Cards Section -->
    <section class="relative -mt-20 pb-24">
      <div class="container mx-auto px-6">
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
          <div 
            v-for="season in seasons" 
            :key="season.name" 
            :class="[
              'rounded-[2.5rem] border p-8 transition-colors',
              season.highlighted 
                ? 'bg-primary text-white' 
                : 'bg-white text-gray-900 hover:border-primary'
            ]"
          >
            
            <div class="relative">
              <!-- Season Name -->
              <h3 
                :class="[
                  'mb-8 text-sm font-bold uppercase tracking-wider',
                  season.highlighted ? 'text-honey' : 'text-primary'
                ]"
              >
                {{ season.name }}
              </h3>
              
              <!-- Price -->
              <div class="mb-6">
                <div class="text-4xl font-bold mb-2">{{ season.price }}</div>
                <span 
                  :class="[
                    'text-sm',
                    season.highlighted ? 'text-white/70' : 'text-gray-500'
                  ]"
                >
                  {{ season.unit }}
                </span>
              </div>
              
              <!-- Weekly Price -->
              <p 
                :class="[
                  'mb-8 text-xs font-medium uppercase tracking-wide',
                  season.highlighted ? 'text-white/60' : 'text-gray-400'
                ]"
              >
                {{ season.weeklyPrice }}
              </p>
              
              <!-- CTA Button -->
              <Button
                :as="Link"
                :href="route('bookings.calendar')"
                :variant="season.highlighted ? 'pricing-highlighted' : 'pricing-primary'"
              >
                {{ season.name === 'SILVESTR' ? 'Rezervovat Silvestr' : 'Rezervovat termín' }}
              </Button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Information Section -->
    <section class="bg-white py-24">
      <div class="container mx-auto px-6">
        <div class="grid gap-12 lg:grid-cols-2">
          
          <!-- Left: Reservation Info -->
          <div class="light-card p-10">
            
            <div class="relative">
              <div class="mb-6 inline-flex items-center gap-2 rounded-full bg-primary/10 px-4 py-1.5 text-sm font-medium text-primary">
                <Check class="h-4 w-4" />
                <span>Podmínky rezervace</span>
              </div>
              
              <h2 class="mb-8 text-3xl font-bold text-gray-900">
                Důležité informace
              </h2>
              
              <ul class="space-y-5">
                <li 
                  v-for="(info, index) in reservationInfo" 
                  :key="index" 
                  class="flex items-start gap-4"
                >
                  <div class="mt-1 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-primary/10">
                    <div class="h-2 w-2 rounded-full bg-primary"></div>
                  </div>
                  <span 
                  :class="[
                    'text-gray-700 leading-relaxed',
                    (info.includes('3000Kč') || info.includes('3 000 Kč')) ? 'font-semibold text-red-600' : ''
                  ]"
                  >
                    {{ info }}
                  </span>
                </li>
              </ul>
            </div>
          </div>

          <!-- Right: Additional Pricing -->
          <div class="light-card p-10">
            
            <div class="relative">
              <div class="mb-6 inline-flex items-center gap-2 rounded-full bg-honey px-4 py-1.5 text-sm font-medium text-primary">
                <FileDown class="h-4 w-4" />
                <span>Doplňkové poplatky</span>
              </div>
              
              <h2 class="mb-8 text-3xl font-bold text-gray-900">
                Doplňkové poplatky
              </h2>
              
              <div class="mb-10 space-y-5">
                <div 
                  v-for="item in additionalPricing" 
                  :key="item.name"
                  class="flex items-start justify-between gap-4 border-b border-gray-100 pb-4"
                >
                  <span class="text-gray-700">{{ item.name }}</span>
                  <span v-if="item.price" class="shrink-0 font-bold text-primary">{{ item.price }}</span>
                </div>
              </div>

              <!-- PDF Download Button -->
              <Button
                :as="Link"
                href="#"
                variant="pricing-primary"
                class="group w-full"
              >
                <FileDown class="h-5 w-5" />
                Ubytovací a reklamační řád (PDF)
              </Button>

              <p class="mt-6 text-center text-sm text-gray-500">
                Máte dotaz? Rádi poradíme.
              </p>
            </div>
          </div>
          
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-gray-50 py-24">
      <div class="container mx-auto px-6">
        <div class="rounded-[3rem] bg-primary px-6 py-20 text-center sm:px-12 lg:py-32">
          
          <div class="relative z-10 mx-auto max-w-2xl">
            <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl lg:text-5xl">
              Připraveni rezervovat?
            </h2>
            <p class="mx-auto mt-6 max-w-xl text-lg text-white/80">
              Vyberte si termín a užijte si nezapomenutelný pobyt v Chatě Jana. Těšíme se na vás!
            </p>
            <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row">
              <Button
                :as="Link"
                :href="route('bookings.calendar')"
                variant="cta-primary"
                class="group w-full sm:w-auto"
              >
                Rezervovat nyní
              </Button>
              <Button
                :as="Link"
                :href="route('contact')"
                variant="cta-secondary"
                class="w-full sm:w-auto"
              >
                Kontaktovat nás
              </Button>
            </div>
          </div>
        </div>
      </div>
    </section>
    
  </WebLayout>
</template>

