<template>
  <component 
    :is="as" 
    :href="href"
    :class="cn(buttonVariants({ variant, size }), $attrs.class)" 
    @click="$emit('click')"
  >
    <slot />
  </component>
</template>

<script setup>
import { cva } from "class-variance-authority";
import { cn } from "@/lib/utils";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  as: {
    type: [String, Object],
    default: "button",
  },
  href: {
    type: String,
    default: undefined,
  },
  variant: {
    type: String,
    default: "default",
    validator: (value) =>
      [
        "default", 
        "destructive", 
        "outline", 
        "secondary", 
        "ghost", 
        "link", 
        "reserve",
        "cta-primary",
        "cta-secondary",
        "pricing-primary",
        "pricing-highlighted",
        "navigation"
      ].includes(value),
  },
  size: {
    type: String,
    default: "default",
    validator: (value) => ["default", "sm", "lg", "icon"].includes(value),
  },
});

const buttonVariants = cva(
  "inline-flex items-center justify-center whitespace-nowrap rounded-full text-sm font-semibold ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50",
  {
    variants: {
      variant: {
        default: "bg-primary text-primary-foreground hover:bg-primary/90",
        destructive: "bg-destructive text-destructive-foreground hover:bg-destructive/90",
        outline: "border border-gray-200 px-8 py-4 font-medium text-gray-700 transition-colors hover:bg-gray-50 hover:text-gray-900",
        secondary: "bg-secondary text-secondary-foreground hover:bg-secondary/80",
        ghost: "hover:bg-accent hover:text-accent-foreground",
        link: "text-primary underline-offset-4 hover:underline",
        reserve: "bg-white text-black px-5 py-2 hover:bg-gray-200",
        "cta-primary": "bg-white px-8 py-4 font-bold text-primary",
        "cta-secondary": "border border-white/30 bg-white/10 px-8 py-4 font-bold text-white transition-colors hover:bg-white/20",
        "pricing-primary": "w-full bg-primary text-white hover:bg-[#1a3f2a] px-6 py-4",
        "pricing-highlighted": "w-full bg-white text-primary hover:bg-honey px-6 py-4",
        "navigation": "bg-gray-200 px-3 py-2 hover:bg-gray-300",
      },
      size: {
        default: "h-10 px-4 py-2",
        sm: "h-9 rounded-md px-3",
        lg: "h-11 rounded-md px-8",
        icon: "h-10 w-10",
      },
    },
    defaultVariants: {
      variant: "default",
      size: "default",
    },
  }
);
</script>
