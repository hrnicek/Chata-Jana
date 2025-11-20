<script setup>
import { Mail, Phone, MapPin, Landmark } from "lucide-vue-next";
</script>

<template>
  <footer class="mt-16 border-t border-gray-200 py-12">
    <div class="container mx-auto px-6">
      <div class="grid grid-cols-1 gap-10 md:grid-cols-3">
        <div class="glassmorphism rounded-3xl border border-gray-200 p-6">
          <h3 class="text-lg font-semibold">Kontaktní informace</h3>
          <div class="mt-4 flex items-start gap-3 text-sm">
            <MapPin class="mt-0.5 h-4 w-4 text-gray-700" />
            <div>
              <p class="font-medium">Chata Jana</p>
              <p class="font-light text-gray-700">Ostružná 165</p>
              <p class="font-light text-gray-700">788 25</p>
            </div>
          </div>
        </div>

        <div class="glassmorphism rounded-3xl border border-gray-200 p-6">
          <h3 class="text-lg font-semibold">Kontakt</h3>
          <div class="mt-4 flex items-start gap-3 text-sm">
            <Mail class="mt-0.5 h-4 w-4 text-gray-700" />
            <div>
              <p class="text-gray-500">E‑mail</p>
              <a href="mailto:info@chata-jana.cz" class="font-medium text-gray-900">info@chata-jana.cz</a>
            </div>
          </div>
          <div class="mt-3 flex items-start gap-3 text-sm">
            <Phone class="mt-0.5 h-4 w-4 text-gray-700" />
            <div>
              <p class="text-gray-500">Telefon</p>
              <a href="tel:+420731492286" class="font-medium text-gray-900">+420 731 492 286</a>
            </div>
          </div>
        </div>

        <div class="glassmorphism rounded-3xl border border-gray-200 p-6">
          <h3 class="text-lg font-semibold">Bankovní údaje</h3>
          <div class="mt-4 space-y-3 text-sm">
            <div>
              <p class="text-gray-500">Číslo účtu</p>
              <p class="font-medium text-gray-900">51475575/2070</p>
            </div>
            <div>
              <p class="text-gray-500">IBAN</p>
              <p class="font-mono text-sm text-gray-900">CZ46 2070 0000 0000 5147 5575</p>
            </div>
            <div class="flex items-start gap-3">
              <Landmark class="mt-0.5 h-4 w-4 text-gray-700" />
              <div>
                <p class="text-gray-500">BIC (SWIFT)</p>
                <p class="font-mono text-sm text-gray-900">MPUBCZPPXXX</p>
              </div>
            </div>
            <div>
              <p class="text-gray-500">Majitel</p>
              <p class="font-medium text-gray-900">Jana Schneider</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>
