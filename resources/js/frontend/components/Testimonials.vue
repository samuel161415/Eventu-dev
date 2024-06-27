<template>
  <section class="testimonials py-12">
    <h2 class="text-center text-3xl mb-8">What Our Users Say</h2>
    <div class="flex justify-center space-x-8">
      <div class="testimonial text-center" v-for="testimonial in testimonials" :key="testimonial.id">
        <p class="mb-4">{{ testimonial.message }}</p>
        <h4 class="font-bold">{{ testimonial.name }}</h4>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "Testimonials",
  props: {
    testimonials: Array
  }
};
</script>

<style scoped>
/* Add additional styles here if needed */
</style>
