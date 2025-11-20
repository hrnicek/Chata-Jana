<template>
  <div class="min-h-screen w-full bg-neutral-50 text-gray-900 font-sans">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 gap-8 lg:grid-cols-12">
        
        <!-- SIDEBAR: Progress & Summary -->
        <aside class="lg:col-span-4 xl:col-span-3">
          <div class="sticky top-8 space-y-8">
            
            <!-- Progress Steps -->
            <nav aria-label="Průběh rezervace">
              <div class="mb-4 flex items-center gap-2 text-primary">
                <Calendar class="h-5 w-5" />
                <h2 class="text-lg font-medium">Vaše cesta</h2>
              </div>
              
              <!-- Mobile Progress Bar -->
              <div class="mb-6 block lg:hidden">
                <div class="h-2 w-full overflow-hidden rounded-full bg-gray-200">
                  <div class="h-full bg-primary transition-all duration-500" :style="{ width: progressPercent + '%' }"></div>
                </div>
                <div class="mt-2 flex justify-between text-xs text-gray-500">
                  <span>Start</span>
                  <span>Dokončení</span>
                </div>
              </div>

              <!-- Desktop Steps -->
              <ul class="space-y-1">
                <li v-for="item in stepItems" :key="item.id">
                  <button
                    @click="navigateTo(item.id)"
                    :disabled="!canNavigateTo(item.id)"
                    class="group flex w-full items-center gap-3 rounded-lg border border-transparent px-3 py-2.5 text-left transition-colors"
                    :class="[
                      step === item.id 
                        ? 'bg-white border-gray-200 shadow-sm' 
                        : canNavigateTo(item.id) 
                          ? 'hover:bg-gray-100' 
                          : 'opacity-50 cursor-not-allowed'
                    ]"
                  >
                    <div 
                      class="flex h-8 w-8 shrink-0 items-center justify-center rounded-md border transition-colors"
                      :class="[
                        step === item.id ? 'border-primary bg-primary/5 text-primary' :
                        step > item.id ? 'border-primary bg-primary/5 text-primary' :
                        'border-gray-200 bg-gray-50 text-gray-400'
                      ]"
                    >
                      <CheckCircle v-if="step > item.id" class="h-5 w-5" />
                      <component v-else :is="item.icon" class="h-4 w-4" />
                    </div>
                    <div>
                      <div class="text-sm font-medium" :class="step === item.id ? 'text-gray-900' : 'text-gray-600'">
                        {{ item.label }}
                      </div>
                      <div class="text-xs text-gray-500">{{ item.desc }}</div>
                    </div>
                  </button>
                </li>
              </ul>
            </nav>

            <!-- Live Summary (Desktop Sticky) -->
            <div class="hidden rounded-xl border border-gray-200 bg-white p-5 lg:block">
              <h3 class="mb-4 flex items-center gap-2 font-medium text-gray-900">
                <StickyNote class="h-4 w-4 text-gray-400" />
                Shrnutí rezervace
              </h3>
              
              <div class="space-y-4 text-sm">
                <!-- Dates -->
                <div class="flex justify-between border-b border-gray-100 pb-3">
                  <span class="text-gray-500">Termín</span>
                  <div class="text-right">
                    <div v-if="startDate && endDate" class="font-medium text-gray-900">
                      {{ formatDate(startDate) }} <br> {{ formatDate(endDate) }}
                    </div>
                    <span v-else class="text-gray-400 italic">Vyberte termín</span>
                  </div>
                </div>

                <!-- Nights -->
                <div class="flex justify-between border-b border-gray-100 pb-3">
                  <span class="text-gray-500">Délka pobytu</span>
                  <span class="font-medium text-gray-900">{{ selectedNights }} nocí</span>
                </div>

                <!-- Base Price -->
                <div class="flex justify-between py-1">
                  <span class="text-gray-500">Ubytování</span>
                  <span class="font-medium text-gray-900">{{ currency(selectedTotalPrice) }}</span>
                </div>

                <!-- Extras -->
                <div v-if="addonsTotalPrice > 0" class="flex justify-between py-1">
                  <span class="text-gray-500">Doplňkové služby</span>
                  <span class="font-medium text-gray-900">{{ currency(addonsTotalPrice) }}</span>
                </div>

                <!-- Total -->
                <div class="mt-4 border-t border-gray-200 pt-4">
                  <div class="flex items-end justify-between">
                    <span class="font-medium text-gray-900">Celkem</span>
                    <span class="text-xl font-semibold text-primary">{{ currency(grandTotalPrice) }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="lg:col-span-8 xl:col-span-9">
          <div class="min-h-[600px] rounded-xl border border-gray-200 bg-white p-4 sm:p-6 lg:p-8">
            
            <!-- Step 1: Calendar -->
            <div v-if="step === 1" class="space-y-6">
              <header class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                  <h1 class="text-2xl font-medium text-gray-900">Vyberte termín</h1>
                  <p class="text-gray-500">Klikněte na datum příjezdu a poté na datum odjezdu.</p>
                </div>
                <div class="flex items-center gap-2">
                  <button 
                    v-if="canGoPrev"
                    @click="prevMonth"
                    class="flex h-10 w-10 items-center justify-center rounded-lg border border-gray-200 text-gray-600 transition-colors hover:border-gray-300 hover:bg-gray-50"
                  >
                    <ChevronLeft class="h-5 w-5" />
                  </button>
                  <div class="min-w-[140px] text-center font-medium text-gray-900">
                    {{ monthLabel }} {{ year }}
                  </div>
                  <button 
                    @click="nextMonth"
                    class="flex h-10 w-10 items-center justify-center rounded-lg border border-gray-200 text-gray-600 transition-colors hover:border-gray-300 hover:bg-gray-50"
                  >
                    <ChevronRight class="h-5 w-5" />
                  </button>
                </div>
              </header>

              <!-- Calendar Grid -->
              <div class="relative">
                 <div v-if="loading" class="absolute inset-0 flex items-center justify-center bg-white/80 z-10">
                    <div class="flex items-center gap-2 text-primary">
                      <Loader2 class="h-6 w-6 animate-spin" />
                      <span class="font-medium">Načítám dostupnost...</span>
                    </div>
                 </div>

                 <div class="grid grid-cols-7 gap-2">
                    <!-- Weekdays -->
                    <div v-for="d in weekDays" :key="d" class="text-center font-medium text-gray-700">
                      {{ d }}
                    </div>
                    
                    <!-- Days -->
                    <div
                      v-for="cell in cells"
                      :key="cell.date"
                      @click="selectDate(cell)"
                      class="cursor-pointer rounded border p-2 transition-colors"
                      :class="[
                        cell.inCurrent ? '' : 'opacity-60',
                        !isAvailable(cell.date)
                          ? isBlackout(cell.date)
                            ? 'border-orange-400 bg-orange-50'
                            : 'border-red-400 bg-red-50'
                          : '',
                        !isAvailable(cell.date) ? 'pointer-events-none cursor-not-allowed' : '',
                        isInRange(cell.date) ? 'border-emerald-400 bg-emerald-50' : '',
                        isStart(cell.date) || isEnd(cell.date) ? 'ring-2 ring-emerald-500' : '',
                      ]"
                    >
                      <div class="flex justify-between items-center">
                        <span class="font-semibold">{{ cell.day }}</span>
                        
                        <!-- Season Badge -->
                        <span 
                          v-if="infoByDate(cell.date)?.season && !infoByDate(cell.date)?.season_is_default"
                          class="rounded px-1.5 py-0.5 text-[10px] font-medium"
                          :class="infoByDate(cell.date)?.season_is_default ? 'bg-gray-100 text-gray-700' : 'bg-amber-100 text-amber-700'"
                        >
                          {{ infoByDate(cell.date)?.season }}
                        </span>
                      </div>

                      <!-- Status/Price -->
                      <div class="mt-1 flex items-center gap-1 text-sm" :class="statusClass(cell.date)">
                         <CheckCircle v-if="infoByDate(cell.date)?.available" class="h-4 w-4" />
                         <Ban v-else-if="isBlackout(cell.date)" class="h-4 w-4" />
                         <XCircle v-else class="h-4 w-4" />
                         {{ statusText(cell.date) }}
                      </div>
                      
                      <div v-if="infoByDate(cell.date)?.price" class="mt-1 text-sm text-gray-800">
                        {{ currency(infoByDate(cell.date)?.price) }}
                      </div>
                    </div>
                 </div>
              </div>

              <!-- Step 1 Footer -->
              <div class="flex flex-col gap-4 border-t border-gray-100 pt-6 sm:flex-row sm:items-center sm:justify-between">
                 <div class="text-sm text-gray-600">
                    <span v-if="startDate && !endDate">Vyberte datum odjezdu</span>
                    <span v-else-if="!startDate">Začněte výběrem data příjezdu</span>
                    <span v-else class="text-primary font-medium">Termín vybrán</span>
                 </div>
                 
                 <div class="flex gap-3">
                    <button 
                      v-if="startDate"
                      @click="clearSelection"
                      class="rounded-lg border border-gray-200 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900"
                    >
                      Zrušit výběr
                    </button>
                    <button
                      @click="verifyAndProceed"
                      :disabled="!canProceed || verifying"
                      class="flex items-center gap-2 rounded-lg bg-primary px-6 py-2.5 text-sm font-medium text-white transition-colors hover:bg-primary/90 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                      <Loader2 v-if="verifying" class="h-4 w-4 animate-spin" />
                      <span>{{ verifying ? 'Ověřuji...' : 'Pokračovat' }}</span>
                      <ChevronRight v-if="!verifying" class="h-4 w-4" />
                    </button>
                 </div>
              </div>
            </div>

            <!-- Step 2: Personal Info -->
            <div v-if="step === 2" class="space-y-8">
              <header>
                <h1 class="text-2xl font-medium text-gray-900">Osobní údaje</h1>
                <p class="text-gray-500">Vyplňte kontaktní údaje pro potvrzení rezervace.</p>
              </header>

              <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <!-- First Name -->
                <div class="space-y-1.5">
                  <label class="text-sm font-medium text-gray-700">Jméno</label>
                  <input
                    v-model="customer.firstName"
                    type="text"
                    class="w-full rounded-lg border-2 border-gray-200 px-4 py-2.5 text-gray-900 placeholder-gray-400 transition-colors focus:border-primary focus:outline-none"
                    placeholder="Jan"
                  />
                </div>

                <!-- Last Name -->
                <div class="space-y-1.5">
                  <label class="text-sm font-medium text-gray-700">Příjmení</label>
                  <input
                    v-model="customer.lastName"
                    type="text"
                    class="w-full rounded-lg border-2 border-gray-200 px-4 py-2.5 text-gray-900 placeholder-gray-400 transition-colors focus:border-primary focus:outline-none"
                    placeholder="Novák"
                  />
                </div>

                <!-- Email -->
                <div class="space-y-1.5">
                  <label class="text-sm font-medium text-gray-700">E-mail</label>
                  <input
                    v-model="customer.email"
                    type="email"
                    class="w-full rounded-lg border-2 border-gray-200 px-4 py-2.5 text-gray-900 placeholder-gray-400 transition-colors focus:border-primary focus:outline-none"
                    placeholder="jan.novak@example.com"
                  />
                </div>

                <!-- Phone -->
                <div class="space-y-1.5">
                  <label class="text-sm font-medium text-gray-700">Telefon</label>
                  <input
                    v-model="customer.phone"
                    type="tel"
                    class="w-full rounded-lg border-2 border-gray-200 px-4 py-2.5 text-gray-900 placeholder-gray-400 transition-colors focus:border-primary focus:outline-none"
                    placeholder="+420 777 123 456"
                  />
                </div>

                <!-- Note -->
                <div class="md:col-span-2 space-y-1.5">
                  <label class="text-sm font-medium text-gray-700">Poznámka (nepovinné)</label>
                  <textarea
                    v-model="customer.note"
                    rows="4"
                    class="w-full rounded-lg border-2 border-gray-200 px-4 py-2.5 text-gray-900 placeholder-gray-400 transition-colors focus:border-primary focus:outline-none"
                    placeholder="Máte nějaké speciální přání?"
                  ></textarea>
                </div>
              </div>

              <div class="flex justify-between border-t border-gray-100 pt-6">
                <button 
                  @click="step = 1"
                  class="flex items-center gap-2 rounded-lg px-4 py-2.5 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900"
                >
                  <ChevronLeft class="h-4 w-4" />
                  Zpět
                </button>
                <button
                  @click="step = 3"
                  :disabled="!formReady"
                  class="flex items-center gap-2 rounded-lg bg-primary px-6 py-2.5 text-sm font-medium text-white transition-colors hover:bg-primary/90 disabled:opacity-50 disabled:cursor-not-allowed"
                >
                  Pokračovat
                  <ChevronRight class="h-4 w-4" />
                </button>
              </div>
            </div>

            <!-- Step 3: Extras -->
            <div v-if="step === 3" class="space-y-8">
              <header>
                <h1 class="text-2xl font-medium text-gray-900">Doplňkové služby</h1>
                <p class="text-gray-500">Vylepšete si svůj pobyt.</p>
              </header>

              <div v-if="extrasLoading" class="py-12 text-center text-gray-500">
                <Loader2 class="mx-auto h-8 w-8 animate-spin text-primary mb-2" />
                Načítám nabídku služeb...
              </div>
              
              <div v-else-if="extrasError" class="rounded-lg bg-red-50 p-4 text-red-700">
                {{ extrasError }}
              </div>

              <div v-else class="grid gap-4 sm:grid-cols-2">
                <div 
                  v-for="ex in validExtras" 
                  :key="ex.id"
                  class="group relative flex flex-col justify-between rounded-xl border-2 border-gray-100 p-5 transition-all hover:border-primary/50"
                  :class="{ 'border-primary bg-primary/5': (extraSelection[ex.id] || 0) > 0 }"
                >
                  <div>
                    <div class="flex items-start justify-between mb-2">
                      <h3 class="font-medium text-gray-900">{{ ex.name }}</h3>
                      <div class="text-sm font-semibold text-primary">
                        {{ currency(ex.price) }}
                        <span class="text-xs font-normal text-gray-500">
                          {{ ex.price_type === 'per_day' ? '/den' : '/pobyt' }}
                        </span>
                      </div>
                    </div>
                    <p class="text-sm text-gray-500 mb-4">{{ ex.description }}</p>
                  </div>

                  <div class="flex items-center justify-end gap-3">
                    <button 
                      @click="booking.setExtraQuantity(ex.id, Math.max(0, (extraSelection[ex.id] || 0) - 1))"
                      class="flex h-8 w-8 items-center justify-center rounded-full border border-gray-200 text-gray-500 hover:border-gray-300 hover:bg-gray-50"
                      :disabled="(extraSelection[ex.id] || 0) === 0"
                    >
                      -
                    </button>
                    <span class="w-8 text-center font-medium text-gray-900">{{ extraSelection[ex.id] || 0 }}</span>
                    <button 
                      @click="booking.setExtraQuantity(ex.id, Math.min(ex.max_quantity, (extraSelection[ex.id] || 0) + 1))"
                      class="flex h-8 w-8 items-center justify-center rounded-full border border-gray-200 text-gray-500 hover:border-gray-300 hover:bg-gray-50"
                      :disabled="(extraSelection[ex.id] || 0) >= ex.max_quantity"
                    >
                      +
                    </button>
                  </div>
                </div>
              </div>

              <div class="flex justify-between border-t border-gray-100 pt-6">
                <button 
                  @click="step = 2"
                  class="flex items-center gap-2 rounded-lg px-4 py-2.5 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900"
                >
                  <ChevronLeft class="h-4 w-4" />
                  Zpět
                </button>
                <button
                  @click="checkExtrasAvailability"
                  :disabled="!canSubmit"
                  class="flex items-center gap-2 rounded-lg bg-primary px-6 py-2.5 text-sm font-medium text-white transition-colors hover:bg-primary/90 disabled:opacity-50 disabled:cursor-not-allowed"
                >
                  Pokračovat
                  <ChevronRight class="h-4 w-4" />
                </button>
              </div>
            </div>

            <!-- Step 4: Review -->
            <div v-if="step === 4" class="space-y-8">
              <header>
                <h1 class="text-2xl font-medium text-gray-900">Kontrola rezervace</h1>
                <p class="text-gray-500">Prosím zkontrolujte všechny údaje před odesláním.</p>
              </header>

              <div class="space-y-6">
                <!-- Date & Price Summary Block -->
                <div class="rounded-xl border border-gray-200 bg-gray-50/50 p-6">
                  <h3 class="mb-4 font-medium text-gray-900">Termín a cena</h3>
                  <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                    <div>
                      <dt class="text-xs text-gray-500 uppercase tracking-wide">Příjezd</dt>
                      <dd class="mt-1 font-medium text-gray-900">{{ formatDate(startDate) }}</dd>
                    </div>
                    <div>
                      <dt class="text-xs text-gray-500 uppercase tracking-wide">Odjezd</dt>
                      <dd class="mt-1 font-medium text-gray-900">{{ formatDate(endDate) }}</dd>
                    </div>
                    <div>
                      <dt class="text-xs text-gray-500 uppercase tracking-wide">Délka pobytu</dt>
                      <dd class="mt-1 text-gray-900">{{ selectedNights }} nocí</dd>
                    </div>
                    <div>
                      <dt class="text-xs text-gray-500 uppercase tracking-wide">Celková cena</dt>
                      <dd class="mt-1 text-xl font-semibold text-primary">{{ currency(grandTotalPrice) }}</dd>
                    </div>
                  </dl>
                </div>

                <!-- Personal Info Block -->
                <div class="rounded-xl border border-gray-200 p-6">
                  <div class="flex items-center justify-between mb-4">
                    <h3 class="font-medium text-gray-900">Kontaktní údaje</h3>
                    <button @click="step = 2" class="text-sm text-primary hover:underline">Upravit</button>
                  </div>
                  <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                    <div>
                      <dt class="text-xs text-gray-500 uppercase tracking-wide">Jméno</dt>
                      <dd class="mt-1 text-gray-900">{{ customer.firstName }} {{ customer.lastName }}</dd>
                    </div>
                    <div>
                      <dt class="text-xs text-gray-500 uppercase tracking-wide">Email</dt>
                      <dd class="mt-1 text-gray-900">{{ customer.email }}</dd>
                    </div>
                    <div>
                      <dt class="text-xs text-gray-500 uppercase tracking-wide">Telefon</dt>
                      <dd class="mt-1 text-gray-900">{{ customer.phone }}</dd>
                    </div>
                  </dl>
                  <div v-if="customer.note" class="mt-4 border-t border-gray-100 pt-4">
                    <dt class="text-xs text-gray-500 uppercase tracking-wide">Poznámka</dt>
                    <dd class="mt-1 text-gray-700 italic">"{{ customer.note }}"</dd>
                  </div>
                </div>

                <!-- Extras Block -->
                <div v-if="selectedExtras.length > 0" class="rounded-xl border border-gray-200 p-6">
                  <div class="flex items-center justify-between mb-4">
                    <h3 class="font-medium text-gray-900">Vybrané služby</h3>
                    <button @click="step = 3" class="text-sm text-primary hover:underline">Upravit</button>
                  </div>
                  <ul class="space-y-3">
                    <li v-for="ex in selectedExtras" :key="ex.id" class="flex justify-between text-sm">
                      <span class="text-gray-700">
                        {{ ex.name }} <span class="text-gray-400">× {{ extraSelection[ex.id] }}</span>
                      </span>
                      <span class="font-medium text-gray-900">
                        {{ currency(ex.price_type === "per_day" ? extraSelection[ex.id] * selectedNights * ex.price : extraSelection[ex.id] * ex.price) }}
                      </span>
                    </li>
                  </ul>
                </div>
              </div>

              <div v-if="submitError" class="rounded-lg bg-red-50 p-4 text-sm text-red-700">
                {{ submitError }}
              </div>

              <div class="flex justify-between border-t border-gray-100 pt-6">
                <button 
                  @click="step = 3"
                  class="flex items-center gap-2 rounded-lg px-4 py-2.5 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900"
                >
                  <ChevronLeft class="h-4 w-4" />
                  Zpět
                </button>
                <button
                  @click="submit"
                  :disabled="!canSubmit || submitting"
                  class="flex items-center gap-2 rounded-lg bg-gray-900 px-8 py-3 text-sm font-medium text-white shadow-lg transition-all hover:bg-black hover:shadow-xl disabled:opacity-50 disabled:shadow-none"
                >
                  <Loader2 v-if="submitting" class="h-4 w-4 animate-spin" />
                  <span v-else>Odeslat závaznou rezervaci</span>
                  <Send v-if="!submitting" class="h-4 w-4" />
                </button>
              </div>
            </div>

            <!-- Step 5: Success -->
            <div v-if="step === 5" class="flex min-h-[400px] flex-col items-center justify-center text-center">
              <div class="mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-emerald-50 text-emerald-600">
                <CheckCircle class="h-10 w-10" />
              </div>
              <h1 class="mb-2 text-3xl font-medium text-gray-900">Rezervace odeslána</h1>
              <p class="mb-8 max-w-md text-gray-500">
                Děkujeme za vaši rezervaci. Na email <strong>{{ customer.email }}</strong> jsme vám poslali potvrzení a další instrukce.
              </p>
              
              <div class="flex gap-4">
                <button 
                  @click="step = 1"
                  class="rounded-lg border border-gray-200 px-6 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900"
                >
                  Nová rezervace
                </button>
                <a 
                  href="/"
                  class="rounded-lg bg-primary px-6 py-2.5 text-sm font-medium text-white hover:bg-primary/90"
                >
                  Zpět na úvod
                </a>
              </div>
            </div>

          </div>
        </main>

      </div>
    </div>
  </div>
</template>

<script setup>
import axios from "axios";
import { ref, computed, onMounted } from "vue";
import { toast } from "vue-sonner";
import { useBookingStore } from "../../stores/booking";
import {
  ChevronLeft,
  ChevronRight,
  CheckCircle,
  Ban,
  XCircle,
  Calendar,
  Moon,
  Home,
  BarChart3,
  CreditCard,
  User,
  Mail,
  Phone,
  StickyNote,
  Send,
  PawPrint,
  Loader2,
} from "lucide-vue-next";

const now = new Date();
const month = ref(now.getMonth() + 1);
const year = ref(now.getFullYear());
const todayMonth = now.getMonth() + 1;
const todayYear = now.getFullYear();
const daysData = ref([]);
const loading = ref(false);
const error = ref("");
const startDate = computed({
  get: () => booking.startDate,
  set: (val) => booking.setStartDate(val),
});
const endDate = computed({
  get: () => booking.endDate,
  set: (val) => booking.setEndDate(val),
});
const step = ref(1);
const booking = useBookingStore();
const customer = computed({
  get: () => booking.customer,
  set: (val) => booking.updateCustomer(val),
});
const extras = computed(() => booking.extras);
const extraSelection = computed(() => booking.extraSelection);
const validExtras = computed(() =>
  (extras.value || []).filter((ex) => ex && typeof ex === "object" && "id" in ex)
);
const selectedExtras = computed(() =>
  validExtras.value.filter((ex) => Number(extraSelection.value[ex.id] || 0) > 0)
);
const submitted = ref(false);
const submitting = ref(false);
const submitError = ref("");
const verifying = ref(false);
const verifyError = ref("");
const extrasLoading = ref(false);
const extrasError = ref("");

const monthLabel = computed(() =>
  new Date(year.value, month.value - 1, 1).toLocaleString("cs-CZ", { month: "long" })
);
const weekDays = ["Po", "Út", "St", "Čt", "Pá", "So", "Ne"];

const stepItems = [
  { id: 1, label: "Krok 1", desc: "Termín pobytu", icon: Calendar },
  { id: 2, label: "Krok 2", desc: "Vaše údaje", icon: User },
  { id: 3, label: "Krok 3", desc: "Doplňkové služby", icon: PawPrint },
  { id: 4, label: "Krok 4", desc: "Kontrola", icon: CreditCard },
  { id: 5, label: "Krok 5", desc: "Potvrzení", icon: CheckCircle },
];

const progressPercent = computed(() => Math.round((Math.min(step.value, 5) / 5) * 100));

function canNavigateTo(id) {
  return id <= step.value;
}

function navigateTo(id) {
  if (canNavigateTo(id)) {
    step.value = id;
  }
}

const daysInMonth = computed(() => new Date(year.value, month.value, 0).getDate());
const firstDayIndex = computed(() => {
  const idx = new Date(year.value, month.value - 1, 1).getDay();
  return idx === 0 ? 6 : idx - 1;
});
const prevYear = computed(() => (month.value === 1 ? year.value - 1 : year.value));
const prevMonthNum = computed(() => (month.value === 1 ? 12 : month.value - 1));
const prevMonthDaysCount = computed(() =>
  new Date(prevYear.value, prevMonthNum.value, 0).getDate()
);

function pad(n) {
  return String(n).padStart(2, "0");
}

function dayKey(d) {
  return `${year.value}-${String(month.value).padStart(2, "0")}-${String(d).padStart(2, "0")}`;
}

function dayInfo(d) {
  const k = dayKey(d);
  return daysData.value.find((x) => x.date === k);
}

function infoByDate(date) {
  return daysData.value.find((x) => x.date === date);
}

function currency(n) {
  return new Intl.NumberFormat("cs-CZ", {
    style: "currency",
    currency: "CZK",
    maximumFractionDigits: 0,
  }).format(Number(n));
}

function formatDate(iso) {
  if (!iso) return "";
  const d = parseISO(iso);
  return `${d.getDate()}. ${d.getMonth() + 1}. ${d.getFullYear()}`;
}

async function fetchCalendar() {
  loading.value = true;
  error.value = "";
  try {
    const [curr, prev] = await Promise.all([
      axios.get("/api/bookings/calendar", { params: { month: month.value, year: year.value } }),
      axios.get("/api/bookings/calendar", {
        params: { month: prevMonthNum.value, year: prevYear.value },
      }),
    ]);
    daysData.value = [...prev.data.days, ...curr.data.days];
  } catch (e) {
    error.value = "Kalendář se nepodařilo načíst. Obnovte stránku nebo zkuste později.";
  } finally {
    loading.value = false;
  }
}

function nextMonth() {
  if (month.value === 12) {
    month.value = 1;
    year.value += 1;
  } else {
    month.value += 1;
  }
  fetchCalendar();
}

function prevMonth() {
  if (month.value === 1) {
    month.value = 12;
    year.value -= 1;
  } else {
    month.value -= 1;
  }
  fetchCalendar();
}

onMounted(fetchCalendar);

const cells = computed(() => {
  const off = firstDayIndex.value;
  const prevStart = prevMonthDaysCount.value - off + 1;
  const prevCells = Array.from({ length: off }, (_, i) => {
    const day = prevStart + i;
    const date = `${prevYear.value}-${pad(prevMonthNum.value)}-${pad(day)}`;
    return { date, day, inCurrent: false };
  });
  const currCells = Array.from({ length: daysInMonth.value }, (_, i) => {
    const day = i + 1;
    const date = `${year.value}-${pad(month.value)}-${pad(day)}`;
    return { date, day, inCurrent: true };
  });
  return [...prevCells, ...currCells];
});

const canGoPrev = computed(() => {
  const targetY = prevYear.value;
  const targetM = prevMonthNum.value;
  return targetY > todayYear || (targetY === todayYear && targetM >= todayMonth);
});

function parseISO(s) {
  const [Y, M, D] = s.split("-").map(Number);
  return new Date(Y, M - 1, D);
}

const rangeStart = computed(() => (startDate.value ? parseISO(startDate.value) : null));
const rangeEnd = computed(() => (endDate.value ? parseISO(endDate.value) : null));

function isSameDate(a, b) {
  if (!a || !b) return false;
  return (
    a.getFullYear() === b.getFullYear() &&
    a.getMonth() === b.getMonth() &&
    a.getDate() === b.getDate()
  );
}

function isInRange(dateStr) {
  if (!rangeStart.value) return false;
  const d = parseISO(dateStr);
  if (rangeStart.value && !rangeEnd.value) {
    return isSameDate(d, rangeStart.value);
  }
  if (rangeStart.value && rangeEnd.value) {
    const a = rangeStart.value <= rangeEnd.value ? rangeStart.value : rangeEnd.value;
    const b = rangeStart.value <= rangeEnd.value ? rangeEnd.value : rangeStart.value;
    return d >= a && d <= b;
  }
  return false;
}

function isStart(dateStr) {
  return !!(rangeStart.value && isSameDate(parseISO(dateStr), rangeStart.value));
}

function isEnd(dateStr) {
  return !!(rangeEnd.value && isSameDate(parseISO(dateStr), rangeEnd.value));
}

function isAvailable(dateStr) {
  const info = infoByDate(dateStr);
  if (!info) return true;
  return !!info.available;
}

function isBlackout(dateStr) {
  const info = infoByDate(dateStr);
  if (!info) return false;
  return !!info.blackout;
}

function statusText(dateStr) {
  const info = infoByDate(dateStr);
  if (!info) return "";
  if (info.available) return "Volné";
  if (info.blackout) return "Nedostupné";
  return "Obsazené";
}

function statusClass(dateStr) {
  const info = infoByDate(dateStr);
  if (!info) return "";
  if (info.available) return "text-green-700";
  if (info.blackout) return "text-orange-700";
  return "text-red-700";
}

function selectDate(cell) {
  if (!isAvailable(cell.date)) return;
  const date = cell.date;
  if (!startDate.value || (startDate.value && endDate.value)) {
    startDate.value = date;
    endDate.value = null;
    return;
  }
  if (!endDate.value) {
    const a = parseISO(startDate.value);
    const b = parseISO(date);
    if (b < a) {
      endDate.value = startDate.value;
      startDate.value = date;
    } else {
      endDate.value = date;
    }
  }
}

function clearSelection() {
  booking.resetDates();
}

const selectedNights = computed(() => {
  return rangeDates.value.length;
});

function addDays(date, days) {
  const d = new Date(date);
  d.setDate(d.getDate() + days);
  return d;
}

function toISO(d) {
  return `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(d.getDate())}`;
}

const rangeDates = computed(() => {
  if (!(rangeStart.value && rangeEnd.value)) return [];
  const a = rangeStart.value <= rangeEnd.value ? rangeStart.value : rangeEnd.value;
  const b = rangeStart.value <= rangeEnd.value ? rangeEnd.value : rangeStart.value;
  const out = [];
  let cur = new Date(a);
  while (cur <= b) {
    out.push(toISO(cur));
    cur = addDays(cur, 1);
  }
  return out;
});

const monthsForRange = computed(() => {
  const m = new Map();
  for (const iso of rangeDates.value) {
    const d = parseISO(iso);
    const key = `${d.getFullYear()}-${d.getMonth() + 1}`;
    if (!m.has(key)) m.set(key, { month: d.getMonth() + 1, year: d.getFullYear() });
  }
  return Array.from(m.values());
});

const selectedTotalPrice = computed(() => {
  if (rangeDates.value.length === 0) return 0;
  return rangeDates.value.reduce((sum, iso) => {
    const info = infoByDate(iso);
    const price = info?.price ? Number(info.price) : 0;
    return sum + price;
  }, 0);
});

const rangeHasUnavailable = computed(() => {
  if (rangeDates.value.length === 0) return false;
  return rangeDates.value.some((iso) => {
    const info = infoByDate(iso);
    return info && info.available === false;
  });
});

const canProceed = computed(() => {
  return !!(startDate.value && endDate.value) && !rangeHasUnavailable.value;
});

const formReady = computed(() => {
  return canProceed.value && booking.isFormFilled;
});

const addonsTotalPrice = computed(() => {
  if (selectedNights.value <= 0 || selectedExtras.value.length === 0) return 0;
  return selectedExtras.value.reduce((sum, ex) => {
    const qty = Number(extraSelection.value[ex.id] || 0);
    const unit = Number(ex.price || 0);
    const line = ex.price_type === "per_day" ? qty * selectedNights.value * unit : qty * unit;
    return sum + line;
  }, 0);
});

const grandTotalPrice = computed(() => selectedTotalPrice.value + addonsTotalPrice.value);

const canSubmit = computed(() => formReady.value);

async function submit() {
  if (!canSubmit.value || submitting.value) return;
  submitting.value = true;
  submitError.value = "";
  try {
    const payload = {
      start_date: startDate.value,
      end_date: endDate.value,
      customer: {
        first_name: customer.value.firstName,
        last_name: customer.value.lastName,
        email: customer.value.email,
        phone: customer.value.phone,
        note: customer.value.note || "",
      },
      addons: selectedExtras.value.map((ex) => ({
        extra_id: ex.id,
        quantity: Number(extraSelection.value[ex.id] || 0),
      })),
      accommodation_total: selectedTotalPrice.value,
      addons_total: addonsTotalPrice.value,
      grand_total: grandTotalPrice.value,
    };
    await axios.post("/api/bookings", payload);
    submitted.value = true;
    step.value = 5;
  } catch (e) {
    submitError.value = "Rezervaci se nepodařilo odeslat. Zkuste to prosím znovu.";
  } finally {
    submitting.value = false;
  }
}

async function verifyAndProceed() {
  if (!canProceed.value) return;
  verifying.value = true;
  verifyError.value = "";
  try {
    const res = await axios.post("/api/bookings/verify", {
      start_date: startDate.value,
      end_date: endDate.value,
    });
    if (!res.data.available) {
      toast.error("Vybraný termín je mezitím obsazen. Vyberte prosím jiné datum.");
      return;
    }
    const requests = monthsForRange.value.map(({ month, year }) =>
      axios.get("/api/bookings/calendar", { params: { month, year } })
    );
    const responses = await Promise.all(requests);
    const freshDays = responses.flatMap((r) => r.data.days);
    const merged = new Map(daysData.value.map((d) => [d.date, d]));
    freshDays.forEach((d) => merged.set(d.date, d));
    daysData.value = Array.from(merged.values());
    step.value = 2;
  } catch (e) {
    toast.error("Ověření dostupnosti se nezdařilo. Zkuste to prosím znovu.");
  } finally {
    verifying.value = false;
  }
}

async function loadExtras() {
  extrasLoading.value = true;
  extrasError.value = "";
  try {
    const res = await axios.get("/api/extras");
    booking.setExtras(res.data.extras || []);
  } catch (e) {
    extrasError.value = "Příplatkové služby se nepodařilo načíst.";
  } finally {
    extrasLoading.value = false;
  }
}

async function checkExtrasAvailability() {
  try {
    const selections = selectedExtras.value.map((ex) => ({
      extra_id: ex.id,
      quantity: Number(extraSelection.value[ex.id] || 0),
    }));
    if (selections.length === 0) {
      step.value = 4;
      return;
    }
    const res = await axios.post("/api/extras/availability", {
      start_date: startDate.value,
      end_date: endDate.value,
      selections,
    });
    if (!res.data.available) {
      toast.error("Některé služby nejsou v požadovaném množství dostupné.");
      return;
    }
    step.value = 4;
  } catch (e) {
    toast.error("Ověření dostupnosti služeb se nezdařilo.");
  }
}

onMounted(() => {
  loadExtras();
});
</script>
