<script setup>
import WebLayout from "../layouts/WebLayout.vue";
import PageHeader from "../components/PageHeader.vue";
import { Phone, Mail, MapPin, Clock, Facebook, Instagram } from "lucide-vue-next";

</script>

<template>
  <WebLayout>
    <PageHeader 
      badge="Kontakt"
      title="Spojte se s námi"
      subtitle="Jsme vám k dispozici. Napište nebo zavolejte, rádi poradíme."
      image="/img/hero2.jpg"
    />

    <section class="relative -mt-20 pb-24">
      <div class="container mx-auto px-6">
        <div class="grid gap-12 lg:grid-cols-2">
          <!-- Contact Info Cards -->
          <div class="space-y-6">
            <!-- Phone Card -->
            <div class="light-card">
              <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-honey text-primary">
                  <Phone class="h-6 w-6" />
                </div>
                <div>
                  <h3 class="text-lg font-semibold text-gray-900">Telefon</h3>
                  <p class="mt-1 text-gray-600">Po–Ne 8:00–20:00</p>
                  <a href="tel:+420731492286" class="mt-1 block text-lg font-medium text-primary hover:underline">
                    +420 731 492 286
                  </a>
                </div>
              </div>
            </div>

            <!-- Email Card -->
            <div class="light-card">
              <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-honey text-primary">
                  <Mail class="h-6 w-6" />
                </div>
                <div>
                  <h3 class="text-lg font-semibold text-gray-900">E-mail</h3>
                  <p class="mt-1 text-gray-600">Odpovídáme do 24 hodin</p>
                  <a href="mailto:info@chata-jana.cz" class="mt-1 block text-lg font-medium text-primary hover:underline">
                   info@chata-jana.cz
                  </a>
                </div>
              </div>
            </div>

            <!-- Address Card -->
            <div class="light-card">
              <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-honey text-primary">
                  <MapPin class="h-6 w-6" />
                </div>
                <div>
                  <h3 class="text-lg font-semibold text-gray-900">Adresa</h3>
                  <p class="mt-1 text-gray-600">
                    Chata Jana<br />
                    Ostružná 165<br />
                    788 25 Ostružná
                  </p>
                  <a 
                    href="https://maps.google.com" 
                    target="_blank" 
                  class="mt-2 inline-flex items-center text-sm font-medium text-primary hover:underline"
                  >
                    Otevřít v Mapách
                  </a>
                </div>
              </div>
            </div>

            <!-- Social Media -->
            <div class="light-card">
              <h3 class="mb-4 text-lg font-semibold text-gray-900">Sledujte nás na sítích</h3>
              <div class="flex gap-4">
                <a href="#" class="flex h-12 w-12 items-center justify-center rounded-2xl bg-honey text-primary transition-colors hover:bg-primary hover:text-white">
                  <Facebook class="h-5 w-5" />
                </a>
                <a href="#" class="flex h-12 w-12 items-center justify-center rounded-2xl bg-honey text-primary transition-colors hover:bg-primary hover:text-white">
                  <Instagram class="h-5 w-5" />
                </a>
              </div>
            </div>
          </div>

          <!-- Map -->
          <div class="relative min-h-[500px] overflow-hidden rounded-[2.5rem] bg-gray-100">
             <iframe 
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2589.963722876844!2d17.0688!3d50.1833!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNTDCsDExJzAwLjAiTiAxN8KwMDQnMDcuNyJF!5e0!3m2!1scs!2scz!4v1620000000000!5m2!1scs!2scz" 
              width="100%" 
              height="100%" 
              style="border:0;" 
              allowfullscreen="" 
              loading="lazy"
              class="absolute inset-0 h-full w-full"
            ></iframe>
          </div>
        </div>
      </div>
    </section>
  </WebLayout>
</template>
