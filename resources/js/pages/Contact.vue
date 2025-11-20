<script setup>
import WebLayout from "../layouts/WebLayout.vue";
import Hero from "../components/Hero.vue"; // Reusing Hero for consistency, or maybe a smaller header?
import { Phone, Mail, MapPin, Clock, Facebook, Instagram } from "lucide-vue-next";

// We might want a smaller hero or just a header for subpages. 
// For now, let's create a simple page structure.
</script>

<template>
  <WebLayout>
    <!-- Simple Header for subpage -->
    <div class="bg-[--color-primary] py-24 text-white">
      <div class="container mx-auto px-6 text-center">
        <h1 class="text-4xl font-bold md:text-5xl">Kontakt</h1>
        <p class="mt-4 text-lg text-white/80">Jsme tu pro vás. Neváhejte se na nás obrátit.</p>
      </div>
    </div>

    <section class="py-16">
      <div class="container mx-auto px-6">
        <div class="grid gap-12 lg:grid-cols-2">
          <!-- Contact Info -->
          <div>
            <h2 class="mb-8 text-3xl font-bold text-gray-900">Spojte se s námi</h2>
            
            <div class="space-y-8">
              <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-[--color-honey] text-[--color-primary]">
                  <Phone class="h-6 w-6" />
                </div>
                <div>
                  <h3 class="text-lg font-semibold text-gray-900">Telefon</h3>
                  <p class="mt-1 text-gray-600">Po-Ne 8:00 - 20:00</p>
                  <a href="tel:+420777123456" class="mt-1 block text-lg font-medium text-[--color-primary] hover:underline">
                    +420 777 123 456
                  </a>
                </div>
              </div>

              <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-[--color-honey] text-[--color-primary]">
                  <Mail class="h-6 w-6" />
                </div>
                <div>
                  <h3 class="text-lg font-semibold text-gray-900">E-mail</h3>
                  <p class="mt-1 text-gray-600">Odpovídáme do 24 hodin</p>
                  <a href="mailto:info@chatajanao.cz" class="mt-1 block text-lg font-medium text-[--color-primary] hover:underline">
                    info@chatajanao.cz
                  </a>
                </div>
              </div>

              <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-[--color-honey] text-[--color-primary]">
                  <MapPin class="h-6 w-6" />
                </div>
                <div>
                  <h3 class="text-lg font-semibold text-gray-900">Adresa</h3>
                  <p class="mt-1 text-gray-600">
                    Chata Jana<br />
                    Ostružná 123<br />
                    788 25 Ostružná
                  </p>
                  <a 
                    href="https://maps.google.com" 
                    target="_blank" 
                    class="mt-2 inline-flex items-center text-sm font-medium text-[--color-primary] hover:underline"
                  >
                    Zobrazit na mapě
                  </a>
                </div>
              </div>
            </div>

            <div class="mt-12">
              <h3 class="mb-4 text-lg font-semibold text-gray-900">Sledujte nás</h3>
              <div class="flex gap-4">
                <a href="#" class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 text-gray-600 transition-colors hover:bg-[--color-primary] hover:text-white">
                  <Facebook class="h-5 w-5" />
                </a>
                <a href="#" class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 text-gray-600 transition-colors hover:bg-[--color-primary] hover:text-white">
                  <Instagram class="h-5 w-5" />
                </a>
              </div>
            </div>
          </div>

          <!-- Map or Form could go here. For now, let's put a nice image or map placeholder -->
          <div class="relative min-h-[400px] overflow-hidden rounded-3xl bg-gray-100">
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
