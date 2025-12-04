<script setup>
import { Phone, Mail, LogIn, LogOut, Star, MapPin, Users, Sparkles } from "lucide-vue-next";
</script>

<template>
  <div class="flex grow flex-col justify-center pt-20 lg:pt-0">
    <div class="container mx-auto grid grid-cols-1 items-center gap-12 px-6 lg:grid-cols-2">
      <!-- Left Content -->
      <div class="text-left text-white">
        <div class="max-w-2xl">
          <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-1.5 text-sm backdrop-blur-sm">
            <Star class="h-4 w-4 text-gold" fill="currentColor" />
            <span class="font-medium text-white">Nejlépe hodnocená chata v okolí</span>
          </div>
          
          <h1 class="mb-6 text-4xl font-heading font-bold leading-normal tracking-tight text-white md:text-7xl lg:text-6xl drop-shadow-lg">
            Horský <span class="text-gold">luxus</span>
            <br />v srdci přírody
          </h1>
          
          <p class="mb-8 max-w-lg text-lg leading-relaxed text-gray-100 md:text-xl">
            Objevte dokonalé útočiště pro vaši dovolenou. Soukromé wellness, 
            designový interiér a nekonečné výhledy na Jeseníky.
          </p>

          <div class="flex flex-wrap gap-4">
            <div class="flex items-center gap-3 rounded-2xl border border-white/20 bg-white/5 p-4 transition-colors hover:bg-white/10 hover:border-gold/30 group">
              <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-gold group-hover:bg-gold group-hover:text-white transition-colors">
                <Users class="h-5 w-5" />
              </div>
              <div>
                <div class="text-xs text-gray-300 uppercase tracking-wider font-bold mb-0.5">Kapacita</div>
                <div class="font-heading font-bold text-lg">Až 12 osob</div>
              </div>
            </div>
            
            <div class="flex items-center gap-3 rounded-2xl border border-white/20 bg-white/5 p-4 transition-colors hover:bg-white/10 hover:border-gold/30 group">
              <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-gold group-hover:bg-gold group-hover:text-white transition-colors">
                <Sparkles class="h-5 w-5" />
              </div>
              <div>
                <div class="text-xs text-gray-300 uppercase tracking-wider font-bold mb-0.5">Relaxace</div>
                <div class="font-heading font-bold text-lg">Wellness</div>
              </div>
            </div>

            <div class="flex items-center gap-3 rounded-2xl border border-white/20 bg-white/5 p-4 transition-colors hover:bg-white/10 hover:border-gold/30 group">
              <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-gold group-hover:bg-gold group-hover:text-white transition-colors">
                <MapPin class="h-5 w-5" />
              </div>
              <div>
                <div class="text-xs text-gray-300 uppercase tracking-wider font-bold mb-0.5">Lokalita</div>
                <div class="font-heading font-bold text-lg">Ostružná</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Content / Floating Card -->
      <div class="flex justify-center lg:justify-end">
        <div class="relative w-full max-w-sm">
          <div class="relative rounded-[2rem] border border-gray-200 bg-white p-8 shadow-xl">
            <div class="mb-6 flex items-center justify-between">
              <h2 class="text-xl font-heading font-bold text-gray-900">Rychlý kontakt</h2>
              <div class="flex items-center gap-2">
                <span class="relative flex h-2 w-2">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                </span>
                <span class="text-xs font-bold text-green-600 uppercase tracking-wider">Online</span>
              </div>
            </div>

            <div class="space-y-6">
              <a href="tel:+420777123456" class="group flex items-center gap-4 rounded-xl border border-gray-200 bg-white p-4 transition-all hover:border-gold/50 hover:shadow-md hover:shadow-gold/5">
                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-honey text-primary transition-transform group-hover:scale-110">
                  <Phone class="h-5 w-5" />
                </div>
                <div>
                  <div class="text-xs text-gray-500 uppercase tracking-wider font-bold mb-0.5">Zavolejte nám</div>
                  <div class="font-heading font-bold text-lg text-gray-900">+420 777 123 456</div>
                </div>
              </a>

              <a href="mailto:info@chata-jana.cz" class="group flex items-center gap-4 rounded-xl border border-gray-200 bg-white p-4 transition-all hover:border-gold/50 hover:shadow-md hover:shadow-gold/5">
                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-honey text-primary transition-transform group-hover:scale-110">
                  <Mail class="h-5 w-5" />
                </div>
                <div>
                  <div class="text-xs text-gray-500 uppercase tracking-wider font-bold mb-0.5">Napište nám</div>
                  <div class="font-heading font-bold text-lg text-gray-900">info@chata-jana.cz</div>
                </div>
              </a>
            </div>

            <div class="mt-8 grid grid-cols-2 gap-4 border-t border-gray-200 pt-6">
              <div>
                <div class="mb-1 flex items-center gap-2 text-xs text-gray-500 uppercase tracking-wider font-bold">
                  <LogIn class="h-3 w-3" /> Check-in
                </div>
                <div class="font-heading font-bold text-lg text-gray-900">14:00</div>
              </div>
              <div>
                <div class="mb-1 flex items-center gap-2 text-xs text-gray-500 uppercase tracking-wider font-bold">
                  <LogOut class="h-3 w-3" /> Check-out
                </div>
                <div class="font-heading font-bold text-lg text-gray-900">10:00</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Bottom Info Bar -->
  <div class="mt-auto w-full border-t border-white/10 bg-black/20 backdrop-blur-sm">
    <div class="container mx-auto px-6 py-8">
      <div class="grid grid-cols-1 md:grid-cols-3 divide-white/10 divide-y md:divide-y-0 md:divide-x">
        <div class="py-4 md:py-0 md:px-6 text-center md:text-left">
          <div class="font-heading font-bold text-white text-lg mb-1">Kapacita 12 osob</div>
          <div class="text-sm text-gray-300">5 pokojů • 2× dvojlůžko s přistýlkou, 2× dvojlůžko, 1× pokoj se dvěma lůžky</div>
        </div>
        <div class="py-4 md:py-0 md:px-6 text-center md:text-left">
          <div class="font-heading font-bold text-white text-lg mb-1">Soukromé wellness</div>
          <div class="text-sm text-gray-300">Vířivka pro 6 osob • Odpočinková zóna • Kuchyňka • Prostorný obývací pokoj</div>
        </div>
        <div class="py-4 md:py-0 md:px-6 text-center md:text-left">
          <div class="font-heading font-bold text-white text-lg mb-1">Skvělá lokalita</div>
          <div class="text-sm text-gray-300">Ostružná • Jonas Park 1 km • Ramzová 1,5 km • Turistické trasy</div>
        </div>
      </div>
    </div>
  </div>
</template>
