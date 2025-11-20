<script setup lang="ts">
import Hero from "../components/Hero.vue";
import WebLayout from "../layouts/WebLayout.vue";
import {
  Mountain,
  Bath,
  Trees,
  Quote,
  Camera,
  CalendarDays,
  Wifi,
  Tv,
  Utensils,
  Car,
  Baby,
  Bike,
  Snowflake,
} from "lucide-vue-next";
</script>

<template>
  <WebLayout>
    <Hero />
    <section class="bg-gray-50 py-16">
      <div class="container mx-auto px-6">
        <div class="mb-6 flex items-center gap-2">
          <Utensils class="h-5 w-5 text-[--color-primary]" />
          <div class="text-sm font-semibold text-[--color-primary]">Vybavení a služby</div>
        </div>
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
          <div class="rounded-3xl border bg-white p-6">
            <div class="flex items-center gap-2">
              <Wifi class="h-5 w-5 text-[--color-primary]" />
              <div class="font-semibold">Wifi zdarma</div>
            </div>
          </div>
          <div class="rounded-3xl border bg-white p-6">
            <div class="flex items-center gap-2">
              <Tv class="h-5 w-5 text-[--color-primary]" />
              <div class="font-semibold">TV</div>
            </div>
          </div>
          <div class="rounded-3xl border bg-white p-6">
            <div class="flex items-center gap-2">
              <Utensils class="h-5 w-5 text-[--color-primary]" />
              <div class="font-semibold">Plně vybavená kuchyň</div>
            </div>
          </div>
          <div class="rounded-3xl border bg-white p-6">
            <div class="flex items-center gap-2">
              <Car class="h-5 w-5 text-[--color-primary]" />
              <div class="font-semibold">Parkování přímo u chaty</div>
            </div>
          </div>
          <div class="rounded-3xl border bg-white p-6">
            <div class="flex items-center gap-2">
              <Baby class="h-5 w-5 text-[--color-primary]" />
              <div class="font-semibold">Vhodné i pro rodiny s malými dětmi</div>
            </div>
          </div>
          <div class="rounded-3xl border bg-white p-6">
            <div class="flex items-center gap-2">
              <Bike class="h-5 w-5 text-[--color-primary]" />
              <div class="font-semibold">Možnost uskladnění horského kola</div>
            </div>
          </div>
          <div class="rounded-3xl border bg-white p-6 sm:col-span-2 lg:col-span-3">
            <div class="flex items-start gap-2">
              <Snowflake class="mt-0.5 h-5 w-5 text-[--color-primary]" />
              <div>
                <div class="font-semibold">Možnost uskladnění lyží, běžek či zimního vybavení</div>
                <div class="mt-1 text-sm text-gray-700">
                  (Pro lyže je určena skříň přímo v předsíni domu)
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="bg-white py-16">
      <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 items-center gap-10 md:grid-cols-2">
          <div>
            <div class="mb-3 flex items-center gap-2">
              <Mountain class="h-5 w-5 text-[--color-primary]" />
              <div class="text-sm font-semibold text-[--color-primary]">O místě</div>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 md:text-4xl">Vaše horské útočiště</h2>
            <p class="mt-4 text-gray-700">
              Chata Jana nabízí soukromé wellness a pohodlí pro celou rodinu. V srdci Jeseníků,
              kousek od lyžařských areálů a turistických tras.
            </p>
            <div class="mt-6 flex items-center gap-3">
              <Link
                :href="route('bookings.calendar')"
                class="rounded-full bg-[--color-primary] px-4 py-2 text-white"
                >Rezervovat termín</Link
              >
              <Link href="#galerie" class="rounded-full border px-4 py-2">Prohlédnout galerii</Link>
            </div>
          </div>
          <div>
            <img
              src="/img/hero2.jpg"
              alt="Chata Jana exteriér"
              class="w-full rounded-3xl object-cover"
            />
          </div>
        </div>
      </div>
    </section>

    <section id="galerie" class="bg-gray-50 py-16">
      <div class="container mx-auto px-6">
        <div class="mb-6 flex items-center gap-2">
          <Camera class="h-5 w-5 text-[--color-primary]" />
          <div class="text-sm font-semibold text-[--color-primary]">Galerie</div>
        </div>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
          <img src="/img/hero.jpg" alt="Wellness" class="h-64 w-full rounded-2xl object-cover" />
          <img
            src="/img/hero3.jpg"
            alt="Obývací pokoj"
            class="h-64 w-full rounded-2xl object-cover"
          />
          <img src="/img/hero2.jpg" alt="Exteriér" class="h-64 w-full rounded-2xl object-cover" />
        </div>
      </div>
    </section>

    <section class="bg-white py-16">
      <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
          <div class="rounded-3xl border p-6">
            <div class="flex items-center gap-2">
              <Bath class="h-5 w-5 text-[--color-primary]" />
              <div class="font-semibold">Soukromé wellness</div>
            </div>
            <div class="mt-2 text-sm text-gray-700">
              Vířivka pro 6 osob, odpočinková zóna a komfortní zázemí.
            </div>
          </div>
          <div class="rounded-3xl border p-6">
            <div class="flex items-center gap-2">
              <Trees class="h-5 w-5 text-[--color-primary]" />
              <div class="font-semibold">Skvělé okolí</div>
            </div>
            <div class="mt-2 text-sm text-gray-700">
              Jonas Park Ostružná a Ramzová na dosah pro zimní i letní aktivity.
            </div>
          </div>
          <div class="rounded-3xl border p-6">
            <div class="flex items-center gap-2">
              <CalendarDays class="h-5 w-5 text-[--color-primary]" />
              <div class="font-semibold">Flexibilní termíny</div>
            </div>
            <div class="mt-2 text-sm text-gray-700">Rezervace na míru s jasnou cenou za noc.</div>
          </div>
        </div>
      </div>
    </section>

    <section class="bg-gray-50 py-16">
      <div class="container mx-auto px-6">
        <div class="mb-6 flex items-center gap-2">
          <Quote class="h-5 w-5 text-[--color-primary]" />
          <div class="text-sm font-semibold text-[--color-primary]">Hodnocení</div>
        </div>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
          <div class="rounded-3xl border bg-white p-6">
            <div class="text-sm text-gray-700">
              Nejlepší wellness pobyt, který jsme zažili. Chata je nádherná.
            </div>
            <div class="mt-3 text-xs text-gray-500">— Petra</div>
          </div>
          <div class="rounded-3xl border bg-white p-6">
            <div class="text-sm text-gray-700">
              Skvělá lokalita, perfektní vybavení, děti nadšené z okolí.
            </div>
            <div class="mt-3 text-xs text-gray-500">— Martin</div>
          </div>
          <div class="rounded-3xl border bg-white p-6">
            <div class="text-sm text-gray-700">Čisté, klidné a útulné. Určitě se vrátíme.</div>
            <div class="mt-3 text-xs text-gray-500">— Jana</div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-16">
      <div class="container mx-auto px-6">
        <div
          class="flex items-center justify-between rounded-3xl bg-[--color-primary] p-8 text-white md:p-12"
        >
          <div>
            <div class="text-2xl font-bold md:text-3xl">Rezervujte si svůj pobyt</div>
            <div class="mt-2 text-white/80">Soukromé wellness, pohodlí a příroda na dosah.</div>
          </div>
          <Link
            :href="route('bookings.calendar')"
            class="rounded-full bg-white px-5 py-3 text-black"
            >Rezervovat</Link
          >
        </div>
      </div>
    </section>

    <footer class="bg-white py-10">
      <div class="container mx-auto px-6">
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-3">
            <img src="/img/logo.png" alt="Logo" class="h-10" />
            <div class="text-sm text-gray-600">
              © {{ new Date().getFullYear() }} Chata Jana Ostružná
            </div>
          </div>
          <div class="text-sm text-gray-600">
            <Link :href="route('bookings.calendar')">Rezervace</Link>
          </div>
        </div>
      </div>
    </footer>
  </WebLayout>
</template>
