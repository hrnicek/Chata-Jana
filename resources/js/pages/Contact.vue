<script setup>
import WebLayout from "../layouts/WebLayout.vue";
import PageHeader from "../components/PageHeader.vue";
import { Mail, Phone, MapPin, MessageCircle, Send, Clock, Calendar } from "lucide-vue-next";
import { useForm, usePage } from "@inertiajs/vue3";
import { ref } from "vue";
import { toast } from "vue-sonner";

const form = useForm({
  name: "",
  email: "",
  phone: "",
  message: "",
});

const page = usePage();
const formSubmitted = ref(false);

const submit = () => {
  form.post(route("contact.store"), {
    preserveScroll: true,
    onSuccess: () => {
      formSubmitted.value = true;
      const flashMessage = page.props.flash?.success;
      if (flashMessage) {
        toast.success(flashMessage);
      }
    },
  });
};
</script>

<template>
  <WebLayout>
    <PageHeader 
      badge="Kontakt"
      title="Pojďme si popovídat"
      subtitle="Máte dotaz ohledně rezervace nebo chcete vědět víc? Rádi vám pomůžeme!"
      image="/img/hero.webp"
    />

    <!-- Contact Methods -->
    <section class="bg-white py-24">
      <div class="container mx-auto px-6">
        <div class="mb-16 text-center">
          <h2 class="text-3xl font-bold text-primary md:text-4xl">Jak nás můžete kontaktovat</h2>
          <p class="mt-4 text-lg text-gray-600">Vyberte si způsob, který vám vyhovuje nejvíce</p>
        </div>

        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
          <!-- Email -->
          <a 
            href="mailto:info@chata-jana.cz"
            class="group rounded-3xl border-2 border-gray-200 bg-white p-8 transition-all hover:border-gold hover:shadow-xl"
          >
            <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-honey text-primary transition-colors group-hover:bg-gold group-hover:text-white">
              <Mail class="h-8 w-8" />
            </div>
            <h3 class="mb-2 text-xl font-bold text-gray-900">E-mail</h3>
            <p class="mb-4 text-sm text-gray-600">Napište nám kdykoliv</p>
            <div class="text-primary font-medium group-hover:text-gold">info@chata-jana.cz</div>
          </a>

          <!-- Phone -->
          <a 
            href="tel:+420731492286"
            class="group rounded-3xl border-2 border-gray-200 bg-white p-8 transition-all hover:border-gold hover:shadow-xl"
          >
            <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-honey text-primary transition-colors group-hover:bg-gold group-hover:text-white">
              <Phone class="h-8 w-8" />
            </div>
            <h3 class="mb-2 text-xl font-bold text-gray-900">Telefon</h3>
            <p class="mb-4 text-sm text-gray-600">Volejte Po-Ne 8-20h</p>
            <div class="text-primary font-medium group-hover:text-gold">+420 731 492 286</div>
          </a>

          <!-- WhatsApp/SMS -->
          <a 
            href="https://wa.me/420731492286"
            target="_blank"
            class="group rounded-3xl border-2 border-gray-200 bg-white p-8 transition-all hover:border-gold hover:shadow-xl"
          >
            <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-honey text-primary transition-colors group-hover:bg-gold group-hover:text-white">
              <MessageCircle class="h-8 w-8" />
            </div>
            <h3 class="mb-2 text-xl font-bold text-gray-900">WhatsApp</h3>
            <p class="mb-4 text-sm text-gray-600">Rychlá odpověď</p>
            <div class="text-primary font-medium group-hover:text-gold">Napsat zprávu</div>
          </a>
        </div>
      </div>
    </section>

    <!-- Contact Form & Info -->
    <section class="bg-honey py-24">
      <div class="container mx-auto px-6">
        <div class="grid gap-12 lg:grid-cols-2">
          <!-- Contact Form -->
          <div class="rounded-[3rem] bg-white p-10">
            <!-- Success Message -->
            <div v-if="formSubmitted" class="text-center py-12">
              <div class="mb-6 flex justify-center">
                <div class="flex h-20 w-20 items-center justify-center rounded-full bg-green-100">
                  <svg class="h-10 w-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                </div>
              </div>
              <h3 class="text-2xl font-bold text-gray-900 mb-3">Zpráva byla odeslána!</h3>
              <p class="text-gray-600 mb-6">Děkujeme za váš zájem. Vaši zprávu jsme obdrželi a brzy se vám ozveme.</p>
              <button 
                @click="formSubmitted = false; form.reset()"
                class="inline-flex items-center gap-2 rounded-xl bg-primary px-6 py-3 font-medium text-white transition-all hover:bg-primary/90"
              >
                Odeslat další zprávu
              </button>
            </div>

            <!-- Contact Form -->
            <div v-else>
              <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Napište nám</h2>
                <p class="text-gray-600">Vyplňte formulář a my se vám ozveme do 24 hodin</p>
              </div>

              <form @submit.prevent="submit" class="space-y-6">
                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-900" for="name">Jméno a příjmení</label>
                  <input 
                    id="name"
                    v-model="form.name"
                    type="text" 
                    class="w-full rounded-xl border-2 border-gray-200 px-4 py-3 transition-colors focus:border-primary focus:outline-none"
                    :class="{ 'border-red-500': form.errors.name }"
                    placeholder="Jan Novák"
                  />
                  <p v-if="form.errors.name" class="mt-1 text-sm text-red-500">{{ form.errors.name }}</p>
                </div>

                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-900" for="email">E-mail</label>
                  <input 
                    id="email"
                    v-model="form.email"
                    type="email" 
                    class="w-full rounded-xl border-2 border-gray-200 px-4 py-3 transition-colors focus:border-primary focus:outline-none"
                    :class="{ 'border-red-500': form.errors.email }"
                    placeholder="jan@example.com"
                  />
                  <p v-if="form.errors.email" class="mt-1 text-sm text-red-500">{{ form.errors.email }}</p>
                </div>

                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-900" for="phone">Telefon</label>
                  <input 
                    id="phone"
                    v-model="form.phone"
                    type="tel" 
                    class="w-full rounded-xl border-2 border-gray-200 px-4 py-3 transition-colors focus:border-primary focus:outline-none"
                    :class="{ 'border-red-500': form.errors.phone }"
                    placeholder="+420 123 456 789"
                  />
                  <p v-if="form.errors.phone" class="mt-1 text-sm text-red-500">{{ form.errors.phone }}</p>
                </div>

                <div>
                  <label class="mb-2 block text-sm font-medium text-gray-900" for="message">Zpráva</label>
                  <textarea 
                    id="message"
                    v-model="form.message"
                    rows="5"
                    class="w-full rounded-xl border-2 border-gray-200 px-4 py-3 transition-colors focus:border-primary focus:outline-none resize-none"
                    :class="{ 'border-red-500': form.errors.message }"
                    placeholder="Napište nám vaši zprávu..."
                  ></textarea>
                  <p v-if="form.errors.message" class="mt-1 text-sm text-red-500">{{ form.errors.message }}</p>
                </div>

                <button 
                  type="submit"
                  :disabled="form.processing"
                  class="flex w-full items-center justify-center gap-2 rounded-xl bg-primary px-6 py-4 font-bold text-white transition-all hover:bg-primary/90 hover:shadow-lg disabled:opacity-75 disabled:cursor-not-allowed"
                >
                  <Send v-if="!form.processing" class="h-5 w-5" />
                  <div v-else class="h-5 w-5 animate-spin rounded-full border-2 border-white border-t-transparent"></div>
                  <span>{{ form.processing ? 'Odesílání...' : 'Odeslat zprávu' }}</span>
                </button>
              </form>
            </div>
          </div>

          <!-- Contact Info & Map -->
          <div class="space-y-8">
            <!-- Info Cards -->
            <div class="rounded-[3rem] bg-white p-10">
              <h3 class="mb-6 text-2xl font-bold text-gray-900">Kontaktní údaje</h3>
              
              <div class="space-y-6">
                <!-- Address -->
                <div class="flex items-start gap-4">
                  <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-xl bg-honey text-primary">
                    <MapPin class="h-6 w-6" />
                  </div>
                  <div>
                    <div class="font-bold text-gray-900">Adresa</div>
                    <div class="text-gray-600">Ostružná 165</div>
                    <div class="text-gray-600">788 25, Jeseníky</div>
                  </div>
                </div>

                <!-- Email -->
                <div class="flex items-start gap-4">
                  <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-xl bg-honey text-primary">
                    <Mail class="h-6 w-6" />
                  </div>
                  <div>
                    <div class="font-bold text-gray-900">E-mail</div>
                    <a href="mailto:info@chata-jana.cz" class="text-primary hover:text-gold transition-colors">
                      info@chata-jana.cz
                    </a>
                  </div>
                </div>

                <!-- Phone -->
                <div class="flex items-start gap-4">
                  <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-xl bg-honey text-primary">
                    <Phone class="h-6 w-6" />
                  </div>
                  <div>
                    <div class="font-bold text-gray-900">Telefon</div>
                    <a href="tel:+420731492286" class="text-primary hover:text-gold transition-colors">
                      +420 731 492 286
                    </a>
                  </div>
                </div>

                <!-- Hours -->
                <div class="flex items-start gap-4">
                  <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-xl bg-honey text-primary">
                    <Clock class="h-6 w-6" />
                  </div>
                  <div>
                    <div class="font-bold text-gray-900">Dostupnost</div>
                    <div class="text-gray-600">Po-Pá: 9:00 - 18:00</div>
                    <div class="text-gray-600">So-Ne: 10:00 - 16:00</div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Map -->
            <div class="overflow-hidden rounded-[3rem] bg-gray-200">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2589.963722876844!2d17.0688!3d50.1833!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNTDCsDExJzAwLjAiTiAxN8KwMDQnMDcuNyJF!5e0!3m2!1scs!2scz!4v1620000000000!5m2!1scs!2scz"
                width="100%"
                height="400"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                class="w-full"
              ></iframe>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Quick Info Banner -->
    <section class="bg-primary py-16">
      <div class="container mx-auto px-6">
        <div class="flex flex-col items-center gap-8 text-center lg:flex-row lg:justify-between lg:text-left">
          <div>
            <h3 class="text-2xl font-bold text-white mb-2">Potřebujete rezervovat termín?</h3>
            <p class="text-white/80">Podívejte se na dostupnost a zarezervujte si pobyt online</p>
          </div>
          <a
            href="#"
            class="inline-flex items-center gap-2 rounded-xl bg-gold px-8 py-4 font-bold text-white transition-all hover:bg-gold/90 hover:shadow-lg"
          >
            <Calendar class="h-5 w-5" />
            <span>Zobrazit kalendář</span>
          </a>
        </div>
      </div>
    </section>
  </WebLayout>
</template>
