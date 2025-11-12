<script setup>
import { Toaster } from "vue-sonner";
</script>

<template>
  <slot />
  <Toaster richColors position="top-right" />
</template>
