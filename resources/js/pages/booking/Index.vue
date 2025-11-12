<template>
  <div class="p-6 max-w-5xl mx-auto">
    <div class="flex items-center gap-2 mb-6">
      <button class="px-4 py-2 rounded" :class="step === 1 ? 'bg-gray-900 text-white' : 'bg-gray-200'" @click="step = 1">1. Termín</button>
      <button class="px-4 py-2 rounded" :class="step === 2 ? 'bg-gray-900 text-white' : 'bg-gray-200'" @click="step = 2" :disabled="!canProceed">2. Informace</button>
      <button class="px-4 py-2 rounded" :class="step === 3 ? 'bg-gray-900 text-white' : 'bg-gray-200'" @click="step = 3" :disabled="!canProceed || !formReady">3. Služby</button>
      <button class="px-4 py-2 rounded" :class="step === 4 ? 'bg-gray-900 text-white' : 'bg-gray-200'" @click="step = 4" :disabled="!canSubmit">4. Shrnutí</button>
      <button class="px-4 py-2 rounded" :class="step === 5 ? 'bg-gray-900 text-white' : 'bg-gray-200'" @click="step = 5" :disabled="!submitted">5. Dokončeno</button>
    </div>
    <div v-if="step === 1" class="flex items-center justify-between mb-6">
      <div class="text-2xl font-semibold flex items-center gap-2">
        {{ monthLabel }} {{ year }}
      </div>
      <div class="flex items-center gap-2">
        <button v-if="canGoPrev" class="px-3 py-2 rounded bg-gray-200 hover:bg-gray-300 flex items-center gap-1" @click="prevMonth">
          <ChevronLeft class="w-4 h-4" />
          Předchozí
        </button>
        <button class="px-3 py-2 rounded bg-gray-200 hover:bg-gray-300 flex items-center gap-1" @click="nextMonth">
          Další
          <ChevronRight class="w-4 h-4" />
        </button>
      </div>
    </div>

    <div v-if="error" class="text-red-600 mb-4">{{ error }}</div>
    <div v-if="loading" class="text-gray-600 mb-4">Načítání…</div>

    <div v-if="step === 1" class="grid grid-cols-7 gap-2">
      <div v-for="d in weekDays" :key="d" class="text-center font-medium text-gray-700">{{ d }}</div>
      <div
        v-for="cell in cells"
        :key="cell.date"
        class="border rounded p-2 cursor-pointer"
        :class="[
          cell.inCurrent ? '' : 'opacity-60',
          !isAvailable(cell.date) ? (isBlackout(cell.date) ? 'bg-orange-50 border-orange-400' : 'bg-red-50 border-red-400') : '',
          !isAvailable(cell.date) ? 'cursor-not-allowed pointer-events-none' : '',
          isInRange(cell.date) ? 'bg-emerald-50 border-emerald-400' : '',
          isStart(cell.date) || isEnd(cell.date) ? 'ring-2 ring-emerald-500' : ''
        ]"
        :aria-disabled="!isAvailable(cell.date)"
        @click="selectDate(cell)"
      >
        <div class="flex items-center justify-between">
          <div class="font-semibold">{{ cell.day }}</div>
          <div v-if="infoByDate(cell.date)?.season" class="text-[10px] text-gray-600 pointer-none">{{ infoByDate(cell.date)?.season }}</div>
        </div>
        <div :class="statusClass(cell.date)" class="text-sm mt-1 flex items-center gap-1">
          <CheckCircle v-if="infoByDate(cell.date)?.available" class="w-4 h-4" />
          <Ban v-else-if="isBlackout(cell.date)" class="w-4 h-4" />
          <XCircle v-else class="w-4 h-4" />
          {{ statusText(cell.date) }}
        </div>
        <div v-if="infoByDate(cell.date)?.price" class="text-sm text-gray-800 mt-1">{{ currency(infoByDate(cell.date)?.price) }}/noc</div>
      </div>
    </div>

    <div v-if="step === 1" class="mt-4 flex items-center gap-3">
      <div class="text-sm text-gray-700">Od: <strong>{{ formatDate(startDate) || '-' }}</strong></div>
      <div class="text-sm text-gray-700">Do: <strong>{{ formatDate(endDate) || '-' }}</strong></div>
      <div v-if="selectedNights > 0" class="text-sm text-gray-700">Nocí: <strong>{{ selectedNights }}</strong></div>
      <div v-if="selectedNights > 0" class="text-sm text-gray-700">Cena celkem: <strong>{{ currency(selectedTotalPrice) }}</strong></div>
      <div v-if="rangeHasUnavailable" class="text-sm text-red-700">Výběr obsahuje obsazené dny</div>
      <button class="ml-auto px-3 py-2 rounded bg-gray-200 hover:bg-gray-300" @click="clearSelection">Vymazat výběr</button>
      <button class="px-3 py-2 rounded bg-emerald-600 text-white disabled:opacity-50" :disabled="!canProceed || verifying" @click="verifyAndProceed">Pokračovat</button>
    </div>
    <div v-if="verifyError" class="mt-2 text-sm text-red-700">{{ verifyError }}</div>
    <div v-if="verifying" class="mt-2 text-sm text-gray-700">Ověřování dostupnosti…</div>

    <div v-if="step === 2" class="mt-2 space-y-4">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm text-gray-700 mb-1 flex items-center gap-1">
            <User class="w-4 h-4" />
            Jméno
          </label>
          <input v-model="customer.firstName" type="text" class="w-full rounded border px-3 py-2" placeholder="Jméno" />
        </div>
        <div>
          <label class="block text-sm text-gray-700 mb-1 flex items-center gap-1">
            <User class="w-4 h-4" />
            Příjmení
          </label>
          <input v-model="customer.lastName" type="text" class="w-full rounded border px-3 py-2" placeholder="Příjmení" />
        </div>
        <div>
          <label class="block text-sm text-gray-700 mb-1 flex items-center gap-1">
            <Mail class="w-4 h-4" />
            Email
          </label>
          <input v-model="customer.email" type="email" class="w-full rounded border px-3 py-2" placeholder="email@domena.cz" />
        </div>
        <div>
          <label class="block text-sm text-gray-700 mb-1 flex items-center gap-1">
            <Phone class="w-4 h-4" />
            Telefon
          </label>
          <input v-model="customer.phone" type="tel" class="w-full rounded border px-3 py-2" placeholder="+420" />
        </div>
        <div class="md:col-span-2">
          <label class="block text-sm text-gray-700 mb-1">Poznámka</label>
          <textarea v-model="customer.note" rows="4" class="w-full rounded border px-3 py-2" placeholder="Poznámka"></textarea>
        </div>
      </div>
      <div class="flex items-center gap-3">
        <div class="text-sm text-gray-700">Termín: <strong>{{ formatDate(startDate) }} – {{ formatDate(endDate) }}</strong></div>
        <div class="text-sm text-gray-700">Nocí: <strong>{{ selectedNights }}</strong></div>
        <div class="text-sm text-gray-700">Cena: <strong>{{ currency(selectedTotalPrice) }}</strong></div>
        <button class="ml-auto px-3 py-2 rounded bg-gray-200 hover:bg-gray-300" @click="step = 1">Zpět</button>
        <button class="px-3 py-2 rounded bg-emerald-600 text-white disabled:opacity-50" :disabled="!formReady" @click="step = 3">Pokračovat</button>
      </div>
    </div>

    <div v-if="step === 3" class="mt-2 space-y-4">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="border rounded p-3">
          <div class="font-medium">Pes</div>
          <div class="text-sm text-gray-700">{{ currency(dogPerDayPrice) }} /den /pes</div>
          <div class="mt-2 flex items-center gap-2">
            <label class="text-sm text-gray-700">Počet psů</label>
            <input v-model.number="dogCount" type="number" min="0" class="w-24 rounded border px-3 py-2" />
          </div>
        </div>
      </div>
      <div class="flex items-center gap-3">
        <div class="text-sm text-gray-700">Termín: <strong>{{ formatDate(startDate) }} – {{ formatDate(endDate) }}</strong></div>
        <div class="text-sm text-gray-700">Nocí: <strong>{{ selectedNights }}</strong></div>
        <div class="text-sm text-gray-700">Služby: <strong>{{ currency(addonsTotalPrice) }}</strong></div>
        <div class="text-sm text-gray-700">Celkem: <strong>{{ currency(grandTotalPrice) }}</strong></div>
        <button class="ml-auto px-3 py-2 rounded bg-gray-200 hover:bg-gray-300" @click="step = 2">Zpět</button>
        <button class="px-3 py-2 rounded bg-emerald-600 text-white disabled:opacity-50" :disabled="!canSubmit" @click="step = 4">Pokračovat</button>
      </div>
    </div>

    <div v-if="step === 4" class="mt-2 space-y-4">
      <div class="border rounded p-5 bg-gray-50">
        <div class="flex items-center gap-2 mb-4">
          <Calendar class="w-5 h-5 text-gray-900" />
          <div class="text-lg font-semibold">Shrnutí rezervace</div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="space-y-3">
            <div class="flex items-center gap-2 text-sm text-gray-700">
              <Calendar class="w-4 h-4" />
              <span>Termín:</span>
              <strong>{{ formatDate(startDate) }} – {{ formatDate(endDate) }}</strong>
            </div>
            <div class="flex items-center gap-2 text-sm text-gray-700">
              <Moon class="w-4 h-4" />
              <span>Nocí:</span>
              <strong>{{ selectedNights }}</strong>
            </div>
            <div class="flex items-center gap-2 text-sm text-gray-700">
              <Home class="w-4 h-4" />
              <span>Cena ubytování:</span>
              <strong>{{ currency(selectedTotalPrice) }}</strong>
            </div>
            <div class="flex items-center gap-2 text-sm text-gray-700">
              <PawPrint class="w-4 h-4" />
              <span>Pes:</span>
              <strong>{{ dogCount }}</strong>
              <span>× {{ currency(dogPerDayPrice) }} /den</span>
            </div>
            <div class="flex items-center gap-2 text-sm text-gray-700">
              <BarChart3 class="w-4 h-4" />
              <span>Cena služeb:</span>
              <strong>{{ currency(addonsTotalPrice) }}</strong>
            </div>
            <div class="border-t pt-3 mt-2 flex items-center gap-2 text-gray-900">
              <CreditCard class="w-5 h-5" />
              <div class="text-base">Celkem k úhradě:</div>
              <div class="text-xl font-semibold ml-auto">{{ currency(grandTotalPrice) }}</div>
            </div>
          </div>
          <div class="space-y-3">
            <div class="flex items-center gap-2 text-sm text-gray-700">
              <User class="w-4 h-4" />
              <span>Jméno:</span>
              <strong>{{ customer.firstName }}</strong>
            </div>
            <div class="flex items-center gap-2 text-sm text-gray-700">
              <User class="w-4 h-4" />
              <span>Příjmení:</span>
              <strong>{{ customer.lastName }}</strong>
            </div>
            <div class="flex items-center gap-2 text-sm text-gray-700">
              <Mail class="w-4 h-4" />
              <span>Email:</span>
              <strong>{{ customer.email }}</strong>
            </div>
            <div class="flex items-center gap-2 text-sm text-gray-700">
              <Phone class="w-4 h-4" />
              <span>Telefon:</span>
              <strong>{{ customer.phone }}</strong>
            </div>
            <div class="flex items-center gap-2 text-sm text-gray-700">
              <StickyNote class="w-4 h-4" />
              <span>Poznámka:</span>
              <strong>{{ customer.note || '-' }}</strong>
            </div>
          </div>
        </div>
      </div>
      <div class="flex items-center gap-3">
        <button class="px-3 py-2 rounded bg-gray-200 hover:bg-gray-300 flex items-center gap-1" @click="step = 3">
          <ChevronLeft class="w-4 h-4" />
          Zpět
        </button>
        <button class="px-3 py-2 rounded bg-gray-900 text-white disabled:opacity-50 flex items-center gap-1" :disabled="!canSubmit || submitting" @click="submit">
          Odeslat
          <Send class="w-4 h-4" />
        </button>
      </div>
      <div v-if="submitError" class="text-sm text-red-700">{{ submitError }}</div>
    </div>

    <div v-if="step === 5" class="mt-2 space-y-4">
      <div class="border rounded p-6 text-center">
        <div class="text-2xl font-semibold mb-2">Dokončeno</div>
        <div class="text-gray-700">Děkujeme, vaše rezervace byla odeslána.</div>
        <div class="mt-4 text-sm text-gray-700">Termín: <strong>{{ formatDate(startDate) }} – {{ formatDate(endDate) }}</strong></div>
        <div class="text-sm text-gray-700">Celkem: <strong>{{ currency(grandTotalPrice) }}</strong></div>
      </div>
      <div class="flex items-center gap-3">
        <button class="px-3 py-2 rounded bg-gray-200 hover:bg-gray-300" @click="step = 1">Zpět na začátek</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import axios from 'axios'
import { ref, computed, onMounted } from 'vue'
import { useBookingStore } from '../../stores/booking'
import { ChevronLeft, ChevronRight, CheckCircle, Ban, XCircle, Calendar, Moon, Home, BarChart3, CreditCard, User, Mail, Phone, StickyNote, Send, PawPrint } from 'lucide-vue-next'

const now = new Date()
const month = ref(now.getMonth() + 1)
const year = ref(now.getFullYear())
const todayMonth = now.getMonth() + 1
const todayYear = now.getFullYear()
const daysData = ref([])
const loading = ref(false)
const error = ref('')
const startDate = computed({
  get: () => booking.startDate,
  set: (val) => booking.setStartDate(val),
})
const endDate = computed({
  get: () => booking.endDate,
  set: (val) => booking.setEndDate(val),
})
const step = ref(1)
const booking = useBookingStore()
const customer = computed({
  get: () => booking.customer,
  set: (val) => booking.updateCustomer(val),
})
const dogPerDayPrice = computed(() => booking.dogPerDayPrice)
const dogCount = computed({
  get: () => booking.dogCount,
  set: (val) => booking.setDogCount(val),
})
const submitted = ref(false)
const submitting = ref(false)
const submitError = ref('')
const verifying = ref(false)
const verifyError = ref('')

const monthLabel = computed(() => new Date(year.value, month.value - 1, 1).toLocaleString('cs-CZ', { month: 'long' }))
const weekDays = ['Po', 'Út', 'St', 'Čt', 'Pá', 'So', 'Ne']

const daysInMonth = computed(() => new Date(year.value, month.value, 0).getDate())
const firstDayIndex = computed(() => {
  const idx = new Date(year.value, month.value - 1, 1).getDay()
  return idx === 0 ? 6 : idx - 1
})
const prevYear = computed(() => (month.value === 1 ? year.value - 1 : year.value))
const prevMonthNum = computed(() => (month.value === 1 ? 12 : month.value - 1))
const prevMonthDaysCount = computed(() => new Date(prevYear.value, prevMonthNum.value, 0).getDate())

function pad(n) {
  return String(n).padStart(2, '0')
}

function dayKey(d) {
  return `${year.value}-${String(month.value).padStart(2, '0')}-${String(d).padStart(2, '0')}`
}

function dayInfo(d) {
  const k = dayKey(d)
  return daysData.value.find(x => x.date === k)
}

function infoByDate(date) {
  return daysData.value.find(x => x.date === date)
}

function currency(n) {
  return new Intl.NumberFormat('cs-CZ', { style: 'currency', currency: 'CZK', maximumFractionDigits: 0 }).format(Number(n))
}

function formatDate(iso) {
  if (!iso) return ''
  const d = parseISO(iso)
  return `${d.getDate()}. ${d.getMonth() + 1}. ${d.getFullYear()}`
}

async function fetchCalendar() {
  loading.value = true
  error.value = ''
  try {
    const [curr, prev] = await Promise.all([
      axios.get('/api/bookings/calendar', { params: { month: month.value, year: year.value } }),
      axios.get('/api/bookings/calendar', { params: { month: prevMonthNum.value, year: prevYear.value } }),
    ])
    daysData.value = [...prev.data.days, ...curr.data.days]
  } catch (e) {
    error.value = 'Nepodařilo se načíst kalendář'
  } finally {
    loading.value = false
  }
}

function nextMonth() {
  if (month.value === 12) {
    month.value = 1
    year.value += 1
  } else {
    month.value += 1
  }
  fetchCalendar()
}

function prevMonth() {
  if (month.value === 1) {
    month.value = 12
    year.value -= 1
  } else {
    month.value -= 1
  }
  fetchCalendar()
}

onMounted(fetchCalendar)

const cells = computed(() => {
  const off = firstDayIndex.value
  const prevStart = prevMonthDaysCount.value - off + 1
  const prevCells = Array.from({ length: off }, (_, i) => {
    const day = prevStart + i
    const date = `${prevYear.value}-${pad(prevMonthNum.value)}-${pad(day)}`
    return { date, day, inCurrent: false }
  })
  const currCells = Array.from({ length: daysInMonth.value }, (_, i) => {
    const day = i + 1
    const date = `${year.value}-${pad(month.value)}-${pad(day)}`
    return { date, day, inCurrent: true }
  })
  return [...prevCells, ...currCells]
})

const canGoPrev = computed(() => {
  const targetY = prevYear.value
  const targetM = prevMonthNum.value
  return targetY > todayYear || (targetY === todayYear && targetM >= todayMonth)
})

function parseISO(s) {
  const [Y, M, D] = s.split('-').map(Number)
  return new Date(Y, M - 1, D)
}

const rangeStart = computed(() => (startDate.value ? parseISO(startDate.value) : null))
const rangeEnd = computed(() => (endDate.value ? parseISO(endDate.value) : null))

function isSameDate(a, b) {
  if (!a || !b) return false
  return a.getFullYear() === b.getFullYear() && a.getMonth() === b.getMonth() && a.getDate() === b.getDate()
}

function isInRange(dateStr) {
  if (!rangeStart.value) return false
  const d = parseISO(dateStr)
  if (rangeStart.value && !rangeEnd.value) {
    return isSameDate(d, rangeStart.value)
  }
  if (rangeStart.value && rangeEnd.value) {
    const a = rangeStart.value <= rangeEnd.value ? rangeStart.value : rangeEnd.value
    const b = rangeStart.value <= rangeEnd.value ? rangeEnd.value : rangeStart.value
    return d >= a && d <= b
  }
  return false
}

function isStart(dateStr) {
  return !!(rangeStart.value && isSameDate(parseISO(dateStr), rangeStart.value))
}

function isEnd(dateStr) {
  return !!(rangeEnd.value && isSameDate(parseISO(dateStr), rangeEnd.value))
}

function isAvailable(dateStr) {
  const info = infoByDate(dateStr)
  if (!info) return true
  return !!info.available
}

function isBlackout(dateStr) {
  const info = infoByDate(dateStr)
  if (!info) return false
  return !!info.blackout
}

function statusText(dateStr) {
  const info = infoByDate(dateStr)
  if (!info) return ''
  if (info.available) return 'Volné'
  if (info.blackout) return 'Nedostupné'
  return 'Obsazené'
}

function statusClass(dateStr) {
  const info = infoByDate(dateStr)
  if (!info) return ''
  if (info.available) return 'text-green-700'
  if (info.blackout) return 'text-orange-700'
  return 'text-red-700'
}

function selectDate(cell) {
  if (!isAvailable(cell.date)) return
  const date = cell.date
  if (!startDate.value || (startDate.value && endDate.value)) {
    startDate.value = date
    endDate.value = null
    return
  }
  if (!endDate.value) {
    const a = parseISO(startDate.value)
    const b = parseISO(date)
    if (b < a) {
      endDate.value = startDate.value
      startDate.value = date
    } else {
      endDate.value = date
    }
  }
}

function clearSelection() {
  booking.resetDates()
}

const selectedNights = computed(() => {
  return rangeDates.value.length
})

function addDays(date, days) {
  const d = new Date(date)
  d.setDate(d.getDate() + days)
  return d
}

function toISO(d) {
  return `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(d.getDate())}`
}

const rangeDates = computed(() => {
  if (!(rangeStart.value && rangeEnd.value)) return []
  const a = rangeStart.value <= rangeEnd.value ? rangeStart.value : rangeEnd.value
  const b = rangeStart.value <= rangeEnd.value ? rangeEnd.value : rangeStart.value
  const out = []
  let cur = new Date(a)
  while (cur <= b) {
    out.push(toISO(cur))
    cur = addDays(cur, 1)
  }
  return out
})

const monthsForRange = computed(() => {
  const m = new Map()
  for (const iso of rangeDates.value) {
    const d = parseISO(iso)
    const key = `${d.getFullYear()}-${d.getMonth() + 1}`
    if (!m.has(key)) m.set(key, { month: d.getMonth() + 1, year: d.getFullYear() })
  }
  return Array.from(m.values())
})

const selectedTotalPrice = computed(() => {
  if (rangeDates.value.length === 0) return 0
  return rangeDates.value.reduce((sum, iso) => {
    const info = infoByDate(iso)
    const price = info?.price ? Number(info.price) : 0
    return sum + price
  }, 0)
})

const rangeHasUnavailable = computed(() => {
  if (rangeDates.value.length === 0) return false
  return rangeDates.value.some((iso) => {
    const info = infoByDate(iso)
    return info && info.available === false
  })
})

const canProceed = computed(() => {
  return !!(startDate.value && endDate.value) && !rangeHasUnavailable.value
})

const formReady = computed(() => {
  return canProceed.value && booking.isFormFilled
})

const addonsTotalPrice = computed(() => {
  if (dogCount.value <= 0 || selectedNights.value <= 0) return 0
  return dogCount.value * selectedNights.value * dogPerDayPrice.value
})

const grandTotalPrice = computed(() => selectedTotalPrice.value + addonsTotalPrice.value)

const canSubmit = computed(() => formReady.value)

async function submit() {
  if (!canSubmit.value || submitting.value) return
  submitting.value = true
  submitError.value = ''
  try {
    const payload = {
      start_date: startDate.value,
      end_date: endDate.value,
      customer: {
        first_name: customer.value.firstName,
        last_name: customer.value.lastName,
        email: customer.value.email,
        phone: customer.value.phone,
        note: customer.value.note || '',
      },
      dog_count: dogCount.value,
      dog_per_day_price: dogPerDayPrice.value,
      accommodation_total: selectedTotalPrice.value,
      addons_total: addonsTotalPrice.value,
      grand_total: grandTotalPrice.value,
    }
    await axios.post('/api/bookings', payload)
    submitted.value = true
    step.value = 5
  } catch (e) {
    submitError.value = 'Nepodařilo se odeslat rezervaci'
  } finally {
    submitting.value = false
  }
}

async function verifyAndProceed() {
  if (!canProceed.value) return
  verifying.value = true
  verifyError.value = ''
  try {
    const res = await axios.post('/api/bookings/verify', {
      start_date: startDate.value,
      end_date: endDate.value,
    })
    if (!res.data.available) {
      verifyError.value = 'Vybraný termín již není dostupný'
      return
    }
    const requests = monthsForRange.value.map(({ month, year }) => axios.get('/api/bookings/calendar', { params: { month, year } }))
    const responses = await Promise.all(requests)
    const freshDays = responses.flatMap(r => r.data.days)
    const merged = new Map(daysData.value.map(d => [d.date, d]))
    freshDays.forEach(d => merged.set(d.date, d))
    daysData.value = Array.from(merged.values())
    step.value = 2
  } catch (e) {
    verifyError.value = 'Nepodařilo se ověřit dostupnost'
  } finally {
    verifying.value = false
  }
}
</script>