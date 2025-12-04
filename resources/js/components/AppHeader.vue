<script setup>
import Button from "./ui/button.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
  <header class="container mx-auto mt-4 rounded-4xl bg-transparent px-6 py-3 z-50">
    <nav class="flex items-center justify-between text-white">
      <Link href="/" class="text-xl font-bold">
        <img alt="Chata Jana Ostružná Logo" class="h-16" src="/img/logo.webp" />
      </Link>
      <div class="hidden items-center space-x-8 text-sm font-medium lg:flex">
        <Link class="transition-colors hover:text-honey" :href="route('home')">Úvod</Link>
        <Link class="transition-colors hover:text-honey" :href="route('about')">O nás</Link>
        <Link class="transition-colors hover:text-honey" :href="route('pricing')">Ceník</Link>
        <Link class="transition-colors hover:text-honey" :href="route('activities')">Aktivity &amp; okolí</Link>
        <Link class="transition-colors hover:text-honey" :href="route('gallery')">Fotogalerie</Link>

        <Link class="transition-colors hover:text-honey" :href="route('contact')">Kontakt</Link>
      </div>
      <Button
        :as="Link"
        :href="'#'"
        variant="reserve"
      >
        Rezervace
      </Button>
    </nav>
  </header>
</template>
