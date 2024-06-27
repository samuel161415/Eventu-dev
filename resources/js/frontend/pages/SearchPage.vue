<template>
  <div class="search-page">
    <FrontendHeader />
    <main class="flex flex-wrap relative">
      <aside class="lg:w-2/5 xl:w-1/5 w-full p-6">
        <h2 class="text-xl font-bold mb-4">Descopera</h2>
        <p class="text-sm text-gray-600 mb-8">Descopera locatii grozave pentru evenimentul tau.</p>
        <Filters :form="form" @applyFilters="fetchResults" :tags="tags" :eventTypes="eventTypes" />
      </aside>

      <div class="xl:w-2/5 lg:w-3/5 w-full p-6 bg-gray-100">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-bold">Se afiseaza {{ pagination.total }} rezultate</h2>
          <!-- <select v-model="form.sortBy" @change="fetchResults" class="p-2 border rounded">
            <option value="recent">Ultimele</option>
            <option value="popular">Populare</option>
          </select> -->
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <LocationCard v-for="location in locations" :key="location.id" :location="location" />
        </div>
        <Pagination :data="pagination" @pagination-change-page="fetchResults" />
      </div>

      <!-- Map Component, hidden on md screens, shown on larger screens -->
      <div ref="mapContainer" class="hidden xl:block xl:w-2/5 p-6">
        <MapComponent :locations="locations" />
      </div>

      <!-- Expand button for medium screens -->
      <button @click="openMapModal" class="fixed bottom-4 right-4 bg-customPurple text-white px-4 py-2 rounded shadow-lg xl:hidden">
        Expand Map
      </button>

      <!-- Map Modal -->
      <MapModal :isOpen="isMapModalOpen" :locations="locations" @close="closeMapModal" />
    </main>
    <Footer :isHomepage="false" />
  </div>
</template>

<script>
import { ref, nextTick } from 'vue';
import { useForm } from "@inertiajs/vue3";
import FrontendHeader from '../components/Header.vue';
import Footer from '../components/Footer.vue';
import Filters from '../components/Filters.vue';
import LocationCard from '../components/LocationCard.vue';
import MapComponent from '../components/Map.vue';
import Pagination from '../components/Pagination.vue';
import notification from '../../utils/notifications';
import MapModal from '../components/MapModal.vue';

export default {
  name: "SearchPage",
  components: {
    FrontendHeader,
    Footer,
    Filters,
    LocationCard,
    MapComponent,
    Pagination,
    MapModal
  },
  props: {
    initialLocations: {
      type: Object,
      required: true
    },
    filters: {
      type: Object,
      default: () => ({
        capacity: '',
        sortBy: 'recent',
        location: '',
        tags: [],
        eventType: []
      })
    },
    tags: {
      type: Array,
      required: true
    },
    eventTypes: {
      type: Array,
      required: true
    }
  },
  setup(props) {
    const form = useForm({
      capacity: props.filters.capacity || '',
      sortBy: props.filters.sortBy || 'recent',
      location: props.filters.location || '',
      tags: props.filters.tags || [],
      eventType: props.filters.eventType || []
    });

    const locations = ref(props.initialLocations.data);
    const pagination = ref(props.initialLocations);
    const isMapModalOpen = ref(false);
    const mapContainer = ref(null);

    // Function to fetch results
    const fetchResults = (page = 1) => {
      form.get(route('search'), {
        preserveState: true,
        preserveScroll: true,
        onSuccess: (page) => {
          // console.log('Page response:', page.props.initialLocations.data);
          locations.value = page.props.initialLocations.data;
          pagination.value = page.props.initialLocations;
        },
        onError: (errors) => {
          // console.log('Error response:', errors['eventType']);
          if (errors) {
            notification.error(errors['eventType']);
          }
        }
      });
    };

    const openMapModal = () => {
      destroyMapInstance(); // Destroy the existing map instance
      isMapModalOpen.value = true;
      nextTick(() => {
        document.dispatchEvent(new Event('map-toggle'));
      });
    };

    const closeMapModal = () => {
      isMapModalOpen.value = false;
    };

    const destroyMapInstance = () => {
      if (mapContainer.value) {
        const mapDiv = mapContainer.value.querySelector('#map');
        if (mapDiv && mapDiv._leaflet_id) {
          L.DomUtil.remove(mapDiv);
        }
      }
    };

    return {
      form,
      locations,
      pagination,
      fetchResults,
      isMapModalOpen,
      openMapModal,
      closeMapModal,
      mapContainer,
      destroyMapInstance
    };
  }
};
</script>

<style scoped>
.bg-customPurple {
  background-color: #8224E3;
}
.z-50 {
  z-index: 50;
}
</style>
