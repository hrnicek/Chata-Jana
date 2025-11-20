<script setup>
import { Phone, Mail, LogIn, LogOut, Star, MapPin, Users, Sparkles, ArrowRight } from "lucide-vue-next";
</script>

<template>
  <div class="flex grow flex-col justify-center pt-20 lg:pt-0">
    <div class="container mx-auto grid grid-cols-1 items-center gap-12 px-6 lg:grid-cols-2">
      <!-- Left Content -->
      <div class="text-left text-white">
        <div class="max-w-2xl">
          <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-1.5 text-sm">
            <Star class="h-4 w-4 text-secondary" fill="currentColor" />
            <span class="font-medium text-white">Nejlépe hodnocená chata v okolí</span>
          </div>
          
          <h1 class="mb-6 text-5xl font-bold leading-tight tracking-tight text-white md:text-7xl lg:text-8xl">
            Horský <span class="text-honey">luxus</span>
            <br />v srdci přírody
          </h1>
          
          <p class="mb-8 max-w-lg text-lg leading-relaxed text-gray-200 md:text-xl">
            Objevte dokonalé útočiště pro vaši dovolenou. Soukromé wellness, 
            designový interiér a nekonečné výhledy na Jeseníky.
          </p>

          <div class="flex flex-wrap gap-4">
            <div class="flex items-center gap-3 rounded-2xl border border-white/20 bg-white/5 p-4 transition-colors hover:bg-white/10">
              <div class="flex h-10 w-10 items-center justify-center rounded-full bg-honey/20 text-honey">
                <Users class="h-5 w-5" />
              </div>
              <div>
                <div class="text-xs text-gray-400">Kapacita</div>
                <div class="font-semibold">Až 12 osob</div>
              </div>
            </div>
            
            <div class="flex items-center gap-3 rounded-2xl border border-white/20 bg-white/5 p-4 transition-colors hover:bg-white/10">
              <div class="flex h-10 w-10 items-center justify-center rounded-full bg-honey/20 text-honey">
                <Sparkles class="h-5 w-5" />
              </div>
              <div>
                <div class="text-xs text-gray-400">Relaxace</div>
                <div class="font-semibold">Wellness</div>
              </div>
            </div>

            <div class="flex items-center gap-3 rounded-2xl border border-white/20 bg-white/5 p-4 transition-colors hover:bg-white/10">
              <div class="flex h-10 w-10 items-center justify-center rounded-full bg-honey/20 text-honey">
                <MapPin class="h-5 w-5" />
              </div>
              <div>
                <div class="text-xs text-gray-400">Lokalita</div>
                <div class="font-semibold">Ostružná</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Content / Floating Card -->
      <div class="flex justify-center lg:justify-end">
        <div class="relative w-full max-w-sm">
          <div class="relative rounded-[2rem] border border-gray-200 bg-white p-8">
            <div class="mb-6 flex items-center justify-between">
              <h2 class="text-xl font-bold text-gray-900">Rychlý kontakt</h2>
              <div class="h-2 w-2 rounded-full bg-green-500"></div>
            </div>

            <div class="space-y-6">
              <a href="tel:+420777123456" class="group flex items-center gap-4 rounded-xl border border-gray-200 bg-white p-4 transition-colors hover:bg-gray-50">
                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-honey text-primary transition-colors group-hover:bg-primary group-hover:text-white">
                  <Phone class="h-5 w-5" />
                </div>
                <div>
                  <div class="text-xs text-gray-500">Zavolejte nám</div>
                  <div class="font-medium text-gray-900">+420 777 123 456</div>
                </div>
              </a>

              <a href="mailto:info@chatajanao.cz" class="group flex items-center gap-4 rounded-xl border border-gray-200 bg-white p-4 transition-colors hover:bg-gray-50">
                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-honey text-primary transition-colors group-hover:bg-primary group-hover:text-white">
                  <Mail class="h-5 w-5" />
                </div>
                <div>
                  <div class="text-xs text-gray-500">Napište nám</div>
                  <div class="font-medium text-gray-900">info@chatajanao.cz</div>
                </div>
              </a>
            </div>

            <div class="mt-8 grid grid-cols-2 gap-4 border-t border-gray-200 pt-6">
              <div>
                <div class="mb-1 flex items-center gap-2 text-xs text-gray-500">
                  <LogIn class="h-3 w-3" /> Check-in
                </div>
                <div class="font-medium text-gray-900">14:00</div>
              </div>
              <div>
                <div class="mb-1 flex items-center gap-2 text-xs text-gray-500">
                  <LogOut class="h-3 w-3" /> Check-out
                </div>
                <div class="font-medium text-gray-900">10:00</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Bottom Info Bar -->
  <div class="mt-auto w-full border-t border-white/10 bg-black/20">
    <div class="container mx-auto px-6 py-8">
      <ul class="grid grid-cols-2 md:grid-cols-4 divide-white/10 divide-y md:divide-y-0 md:divide-x">
        <li class="flex items-center justify-center gap-3 py-4 text-center">
          <span class="text-4xl font-bold text-white tabular-nums">5</span>
          <span class="text-sm text-white/70">pokojů</span>
        </li>
        <li class="flex items-center justify-center gap-3 py-4 text-center">
          <span class="text-4xl font-bold text-white tabular-nums">12</span>
          <span class="text-sm text-white/70">lůžek</span>
        </li>
        <li class="flex items-center justify-center gap-3 py-4 text-center">
          <span class="text-4xl font-bold text-white tabular-nums">3</span>
          <span class="text-sm text-white/70">koupelny</span>
        </li>
        <li class="flex items-center justify-center gap-3 py-4 text-center">
          <span class="text-4xl font-bold text-white tabular-nums">∞</span>
          <span class="text-sm text-white/70">zážitků</span>
        </li>
      </ul>
    </div>
  </div>
</template>
