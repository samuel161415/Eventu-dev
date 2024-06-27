<template>
  <section class="features py-12">
    <h2 class="text-center text-3xl mb-2 font-bold">ULTIMELE ADAUGATE</h2>
    <p class="text-center text-gray-500 mb-8">Vezi aici ultimele locatii adaugate</p>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 max-w-7xl mx-auto px-4">
      <FeaturesCard v-for="company in companies" :key="company.id" :location="company" />
    </div>
  </section>
</template>

<script>
import FeaturesCard from './FeaturesCard.vue';

export default {
  name: "Features",
  components: {
    FeaturesCard,
  },
  props: {
    companies: {
      type: Array,
      default: () => [],
    },
  },
};
</script>

<style scoped>
/* Additional styles if needed */
</style>
