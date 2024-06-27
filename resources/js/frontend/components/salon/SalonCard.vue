<template>
  <div @click="$emit('open-modal', salon)" class="relative cursor-pointer">
    <img src="/images/eventu-hero.jpg" class="w-full h-64 object-cover rounded-lg" />
    <div
      class="absolute inset-0 bg-black bg-opacity-50 opacity-0 hover:opacity-100 transition duration-300 flex items-center justify-center text-white text-lg font-bold">
      {{ salon.salon_name }}
    </div>
  </div>
</template>

<script>
export default {
  name: 'SalonCard',
  props: {
    salon: Object
  },

}
</script>

<style scoped></style>
