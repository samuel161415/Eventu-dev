<template>
	<section class="resources py-12">
	  <h2 class="text-center text-3xl mb-2 font-bold">RESURSE</h2>
	  <p class="text-center text-gray-500 mb-8">Informatii utile pentru organizarea unui eveniment perfect.</p>
	  <div class="grid grid-cols-1 md:grid-cols-4 gap-5 max-w-7xl mx-auto px-4">
		<div v-for="(post, index) in posts.data" :key="post.id"
		  :class="index === 0 ? 'col-span-1 md:col-span-2 md:row-span-2' : ''"
		  class="bg-white rounded-2xl shadow-lg overflow-hidden">
		  <div class="relative">
			<img :class="index === 0 ? 'h-3/5' : 'h-48'" class="w-full object-cover rounded-t-2xl"
			  :src="post.image" alt="Resource image">
		  </div>
  
		  <div class="p-2">
			<h3 class="leading-5 text-md font-semibold text-gray-800">{{ truncateText(post.title, 30) }}</h3>
			<p class="text-gray-500 mt-1">{{ truncateText(post.content, index === 0 ? 570 : 50) }}</p>
			<div class="flex justify-end">
			  <Link :href="`/blog/${post.slug}`" class="bg-eventuPurple text-white px-4 py-1 rounded-lg mt-4">Vezi mai mult</Link>
			</div>
		  </div>
		</div>
	  </div>
	</section>
  </template>
  
  <script>
  import { Link, usePage } from '@inertiajs/vue3';
  
  export default {
	name: "Blog",
	components: {
	  Link,
	},
	props: {
	  posts: {
		type: Object,
		required: true
	  }
	},
	methods: {
	  truncateText(text, length) {
		if (text.length <= length) {
		  return text;
		}
		return text.substring(0, length) + '...';
	  },
	  route(name, params) {
		const page = usePage();
		return page.props.routes[name].replace(/{([^}]+)}/g, (_, key) => params[key]);
	  }
	}
  };
  </script>
  
  <style scoped>
  </style>
  