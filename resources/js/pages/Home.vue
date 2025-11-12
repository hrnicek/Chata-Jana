<script setup lang="ts">
import Hero from '../components/Hero.vue'
import WebLayout from '../layouts/WebLayout.vue'
import { Mountain, Bath, Trees, Quote, Camera, CalendarDays } from 'lucide-vue-next'
</script>

<template>
  <WebLayout>
    <Hero />
    <section class="py-16 bg-white">
      <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
          <div>
            <div class="flex items-center gap-2 mb-3">
              <Mountain class="w-5 h-5 text-[--color-primary]" />
              <div class="text-sm font-semibold text-[--color-primary]">O místě</div>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Vaše horské útočiště</h2>
            <p class="mt-4 text-gray-700">Chata Jana nabízí soukromé wellness a pohodlí pro celou rodinu. V srdci Jeseníků, kousek od lyžařských areálů a turistických tras.</p>
            <div class="mt-6 flex items-center gap-3">
              <Link :href="route('bookings.calendar')" class="px-4 py-2 rounded-full bg-[--color-primary] text-white">Rezervovat termín</Link>
              <Link href="#galerie" class="px-4 py-2 rounded-full border">Prohlédnout galerii</Link>
            </div>
          </div>
          <div>
            <img src="/img/hero2.jpg" alt="Chata Jana exteriér" class="rounded-3xl w-full object-cover" />
          </div>
        </div>
      </div>
    </section>

    <section id="galerie" class="py-16 bg-gray-50">
      <div class="container mx-auto px-6">
        <div class="flex items-center gap-2 mb-6">
          <Camera class="w-5 h-5 text-[--color-primary]" />
          <div class="text-sm font-semibold text-[--color-primary]">Galerie</div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
          <img src="/img/hero.jpg" alt="Wellness" class="rounded-2xl w-full h-64 object-cover" />
          <img src="/img/hero3.jpg" alt="Obývací pokoj" class="rounded-2xl w-full h-64 object-cover" />
          <img src="/img/hero2.jpg" alt="Exteriér" class="rounded-2xl w-full h-64 object-cover" />
        </div>
      </div>
    </section>

    <section class="py-16 bg-white">
      <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div class="rounded-3xl border p-6">
            <div class="flex items-center gap-2">
              <Bath class="w-5 h-5 text-[--color-primary]" />
              <div class="font-semibold">Soukromé wellness</div>
            </div>
            <div class="mt-2 text-sm text-gray-700">Vířivka pro 6 osob, odpočinková zóna a komfortní zázemí.</div>
          </div>
          <div class="rounded-3xl border p-6">
            <div class="flex items-center gap-2">
              <Trees class="w-5 h-5 text-[--color-primary]" />
              <div class="font-semibold">Skvělé okolí</div>
            </div>
            <div class="mt-2 text-sm text-gray-700">Jonas Park Ostružná a Ramzová na dosah pro zimní i letní aktivity.</div>
          </div>
          <div class="rounded-3xl border p-6">
            <div class="flex items-center gap-2">
              <CalendarDays class="w-5 h-5 text-[--color-primary]" />
              <div class="font-semibold">Flexibilní termíny</div>
            </div>
            <div class="mt-2 text-sm text-gray-700">Rezervace na míru s jasnou cenou za noc.</div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-16 bg-gray-50">
      <div class="container mx-auto px-6">
        <div class="flex items-center gap-2 mb-6">
          <Quote class="w-5 h-5 text-[--color-primary]" />
          <div class="text-sm font-semibold text-[--color-primary]">Hodnocení</div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div class="rounded-3xl border p-6 bg-white">
            <div class="text-sm text-gray-700">Nejlepší wellness pobyt, který jsme zažili. Chata je nádherná.</div>
            <div class="mt-3 text-xs text-gray-500">— Petra</div>
          </div>
          <div class="rounded-3xl border p-6 bg-white">
            <div class="text-sm text-gray-700">Skvělá lokalita, perfektní vybavení, děti nadšené z okolí.</div>
            <div class="mt-3 text-xs text-gray-500">— Martin</div>
          </div>
          <div class="rounded-3xl border p-6 bg-white">
            <div class="text-sm text-gray-700">Čisté, klidné a útulné. Určitě se vrátíme.</div>
            <div class="mt-3 text-xs text-gray-500">— Jana</div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-16">
      <div class="container mx-auto px-6">
        <div class="rounded-3xl bg-[--color-primary] text-white p-8 md:p-12 flex items-center justify-between">
          <div>
            <div class="text-2xl md:text-3xl font-bold">Rezervujte si svůj pobyt</div>
            <div class="mt-2 text-white/80">Soukromé wellness, pohodlí a příroda na dosah.</div>
          </div>
          <Link :href="route('bookings.calendar')" class="px-5 py-3 rounded-full bg-white text-black">Rezervovat</Link>
        </div>
      </div>
    </section>

    <footer class="py-10 bg-white">
      <div class="container mx-auto px-6">
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-3">
            <img src="/img/logo.png" alt="Logo" class="h-10" />
            <div class="text-sm text-gray-600">© {{ new Date().getFullYear() }} Chata Jana Ostružná</div>
          </div>
          <div class="text-sm text-gray-600">
            <Link :href="route('bookings.calendar')">Rezervace</Link>
          </div>
        </div>
      </div>
    </footer>
  </WebLayout>
</template>