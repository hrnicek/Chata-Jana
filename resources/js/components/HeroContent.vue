<script setup>
import Button from './ui/button.vue'
import { Star, CalendarDays, Users, MoreHorizontal } from 'lucide-vue-next'
</script>

<template>
  <div class="grow flex items-center">
    <div class="container mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
      <div class="text-white text-left">
        <div class="max-w-xl">
          <h1 class="text-5xl md:text-7xl font-bold mb-4 leading-tight">Chata Jana Ostružná</h1>
          <p class="text-lg md:text-xl text-white/80 max-w-3xl">Soukromé wellness a jen kousek od lyžařského parku.</p>
        </div>
      </div>
      <div class="flex justify-center lg:justify-end">
        <div class="p-6 rounded-4xl w-full max-w-sm text-white glassmorphism">
          <div class="flex justify-between items-start mb-4">
            <div>
              <h2 class="text-xl font-bold">Chata Jana</h2>
              <div class="flex items-center text-sm mt-1">
                <Star class="w-4 h-4 text-yellow-400 mr-1" />
                <span class="font-semibold">4.9</span>
                <span class="text-white/70 ml-1">z 200+ pobytů</span>
              </div>
            </div>
            <button class="text-white/70 hover:text-white">
              <MoreHorizontal class="w-5 h-5" />
            </button>
          </div>
          <div class="grid grid-cols-2 gap-4 border-y border-white/10 py-4 mb-4 text-sm">
            <div class="flex items-center space-x-2">
              <CalendarDays class="w-4 h-4 text-white/80" />
              <div>
                <p class="font-semibold">Feb 11</p>
                <p class="text-gray-400 text-xs">Check in After 2:00 PM</p>
              </div>
            </div>
            <div class="flex items-center space-x-2">
              <CalendarDays class="w-4 h-4 text-white/80" />
              <div>
                <p class="font-semibold">Mar 25</p>
                <p class="text-gray-400 text-xs">Check out Until 12:00 PM</p>
              </div>
            </div>
          </div>
          <div class="flex justify-between items-center mb-4">
            <div>
              <span class="text-2xl font-bold">4 500 Kč</span><span class="text-white/70">/noc</span>
            </div>
            <div class="text-white/80 text-sm flex items-center gap-1">
              <Users class="w-4 h-4" />
              <span>2–12 hostů</span>
            </div>
          </div>
          <Link :href="route('bookings.calendar')">
            <Button variant="reserve">Rezervovat</Button>
          </Link>
        </div>
      </div>
    </div>
  </div>
  <div class="pb-12 pt-8 md:pb-16 md:pt-12">
    <div class="container mx-auto px-6">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 ">
        <div class="text-white text-left glassmorphism p-6 rounded-3xl border">
          <h3 class="text-lg font-semibold">Celkem 12 osob (5 pokojů)</h3>
          <p class="text-xs max-w-[300px] mt-2">
            2 dvojlůžkové pokoje s přistýlkou, 2 pokoje s dvojlůžkem a 1 pokoj s 2x samostatnou postelí.
          </p>
        </div>
        <div class="text-white text-left glassmorphism p-6 rounded-3xl border">
          <h3 class="text-lg font-semibold">Komfortní wellness (soukromý)</h3>
          <p class="text-xs max-w-[300px] mt-2">
            Vířivka pro 6 osob, samostatná odpočinková kuchyňka, WC, a prostorný obývací pokoj.
          </p>
        </div>
        <div class="text-white text-left glassmorphism p-6 rounded-3xl border">
          <h3 class="text-lg font-semibold">Skvělá lokalita (Ostružná)</h3>
          <p class="text-xs max-w-[300px] mt-2">
            V blízkosti lyžařského parku Ostružná – Jonas Park ( 1km ) a 1,5 km od ski areálu Ramzová.
          </p>
        </div>
      </div>
    </div>
  </div>
</template>