<template>
	<header class="text-white"
	  :class="isHomepage ? 'absolute top-0 left-0 w-full z-10' : 'text-white bg-gray-800 shadow-lg'">
	  <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
		<div class="flex items-center space-x-4">
		  <Link href="/" class="max-h-full">
			<img :src="logoUrl" class="w-auto logo mb-2" alt="Logo">
		  </Link>
		</div>
		<div class="hidden md:flex items-center space-x-4">
		  <Link href="/" class="hover:text-gray-300">Acasă</Link>
		  <Link href="/descopera" class="hover:text-gray-300">Descoperă</Link>
		  <Link href="/resurse" class="hover:text-gray-300">Resurse</Link>
		  <template v-if="isLoggedIn">
			<Link href="/dashboard" class="hover:text-gray-300">Dashboard</Link>
			<form @submit.prevent="logout">
			  <button type="submit" class="hover:text-gray-300">Logout</button>
			</form>
		  </template>
		  <template v-else>
			<a href="/login" class="hover:text-gray-300">Intră în cont</a>
		  </template>
		</div>
		<div class="md:hidden flex items-center">
		  <button @click="toggleMenu" class="text-white focus:outline-none">
			<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
			  xmlns="http://www.w3.org/2000/svg">
			  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
				d="M4 6h16M4 12h16m-7 6h7"></path>
			</svg>
		  </button>
		</div>
	  </nav>
	  <div v-if="isMenuOpen" class="md:hidden bg-gray-800 text-white px-2 pt-2 pb-3 space-y-1 sm:px-3">
		<Link href="/" class="block hover:bg-gray-700 px-3 py-2 rounded-md">Acasă</Link>
		<Link href="/descopera" class="block hover:bg-gray-700 px-3 py-2 rounded-md">Descoperă</Link>
		<Link href="/resurse" class="block hover:bg-gray-700 px-3 py-2 rounded-md">Resurse</Link>
		<template v-if="isLoggedIn">
		  <Link href="/dashboard" class="block hover:bg-gray-700 px-3 py-2 rounded-md">Dashboard</Link>
		  <form @submit.prevent="logout">
			<button type="submit" class="block hover:bg-gray-700 px-3 py-2 rounded-md w-full text-left">Logout</button>
		  </form>
		</template>
		<template v-else>
			<Link href="/login" class="block hover:bg-gray-700 px-3 py-2 rounded-md">Intră în cont</Link>
		</template>
	  </div>
	</header>
  </template>
  
  <script>
  import { Link, useForm, usePage } from '@inertiajs/vue3';
  
  export default {
	components: {
	  Link,
	},
	name: "FrontendHeader",
	computed: {
	  ...usePage().props,
	  isLoggedIn() {
		return this.$page.props.isLoggedIn;
	  },
	},
	props: {
	  isHomepage: {
		type: Boolean,
		default: false
	  },
	},
	data() {
	  return {
		logoUrl: '/images/white.png',
		isMenuOpen: false
	  };
	},
	methods: {
	  toggleMenu() {
		this.isMenuOpen = !this.isMenuOpen;
	  },
	  logout() {
		this.$inertia.post('/logout');
	  }
	}
  };
  </script>
  
  <style scoped>
  .logo {
	max-width: 150px;
  }
  </style>
  