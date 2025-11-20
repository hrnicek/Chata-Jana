<script setup>
</script>

<template>
    <!-- Footer -->
    <footer class="border-t border-gray-100 bg-white py-16">
      <div class="container mx-auto px-6">
        <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-4">
          <div>
            <div class="flex items-center gap-4">
              <img src="/img/logo.png" alt="Logo" class="h-12" />
              <div>
                <div class="font-bold text-gray-900">Chata Jana</div>
                <div class="text-sm text-gray-500">Ostružná, Jeseníky</div>
              </div>
            </div>
            <div class="mt-4 space-y-1 text-sm text-gray-600">
              <div>Ostružná 165</div>
              <div>788 25</div>
            </div>
          </div>

          <div>
            <div class="text-xs font-semibold uppercase tracking-wider text-gray-500">Navigace</div>
            <ul class="mt-3 space-y-2 text-sm text-gray-600">
              <li><Link :href="route('bookings.calendar')" class="hover:text-primary">Rezervace</Link></li>
              <li><a href="#" class="hover:text-primary">Obchodní podmínky</a></li>
              <li><a href="#" class="hover:text-primary">Kontakt</a></li>
            </ul>
          </div>

          <div>
            <div class="text-xs font-semibold uppercase tracking-wider text-gray-500">Kontakt</div>
            <div class="mt-3 space-y-2 text-sm text-gray-600">
              <div>E‑mail: <a href="mailto:info@chata-jana.cz" class="hover:text-primary">info@chata-jana.cz</a></div>
              <div>Telefon: <a href="tel:+420731492286" class="hover:text-primary">+420 731 492 286</a></div>
            </div>
          </div>

          <div>
            <div class="text-xs font-semibold uppercase tracking-wider text-gray-500">Platební údaje</div>
            <div class="mt-3 space-y-2 text-sm text-gray-600">
              <div>Číslo účtu: 51475575/2070</div>
              <div>IBAN: CZ46 2070 0000 0000 5147 5575</div>
              <div>BIC (SWIFT): MPUBCZPPXXX</div>
              <div>Majitel: Jana Schneider</div>
            </div>
          </div>
        </div>

        <div class="mt-10 text-center text-sm text-gray-400">
          © {{ new Date().getFullYear() }} Chata Jana. Všechna práva vyhrazena.
        </div>
      </div>
    </footer>
</template>
