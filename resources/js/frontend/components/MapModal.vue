<template>
    <transition name="fade">
      <div v-if="isOpen" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg relative w-full h-full max-w-4xl">
          <button @click="closeModal" class="absolute top-4 right-4 bg-red-600 text-white px-2 py-1 rounded-full z-500">Închide</button>
          <MapModalComponent :locations="locations" />
        </div>
      </div>
    </transition>
  </template>
  
  <script>
  import MapModalComponent from './MapModalComponent.vue';
  
  export default {
    props: {
      isOpen: {
        type: Boolean,
        required: true
      },
      locations: {
        type: Array,
        required: true
      }
    },
    methods: {
      closeModal() {
        this.$emit('close');
      }
    },
    components: {
      MapModalComponent
    }
  };
  </script>
  
  <style scoped>
  .fade-enter-active, .fade-leave-active {
    transition: opacity 0.5s;
  }
  .fade-enter, .fade-leave-to {
    opacity: 0;
  }
  .z-500{
    z-index:500!important;
  }
  </style>
  