<script setup>
import { CalendarDays, FileText, Mail, Phone, MapPin, Wallet, Globe, Hash, User } from "lucide-vue-next";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <!-- Footer -->
    <footer class="bg-honey py-32">
      <div class="container mx-auto px-6">
        <!-- Main Footer Content -->
        <div class="grid gap-16 lg:grid-cols-12">
          <!-- Logo & Description (Larger) -->
          <div class="lg:col-span-4">
            <div class="mb-8">
              <img src="/img/logo-black.webp" alt="Chata Jana Logo" class="h-16 mb-4" />
              <h3 class="text-2xl font-bold text-primary mb-2">Chata Jana</h3>
              <p class="text-gray-600 leading-relaxed">
                Váš horský úkryt v srdci Jeseníků. Soukromé wellness, 
                designový interiér a nekonečné výhledy.
              </p>
            </div>
            <div class="flex items-start gap-3 text-gray-700">
              <MapPin class="h-5 w-5 text-primary mt-0.5 flex-shrink-0" />
              <div>
                <div class="font-medium text-gray-900">Ostružná 165</div>
                <div class="text-sm text-gray-600">788 25, Jeseníky</div>
              </div>
            </div>
          </div>

          <!-- Navigation Links -->
          <div class="lg:col-span-2">
            <h4 class="text-sm font-bold uppercase tracking-wider text-primary mb-6">Navigace</h4>
            <ul class="space-y-4">
              <li>
                <Link :href="route('home')" class="text-gray-700 hover:text-primary transition-colors">Úvod</Link>
              </li>
              <li>
                <Link :href="route('about')" class="text-gray-700 hover:text-primary transition-colors">O nás</Link>
              </li>
              <li>
                <Link :href="route('pricing')" class="text-gray-700 hover:text-primary transition-colors">Ceník</Link>
              </li>
              <li>
                <Link :href="route('gallery')" class="text-gray-700 hover:text-primary transition-colors">Fotogalerie</Link>
              </li>
              <li>
                <Link :href="route('contact')" class="text-gray-700 hover:text-primary transition-colors">Kontakt</Link>
              </li>
            </ul>
          </div>

          <!-- Contact Info -->
          <div class="lg:col-span-3">
            <h4 class="text-sm font-bold uppercase tracking-wider text-primary mb-6">Kontakt</h4>
            <div class="space-y-4">
              <a href="mailto:info@chata-jana.cz" class="group flex items-start gap-3 text-gray-700 hover:text-primary transition-colors">
                <Mail class="h-5 w-5 text-primary mt-0.5 flex-shrink-0" />
                <div>
                  <div class="text-xs text-gray-500 uppercase tracking-wider mb-0.5">E-mail</div>
                  <div class="font-medium">info@chata-jana.cz</div>
                </div>
              </a>
              <a href="tel:+420731492286" class="group flex items-start gap-3 text-gray-700 hover:text-primary transition-colors">
                <Phone class="h-5 w-5 text-primary mt-0.5 flex-shrink-0" />
                <div>
                  <div class="text-xs text-gray-500 uppercase tracking-wider mb-0.5">Telefon</div>
                  <div class="font-medium">+420 731 492 286</div>
                </div>
              </a>
            </div>
          </div>

          <!-- Payment Info -->
          <div class="lg:col-span-3">
            <h4 class="text-sm font-bold uppercase tracking-wider text-primary mb-6">Platební údaje</h4>
            <div class="space-y-3 text-sm">
              <div class="flex items-start gap-2">
                <Wallet class="h-4 w-4 text-primary mt-0.5 flex-shrink-0" />
                <div>
                  <div class="text-xs text-gray-500">Číslo účtu</div>
                  <div class="font-mono text-gray-900">51475575/2070</div>
                </div>
              </div>
              <div class="flex items-start gap-2">
                <Globe class="h-4 w-4 text-primary mt-0.5 flex-shrink-0" />
                <div>
                  <div class="text-xs text-gray-500">IBAN</div>
                  <div class="font-mono text-xs text-gray-900">CZ46 2070 0000 0000 5147 5575</div>
                </div>
              </div>
              <div class="flex items-start gap-2">
                <User class="h-4 w-4 text-primary mt-0.5 flex-shrink-0" />
                <div>
                  <div class="text-xs text-gray-500">Majitel</div>
                  <div class="text-gray-900">Jana Schneider</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Bottom Bar -->
        <div class="mt-16 pt-8 border-t border-primary/10">
          <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-sm text-gray-600">
              © {{ new Date().getFullYear() }} Chata Jana. Všechna práva vyhrazena.
            </p>
            <div class="flex gap-6 text-sm">
              <a href="#" class="text-gray-600 hover:text-primary transition-colors">Obchodní podmínky</a>
              <a href="#" class="text-gray-600 hover:text-primary transition-colors">Ochrana údajů</a>
            </div>
          </div>
        </div>
      </div>
    </footer>
</template>
