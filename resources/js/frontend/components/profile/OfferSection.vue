<template>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <!-- Offer 1: Invitati -->
    <div v-if="business.min_people !== null && business.max_people !== null" 
         class="bg-white p-6 shadow rounded-lg text-center relative">
      <h2 class="text-gray-800 font-semibold mb-2">Invitati</h2>
      <div class="flex justify-between px-4">
        <p class="text-sm text-gray-500 mb-2">Min: {{ business.min_people }}</p>
        <p class="text-sm text-gray-500 mb-2">Max: {{ business.max_people }}</p>
      </div>
      <a href="#" class="text-purple-500">Cere o ofertă personalizată</a>

      <!-- Edit Button -->
      <button v-if="isOwner" @click="editOffer('invitati')" class="absolute top-0 right-0 mt-2 mr-2 text-gray-500 hover:text-gray-700">
        <font-awesome-icon icon="pencil" />
      </button>

      <!-- Edit Form -->
      <div v-if="editingOffer === 'invitati'" class="absolute inset-0 bg-white bg-opacity-90 flex items-center justify-center">
        <div class="bg-white p-6 shadow rounded-lg text-center">
          <h2 class="text-gray-800 font-semibold mb-2">Edit Invitati</h2>
          <div class="flex justify-between px-4 mb-4">
            <input v-model="editData.min_people" type="number" class="border rounded p-2 w-20 text-center" placeholder="Min" />
            <input v-model="editData.max_people" type="number" class="border rounded p-2 w-20 text-center" placeholder="Max" />
          </div>
          <div class="flex justify-center space-x-4">
            <button @click="saveOffer('invitati')" class="border border-purple-500 text-purple-500 px-4 py-2 rounded-md text-sm font-medium">Save</button>
            <button @click="cancelEdit('invitati')" class="border border-red-500 text-red-500 px-4 py-2 rounded-md text-sm font-medium">Cancel</button>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Offer 2: Botez -->
    <div v-if="business.pret_min_botez !== null"
         class="bg-white p-6 shadow rounded-lg text-center relative">
      <h2 class="text-gray-800 font-semibold mb-2">Botez</h2>
      <p class="text-gray-600 mb-2">de la: <span class="text-black font-bold">€ {{ business.pret_min_botez }}</span> / pers</p>
      <a href="#" class="text-purple-500">Cere o ofertă personalizată</a>

      <!-- Edit Button -->
      <button v-if="isOwner" @click="editOffer('botez')" class="absolute top-0 right-0 mt-2 mr-2 text-gray-500 hover:text-gray-700">
        <font-awesome-icon icon="pencil" />
      </button>

      <!-- Edit Form -->
      <div v-if="editingOffer === 'botez'" class="absolute inset-0 bg-white bg-opacity-90 flex items-center justify-center">
        <div class="bg-white p-6 shadow rounded-lg text-center">
          <h2 class="text-gray-800 font-semibold mb-2">Edit Botez</h2>
          <div class="flex justify-center mb-4">
            <input v-model="editData.pret_min_botez" type="number" class="border rounded p-2 w-32 text-center" placeholder="Price" />
          </div>
          <div class="flex justify-center space-x-4">
            <button @click="saveOffer('botez')" class="border border-purple-500 text-purple-500 px-4 py-2 rounded-md text-sm font-medium">Save</button>
            <button @click="cancelEdit('botez')" class="border border-red-500 text-red-500 px-4 py-2 rounded-md text-sm font-medium">Cancel</button>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Offer 3: Nunta -->
    <div v-if="business.pret_min_nunta !== null"
         class="bg-white p-6 shadow rounded-lg text-center relative">
      <h2 class="text-gray-800 font-semibold mb-2">Nunta</h2>
      <p class="text-gray-600 mb-2">de la: <span class="text-black font-bold">€ {{ business.pret_min_nunta }}</span> / pers</p>
      <a href="#" class="text-purple-500">Cere o ofertă personalizată</a>

      <!-- Edit Button -->
      <button v-if="isOwner" @click="editOffer('nunta')" class="absolute top-0 right-0 mt-2 mr-2 text-gray-500 hover:text-gray-700">
        <font-awesome-icon icon="pencil" />
      </button>

      <!-- Edit Form -->
      <div v-if="editingOffer === 'nunta'" class="absolute inset-0 bg-white bg-opacity-90 flex items-center justify-center">
        <div class="bg-white p-6 shadow rounded-lg text-center">
          <h2 class="text-gray-800 font-semibold mb-2">Edit Nunta</h2>
          <div class="flex justify-center mb-4">
            <input v-model="editData.pret_min_nunta" type="number" class="border rounded p-2 w-32 text-center" placeholder="Price" />
          </div>
          <div class="flex justify-center space-x-4">
            <button @click="saveOffer('nunta')" class="border border-purple-500 text-purple-500 px-4 py-2 rounded-md text-sm font-medium">Save</button>
            <button @click="cancelEdit('nunta')" class="border border-red-500 text-red-500 px-4 py-2 rounded-md text-sm font-medium">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { useForm } from "@inertiajs/vue3";
import notification from '../../../utils/notifications'; 

export default {
  props: {
    business: {
      type: Object,
      required: true,
      default: () => ({
        min_people: null,
        max_people: null,
        pret_min_botez: null,
        pret_min_nunta: null
      })
    },
    isOwner: {
      type: Boolean,
      required: true
    }
  },
  data() {
    return {
      editingOffer: null,
      editData: {
        min_people: null,
        max_people: null,
        pret_min_botez: null,
        pret_min_nunta: null
      }
    };
  },
  methods: {
    editOffer(type) {
      this.editingOffer = type;
      // Populate editData with current values
      if (type === 'invitati') {
        this.editData.min_people = this.business.min_people;
        this.editData.max_people = this.business.max_people;
      } else if (type === 'botez') {
        this.editData.pret_min_botez = this.business.pret_min_botez;
      } else if (type === 'nunta') {
        this.editData.pret_min_nunta = this.business.pret_min_nunta;
      }
    },
    async saveOffer(type) {
      try {
        const response = await axios.put(`/business/${this.business.slug}/schimba-preturi`, this.editData);
        notification.success(response.data.message); 
        if (type === 'invitati') {
          this.business.min_people = this.editData.min_people;
          this.business.max_people = this.editData.max_people;
        } else if (type === 'botez') {
          this.business.pret_min_botez = this.editData.pret_min_botez;
        } else if (type === 'nunta') {
          this.business.pret_min_nunta = this.editData.pret_min_nunta;
        }
        this.cancelEdit(type);
      } catch (error) {
        const errorMessage = 'Eroare: ' + error.response.data.message;
        notification.error(errorMessage); 
      }
    },
    cancelEdit(type) {
      this.editingOffer = null;
      // Clear editData
      this.editData = {
        min_people: null,
        max_people: null,
        pret_min_botez: null,
        pret_min_nunta: null
      };
    }
  }
};
</script>

<style scoped>
/* Add specific styles if necessary */
</style>
