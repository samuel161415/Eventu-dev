<template>
    <div class="mt-12">
      <h2 class="text-2xl font-semibold mb-4">Te-ar putea interesa și:</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div v-for="recommendation in recommendations" :key="recommendation.id" class="bg-white shadow rounded-lg overflow-hidden">
          <img :src="recommendation.image" class="w-full h-48 object-cover" />
          <div class="p-4">
            <h3 class="text-lg font-semibold">{{ recommendation.name }}</h3>
            <p class="text-gray-500">{{ recommendation.location }}</p>
            <p class="text-gray-900 font-bold">{{ recommendation.price }}</p>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      recommendations: Array,
    }
  };
  </script>
  
  <style scoped>
  /* Add specific styles if necessary */
  </style>
  