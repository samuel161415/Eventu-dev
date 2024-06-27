<template>
	<div>
	  <div class="stats flex justify-between mb-6">
		<div class="stat-box purple">
		  <div class="count">{{ publishedListings }}</div>
		  <div class="label">Listări publicate</div>
		</div>
		<div class="stat-box purple">
		  <div class="count">{{ pendingListings }}</div>
		  <div class="label">Listări în așteptare</div>
		</div>
		<div class="stat-box purple">
		  <div class="count">{{ activePromotions }}</div>
		  <div class="label">Promoții active</div>
		</div>
		<div class="stat-box blue">
		  <div class="count">{{ weeklyVisits }}</div>
		  <div class="label">Vizite săptămâna aceasta</div>
		</div>
	  </div>
	  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
  
		<div v-for="salon in salons" :key="salon.id" class="p-4 bg-white rounded-lg shadow">
		  <div class="flex justify-between items-center mb-4">
			<span class="px-2 py-1 text-xs rounded-full bg-gray-100">{{ salon.type }}</span>
			<span
			  :class="['px-2 py-1 text-xs rounded-full', salon.status === 'Expired' ? 'bg-red-200' : 'bg-green-200']">{{
				salon.status }}</span>
		  </div>
		  <div class="flex flex-wrap flex-col items-center mb-4">
			<img src="/images/eventu-hero.jpg" alt="" class="w-10 h-10 rounded-full mr-4">
			<div>
			  <h4 class="text-lg font-bold text-center">{{ salon.salon_name }}</h4>
			  <!-- <p class="text-gray-600">{{ salon.description }}</p> -->
			</div>
		  </div>
		  <div class="flex justify-between flex-col items-center">
			<div class="flex justify-center w-full my-3">
			  <Link :href="`/business/${salon.id}/profile`" class="bg-gray-200 text-gray-800 py-1 px-3 rounded-md mr-2">Editeaza</Link>
			  <button class="bg-red-200 text-gray-800 py-1 px-3 rounded-md">Sterge</button>
			</div>
			<div class="flex justify-between w-full my-2">
			  <p class="text-sm text-gray-600">Created: {{ formatDate(salon.created_at) }}</p>
			  <!-- <p class="text-sm text-gray-600">Expires: {{ formatDate(salon.expires_at) }}</p> -->
			</div>
			<div class="flex space-x-2">
			  <button class="text-gray-600 hover:text-gray-800"><i class="fas fa-edit"></i></button>
			  <button class="text-gray-600 hover:text-gray-800"><i class="fas fa-chart-bar"></i></button>
			  <button class="text-gray-600 hover:text-gray-800"><i class="fas fa-trash"></i></button>
			</div>
		  </div>
		</div>
  
		<div v-for="foodMenu in foodMenus" :key="foodMenu.id" class="p-4 bg-white rounded-lg shadow">
		  <div class="flex justify-between items-center mb-4">
			<span class="px-2 py-1 text-xs rounded-full bg-gray-100">Meniu</span>
			<span
			  :class="['px-2 py-1 text-xs rounded-full', foodMenu.status === 'Expired' ? 'bg-red-200' : 'bg-green-200']">{{
				foodMenu.status }}</span>
		  </div>
		  <div class="flex flex-wrap flex-col items-center mb-4">
			<img src="/images/eventu-hero.jpg" alt="" class="w-10 h-10 rounded-full mr-4">
			<div>
			  <h4 class="text-lg font-bold text-center">{{ foodMenu.menu_name }}</h4>
			  <p class="text-gray-600">{{ foodMenu.short_description }}</p>
			</div>
		  </div>
		  <div class="flex justify-between items-center">
			<div class="flex justify-between w-full">
			  <p class="text-sm text-gray-600">Created: {{ formatDate(foodMenu.created_at) }}</p>
			  <!-- <p class="text-sm text-gray-600">Expires: {{ formatDate(foodMenu.expires_at) }}</p> -->
			</div>
			<div class="flex space-x-2">
			  <Link :href="`/business/${foodMenu.id}/profile`" class="text-gray-600 hover:text-gray-800"><i class="fas fa-edit"></i></Link>
			  <button class="text-gray-600 hover:text-gray-800"><i class="fas fa-chart-bar"></i></button>
			  <button class="text-gray-600 hover:text-gray-800"><i class="fas fa-trash"></i></button>
			</div>
		  </div>
		</div>
	  </div>
	</div>
  </template>
  
  <script>
  import { Link } from '@inertiajs/vue3';
  
  export default {
	name: 'Listings',
	props: {
	  salons: {
		type: Array,
		required: true
	  },
	  foodMenus: {
		type: Array,
		required: true
	  }
	},
	methods: {
	  formatDate(dateString) {
		const options = { year: 'numeric', month: 'long', day: 'numeric' };
		return new Date(dateString).toLocaleDateString(undefined, options);
	  }
	},
	components: {
	  Link,
	},
  };
  </script>
  
  <style scoped>
  .stats {
	display: flex;
	justify-content: space-between;
  }
  
  .stat-box {
	width: 22%;
	padding: 20px;
	border-radius: 8px;
	color: #fff;
	text-align: center;
  }
  
  .stat-box.purple {
	background-color: #8224E3;
  }
  
  .stat-box.blue {
	background-color: #0076ff;
  }
  
  .stat-box .count {
	font-size: 36px;
	margin-bottom: 10px;
  }
  
  .stat-box .label {
	font-size: 18px;
  }
  </style>
  