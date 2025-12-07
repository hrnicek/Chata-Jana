<script setup>
import { ref } from "vue";
import Button from "./ui/button.vue";
import { Link } from "@inertiajs/vue3";
import { Menu } from "lucide-vue-next";
import MobileMenu from "./MobileMenu.vue";

const isMobileMenuOpen = ref(false);
</script>

<template>
  <header class="container mx-auto mt-6 px-8 py-4 z-50 relative">
    <nav class="flex items-center justify-between text-white">
      <Link href="/" class="flex items-center gap-3 group">
        <img alt="Chata Jana Ostružná Logo" class="h-12 w-auto transition-transform group-hover:scale-105" src="/img/logo.webp" />
      </Link>
      
      <!-- Desktop Navigation -->
      <div class="hidden items-center space-x-10 text-sm font-medium lg:flex">
        <Link class="transition-colors hover:text-gold font-heading uppercase tracking-wide text-xs font-bold" :href="route('home')">Úvod</Link>
        <Link class="transition-colors hover:text-gold font-heading uppercase tracking-wide text-xs font-bold" :href="route('about')">O nás</Link>
        <Link class="transition-colors hover:text-gold font-heading uppercase tracking-wide text-xs font-bold" :href="route('pricing')">Ceník</Link>
        <Link class="transition-colors hover:text-gold font-heading uppercase tracking-wide text-xs font-bold" :href="route('activities')">Aktivity &amp; okolí</Link>
        <Link class="transition-colors hover:text-gold font-heading uppercase tracking-wide text-xs font-bold" :href="route('gallery')">Fotogalerie</Link>
        <Link class="transition-colors hover:text-gold font-heading uppercase tracking-wide text-xs font-bold" :href="route('contact')">Kontakt</Link>
      </div>

       <!-- Mobile Menu Button -->
      <button 
        class="lg:hidden text-white hover:text-gold transition-colors"
        @click="isMobileMenuOpen = true"
      >
        <Menu class="h-8 w-8" />
      </button>

      <Button
        :as="Link"
        :href="'#'"
        variant="outline"
        class="hidden lg:inline-flex border-white text-white hover:bg-white hover:text-primary font-bold transition-all"
      >
        Rezervace
      </Button>
    </nav>

    <MobileMenu :is-open="isMobileMenuOpen" @close="isMobileMenuOpen = false" />
  </header>
</template>
