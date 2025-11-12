<template>
  <div class="p-6 max-w-5xl mx-auto">
    <div class="flex items-center justify-between mb-6">
      <div class="text-2xl font-semibold">{{ monthLabel }} {{ year }}</div>
      <div class="flex items-center gap-2">
        <button class="px-3 py-2 rounded bg-gray-200 hover:bg-gray-300" @click="prevMonth">Předchozí</button>
        <button class="px-3 py-2 rounded bg-gray-200 hover:bg-gray-300" @click="nextMonth">Další</button>
      </div>
    </div>

    <div v-if="error" class="text-red-600 mb-4">{{ error }}</div>
    <div v-if="loading" class="text-gray-600 mb-4">Načítání…</div>

    <div class="grid grid-cols-7 gap-2">
      <div v-for="d in weekDays" :key="d" class="text-center font-medium text-gray-700">{{ d }}</div>
      <div
        v-for="cell in cells"
        :key="cell.date"
        class="border rounded p-2 cursor-pointer"
        :class="[
          cell.inCurrent ? '' : 'opacity-60',
          isInRange(cell.date) ? 'bg-emerald-50 border-emerald-400' : '',
          isStart(cell.date) || isEnd(cell.date) ? 'ring-2 ring-emerald-500' : ''
        ]"
        @click="selectDate(cell)"
      >
        <div class="flex items-center justify-between">
          <div class="font-semibold">{{ cell.day }}</div>
          <div v-if="infoByDate(cell.date)?.season" class="text-xs text-gray-600">{{ infoByDate(cell.date)?.season }}</div>
        </div>
        <div :class="infoByDate(cell.date)?.available ? 'text-green-700' : 'text-red-700'" class="text-sm mt-1">
          {{ infoByDate(cell.date)?.available ? 'Volné' : 'Obsazené' }}
        </div>
        <div v-if="infoByDate(cell.date)?.price" class="text-sm text-gray-800 mt-1">{{ currency(infoByDate(cell.date)?.price) }}/noc</div>
      </div>
    </div>

    <div class="mt-4 flex items-center gap-3">
      <div class="text-sm text-gray-700">Od: <strong>{{ selectedStart || '-' }}</strong></div>
      <div class="text-sm text-gray-700">Do: <strong>{{ selectedEnd || '-' }}</strong></div>
      <div v-if="selectedNights > 0" class="text-sm text-gray-700">Nocí: <strong>{{ selectedNights }}</strong></div>
      <button class="ml-auto px-3 py-2 rounded bg-gray-200 hover:bg-gray-300" @click="clearSelection">Vymazat výběr</button>
    </div>
  </div>
</template>

<script setup>
import axios from 'axios'
import { ref, computed, onMounted } from 'vue'

const now = new Date()
const month = ref(now.getMonth() + 1)
const year = ref(now.getFullYear())
const daysData = ref([])
const loading = ref(false)
const error = ref('')
const selectedStart = ref(null)
const selectedEnd = ref(null)

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

function parseISO(s) {
  const [Y, M, D] = s.split('-').map(Number)
  return new Date(Y, M - 1, D)
}

const rangeStart = computed(() => (selectedStart.value ? parseISO(selectedStart.value) : null))
const rangeEnd = computed(() => (selectedEnd.value ? parseISO(selectedEnd.value) : null))

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

function selectDate(cell) {
  const date = cell.date
  if (!selectedStart.value || (selectedStart.value && selectedEnd.value)) {
    selectedStart.value = date
    selectedEnd.value = null
    return
  }
  if (!selectedEnd.value) {
    selectedEnd.value = date
  }
}

function clearSelection() {
  selectedStart.value = null
  selectedEnd.value = null
}

const selectedNights = computed(() => {
  if (!(rangeStart.value && rangeEnd.value)) return 0
  const ms = Math.abs(rangeEnd.value - rangeStart.value)
  return Math.max(1, Math.round(ms / (1000 * 60 * 60 * 24)))
})
</script>