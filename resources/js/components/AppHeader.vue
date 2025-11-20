<script setup></script>

<template>
  <header class="glassmorphism container mx-auto mt-4 rounded-4xl p-3 px-6 py-1">
    <nav class="flex items-center justify-between text-white">
      <Link href="/" class="text-xl font-bold">
        <img alt="Chata Jana Ostružná Logo" class="h-16" src="/img/logo.png" />
      </Link>
      <div class="hidden items-center space-x-8 text-sm font-medium lg:flex">
        <Link class="transition-colors hover:text-gray-300" href="#">Úvod</Link>
        <Link class="transition-colors hover:text-gray-300" href="#">O nás</Link>
        <Link class="transition-colors hover:text-gray-300" href="#">Ceník</Link>
        <Link class="transition-colors hover:text-gray-300" href="#">Aktivity & okolí</Link>
        <Link class="transition-colors hover:text-gray-300" href="#">Fotogalerie</Link>

        <Link class="transition-colors hover:text-gray-300" :href="route('contact')">Kontakt</Link>
      </div>
      <Link
        :href="route('bookings.calendar')"
        class="rounded-full bg-white px-5 py-2 text-sm font-semibold text-black transition-colors hover:bg-gray-200"
      >
        Rezervace
      </Link>
    </nav>
  </header>
</template>
