<script setup lang="ts">
import { ref, computed, watch, onMounted, onUnmounted } from 'vue';
import { X, ChevronLeft, ChevronRight } from 'lucide-vue-next';

interface Photo {
  src: string;
  alt: string;
  category?: string;
}

const props = defineProps<{
  photos: Photo[];
  initialIndex: number;
  isOpen: boolean;
}>();

const emit = defineEmits<{
  close: [];
}>();

const currentIndex = ref(props.initialIndex);

watch(() => props.initialIndex, (newIndex) => {
  currentIndex.value = newIndex;
});

watch(() => props.isOpen, (isOpen) => {
  if (isOpen) {
    document.body.style.overflow = 'hidden';
  } else {
    document.body.style.overflow = '';
  }
});

const currentPhoto = computed(() => props.photos[currentIndex.value]);
const hasPrevious = computed(() => currentIndex.value > 0);
const hasNext = computed(() => currentIndex.value < props.photos.length - 1);

const goToPrevious = () => {
  if (hasPrevious.value) {
    currentIndex.value--;
  }
};

const goToNext = () => {
  if (hasNext.value) {
    currentIndex.value++;
  }
};

const handleKeydown = (e: KeyboardEvent) => {
  if (!props.isOpen) return;
  
  if (e.key === 'Escape') {
    emit('close');
  } else if (e.key === 'ArrowLeft') {
    goToPrevious();
  } else if (e.key === 'ArrowRight') {
    goToNext();
  }
};

onMounted(() => {
  window.addEventListener('keydown', handleKeydown);
});

onUnmounted(() => {
  window.removeEventListener('keydown', handleKeydown);
  document.body.style.overflow = '';
});
</script>

<template>
  <Teleport to="body">
    <Transition name="lightbox">
      <div
        v-if="isOpen"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/95"
        @click="emit('close')"
      >
        <!-- Close Button -->
        <button
          @click.stop="emit('close')"
          class="absolute right-4 top-4 z-10 flex h-12 w-12 items-center justify-center rounded-full bg-white/10 text-white backdrop-blur-sm transition-colors hover:bg-white/20"
        >
          <X class="h-6 w-6" />
        </button>

        <!-- Counter -->
        <div class="absolute left-1/2 top-4 z-10 -translate-x-1/2 rounded-full bg-white/10 px-4 py-2 text-sm font-medium text-white backdrop-blur-sm">
          {{ currentIndex + 1 }} / {{ photos.length }}
        </div>

        <!-- Previous Button -->
        <button
          v-if="hasPrevious"
          @click.stop="goToPrevious"
          class="absolute left-4 top-1/2 z-10 flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full bg-white/10 text-white backdrop-blur-sm transition-colors hover:bg-white/20"
        >
          <ChevronLeft class="h-6 w-6" />
        </button>

        <!-- Next Button -->
        <button
          v-if="hasNext"
          @click.stop="goToNext"
          class="absolute right-4 top-1/2 z-10 flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full bg-white/10 text-white backdrop-blur-sm transition-colors hover:bg-white/20"
        >
          <ChevronRight class="h-6 w-6" />
        </button>

        <!-- Image -->
        <div
          @click.stop
          class="relative max-h-[90vh] max-w-[90vw]"
        >
          <Transition name="fade" mode="out-in">
            <img
              :key="currentIndex"
              :src="currentPhoto.src"
              :alt="currentPhoto.alt"
              class="max-h-[90vh] max-w-[90vw] object-contain"
            />
          </Transition>
          
          <!-- Caption -->
          <div
            v-if="currentPhoto.alt"
            class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-6 text-center"
          >
            <p class="text-lg font-medium text-white">{{ currentPhoto.alt }}</p>
            <p v-if="currentPhoto.category" class="mt-1 text-sm text-white/70">{{ currentPhoto.category }}</p>
          </div>
        </div>
      </div>
    </Transition>
  </Teleport>
</template>

<style scoped>
.lightbox-enter-active,
.lightbox-leave-active {
  transition: opacity 0.3s ease;
}

.lightbox-enter-from,
.lightbox-leave-to {
  opacity: 0;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.2s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
