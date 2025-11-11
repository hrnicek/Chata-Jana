<template>
  <button
    :class="buttonClasses"
    @click="$emit('click')"
  >
    <slot />
  </button>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  variant: {
    type: String,
    default: 'primary',
    validator: (value) => ['primary', 'secondary', 'reserve'].includes(value)
  },
  size: {
    type: String,
    default: 'default',
    validator: (value) => ['sm', 'default', 'lg'].includes(value)
  }
})

const buttonClasses = computed(() => {
  const baseClasses = 'font-semibold transition-colors rounded-full'

  const variantClasses = {
    primary: 'bg-black text-white hover:bg-gray-800',
    secondary: 'bg-gray-200 text-black hover:bg-gray-300',
    reserve: 'w-full bg-white text-black py-3 px-6 hover:bg-gray-200'
  }

  const sizeClasses = {
    sm: 'py-2 px-4 text-sm',
    default: 'py-2 px-4',
    lg: 'py-3 px-6 text-lg'
  }

  return `${baseClasses} ${variantClasses[props.variant]} ${sizeClasses[props.size]}`
})
</script>