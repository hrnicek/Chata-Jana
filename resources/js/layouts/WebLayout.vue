<script setup>
import { Toaster } from "vue-sonner";
import AppHeader from "../components/AppHeader.vue";
import AppFooter from "../components/AppFooter.vue";
import Head from "../components/Head.vue";
</script>

<template>
  <Head />
  <div class="absolute top-0 w-full z-50">
    <AppHeader />
  </div>
  <slot />
  <Toaster richColors position="top-right" />
  <AppFooter />
</template>
