<template>
	<section class="hero bg-cover bg-center h-screen relative">
	  <div class="bg-black bg-opacity-50 h-full flex flex-col justify-center items-center text-center px-4">
		<h1 class="font-bold text-white text-4xl md:text-6xl mb-4 max-w-lg md:max-w-4xl">Descopera locatii grozave pentru evenimentul tau</h1>
		<p class="text-white text-lg mb-8 max-w-lg md:max-w-2xl">Ghidul tau in alegerea locatiei perfecte.</p>
		<form @submit.prevent="submitSearch" class="bg-white rounded-md md:rounded-full shadow-lg flex flex-wrap justify-center items-start space-y-4 md:space-y-0 md:space-x-4 p-4 md:px-4 md:py-4 w-full md:max-w-5xl items-center">
		  <div class="flex flex-col items-start w-full md:w-auto min-w-56">
			<label for="location" class="font-bold text-gray-700">Unde?</label>
			<div class="relative w-full">
			  <select v-model="form.location" id="location" class="border-0 border-b-2 boeder-slate-500 text-sm outline-none p-2 bg-transparent text-gray-900 focus:outline-none w-full custom-select">
				<option value="" disabled>Alege locația</option>
				<option v-for="location in locations" :key="location.id" :value="location.name">{{ location.name }}</option>
			  </select>
			</div>
		  </div>
		  <div class="flex flex-col items-start w-full md:w-auto min-w-56">
			<label for="eventType" class="font-bold text-gray-700">Tip Eveniment</label>
			<div class="relative w-full">
			  <select v-model="form.eventType" id="eventType" class="border-0 border-b-2 boeder-slate-500 text-sm outline-none border-0 p-2 bg-transparent text-gray-900 focus:outline-none w-full custom-select">
				<option value="" disabled selected>Tipul evenimentului</option>
				<option v-for="category in eventCategories" :key="category.id" :value="category.name">{{ category.name }}</option>
			  </select>
			</div>
		  </div>
		  <div class="flex flex-col items-start w-full md:w-auto min-w-56">
			<label for="capacity" class="font-bold text-gray-700">Cate persoane?</label>
			<input v-model="form.capacity" id="capacity" class="custom-select focus:outline-none w-fulltext-sm outline-none border-0 p-2 bg-transparent placeholder-gray-400 text-gray-900 focus:outline-none w-full outline-zero" type="text" placeholder="Cate persoane?">
		  </div>
		  <button type="submit" class="bg-eventuPurple text-white px-8 py-2 rounded-full w-full md:w-auto mt-4 md:mt-0">Cauta</button>
		</form>
	  </div>
	</section>
  </template>
  
  <script>
  import { ref } from 'vue';
  import { usePage } from '@inertiajs/vue3';
  import notification from '../../utils/notifications'; // Import your notification system
  
  export default {
	name: "Hero",
	data() {
	  return {
		form: {
		  location: '',
		  eventType: [],
		  capacity: ''
		}
	  };
	},
	methods: {
	  async submitSearch() {     
		try {
		  // Perform form submission via Inertia.js
		  await this.$inertia.visit(route('search', {
			location: this.form.location,
			eventType: Array.isArray(this.form.eventType) ? this.form.eventType : [this.form.eventType],
			capacity: this.form.capacity
		  }));
		} catch (error) {      
		  // Display error notification based on error response
		  if (error.response && error.response.status === 422) {
			const errors = error.response.data;
			if (errors && errors['eventType']) {
			  notification.error(errors['eventType']);
			} else {
			  notification.error('There was an error processing your request.');
			}
		  } else {
			notification.error('There was an unexpected error.');
		  }
		}
	  }
	},
	setup() {
	  const { data } = usePage().props;
  
	  const locations = ref(data.locations);
	  const eventCategories = ref(data.eventCategories);
  
	  return {
		locations,
		eventCategories
	  };
	}
  };
  </script>
  
  <style scoped>
  .outline-zero:focus{
	outline:none!important;
	box-shadow:none;
	border-bottom:2px solid #333;
	border-radius:0.5rem;
  }
  .hero {
	background-image: url('/images/eventu-hero.jpg');
	background-size: cover;
	background-position: center;
  }
  
  .custom-select {
	padding-top: 0.25rem;
    padding-bottom: 0.25rem;
	appearance: none;
	font-size: 14px;
	line-height: 1.5;
	border-radius: 8px;
	/* border: 1px solid #ccc; */
	width: 100%;
	transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
	position: relative;
  }
  
  .custom-select select {
	padding-right: 32px; /* Space for the arrow */
  }
  
  .custom-select:hover {
	border-color: #8224E3; /* Eventu Purple */
  }
  
  .custom-select:focus {
	outline: none;
	border-color: #8224E3; /* Eventu Purple */
	box-shadow: 0 0 0 0.2rem rgba(130, 36, 227, 0.25); /* Eventu Purple shadow */
  }
  
  .custom-select option {
	margin: 8px 0; /* Increased margin for better spacing */
	background-color: #8224E3; /* Eventu Purple */
	color: white;
	font-weight: 600; /* Semibold */
	padding: 10px 16px; /* Adjust padding */
	border-radius: 8px; /* Rounded ends */
	transition: background-color 0.15s ease-in-out, color 0.15s ease-in-out;
  }
  
  .custom-select option:hover {
	background-color: white;
	color: #333; /* Dark text */
  }
  
  .arrow-icon {
	position: absolute;
	right: 10px;
	top: 50%;
	transform: translateY(-50%);
  }
  </style>
  