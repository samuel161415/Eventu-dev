<template>
	<div class="bg-white rounded-2xl shadow-lg overflow-hidden">
		<img :src="location.cover_photo_url" alt="Location Image" class="w-full h-48 object-cover" />
		<div class="p-4">
			<Link :href="`/business/${location.slug}`">
				<h3 class="text-xl font-semibold">{{ location.name }}</h3>
			</Link>

			<p class="text-gray-500 mt-2 flex items-center">
				<font-awesome-icon icon="map-marker-alt" class="mr-2" />{{ truncatedAddress }}
			</p>
			<p class="text-gray-500 mt-2 flex items-center">
				<font-awesome-icon icon="users" class="mr-2" /> {{ location.min_people }} - {{ location.max_people }} people
			</p>
			<p class="text-gray-500 mt-2 flex items-center">
				<font-awesome-icon icon="dollar-sign" class="mr-2" /> De la $50 nunta
			</p>
			<div class="flex flex-wrap mt-4">
				<button v-for="category in visibleCategories" :key="category.id"
					class="bg-customPurple text-white px-4 py-1 rounded-lg flex items-center m-1">
					<font-awesome-icon icon="ring" class="mr-2" /> {{ category.name }}
				</button>
				<button v-if="hiddenCategoriesCount > 0 && !showAll" @click="showAllCategories"
					class="bg-customPurple text-white px-4 py-1 rounded-lg flex items-center m-1">
					<font-awesome-icon icon="plus" class="mr-2" /> +{{ hiddenCategoriesCount }} tipuri
				</button>
				<button v-if="showAll" @click="hideAllCategories"
					class="bg-red-600 text-white px-4 py-1 rounded-lg flex items-center m-1 buton-ascunde">
					<font-awesome-icon icon="eye-slash" />
				</button>
			</div>
			<div class="flex justify-end items-center mt-4">
				<div class="flex space-x-2 text-gray-500">
					<Link as="button" :href="`/business/${location.slug}`">
						<font-awesome-icon icon="search" />
					</Link>
					<Link as="button" href="#">
						<font-awesome-icon icon="heart" />
					</Link>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
	components: {
		Link,
	},
	name: "LocationCard",
	props: {
		location: {
			type: Object,
			required: true,
		},
	},
	data() {
		return {
			showAll: false,
		};
	},
	computed: {
		truncatedAddress() {
			const address = `${this.location.address} ${this.location.number}, ${this.location.city}`;
			return address.length > 20 ? address.slice(0, 65) + '...' : address;
		},
		visibleCategories() {
			return this.showAll ? this.location.event_categories : this.location.event_categories.slice(0, 1);
		},
		hiddenCategoriesCount() {
			return this.location.event_categories.length - 1;
		}
	},
	methods: {
		showAllCategories() {
			this.showAll = true;
		},
		hideAllCategories() {
			this.showAll = false;
		}
	}
};
</script>

<style scoped>
.buton-ascunde{
	border: 1px solid red;
	background-color:white;
	color:#333;
	padding:0.5rem 0.4rem;
	border-radius: 3rem;
}
.bg-customPurple {
	background-color: #8224E3;
}
button {
  transition: all 0.3s ease-in-out;
}
</style>
