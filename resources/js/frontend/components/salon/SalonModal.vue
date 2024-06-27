<template>
    <div v-if="isOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
      <div class="bg-white rounded-lg overflow-hidden w-3/4 lg:w-1/2">
        <div class="relative">
          <img :src="salon.image_url || '/images/eventu-hero.jpg'" class="w-full h-64 object-cover" />
          <button @click="closeModal" class="absolute top-4 right-4 bg-white rounded-full p-2">✕</button>
        </div>
        <div class="p-6 space-y-4">
          <h2 class="text-2xl font-bold">{{ salon.salon_name }}</h2>
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
              <div class="bg-white p-2 shadow rounded-lg mb-4">
                <h5 class="h5 font-semibold">Quick Info</h5>
                <ul>
                  <li class="h6">Capacitate: {{ salon.max_people }}</li>
                  <li class="h6">Adresa: {{ salon.street }}, {{ salon.number }}, {{ salon.city }}</li>
                </ul>
              </div>
              <div class="bg-white p-2 shadow rounded-lg mb-4">
                <h5 class="h5 font-semibold">Descriere:</h5>
                <p>{{ salon.description }}</p>
              </div>
              <div class="relative">
                <SalonTags :salon="salon" :isOwner="isOwner" />
              </div>
            </div>
            <div class="bg-white p-2 shadow rounded-lg">
              <h5 class="h5 font-semibold">Trimite cererea:</h5>
              <form>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                  <div>
                    <label class="block text-sm font-medium text-gray-700">Ce tip de eveniment organizati?</label>
                    <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700">Cati invitati?</label>
                    <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700">Data/Perioada</label>
                    <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700">Nume si Prenume</label>
                    <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700">Telefon</label>
                    <input type="tel" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                  </div>
                  <div class="lg:col-span-2">
                    <button type="submit" class="w-full bg-purple-700 text-white py-2 rounded-md">Trimite</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import SalonTags from './SalonTags.vue';
  
  export default {
    name: 'SalonModal',
    components: {
      SalonTags,
    },
    props: {
      isOpen: Boolean,
      salon: Object,
      isOwner: Boolean
    },
    emits: ['close-modal'],
    methods: {
      closeModal() {
        this.$emit('close-modal');
      }
    }
  }
  </script>
  
  <style scoped></style>
  