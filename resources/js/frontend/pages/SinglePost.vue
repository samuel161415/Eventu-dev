<template>
    <div>
      <FrontendHeader />
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ post.title }}</h1>
        <div class="flex justify-between items-center mb-6">
          <span class="text-gray-500">{{ post.category }}</span>
          <button class="flex items-center space-x-2 text-gray-700 border px-3 py-1 rounded-full">
            <span>Distribuie</span>
          </button>
        </div>
        <img src="/images/eventu-hero.jpg" alt="Post Image" class="w-full h-96 object-cover rounded-lg mb-12" />
        <div v-html="post.content" class="prose prose-lg max-w-5xl mx-auto"></div>
      </div>
      <Footer />
    </div>
  </template>
  
  <script>
  import FrontendHeader from '../components/Header.vue';
  import Footer from '../components/Footer.vue';
  
  export default {
    name: 'SinglePost',
    components: {
      FrontendHeader,
      Footer
    },
    props: {
      post: Object
    }
  };
  </script>
  
  <style scoped>
  /* Add specific styles if necessary */
  </style>
  