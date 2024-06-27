<template>
  <div class="bg-white p-6 shadow rounded-lg relative">
    <h2 class="text-gray-800 font-semibold mb-4 flex items-center">
      <i class="fas fa-list-ul mr-2"></i> Esențiale
      <button @click="toggleEdit" v-if="isOwner" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900">
        <font-awesome-icon icon="pencil" />
      </button>
    </h2>

    <form v-if="editing" @submit.prevent="saveChanges">
      <div class="grid grid-cols-2 gap-4">
        <div v-if="showCity" class="flex items-center">
          <i class="fas fa-city mr-2 text-gray-400"></i>
          <input v-model="formData.city" type="text" class="border p-2 rounded" placeholder="Oraș">
        </div>
        <div v-if="showDistrict" class="flex items-center">
          <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>
          <input v-model="formData.district" type="text" class="border p-2 rounded" placeholder="Zonă">
        </div>
        <div v-if="showAddress" class="flex items-center">
          <i class="fas fa-map-pin mr-2 text-gray-400"></i>
          <input v-model="formData.address" type="text" class="border p-2 rounded" placeholder="Adresă">
        </div>
      </div>

      <div class="mt-4 flex justify-end">
        <button type="button" @click="cancelEdit" class="border border-gray-300 text-gray-600 px-4 py-2 rounded-md mr-2">Anulează</button>
        <button type="submit" class="bg-purple-500 text-white px-4 py-2 rounded-md">Salvează</button>
      </div>
    </form>

    <div v-else class="grid grid-cols-2 gap-4">
      <div v-if="showCity" class="flex items-center">
        <i class="fas fa-city mr-2 text-gray-400"></i>
        <p class="text-gray-600"><strong>Oraș:</strong> {{ business.city }}</p>
      </div>
      <div v-if="showDistrict" class="flex items-center">
        <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>
        <p class="text-gray-600"><strong>Zonă:</strong> {{ business.district }}</p>
      </div>
      <div v-if="showAddress" class="flex items-center">
        <i class="fas fa-map-pin mr-2 text-gray-400"></i>
        <p class="text-gray-600"><strong>Adresă:</strong> {{ business.address }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';
import axios from 'axios';
import notification from '@/utils/notifications';

export default {
  props: {
    business: Object,
    isOwner: {
      type: Boolean,
      required: true
    }
  },
  
  data() {
    return {
      editing: false,
      showCity: true, 
      showDistrict: true,
      showAddress: true,
      showSpecific: true,
      formData: {
        city: this.business.city || '',
        district: this.business.district || '',
        address: this.business.address || '',
      },
    };
  },
  methods: {
    toggleEdit() {
      this.editing = !this.editing;
    },
    cancelEdit() {
      this.editing = false;
      this.formData = {
        city: this.business.city || '',
        district: this.business.district || '',
        address: this.business.address || ''
      };
    },
    saveChanges() {
      axios.put(`/business/${this.business.slug}/schimba-esentiale`, this.formData)
        .then(response => {
          notification.success(response.data.message);
          this.business.city = this.formData.city;
          this.business.district = this.formData.district;
          this.business.address = this.formData.address;
          this.editing = false;
        })
        .catch(error => {
          console.error('Error updating essentials section:', error.response.data.message);
          notification.error('Nu s-a putut face actualizarea: ' + error.response.data.message);
        });
    },
  },
  created(){
    // console.log(this.$page.props.isOwner);
  }
};
</script>

<style scoped>
/* Add specific styles if necessary */
</style>
