<script setup>
import { Phone, Mail, LogIn, LogOut, Star, MapPin, Users, Sparkles } from "lucide-vue-next";
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <div class="flex grow flex-col justify-center pt-20 lg:pt-0">
    <div class="container mx-auto grid grid-cols-1 items-center gap-12 px-6 lg:grid-cols-2">
      <!-- Left Content -->
      <div class="text-left text-white">
        <div class="max-w-2xl">
          <div class="mb-8 inline-flex items-center gap-3 rounded-full border border-gold/30 bg-black/40 px-5 py-2.5 backdrop-blur-xl shadow-2xl ring-1 ring-white/10">
            <Star class="h-4 w-4 text-gold drop-shadow-[0_0_8px_rgba(251,191,36,0.6)]" fill="currentColor" />
            <span class="text-sm font-bold tracking-wide text-white drop-shadow-md">Nejlépe hodnocená chata v okolí</span>
          </div>
          
          <h1 class="mb-6 text-4xl font-heading font-bold leading-tight tracking-tight text-white md:text-7xl lg:text-6xl" style="text-shadow: 0 4px 20px rgba(0,0,0,0.8), 0 8px 40px rgba(0,0,0,0.6), 0 2px 4px rgba(0,0,0,0.9);">
            Horský <span class="text-gold" style="text-shadow: 0 4px 20px rgba(0,0,0,0.8), 0 8px 40px rgba(0,0,0,0.6), 0 2px 4px rgba(0,0,0,0.9), 0 0 30px rgba(212,175,55,0.3);">luxus</span>
            <br />v srdci přírody
          </h1>
          
          <p class="mb-10 max-w-xl text-lg leading-relaxed text-gray-100 md:text-xl font-medium drop-shadow-lg" style="text-shadow: 0 2px 10px rgba(0,0,0,0.8);">
            Objevte dokonalé útočiště pro vaši dovolenou. Soukromé wellness, 
            designový interiér a nekonečné výhledy na Jeseníky.
          </p>

          <div class="mb-10 flex flex-wrap gap-6">
            <Link :href="route('contact')" class="group relative inline-flex items-center gap-3 overflow-hidden rounded-full bg-gold px-8 py-4 transition-all hover:bg-gold/90 hover:shadow-[0_0_40px_-10px_rgba(251,191,36,0.5)]">
              <span class="relative z-10 font-bold text-primary">Rezervovat termín</span>
              <div class="absolute inset-0 -translate-x-full bg-white/20 transition-transform duration-500 ease-in-out group-hover:translate-x-0"></div>
            </Link>
            
            <Link :href="route('gallery')" class="group flex items-center gap-4 rounded-full border border-white/10 bg-black/40 pr-6 pl-2 py-2 backdrop-blur-md transition-all hover:bg-black/60 hover:border-gold/30">
              <div class="relative h-12 w-12 overflow-hidden rounded-full ring-2 ring-white/20 transition-all group-hover:ring-gold">
                <img src="/img/gallery/IMG_3.jpg" alt="Galerie" class="h-full w-full object-cover" />
                <div class="absolute inset-0 flex items-center justify-center bg-black/20 group-hover:bg-transparent transition-colors">
                  <span class="h-2 w-2 rounded-full bg-white"></span>
                </div>
              </div>
              <div class="text-left">
                <div class="text-xs font-bold uppercase tracking-wider text-gold">Fotogalerie</div>
                <div class="text-sm font-medium text-white group-hover:text-gold transition-colors">Prohlédnout chatu</div>
              </div>
            </Link>
          </div>

          <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <!-- Capacity Card -->
            <div class="group flex items-center gap-3 rounded-2xl border border-white/10 bg-black/40 p-3 shadow-[0_8px_32px_rgba(0,0,0,0.4)] backdrop-blur-xl transition-all duration-300 hover:border-gold/30 hover:bg-black/60">
              <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white/5 text-gold shadow-inner ring-1 ring-white/10 transition-colors group-hover:bg-gold group-hover:text-black">
                <Users class="h-5 w-5" />
              </div>
              <div class="flex flex-col">
                <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400 group-hover:text-gray-300">Kapacita</span>
                <span class="font-heading text-base font-bold text-white shadow-black drop-shadow-md">Až 12 osob</span>
              </div>
            </div>
            
            <!-- Wellness Card -->
            <div class="group flex items-center gap-3 rounded-2xl border border-white/10 bg-black/40 p-3 shadow-[0_8px_32px_rgba(0,0,0,0.4)] backdrop-blur-xl transition-all duration-300 hover:border-gold/30 hover:bg-black/60">
              <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white/5 text-gold shadow-inner ring-1 ring-white/10 transition-colors group-hover:bg-gold group-hover:text-black">
                <Sparkles class="h-5 w-5" />
              </div>
              <div class="flex flex-col">
                <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400 group-hover:text-gray-300">Relaxace</span>
                <span class="font-heading text-base font-bold text-white shadow-black drop-shadow-md">Wellness</span>
              </div>
            </div>

            <!-- Location Card -->
            <div class="group flex items-center gap-3 rounded-2xl border border-white/10 bg-black/40 p-3 shadow-[0_8px_32px_rgba(0,0,0,0.4)] backdrop-blur-xl transition-all duration-300 hover:border-gold/30 hover:bg-black/60">
              <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white/5 text-gold shadow-inner ring-1 ring-white/10 transition-colors group-hover:bg-gold group-hover:text-black">
                <MapPin class="h-5 w-5" />
              </div>
              <div class="flex flex-col">
                <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400 group-hover:text-gray-300">Lokalita</span>
                <span class="font-heading text-base font-bold text-white shadow-black drop-shadow-md">Ostružná</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Content / Floating Card -->
      <div class="flex justify-center lg:justify-end">
        <div class="relative w-full max-w-sm transform transition-all hover:-translate-y-1">
          <div class="relative rounded-[2.5rem] bg-white p-8 shadow-[0_20px_60px_-15px_rgba(0,0,0,0.3)] ring-1 ring-white/50 backdrop-blur-xl">
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
  <div class="mt-auto w-full border-t border-white/10 bg-black/40 backdrop-blur-md shadow-[0_-1px_0_rgba(255,255,255,0.1)]">
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
