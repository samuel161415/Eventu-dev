<template>
  <section class="popular-listings py-12 bg-gray-100">
    <h2 class="text-center text-3xl mb-8">Popular Listings</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
      <div class="listing bg-white p-4 rounded shadow" v-for="listing in listings" :key="listing.id">
        <img class="mb-4 rounded" :src="listing.image" alt="Listing image">
        <h3 class="text-xl mb-2">{{ listing.title }}</h3>
        <p>{{ listing.description }}</p>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "PopularListings",
  props: {
    listings: Array
  }
};
</script>

<style scoped>
/* Add additional styles here if needed */
</style>
