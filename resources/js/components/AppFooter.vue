<script setup>
import { Mail, Phone, MapPin, Landmark } from "lucide-vue-next";
</script>

<template>
    <!-- Footer -->
    <footer class="border-t border-gray-100 bg-white py-16">
      <div class="container mx-auto px-6">
        <div class="flex flex-col items-center justify-between gap-8 md:flex-row">
          <div class="flex items-center gap-4">
            <img src="/img/logo.png" alt="Logo" class="h-12" />
            <div class="flex flex-col">
              <span class="font-bold text-gray-900">Chata Jana</span>
              <span class="text-sm text-gray-500">Ostružná, Jeseníky</span>
            </div>
          </div>
          
          <div class="flex gap-8 text-sm font-medium text-gray-600">
            <Link :href="route('bookings.calendar')" class="hover:text-primary">Rezervace</Link>
            <a href="#" class="hover:text-primary">Obchodní podmínky</a>
            <a href="#" class="hover:text-primary">Kontakt</a>
          </div>
          
          <div class="text-sm text-gray-400">
            © {{ new Date().getFullYear() }} Chata Jana. Všechna práva vyhrazena.
          </div>
        </div>
      </div>
    </footer>
</template>
