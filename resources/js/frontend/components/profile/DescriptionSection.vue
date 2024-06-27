<template>
  <div class="bg-white p-6 shadow rounded-lg relative">
    <h2 class="text-gray-800 font-semibold mb-4 flex items-center">
      Descriere
      <button @click="toggleEdit" v-if="isOwner" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900">
        <font-awesome-icon icon="pencil" />
      </button>
    </h2>

    <form v-if="editing" @submit.prevent="saveDescription">
      <textarea v-model="formData.description" class="border p-2 w-full rounded"></textarea>
      <div class="mt-4 flex justify-end space-x-4">
        <button type="button" @click="cancelEdit" class="border border-gray-300 text-gray-600 px-4 py-2 rounded-md mr-2">Anulează</button>
        <button type="submit" class="bg-purple-500 text-white px-4 py-2 rounded-md">Salvează</button>
      </div>
    </form>

    <div v-else>
      <p>{{ business.short_description }}</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import notification from '@/utils/notifications'; // Assuming you have a notification utility

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
      formData: {
        description: this.business.short_description,
      }
    };
  },
  methods: {
    toggleEdit() {
      this.editing = !this.editing;
      if (this.editing) {
        this.formData.description = this.business.short_description;
      }
    },
    cancelEdit() {
      this.editing = false;
      this.formData.description = this.business.short_description;
    },
    saveDescription() {
      axios.put(`/business/${this.business.slug}/schimba-descriere`, this.formData)
        .then(response => {
          notification.success(response.data.message);
          this.business.short_description = this.formData.description;
          this.editing = false;
        })
        .catch(error => {
          console.error('Error updating essentials section:' + error);
          notification.error('Nu s-a putut face actualizarea: ');
        });
    },
  }
};
</script>

<style scoped>
/* Add specific styles if necessary */
</style>
