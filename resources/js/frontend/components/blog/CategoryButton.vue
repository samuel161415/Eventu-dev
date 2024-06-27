<template>
    <div class="flex-shrink-0 flex flex-col align-center justify-center">
        <img src="images/eventu-hero.jpg" class="w-16 h-16 rounded-full mx-auto" alt="">
      <button class="px-4 py-2 focus:outline-none">
        {{ text }}
      </button>
    </div>
  </template>
  
  <script>
  export default {
    name: 'CategoryButton',
    props: {
      text: String,
    }
  };
  </script>
  
  <style scoped>
  /* Add specific styles if necessary */
  </style>
  