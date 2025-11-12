<script setup>
import { Phone, Mail, LogIn, LogOut } from "lucide-vue-next";
</script>

<template>
  <div class="flex grow items-center">
    <div class="container mx-auto grid grid-cols-1 items-center gap-8 px-6 lg:grid-cols-2">
      <div class="text-left text-white">
        <div class="max-w-xl">
          <h1 class="mb-4 text-5xl leading-tight font-bold md:text-7xl">Chata Jana Ostružná</h1>
          <p class="max-w-3xl text-lg text-white/80 md:text-xl">
            Soukromé wellness uprostřed Jeseníků. Ideální pro rodiny, přátele i malé oslavy.
          </p>
        </div>
      </div>
      <div class="flex justify-center lg:justify-end">
        <div class="glassmorphism w-full max-w-sm rounded-4xl p-6 text-white">
          <div class="mb-4">
            <h2 class="text-xl font-bold">Kontakt & informace</h2>
          </div>
          <div class="mb-4 grid gap-4 border-y border-white/10 py-4 text-sm">
            <div class="flex items-start gap-3">
              <Phone class="h-4 w-4 text-white/80" />
              <div>
                <p class="font-semibold">Telefon</p>
                <a href="tel:+420777123456" class="text-xs text-gray-400">+420 777 123 456</a>
              </div>
            </div>
            <div class="flex items-start gap-3">
              <Mail class="h-4 w-4 text-white/80" />
              <div>
                <p class="font-semibold">E‑mail</p>
                <a href="mailto:info@chatajanao.cz" class="text-xs text-gray-400"
                  >info@chatajanao.cz</a
                >
              </div>
            </div>
            <div class="flex items-start gap-3">
              <LogIn class="h-4 w-4 text-white/80" />
              <div>
                <p class="font-semibold">Check‑in</p>
                <p class="text-xs text-gray-400">po 14:00</p>
              </div>
            </div>
            <div class="flex items-start gap-3">
              <LogOut class="h-4 w-4 text-white/80" />
              <div>
                <p class="font-semibold">Check‑out</p>
                <p class="text-xs text-gray-400">do 12:00</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="pt-8 pb-12 md:pt-12 md:pb-16">
    <div class="container mx-auto px-6">
      <div class="grid grid-cols-1 gap-6 md:grid-cols-3 md:gap-8">
        <div class="glassmorphism rounded-3xl border p-6 text-left text-white">
          <h3 class="text-lg font-semibold">Kapacita až 12 osob (5 pokojů)</h3>
          <p class="mt-2 max-w-[300px] text-xs">
            2 dvojlůžkové pokoje s přistýlkou, 2 pokoje s dvojlůžkem a 1 pokoj s 2× samostatnou
            postelí.
          </p>
        </div>
        <div class="glassmorphism rounded-3xl border p-6 text-left text-white">
          <h3 class="text-lg font-semibold">Soukromé wellness</h3>
          <p class="mt-2 max-w-[300px] text-xs">
            Vířivka pro 6 osob, odpočinková zóna a prostorný obývací pokoj.
          </p>
        </div>
        <div class="glassmorphism rounded-3xl border p-6 text-left text-white">
          <h3 class="text-lg font-semibold">Ostružná — skvělá lokalita</h3>
          <p class="mt-2 max-w-[300px] text-xs">
            V blízkosti lyžařského parku Ostružná – Jonas Park (1 km) a 1,5 km od ski areálu
            Ramzová.
          </p>
        </div>
      </div>
    </div>
  </div>
</template>
