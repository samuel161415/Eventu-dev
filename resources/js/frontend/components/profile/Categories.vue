<template>
    <div class="bg-white p-6 shadow rounded-lg">
      <h2 class="text-gray-800 font-semibold mb-4">Categorii</h2>
      <div class="flex space-x-4">
        <div v-for="category in categories" :key="category.id" class="text-center">
          <div class="bg-purple-100 text-purple-500 px-4 py-2 rounded-full">{{ category.name }}</div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      categories: Array,
    }
  };
  </script>
  
  <style scoped>
  /* Add specific styles if necessary */
  </style>
  