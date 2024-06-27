<template>
    <div class="bg-white p-6 shadow rounded-lg">
      <h2 class="text-xl font-semibold mb-4 flex items-center">
        Contactează "{{ business.name }}"
      </h2>
      <form @submit.prevent="submitForm">
        <div class="mb-4">
          <label class="block text-gray-700">Ce tip de eveniment organizați?</label>
          <select class="mt-1 block w-full border-gray-300 rounded-md border-0 border-b-2 py-1">
            <option value="">Selectează</option>
            <option value="botez">Botez</option>
            <option value="nunta">Nuntă</option>
            <option value="corporate">Corporate</option>
          </select>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Câți invitați?</label>
          <select class="mt-1 block w-full border-gray-300 rounded-md border-0 border-b-2 py-1">
            <option value="">Selectează</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="200">200</option>
          </select>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Data/Perioada</label>
          <input type="date" class="mt-1 block w-full border-gray-300 rounded-md border-0 border-b-2" />
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Nume și Prenume</label>
          <input type="text" class="mt-1 py-1 block w-full border-gray-300 rounded-md border-0 border-b-2" />
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Email</label>
          <input type="email" class="mt-1 py-1 block w-full border-gray-300 rounded-md border-0 border-b-2" />
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Telefon</label>
          <input type="text" class="mt-1 py-1 block w-full border-gray-300 rounded-md border-0 border-b-2" />
        </div>
        <button type="submit" class="w-full bg-purple-800 text-white font-semibold py-2 px-4 rounded-md">
          Trimite
        </button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      business: Object,
    },
    methods: {
      submitForm() {
        // Handle form submission logic
      }
    }
  };
  </script>
  
  <style scoped>
  /* Add specific styles if necessary */
  </style>
  