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
  { id: 'pokoje', label: 'Pokoje' },
  { id: 'kuchyn', label: 'Kuchyně' },
  { id: 'wellness', label: 'Wellness' },
  { id: 'koupelny', label: 'Koupelny & WC' },
  { id: 'terasa', label: 'Terasa' },
  { id: 'chodby', label: 'Chodby' },
  { id: 'satna', label: 'Šatna' },
  { id: 'ostatni', label: 'Ostatní' },
];

const photos: Photo[] = [
  // Exteriér
  { src: '/img/photos/exterier/0Q9A0146.webp', alt: 'Chata Jana - pohled zepředu', category: 'exterier' },
  { src: '/img/photos/exterier/0Q9A0157.webp', alt: 'Chata Jana - zimní atmosféra', category: 'exterier' },
  { src: '/img/photos/exterier/IMG_2.jpg', alt: 'Exteriér chaty', category: 'exterier' },
  
  // Společenská místnost
  { src: '/img/photos/spolecenska-mistnost/0Q9A0170-HDR.webp', alt: 'Společenská místnost - obývací prostor', category: 'spolecenska-mistnost' },
  { src: '/img/photos/spolecenska-mistnost/0Q9A0212-HDR.webp', alt: 'Společenská místnost - posezení', category: 'spolecenska-mistnost' },
  { src: '/img/photos/spolecenska-mistnost/0Q9A0226-HDR.webp', alt: 'Společenská místnost - detail', category: 'spolecenska-mistnost' },
  { src: '/img/photos/spolecenska-mistnost/0Q9A0289-HDR.webp', alt: 'Společenská místnost - celkový pohled', category: 'spolecenska-mistnost' },
  { src: '/img/photos/spolecenska-mistnost/0Q9A0317-HDR.webp', alt: 'Společenská místnost - relaxační zóna', category: 'spolecenska-mistnost' },
  
  // Pokoje
  { src: '/img/photos/pokoje/IMG_42.jpg', alt: 'Ložnice', category: 'pokoje' },
  { src: '/img/photos/pokoje/IMG_52.jpg', alt: 'Interiér pokoje', category: 'pokoje' },
  { src: '/img/photos/pokoje/IMG_57.jpg', alt: 'Útulná ložnice', category: 'pokoje' },
  { src: '/img/photos/pokoje/IMG_59.jpg', alt: 'Podkrovní pokoj', category: 'pokoje' },
  { src: '/img/photos/pokoje/IMG_61.jpg', alt: 'Světlý pokoj', category: 'pokoje' },

  // Kuchyně
  { src: '/img/photos/kuchyn/0Q9A0261-HDR.webp', alt: 'Plně vybavená kuchyně', category: 'kuchyn' },
  { src: '/img/photos/kuchyn/IMG_22.jpg', alt: 'Kuchyňská linka', category: 'kuchyn' },
  { src: '/img/photos/kuchyn/IMG_34.jpg', alt: 'Jídelní kout', category: 'kuchyn' },
  { src: '/img/photos/kuchyn/IMG_39.jpg', alt: 'Detail kuchyně', category: 'kuchyn' },

  // Wellness (Vířivka)
  { src: '/img/photos/vyrivka/0Q9A0765-HDR.webp', alt: 'Vířivka - wellness zóna', category: 'wellness' },
  { src: '/img/photos/vyrivka/IMG_67.jpg', alt: 'Relaxace ve vířivce', category: 'wellness' },
  { src: '/img/photos/vyrivka/IMG_69.jpg', alt: 'Večerní wellness', category: 'wellness' },

  // Koupelny & WC
  { src: '/img/photos/koupelny-wc/IMG_31.jpg', alt: 'Moderní koupelna', category: 'koupelny' },
  { src: '/img/photos/koupelny-wc/IMG_46.jpg', alt: 'Koupelna se sprchou', category: 'koupelny' },
  { src: '/img/photos/koupelny-wc/IMG_51.jpg', alt: 'Detail koupelny', category: 'koupelny' },
  { src: '/img/photos/koupelny-wc/IMG_65.jpg', alt: 'Sprchový kout', category: 'koupelny' },

  // Terasa
  { src: '/img/photos/terasa/0Q9A0352-HDR.webp', alt: 'Terasa s výhledem', category: 'terasa' },
  { src: '/img/photos/terasa/IMG_10.jpg', alt: 'Posezení na terase', category: 'terasa' },

  // Chodby
  { src: '/img/photos/chodby/0Q9A0303-HDR.webp', alt: 'Chodba a schodiště', category: 'chodby' },

  // Šatna
  { src: '/img/photos/satna/0Q9A0813-HDR.webp', alt: 'Prostorná šatna', category: 'satna' },

  // Ostatní
  { src: '/img/photos/ostatni/IMG_30.jpg', alt: 'Detail interiéru', category: 'ostatni' },
  { src: '/img/photos/ostatni/IMG_36.jpg', alt: 'Dekorace', category: 'ostatni' },
  { src: '/img/photos/ostatni/IMG_37.jpg', alt: 'Atmosféra chaty', category: 'ostatni' },
  { src: '/img/photos/ostatni/IMG_56.jpg', alt: 'Pohled z okna', category: 'ostatni' },
  { src: '/img/photos/ostatni/IMG_72.jpg', alt: 'Zimní nálada', category: 'ostatni' },
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
        <div class="mb-12 flex flex-wrap justify-center gap-2">
          <button
            v-for="category in categories"
            :key="category.id"
            @click="activeCategory = category.id"
            :class="[
              'rounded-full px-4 py-2 text-xs font-medium transition-all',
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
          class="grid gap-4  sm:grid-cols-2 lg:grid-cols-3"
        >
          <div
            v-for="(photo, index) in filteredPhotos"
            :key="photo.src"
            @click="openLightbox(index)"
            class="group mt-16 relative aspect-[4/3] cursor-pointer overflow-hidden rounded-3xl bg-gray-100"
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