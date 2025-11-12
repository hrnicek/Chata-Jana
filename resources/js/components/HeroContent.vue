<script setup>
import Button from "./ui/button.vue";
import { Star, CalendarDays, Users, MoreHorizontal } from "lucide-vue-next";
</script>

<template>
  <div class="flex grow items-center">
    <div class="container mx-auto grid grid-cols-1 items-center gap-8 px-6 lg:grid-cols-2">
      <div class="text-left text-white">
        <div class="max-w-xl">
          <h1 class="mb-4 text-5xl leading-tight font-bold md:text-7xl">Chata Jana Ostružná</h1>
          <p class="max-w-3xl text-lg text-white/80 md:text-xl">
            Soukromé wellness a jen kousek od lyžařského parku.
          </p>
        </div>
      </div>
      <div class="flex justify-center lg:justify-end">
        <div class="glassmorphism w-full max-w-sm rounded-4xl p-6 text-white">
          <div class="mb-4 flex items-start justify-between">
            <div>
              <h2 class="text-xl font-bold">Chata Jana</h2>
              <div class="mt-1 flex items-center text-sm">
                <Star class="mr-1 h-4 w-4 text-yellow-400" />
                <span class="font-semibold">4.9</span>
                <span class="ml-1 text-white/70">z 200+ pobytů</span>
              </div>
            </div>
            <button class="text-white/70 hover:text-white">
              <MoreHorizontal class="h-5 w-5" />
            </button>
          </div>
          <div class="mb-4 grid grid-cols-2 gap-4 border-y border-white/10 py-4 text-sm">
            <div class="flex items-center space-x-2">
              <CalendarDays class="h-4 w-4 text-white/80" />
              <div>
                <p class="font-semibold">Feb 11</p>
                <p class="text-xs text-gray-400">Check in After 2:00 PM</p>
              </div>
            </div>
            <div class="flex items-center space-x-2">
              <CalendarDays class="h-4 w-4 text-white/80" />
              <div>
                <p class="font-semibold">Mar 25</p>
                <p class="text-xs text-gray-400">Check out Until 12:00 PM</p>
              </div>
            </div>
          </div>
          <div class="mb-4 flex items-center justify-between">
            <div>
              <span class="text-2xl font-bold">4 500 Kč</span
              ><span class="text-white/70">/noc</span>
            </div>
            <div class="flex items-center gap-1 text-sm text-white/80">
              <Users class="h-4 w-4" />
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
  <div class="pt-8 pb-12 md:pt-12 md:pb-16">
    <div class="container mx-auto px-6">
      <div class="grid grid-cols-1 gap-6 md:grid-cols-3 md:gap-8">
        <div class="glassmorphism rounded-3xl border p-6 text-left text-white">
          <h3 class="text-lg font-semibold">Celkem 12 osob (5 pokojů)</h3>
          <p class="mt-2 max-w-[300px] text-xs">
            2 dvojlůžkové pokoje s přistýlkou, 2 pokoje s dvojlůžkem a 1 pokoj s 2x samostatnou
            postelí.
          </p>
        </div>
        <div class="glassmorphism rounded-3xl border p-6 text-left text-white">
          <h3 class="text-lg font-semibold">Komfortní wellness (soukromý)</h3>
          <p class="mt-2 max-w-[300px] text-xs">
            Vířivka pro 6 osob, samostatná odpočinková kuchyňka, WC, a prostorný obývací pokoj.
          </p>
        </div>
        <div class="glassmorphism rounded-3xl border p-6 text-left text-white">
          <h3 class="text-lg font-semibold">Skvělá lokalita (Ostružná)</h3>
          <p class="mt-2 max-w-[300px] text-xs">
            V blízkosti lyžařského parku Ostružná – Jonas Park ( 1km ) a 1,5 km od ski areálu
            Ramzová.
          </p>
        </div>
      </div>
    </div>
  </div>
</template>
