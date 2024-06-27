<template>
  <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
    <img :src="location.cover_photo_url" alt="Location Image" class="w-full h-48 object-cover">
    <div class="p-4">
      <router-link :to="`/business/${location.id}`">
        <Link :href="`/business/${location.slug}`">
          <h3 class="text-xl font-semibold">{{ location.name }}</h3>
        </Link>
      </router-link>
      <p class="text-gray-500 mt-2 flex items-center">
        <font-awesome-icon icon="map-marker-alt" class="mr-2" />{{ truncatedAddress }}
      </p>
      <p class="text-gray-500 mt-2 flex items-center">
        <font-awesome-icon icon="users" class="mr-2" /> {{ location.min_people }} - {{ location.max_people }} people
      </p>
      <p class="text-gray-500 mt-2 flex items-center">
        <font-awesome-icon icon="dollar-sign" class="mr-2" /> De la ${{ location.price }} nunta
      </p>
      <div class="flex flex-wrap mt-4">
        <button v-for="category in location.event_categories" :key="category.id"
          class="bg-customPurple text-white px-4 py-1 rounded-lg flex items-center m-1">
          <font-awesome-icon icon="ring" class="mr-2" /> {{ category.name }}
        </button>
      </div>
      <div class="flex justify-between items-center mt-4">
        <div class="flex space-x-2 text-gray-500">
          <router-link :to="`/business/${location.id}`">
            <font-awesome-icon icon="search" />
          </router-link>
          <router-link to="#">
            <font-awesome-icon icon="heart" />
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faMapMarkerAlt, faUsers, faDollarSign, faRing, faSearch, faHeart } from '@fortawesome/free-solid-svg-icons';
import { Link } from '@inertiajs/vue3';

export default {
  name: 'LocationCard',
  components: {
    FontAwesomeIcon,
    Link,
  },
  props: {
    location: {
      type: Object,
      required: true,
    },
  },
  computed: {
    truncatedAddress() {
      const address = `${this.location.address} ${this.location.number}, ${this.location.city}`;
      return address.length > 20 ? address.slice(0, 65) + '...' : address;
    },
  },
};
</script>

<style scoped>
.bg-customPurple {
  background-color: #8224E3;
}
</style>