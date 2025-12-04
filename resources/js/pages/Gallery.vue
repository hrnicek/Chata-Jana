<script setup lang="ts">
import { ref, computed } from 'vue';
import WebLayout from '../layouts/WebLayout.vue';
import PageHeader from '../components/PageHeader.vue';
import PhotoLightbox from '../components/PhotoLightbox.vue';
import { Camera } from 'lucide-vue-next';

interface Photo {
  src: string;
  alt: string;
  category: string;
}

const categories = [
  { id: 'all', label: 'Vše' },
  { id: 'exterier', label: 'Exteriér' },
  { id: 'spolecenska-mistnost', label: 'Společenská místnost' },
  { id: 'wellness', label: 'Wellness' },
  { id: 'kuchyn', label: 'Kuchyně' },
  { id: 'terasa', label: 'Terasa' },
  { id: 'ostatni', label: 'Ostatní' },
];

const photos: Photo[] = [
  // Exteriér
  { src: '/img/photos/exterier/0Q9A0146.webp', alt: 'Chata Jana - pohled zepředu', category: 'exterier' },
  { src: '/img/photos/exterier/0Q9A0157.webp', alt: 'Chata Jana - zimní atmosféra', category: 'exterier' },
  
  // Společenská místnost
  { src: '/img/photos/spolecenska-mistnost/0Q9A0170-HDR.webp', alt: 'Společenská místnost - obývací prostor', category: 'spolecenska-mistnost' },
  { src: '/img/photos/spolecenska-mistnost/0Q9A0212-HDR.webp', alt: 'Společenská místnost - posezení', category: 'spolecenska-mistnost' },
  { src: '/img/photos/spolecenska-mistnost/0Q9A0226-HDR.webp', alt: 'Společenská místnost - detail', category: 'spolecenska-mistnost' },
  { src: '/img/photos/spolecenska-mistnost/0Q9A0289-HDR.webp', alt: 'Společenská místnost - celkový pohled', category: 'spolecenska-mistnost' },
  { src: '/img/photos/spolecenska-mistnost/0Q9A0317-HDR.webp', alt: 'Společenská místnost - relaxační zóna', category: 'spolecenska-mistnost' },
  
  // Wellness
  { src: '/img/photos/vyrivka/0Q9A0765-HDR.webp', alt: 'Vířivka - wellness zóna', category: 'wellness' },
  
  // Kuchyně
  { src: '/img/photos/kuchyn/0Q9A0261-HDR.webp', alt: 'Plně vybavená kuchyně', category: 'kuchyn' },
  
  // Terasa
  { src: '/img/photos/terasa/0Q9A0352-HDR.webp', alt: 'Terasa s výhledem', category: 'terasa' },
];

const activeCategory = ref('all');
const lightboxOpen = ref(false);
const lightboxIndex = ref(0);

const filteredPhotos = computed(() => {
  if (activeCategory.value === 'all') {
    return photos;
  }
  return photos.filter(photo => photo.category === activeCategory.value);
});

const openLightbox = (index: number) => {
  lightboxIndex.value = index;
  lightboxOpen.value = true;
};

const closeLightbox = () => {
  lightboxOpen.value = false;
};
</script>

<template>
  <WebLayout>
    <PageHeader 
      badge="Fotogalerie"
      title="Prohlédněte si Chatu Jana"
      subtitle="Každý kout naší chaty je navržen pro vaše pohodlí. Prohlédněte si místa, kde budete trávit společné chvíle."
      :image="photos[0].src"
    />

    <section class="relative -mt-20 pb-32">
      <div class="container mx-auto px-6">
        <!-- Category Filters -->
        <div class="mb-12 flex flex-wrap justify-center gap-3">
          <button
            v-for="category in categories"
            :key="category.id"
            @click="activeCategory = category.id"
            :class="[
              'rounded-full px-6 py-3 text-sm font-medium transition-all',
              activeCategory === category.id
                ? 'bg-primary text-white shadow-lg'
                : 'bg-white text-gray-700 hover:bg-honey hover:text-primary'
            ]"
          >
            {{ category.label }}
          </button>
        </div>

        <!-- Photo Grid -->
        <TransitionGroup
          name="gallery"
          tag="div"
          class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3"
        >
          <div
            v-for="(photo, index) in filteredPhotos"
            :key="photo.src"
            @click="openLightbox(index)"
            class="group relative aspect-[4/3] cursor-pointer overflow-hidden rounded-3xl bg-gray-100"
          >
            <img
              :src="photo.src"
              :alt="photo.alt"
              class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"
              loading="lazy"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100">
              <div class="absolute bottom-0 left-0 right-0 p-6">
                <p class="text-lg font-semibold text-white">{{ photo.alt }}</p>
              </div>
            </div>
            <div class="absolute right-4 top-4 flex h-10 w-10 items-center justify-center rounded-full bg-white/90 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
              <Camera class="h-5 w-5 text-primary" />
            </div>
          </div>
        </TransitionGroup>

        <!-- Empty State -->
        <div
          v-if="filteredPhotos.length === 0"
          class="py-20 text-center"
        >
          <Camera class="mx-auto mb-4 h-12 w-12 text-gray-300" />
          <p class="text-gray-500">V této kategorii zatím nejsou žádné fotky.</p>
        </div>
      </div>
    </section>

    <!-- Lightbox -->
    <PhotoLightbox
      :photos="filteredPhotos"
      :initial-index="lightboxIndex"
      :is-open="lightboxOpen"
      @close="closeLightbox"
    />
  </WebLayout>
</template>

<style scoped>
.gallery-enter-active,
.gallery-leave-active {
  transition: all 0.3s ease;
}

.gallery-enter-from {
  opacity: 0;
  transform: scale(0.9);
}

.gallery-leave-to {
  opacity: 0;
  transform: scale(0.9);
}

.gallery-move {
  transition: transform 0.3s ease;
}
</style>