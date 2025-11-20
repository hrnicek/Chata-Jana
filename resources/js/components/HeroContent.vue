<script setup>
import { Phone, Mail, LogIn, LogOut, Star, MapPin, Users, Sparkles, ArrowRight } from "lucide-vue-next";
</script>

<template>
  <div class="flex grow flex-col justify-center pt-20 lg:pt-0">
    <div class="container mx-auto grid grid-cols-1 items-center gap-12 px-6 lg:grid-cols-2">
      <!-- Left Content -->
      <div class="text-left text-white">
        <div class="max-w-2xl">
          <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-1.5 text-sm backdrop-blur-md">
            <Star class="h-4 w-4 text-secondary" fill="currentColor" />
            <span class="font-medium text-white">Nejlépe hodnocená chata v okolí</span>
          </div>
          
          <h1 class="mb-6 text-5xl font-bold leading-tight tracking-tight text-white md:text-7xl lg:text-8xl">
            Horský <span class="text-transparent bg-clip-text bg-gradient-to-r from-honey to-white">luxus</span>
            <br />v srdci přírody
          </h1>
          
          <p class="mb-8 max-w-lg text-lg leading-relaxed text-gray-200 md:text-xl">
            Objevte dokonalé útočiště pro vaši dovolenou. Soukromé wellness, 
            designový interiér a nekonečné výhledy na Jeseníky.
          </p>

          <div class="flex flex-wrap gap-4">
            <div class="flex items-center gap-3 rounded-2xl bg-white/5 p-4 backdrop-blur-sm transition-colors hover:bg-white/10">
              <div class="flex h-10 w-10 items-center justify-center rounded-full bg-honey/20 text-honey">
                <Users class="h-5 w-5" />
              </div>
              <div>
                <div class="text-xs text-gray-400">Kapacita</div>
                <div class="font-semibold">Až 12 osob</div>
              </div>
            </div>
            
            <div class="flex items-center gap-3 rounded-2xl bg-white/5 p-4 backdrop-blur-sm transition-colors hover:bg-white/10">
              <div class="flex h-10 w-10 items-center justify-center rounded-full bg-honey/20 text-honey">
                <Sparkles class="h-5 w-5" />
              </div>
              <div>
                <div class="text-xs text-gray-400">Relaxace</div>
                <div class="font-semibold">Wellness</div>
              </div>
            </div>

            <div class="flex items-center gap-3 rounded-2xl bg-white/5 p-4 backdrop-blur-sm transition-colors hover:bg-white/10">
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
          <!-- Glow effect -->
          <div class="absolute -inset-1 rounded-[2rem] bg-gradient-to-r from-honey to-primary opacity-30 blur-xl"></div>
          
          <div class="relative rounded-[2rem] border border-white/10 bg-black/40 p-8 backdrop-blur-xl">
            <div class="mb-6 flex items-center justify-between">
              <h2 class="text-xl font-bold text-white">Rychlý kontakt</h2>
              <div class="h-2 w-2 rounded-full bg-green-500"></div>
            </div>

            <div class="space-y-6">
              <a href="tel:+420777123456" class="group flex items-center gap-4 rounded-xl bg-white/5 p-4 transition-colors hover:bg-white/10">
                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white transition-colors group-hover:bg-primary group-hover:text-white">
                  <Phone class="h-5 w-5" />
                </div>
                <div>
                  <div class="text-xs text-gray-400">Zavolejte nám</div>
                  <div class="font-medium text-white">+420 777 123 456</div>
                </div>
              </a>

              <a href="mailto:info@chatajanao.cz" class="group flex items-center gap-4 rounded-xl bg-white/5 p-4 transition-colors hover:bg-white/10">
                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white transition-colors group-hover:bg-primary group-hover:text-white">
                  <Mail class="h-5 w-5" />
                </div>
                <div>
                  <div class="text-xs text-gray-400">Napište nám</div>
                  <div class="font-medium text-white">info@chatajanao.cz</div>
                </div>
              </a>
            </div>

            <div class="mt-8 grid grid-cols-2 gap-4 border-t border-white/10 pt-6">
              <div>
                <div class="mb-1 flex items-center gap-2 text-xs text-gray-400">
                  <LogIn class="h-3 w-3" /> Check-in
                </div>
                <div class="font-medium text-white">14:00</div>
              </div>
              <div>
                <div class="mb-1 flex items-center gap-2 text-xs text-gray-400">
                  <LogOut class="h-3 w-3" /> Check-out
                </div>
                <div class="font-medium text-white">10:00</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Bottom Info Bar -->
  <div class="mt-auto w-full border-t border-white/10 bg-black/20 backdrop-blur-md">
    <div class="container mx-auto px-6 py-6">
      <div class="flex flex-wrap justify-center gap-8 text-center md:justify-between md:text-left">
        <div>
          <div class="text-2xl font-bold text-white">5</div>
          <div class="text-sm text-gray-400">pokojů</div>
        </div>
        <div class="h-10 w-px bg-white/10 hidden md:block"></div>
        <div>
          <div class="text-2xl font-bold text-white">12</div>
          <div class="text-sm text-gray-400">lůžek</div>
        </div>
        <div class="h-10 w-px bg-white/10 hidden md:block"></div>
        <div>
          <div class="text-2xl font-bold text-white">3</div>
          <div class="text-sm text-gray-400">koupelny</div>
        </div>
        <div class="h-10 w-px bg-white/10 hidden md:block"></div>
        <div>
          <div class="text-2xl font-bold text-white">∞</div>
          <div class="text-sm text-gray-400">zážitků</div>
        </div>
      </div>
    </div>
  </div>
</template>
