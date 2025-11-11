<script setup>
</script>

<template>
  <header class="container mx-auto px-6 py-1 mt-4 glassmorphism p-3 rounded-4xl">
    <nav class="flex items-center justify-between text-white">
      <Link href="/" class="text-xl font-bold">
        <img
          alt="Chata Jana Ostružná Logo"
          class="h-16"
          src="/img/logo.png"
        />
      </Link>
      <div class="hidden lg:flex items-center space-x-8 font-medium text-sm">
        <Link class="hover:text-gray-300 transition-colors" href="#">Úvod</Link>
                <Link class="hover:text-gray-300 transition-colors" href="#">Aktivity & okolí</Link>

        <Link class="hover:text-gray-300 transition-colors" href="#">Kontakt</Link>
      </div>
      <a class="bg-white text-black font-semibold py-2 px-5 rounded-full hover:bg-gray-200 transition-colors text-sm" href="#">
        REZERVACE
      </a>
    </nav>
  </header>
</template>