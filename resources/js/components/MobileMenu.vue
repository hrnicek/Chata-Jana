<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { X } from "lucide-vue-next";

defineProps<{
  isOpen: boolean;
}>();

const emit = defineEmits(["close"]);
</script>

<template>
  <Teleport to="body">
    <Transition
      enter-active-class="transition duration-300 ease-out"
      enter-from-class="translate-x-full opacity-0"
      enter-to-class="translate-x-0 opacity-100"
      leave-active-class="transition duration-200 ease-in"
      leave-from-class="translate-x-0 opacity-100"
      leave-to-class="translate-x-full opacity-0"
    >
      <div
        v-if="isOpen"
        class="fixed inset-0 z-[100] flex flex-col bg-zinc-950 text-white"
      >
        <div class="flex items-center justify-between p-6">
          <Link href="/" class="flex items-center gap-3" @click="emit('close')">
            <img
              alt="Chata Jana Ostružná"
              class="h-10 w-auto"
              src="/img/logo.webp"
            />
          </Link>
          <button
            @click="emit('close')"
            class="rounded-full p-2 hover:bg-white/10 transition-colors"
          >
            <X class="h-8 w-8" />
          </button>
        </div>

        <nav
          class="flex flex-col items-center justify-center flex-1 space-y-8 text-2xl font-bold uppercase tracking-widest"
        >
          <Link
            href="/"
            class="hover:text-gold transition-colors"
            @click="emit('close')"
          >
            Úvod
          </Link>
          <Link
            :href="route('about')"
            class="hover:text-gold transition-colors"
            @click="emit('close')"
          >
            O nás
          </Link>
          <Link
            :href="route('pricing')"
            class="hover:text-gold transition-colors"
            @click="emit('close')"
          >
            Ceník
          </Link>
          <Link
            :href="route('activities')"
            class="hover:text-gold transition-colors"
            @click="emit('close')"
          >
            Aktivity & okolí
          </Link>
          <Link
            :href="route('gallery')"
            class="hover:text-gold transition-colors"
            @click="emit('close')"
          >
            Fotogalerie
          </Link>
          <Link
            :href="route('contact')"
            class="hover:text-gold transition-colors"
            @click="emit('close')"
          >
            Kontakt
          </Link>
          
           <div class="pt-8 w-full px-12">
               <Link
                    :href="'#'"
                    class="block w-full py-4 text-center border-2 border-white rounded-lg hover:bg-white hover:text-primary transition-colors font-bold text-lg"
                     @click="emit('close')"
                >
                    Rezervace
                </Link>
           </div>
        </nav>
      </div>
    </Transition>
  </Teleport>
</template>
