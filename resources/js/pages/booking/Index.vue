<template>
  <div class="h-screen w-full">
    <div class="grid h-full grid-cols-1 rounded-4xl md:grid-cols-12">
      <aside class="h-full overflow-auto border-r bg-neutral-50 md:sticky md:top-0 md:col-span-3">
        <div class="p-4">
          <div class="mb-3 flex items-center gap-2">
            <Calendar class="text-primary h-5 w-5" />
            <div class="font-semibold">Průběh rezervace</div>
          </div>
          <div class="mb-4 h-2 rounded-full bg-gray-200">
            <div
              class="bg-primary h-2 rounded-full"
              :style="{ width: progressPercent + '%' }"
            ></div>
          </div>
          <nav aria-label="Průběh" class="space-y-2">
            <button
              v-for="item in stepItems"
              :key="item.id"
              class="flex w-full items-start gap-3 rounded-2xl p-3 transition-colors"
              :class="[
                canNavigateTo(item.id)
                  ? 'hover:bg-honey focus:bg-honey'
                  : 'cursor-not-allowed opacity-60',
                step === item.id ? 'border bg-white shadow-sm' : 'border',
              ]"
              :aria-current="step === item.id ? 'step' : undefined"
              :disabled="!canNavigateTo(item.id)"
              @click="navigateTo(item.id)"
            >
              <div class="mt-0.5">
                <CheckCircle v-if="step > item.id" class="h-4 w-4 text-emerald-600" />
                <component v-else :is="item.icon" class="h-4 w-4 text-gray-900" />
              </div>
              <div class="text-left">
                <div
                  :class="
                    step === item.id
                      ? 'font-medium text-gray-900'
                      : step > item.id
                        ? 'text-gray-700'
                        : 'text-gray-500'
                  "
                >
                  {{ item.label }}
                </div>
                <div class="text-xs text-gray-700">{{ item.desc }}</div>
                <div
                  :class="
                    step > item.id
                      ? 'text-xs text-emerald-600'
                      : step === item.id
                        ? 'text-xs text-amber-600'
                        : 'text-xs text-gray-500'
                  "
                >
                  {{ step > item.id ? "Dokončeno" : step === item.id ? "Probíhá" : "Čeká" }}
                </div>
              </div>
            </button>
          </nav>
        </div>
      </aside>
      <section class="h-full bg-white md:col-span-9">
        <div v-if="step === 1" class="flex h-full flex-col">
          <div class="flex shrink-0 items-center justify-between border-b bg-white px-4 py-3">
            <div class="flex items-center gap-2 text-2xl font-semibold">
              {{ monthLabel }} {{ year }}
            </div>
            <div class="flex items-center gap-2">
              <button
                v-if="canGoPrev"
                class="flex items-center gap-1 rounded bg-gray-200 px-3 py-2 hover:bg-gray-300"
                @click="prevMonth"
              >
                <ChevronLeft class="h-4 w-4" />
                Předchozí měsíc
              </button>
              <button
                class="flex items-center gap-1 rounded bg-gray-200 px-3 py-2 hover:bg-gray-300"
                @click="nextMonth"
              >
                Další měsíc
                <ChevronRight class="h-4 w-4" />
              </button>
            </div>
          </div>

          <div class="flex-1 overflow-auto bg-white px-4 py-3">
            <div v-if="error" class="mb-4 text-red-600">{{ error }}</div>
            <div v-if="loading" class="mb-4 text-gray-600">Načítáme kalendář…</div>

            <div v-if="step === 1" class="mb-3 text-sm text-gray-700">
              Vyberte začátek a konec pobytu kliknutím v kalendáři. Dostupné dny jsou označeny
              „Volné“.
            </div>
            <div v-if="step === 1" class="mb-4 space-y-1 text-xs text-gray-600">
              <div>Nejprve klikněte na den začátku, poté na den konce.</div>
              <div>Po výběru uvidíte počet nocí a celkovou cenu dole.</div>
              <div>Dny „Nedostupné“ nebo „Obsazené“ není možné zvolit.</div>
            </div>
            <div
              v-if="step === 1 && verifying"
              role="status"
              aria-live="polite"
              class="bg-honey text-primary mb-4 flex items-center gap-2 rounded-2xl border px-3 py-2"
            >
              <Loader2 class="h-4 w-4 animate-spin" />
              <div class="text-sm">Ověřujeme dostupnost…</div>
            </div>
            <div
              v-if="step === 1 && rangeHasUnavailable"
              role="alert"
              aria-live="polite"
              class="mb-4 flex items-start gap-2 rounded-2xl border border-red-200 bg-red-50 px-3 py-2 text-red-800"
            >
              <XCircle class="h-4 w-4 shrink-0" />
              <div class="text-sm">
                Ve zvoleném období jsou některé dny obsazené. Zvolte prosím jiné datum.
              </div>
            </div>
            <div v-if="step === 1" class="grid grid-cols-7 gap-2">
              <div v-for="d in weekDays" :key="d" class="text-center font-medium text-gray-700">
                {{ d }}
              </div>
              <div
                v-for="cell in cells"
                :key="cell.date"
                class="cursor-pointer rounded border p-2"
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
                :aria-disabled="!isAvailable(cell.date)"
                @click="selectDate(cell)"
              >
                <div class="flex items-center justify-between">
                  <div class="font-semibold">{{ cell.day }}</div>
                  <div v-if="infoByDate(cell.date)?.season" class="text-[10px]">
                    <span
                      :class="
                        infoByDate(cell.date)?.season_is_default
                          ? 'rounded bg-gray-100 px-1.5 py-0.5 text-gray-700'
                          : 'rounded bg-amber-100 px-1.5 py-0.5 text-amber-700'
                      "
                    >
                      {{ infoByDate(cell.date)?.season }}
                    </span>
                  </div>
                </div>
                <div :class="statusClass(cell.date)" class="mt-1 flex items-center gap-1 text-sm">
                  <CheckCircle v-if="infoByDate(cell.date)?.available" class="h-4 w-4" />
                  <Ban v-else-if="isBlackout(cell.date)" class="h-4 w-4" />
                  <XCircle v-else class="h-4 w-4" />
                  {{ statusText(cell.date) }}
                </div>
                <div v-if="infoByDate(cell.date)?.price" class="mt-1 text-sm text-gray-800">
                  {{ currency(infoByDate(cell.date)?.price) }}/noc
                </div>
              </div>
            </div>
          </div>

          <div
            v-if="step === 1"
            class="flex shrink-0 items-center gap-3 border-t bg-white px-4 py-3"
          >
            <div class="text-sm text-gray-700">
              Od: <strong>{{ formatDate(startDate) || "-" }}</strong>
            </div>
            <div class="text-sm text-gray-700">
              Do: <strong>{{ formatDate(endDate) || "-" }}</strong>
            </div>
            <div v-if="selectedNights > 0" class="text-sm text-gray-700">
              Nocí: <strong>{{ selectedNights }}</strong>
            </div>
            <div v-if="selectedNights > 0" class="text-sm text-gray-700">
              Cena celkem: <strong>{{ currency(selectedTotalPrice) }}</strong>
            </div>
            <button
              class="ml-auto rounded bg-gray-200 px-3 py-2 hover:bg-gray-300"
              @click="clearSelection"
            >
              Zrušit výběr
            </button>
            <button
              type="button"
              class="flex items-center gap-2 rounded bg-emerald-600 px-3 py-2 text-white disabled:opacity-50"
              :disabled="!canProceed || verifying"
              @click="verifyAndProceed"
            >
              <Loader2 v-if="verifying" class="h-4 w-4 animate-spin" />
              <span v-if="!verifying">Pokračovat</span>
              <span v-else>Ověřujeme…</span>
            </button>
          </div>
        </div>

        <div v-if="step === 2" class="flex h-full flex-col">
          <div class="flex shrink-0 items-center justify-between border-b bg-white px-4 py-3">
            <div class="text-2xl font-semibold">Vaše údaje</div>
            <div class="text-sm text-gray-700">Krok 2</div>
          </div>
          <div class="flex-1 overflow-auto px-4 py-6">
            <div class="grid min-h-full place-items-center">
              <div class="w-full max-w-2xl rounded-2xl border bg-white p-6 shadow-sm">
                <div class="mb-4 text-sm text-gray-700">
                  Vyplňte prosím kontaktní údaje, abychom vám mohli potvrdit rezervaci. E‑mail
                  použijeme pro zaslání potvrzení a telefon jen v případě potřeby.
                </div>
                <div class="mb-4 space-y-1 text-xs text-gray-600">
                  <div>Uveďte jméno a příjmení tak, jak chcete mít na potvrzení.</div>
                  <div>Použijte e‑mail, který běžně čtete; potvrzení zašleme tam.</div>
                  <div>Telefon slouží pouze pro rychlé upřesnění před příjezdem.</div>
                </div>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                  <div>
                    <label class="mb-1 block flex items-center gap-1 text-sm text-gray-800">
                      <User class="text-primary h-4 w-4" />
                      Jméno
                    </label>
                    <input
                      v-model="customer.firstName"
                      type="text"
                      class="focus:ring-primary w-full rounded-2xl border px-3.5 py-2.5 placeholder:text-gray-400 focus:ring-2 focus:outline-none"
                      placeholder="Jméno"
                    />
                  </div>
                  <div>
                    <label class="mb-1 block flex items-center gap-1 text-sm text-gray-800">
                      <User class="text-primary h-4 w-4" />
                      Příjmení
                    </label>
                    <input
                      v-model="customer.lastName"
                      type="text"
                      class="focus:ring-primary w-full rounded-2xl border px-3.5 py-2.5 placeholder:text-gray-400 focus:ring-2 focus:outline-none"
                      placeholder="Příjmení"
                    />
                  </div>
                  <div>
                    <label class="mb-1 block flex items-center gap-1 text-sm text-gray-800">
                      <Mail class="text-primary h-4 w-4" />
                      E‑mail
                    </label>
                    <input
                      v-model="customer.email"
                      type="email"
                      class="focus:ring-primary w-full rounded-2xl border px-3.5 py-2.5 placeholder:text-gray-400 focus:ring-2 focus:outline-none"
                      placeholder="např. jana@domena.cz"
                    />
                  </div>
                  <div>
                    <label class="mb-1 block flex items-center gap-1 text-sm text-gray-800">
                      <Phone class="text-primary h-4 w-4" />
                      Telefon
                    </label>
                    <input
                      v-model="customer.phone"
                      type="tel"
                      class="focus:ring-primary w-full rounded-2xl border px-3.5 py-2.5 placeholder:text-gray-400 focus:ring-2 focus:outline-none"
                      placeholder="např. +420 777 000 000"
                    />
                  </div>
                  <div class="md:col-span-2">
                    <label class="mb-1 block text-sm text-gray-800">Poznámka (nepovinné)</label>
                    <textarea
                      v-model="customer.note"
                      rows="4"
                      class="focus:ring-primary w-full rounded-2xl border px-3.5 py-2.5 placeholder:text-gray-400 focus:ring-2 focus:outline-none"
                      placeholder="Např. speciální požadavky"
                    ></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="flex shrink-0 items-center gap-3 border-t bg-white px-4 py-3">
            <div class="text-sm text-gray-700">
              Termín: <strong>{{ formatDate(startDate) }} – {{ formatDate(endDate) }}</strong>
            </div>
            <div class="text-sm text-gray-700">
              Nocí: <strong>{{ selectedNights }}</strong>
            </div>
            <div class="text-sm text-gray-700">
              Cena ubytování: <strong>{{ currency(selectedTotalPrice) }}</strong>
            </div>
            <button
              class="ml-auto rounded bg-gray-200 px-3 py-2 hover:bg-gray-300"
              @click="step = 1"
            >
              Zpět
            </button>
            <button
              class="rounded bg-emerald-600 px-3 py-2 text-white disabled:opacity-50"
              :disabled="!formReady"
              @click="step = 3"
            >
              Pokračovat
            </button>
          </div>
        </div>

        <div v-if="step === 3" class="flex h-full flex-col">
          <div class="flex shrink-0 items-center justify-between border-b bg-white px-4 py-3">
            <div class="text-2xl font-semibold">Doplňkové služby</div>
            <div class="text-sm text-gray-700">Krok 3</div>
          </div>
          <div class="flex-1 overflow-auto px-4 py-6">
            <div class="grid min-h-full place-items-center">
              <div class="w-full max-w-2xl rounded-2xl border bg-white p-6 shadow-sm">
                <div class="mb-4 text-sm text-gray-700">
                  Vyberte si z doplňkových služeb. Cena se počítá dle typu služby (za den nebo za
                  pobyt).
                </div>
                <div v-if="extrasLoading" class="flex items-center gap-2 text-sm text-gray-700">
                  <Loader2 class="h-4 w-4 animate-spin" /> Načítám služby…
                </div>
                <div v-else-if="extrasError" class="text-sm text-red-700">{{ extrasError }}</div>
                <div v-else class="space-y-4">
                  <div v-for="ex in validExtras" :key="ex.id" class="rounded-2xl border p-4">
                    <div class="flex items-center justify-between">
                      <div>
                        <div class="font-medium">{{ ex.name }}</div>
                        <div class="text-sm text-gray-700">
                          {{ currency(ex.price)
                          }}<span v-if="ex.price_type === 'per_day'"> /den</span
                          ><span v-else> /pobyt</span>
                        </div>
                      </div>
                      <div class="flex items-center gap-2">
                        <label class="text-sm text-gray-700">Množství</label>
                        <input
                          :value="extraSelection[ex.id] || 0"
                          @input="booking.setExtraQuantity(ex.id, $event.target.value)"
                          type="number"
                          min="0"
                          :max="ex.max_quantity"
                          class="w-24 rounded border px-3 py-2"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="flex shrink-0 items-center gap-3 border-t bg-white px-4 py-3">
            <div class="text-sm text-gray-700">
              Termín: <strong>{{ formatDate(startDate) }} – {{ formatDate(endDate) }}</strong>
            </div>
            <div class="text-sm text-gray-700">
              Nocí: <strong>{{ selectedNights }}</strong>
            </div>
            <div class="text-sm text-gray-700">
              Služby: <strong>{{ currency(addonsTotalPrice) }}</strong>
            </div>
            <div class="text-sm text-gray-700">
              Celkem k úhradě: <strong>{{ currency(grandTotalPrice) }}</strong>
            </div>
            <button
              class="ml-auto rounded bg-gray-200 px-3 py-2 hover:bg-gray-300"
              @click="step = 2"
            >
              Zpět
            </button>
            <button
              class="rounded bg-emerald-600 px-3 py-2 text-white disabled:opacity-50"
              :disabled="!canSubmit"
              @click="checkExtrasAvailability"
            >
              Pokračovat
            </button>
          </div>
        </div>

        <div v-if="step === 4" class="flex h-full flex-col">
          <div class="flex shrink-0 items-center justify-between border-b bg-white px-4 py-3">
            <div class="flex items-center gap-2">
              <Calendar class="text-primary h-5 w-5" />
              <div class="text-2xl font-semibold">Zkontrolujte rezervaci</div>
            </div>
            <div class="text-sm text-gray-700">Krok 4</div>
          </div>
          <div class="flex-1 overflow-auto px-4 py-6">
            <div class="grid min-h-full place-items-center">
              <div class="w-full max-w-3xl rounded-2xl border bg-white p-6 shadow-sm">
                <div class="mb-4 text-sm text-gray-700">
                  Zkontrolujte prosím všechny údaje níže. Pokud je vše v pořádku, klikněte na
                  „Odeslat rezervaci“. V případě potřeby se vraťte a údaje upravte.
                </div>
                <div class="mb-4 space-y-1 text-xs text-gray-600">
                  <div>Zkontrolujte termín, počet nocí, ceny a kontaktní údaje.</div>
                  <div>Pro opravy použijte tlačítko „Zpět“ a upravte potřebné informace.</div>
                </div>
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                  <div class="space-y-3">
                    <div class="flex items-center gap-2 text-sm text-gray-700">
                      <Calendar class="h-4 w-4" />
                      <span>Termín:</span>
                      <strong>{{ formatDate(startDate) }} – {{ formatDate(endDate) }}</strong>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-700">
                      <Moon class="h-4 w-4" />
                      <span>Nocí:</span>
                      <strong>{{ selectedNights }}</strong>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-700">
                      <Home class="h-4 w-4" />
                      <span>Cena ubytování:</span>
                      <strong>{{ currency(selectedTotalPrice) }}</strong>
                    </div>
                    <div class="space-y-2">
                      <div class="flex items-center gap-2 text-sm text-gray-700">
                        <PawPrint class="h-4 w-4" />
                        <span>Doplňkové služby:</span>
                      </div>
                      <div class="text-sm text-gray-700" v-if="selectedExtras.length === 0">—</div>
                      <div v-else class="space-y-1">
                        <div
                          v-for="ex in selectedExtras"
                          :key="ex.id"
                          class="flex items-center gap-2 text-sm text-gray-700"
                        >
                          <strong>{{ ex.name }}</strong>
                          <span>× {{ extraSelection[ex.id] }}</span>
                          <span v-if="ex.price_type === 'per_day'"
                            >× {{ selectedNights }} nocí</span
                          >
                          <span
                            >=
                            {{
                              currency(
                                ex.price_type === "per_day"
                                  ? extraSelection[ex.id] * selectedNights * ex.price
                                  : extraSelection[ex.id] * ex.price
                              )
                            }}</span
                          >
                        </div>
                      </div>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-700">
                      <BarChart3 class="h-4 w-4" />
                      <span>Cena služeb:</span>
                      <strong>{{ currency(addonsTotalPrice) }}</strong>
                    </div>
                    <div class="mt-2 flex items-center gap-2 border-t pt-3 text-gray-900">
                      <CreditCard class="text-primary h-5 w-5" />
                      <div class="text-base">Celkem k úhradě:</div>
                      <div class="text-primary ml-auto text-xl font-semibold">
                        {{ currency(grandTotalPrice) }}
                      </div>
                    </div>
                  </div>
                  <div class="space-y-3">
                    <div class="flex items-center gap-2 text-sm text-gray-700">
                      <User class="h-4 w-4" />
                      <span>Jméno:</span>
                      <strong>{{ customer.firstName }}</strong>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-700">
                      <User class="h-4 w-4" />
                      <span>Příjmení:</span>
                      <strong>{{ customer.lastName }}</strong>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-700">
                      <Mail class="h-4 w-4" />
                      <span>Email:</span>
                      <strong>{{ customer.email }}</strong>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-700">
                      <Phone class="h-4 w-4" />
                      <span>Telefon:</span>
                      <strong>{{ customer.phone }}</strong>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-700">
                      <StickyNote class="h-4 w-4" />
                      <span>Poznámka:</span>
                      <strong>{{ customer.note || "-" }}</strong>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="flex shrink-0 items-center gap-3 border-t bg-white px-4 py-3">
            <button
              class="flex items-center gap-1 rounded bg-gray-200 px-3 py-2 hover:bg-gray-300"
              @click="step = 3"
            >
              <ChevronLeft class="h-4 w-4" />
              Zpět
            </button>
            <button
              class="flex items-center gap-1 rounded bg-gray-900 px-3 py-2 text-white disabled:opacity-50"
              :disabled="!canSubmit || submitting"
              @click="submit"
            >
              Odeslat rezervaci
              <Send class="h-4 w-4" />
            </button>
          </div>
          <div v-if="submitError" class="mt-2 text-sm text-red-700">{{ submitError }}</div>
        </div>

        <div v-if="step === 5" class="flex h-full flex-col">
          <div class="flex shrink-0 items-center justify-between border-b bg-white px-4 py-3">
            <div class="text-2xl font-semibold">Dokončeno</div>
            <div class="text-sm text-gray-700">Krok 5</div>
          </div>
          <div class="flex-1 overflow-auto px-4 py-6">
            <div class="grid min-h-full place-items-center">
              <div class="w-full max-w-2xl rounded-2xl border bg-white p-6 text-center shadow-sm">
                <div class="mb-2 text-2xl font-semibold">Dokončeno</div>
                <div class="text-gray-700">
                  Děkujeme, rezervace byla úspěšně odeslána. Potvrzení vám zašleme e‑mailem.
                </div>
                <div class="mt-2 text-sm text-gray-700">V případě dotazů jsme vám k dispozici.</div>
                <div class="mt-4 text-sm text-gray-700">
                  Termín: <strong>{{ formatDate(startDate) }} – {{ formatDate(endDate) }}</strong>
                </div>
                <div class="text-sm text-gray-700">
                  Celkem: <strong>{{ currency(grandTotalPrice) }}</strong>
                </div>
              </div>
            </div>
          </div>
          <div class="flex shrink-0 items-center gap-3 border-t bg-white px-4 py-3">
            <button class="rounded bg-gray-200 px-3 py-2 hover:bg-gray-300" @click="step = 1">
              Zpět na kalendář
            </button>
          </div>
        </div>
      </section>
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
