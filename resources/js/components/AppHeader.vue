<script setup>
import Button from "./ui/button.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
  <header class="container mx-auto mt-6 px-8 py-4 z-50">
    <nav class="flex items-center justify-between text-white">
      <Link href="/" class="flex items-center gap-3 group">
        <img alt="Chata Jana Ostružná Logo" class="h-12 w-auto transition-transform group-hover:scale-105" src="/img/logo.webp" />
      </Link>
      
      <div class="hidden items-center space-x-10 text-sm font-medium lg:flex">
        <Link class="transition-all hover:text-gold hover:tracking-widest font-heading uppercase tracking-wide text-xs font-bold" :href="route('home')">Úvod</Link>
        <Link class="transition-all hover:text-gold hover:tracking-widest font-heading uppercase tracking-wide text-xs font-bold" :href="route('about')">O nás</Link>
        <Link class="transition-all hover:text-gold hover:tracking-widest font-heading uppercase tracking-wide text-xs font-bold" :href="route('pricing')">Ceník</Link>
        <Link class="transition-all hover:text-gold hover:tracking-widest font-heading uppercase tracking-wide text-xs font-bold" :href="route('activities')">Aktivity &amp; okolí</Link>
        <Link class="transition-all hover:text-gold hover:tracking-widest font-heading uppercase tracking-wide text-xs font-bold" :href="route('gallery')">Fotogalerie</Link>
        <Link class="transition-all hover:text-gold hover:tracking-widest font-heading uppercase tracking-wide text-xs font-bold" :href="route('contact')">Kontakt</Link>
      </div>

      <Button
        :as="Link"
        :href="'#'"
        variant="outline"
        class="border-white text-white hover:bg-white hover:text-primary font-bold transition-all"
      >
        Rezervace
      </Button>
    </nav>
  </header>
</template>
