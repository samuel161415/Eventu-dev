<template>
  <div :class="['bg-white p-0 rounded-lg shadow', { 'lg:row-span-2': large }]" class="shadow-md">
    <img :src="post.image" alt="Post Image"
      :class="['w-full rounded-lg', { 'h-80 object-cover': large, 'h-40 object-cover': !large, 'h-60 object-cover': recent }]" />
    <div class="mt-4 px-4 pb-2 flex flex-col justify-between max-h-full">
      <div class="h-full max-h-full">
        <h3 class="leading-5 text-md font-semibold text-gray-800">{{ truncateText(post.title, 7) }}</h3>
        <p class="text-gray-500 mt-1">{{ truncateText(post.content, large ? 1000 : (recent ? 20 : 8)) }}</p>
      </div>
      <div class="flex justify-end">
        <Link :href="`/blog/${post.slug}`" class="mt-4 px-4 py-1 bg-purple-600 text-white rounded-lg">
          Citește articolul
        </Link>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/vue3'

export default {
  name: 'BlogPostCard',
  components: {
    Link,
  },
  props: {
    post: Object,
    large: {
      type: Boolean,
      default: false,
    },
    recent: {
      type: Boolean,
      default: false,
    },
  },
  methods: {
    truncateText(text, length) {
      const words = text.split(' ');
      if (words.length <= length) {
        return text;
      }
      return words.slice(0, length).join(' ') + '...';
    }
  }
};
</script>

<style scoped>
</style>
