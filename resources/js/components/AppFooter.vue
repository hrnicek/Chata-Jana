<script setup>
import { CalendarDays, FileText, Mail, Phone, MapPin, Wallet, Globe, Hash, User } from "lucide-vue-next";
</script>

<template>
    <!-- Footer -->
    <footer class="border-t border-primary bg-honey py-20">
      <div class="container mx-auto px-6">
        <div class="grid gap-16 sm:grid-cols-2 lg:grid-cols-4">
          <div>
            <div class="flex items-center gap-4">
              <img src="/img/logo-black.png" alt="Logo" class="h-12" />
              <div>
                <div class="font-bold text-primary">Chata Jana</div>
                <div class="text-sm text-primary/70">Ostružná, Jeseníky</div>
              </div>
            </div>
            <div class="mt-6 space-y-2 text-sm text-gray-800">
              <div class="flex items-center gap-2">
                <MapPin class="h-4 w-4 text-primary" />
                <span>Ostružná 165, 788 25</span>
              </div>
            </div>
          </div>

          <div>
            <div class="text-xs font-semibold uppercase tracking-wider text-primary">Navigace</div>
            <ul class="mt-4 space-y-3 text-sm text-gray-800">
              <li class="flex items-center gap-2">
                <CalendarDays class="h-4 w-4 text-primary" />
                <Link :href="route('home')" class="hover:text-primary">Rezervace</Link>
              </li>
              <li class="flex items-center gap-2">
                <FileText class="h-4 w-4 text-primary" />
                <a href="#" class="hover:text-primary">Obchodní podmínky</a>
              </li>
              <li class="flex items-center gap-2">
                <Mail class="h-4 w-4 text-primary" />
                <a href="#" class="hover:text-primary">Kontakt</a>
              </li>
            </ul>
          </div>

          <div>
            <div class="text-xs font-semibold uppercase tracking-wider text-primary">Kontakt</div>
            <div class="mt-4 space-y-3 text-sm text-gray-800">
              <div class="flex items-center gap-2">
                <Mail class="h-4 w-4 text-primary" />
                <span>E‑mail:</span>
                <a href="mailto:info@chata-jana.cz" class="hover:text-primary">info@chata-jana.cz</a>
              </div>
              <div class="flex items-center gap-2">
                <Phone class="h-4 w-4 text-primary" />
                <span>Telefon:</span>
                <a href="tel:+420731492286" class="hover:text-primary">+420 731 492 286</a>
              </div>
            </div>
          </div>

          <div>
            <div class="text-xs font-semibold uppercase tracking-wider text-primary">Platební údaje</div>
            <div class="mt-4 space-y-3 text-sm text-gray-800">
              <div class="flex items-center gap-2">
                <Wallet class="h-4 w-4 text-primary" />
                <span>Číslo účtu:</span>
                <span>51475575/2070</span>
              </div>
              <div class="flex items-center gap-2">
                <Globe class="h-4 w-4 text-primary" />
                <span>IBAN:</span>
                <span>CZ46 2070 0000 0000 5147 5575</span>
              </div>
              <div class="flex items-center gap-2">
                <Hash class="h-4 w-4 text-primary" />
                <span>BIC (SWIFT):</span>
                <span>MPUBCZPPXXX</span>
              </div>
              <div class="flex items-center gap-2">
                <User class="h-4 w-4 text-primary" />
                <span>Majitel:</span>
                <span>Jana Schneider</span>
              </div>
            </div>
          </div>
        </div>

        <div class="mt-12 text-center text-sm text-primary/70">
          © {{ new Date().getFullYear() }} Chata Jana · Všechna práva vyhrazena
        </div>
      </div>
    </footer>
</template>
