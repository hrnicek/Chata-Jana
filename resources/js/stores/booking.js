import { defineStore } from 'pinia'

export const useBookingStore = defineStore('booking', {
  state: () => ({
    customer: {
      firstName: '',
      lastName: '',
      email: '',
      phone: '',
      note: '',
    },
    startDate: null,
    endDate: null,
    dogPerDayPrice: 300,
    dogCount: 0,
  }),
  getters: {
    isFormFilled: (state) => {
      return !!(
        state.customer.firstName &&
        state.customer.lastName &&
        state.customer.email &&
        state.customer.phone
      )
    },
  },
  actions: {
    updateCustomer(partial) {
      this.customer = { ...this.customer, ...partial }
    },
    resetCustomer() {
      this.customer = { firstName: '', lastName: '', email: '', phone: '', note: '' }
    },
    setStartDate(date) {
      this.startDate = date || null
    },
    setEndDate(date) {
      this.endDate = date || null
    },
    resetDates() {
      this.startDate = null
      this.endDate = null
    },
    setDogCount(n) {
      const num = Number(n)
      this.dogCount = Number.isNaN(num) || num < 0 ? 0 : num
    },
    setDogPerDayPrice(price) {
      const num = Number(price)
      this.dogPerDayPrice = Number.isNaN(num) || num < 0 ? 0 : num
    },
  },
})