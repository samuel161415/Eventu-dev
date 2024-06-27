<template>
	<div class="bg-gray-100">
		<FrontendHeader />
		<div class="relative">
			<img src="/images/eventu-hero.jpg" class="w-full h-96 object-cover" />
			<div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent h-32"></div>
			<div class="absolute bottom-4 left-4 flex items-center">
				<img src="/images/eventu-hero.jpg" class="w-20 h-20 rounded-full border-4 border-white" />
				<div class="ml-4 text-white">
					<h1 class="text-2xl font-bold">{{ business.name }}</h1>
					<p>{{ business.slogan }}</p>
				</div>
			</div>
		</div>

		<nav class="bg-white shadow-lg">
			<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
				<div class="flex justify-center align-center space-x-4 py-2">
					<button @click="activeTab = 'profil-companie'"
						:class="{ 'text-purple-700': activeTab === 'profil-companie' }"
						class="text-gray-900 hover:bg-gray-200 px-5 py-2 rounded-md text-sm font-medium">Profil
						Companie</button>
					<button @click="activeTab = 'saloane'" :class="{ 'text-purple-700': activeTab === 'saloane' }"
						class="text-gray-900 hover:bg-gray-200 px-5 py-2 rounded-md text-sm font-medium">Saloane</button>
					<button @click="activeTab = 'meniuri'" :class="{ 'text-purple-700': activeTab === 'meniuri' }"
						class="text-gray-900 hover:bg-gray-200 px-5 py-2 rounded-md text-sm font-medium">Meniuri</button>
				</div>
			</div>
		</nav>

		<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8" v-if="activeTab === 'profil-companie'">
			<div class="flex justify-center mb-6">
				<button
					class="outline mx-2 bg-none text-gray-700 outline-gray-300 rounded-full outline-1 px-4 py-2">Sună
					acum</button>
				<button
					class="outline mx-2 bg-none text-gray-700 outline-gray-300 rounded-full outline-1 px-4 py-2">Partajează</button>
				<button
					class="outline mx-2 bg-none text-gray-700 outline-gray-300 rounded-full outline-1 px-4 py-2">Trimite
					email</button>
			</div>

			<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
				<div class="lg:col-span-2 space-y-6">
					<div class="relative">
						<OfferSection :business="business" v-if="editingSection !== 'offers'" :isOwner="isOwner" />

					</div>
					<div class="relative">
						<EssentialsSection :business="business" :isOwner="isOwner" />
					</div>
					<div class="relative">
						<DescriptionSection :isOwner="isOwner":business="business" />
					</div>
					<div class="relative">
						<Tags :business="business" :isOwner="isOwner"/>
					</div>
				</div>
				<div class="space-y-6">
					<div class="relative">
						<Gallery :images="images" :isOwner="isOwner" :business="business"
							@image-deleted="handleImageDeleted" />
					</div>
					<div class="relative">
						<Categories :categories="categories" v-if="editingSection !== 'categories'" />
						<div v-if="editingSection === 'categories'">
							<textarea v-model="editData.categories" class="w-full border rounded p-2"></textarea>
							<button @click="saveSection('categories')" class="btn btn-primary mt-2">Save</button>
							<button @click="cancelEdit('categories')" class="btn btn-secondary mt-2">Cancel</button>
						</div>
						<button v-if="isOwner" @click="editSection('categories')"
							class="absolute top-0 right-0 mt-2 mr-2 text-gray-500 hover:text-gray-700">
							<font-awesome-icon icon="pencil" />
						</button>
					</div>
					<ContactForm :business="business" />
				</div>
			</div>

			<Suggestions :recommendations="recommendations" />
		</div>

		<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8" v-if="activeTab === 'saloane'">
			<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
				<SalonCard v-for="salon in salons" :key="salon.id" :salon="salon" @open-modal="openSalonModal" />
			</div>
		</div>

		<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8" v-if="activeTab === 'meniuri'">
			<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
				<FoodMenuCard v-for="foodMenu in foodMenus" :key="foodMenu.id" :foodMenu="foodMenu"
					@open-modal="openFoodMenuModal" />
			</div>
		</div>
		<FoodMenuModal :isOpen="isFoodMenuModalOpen" :foodMenu="selectedFoodMenu" @close-modal="closeFoodMenuModal" />
		<SalonModal :isOpen="isSalonModalOpen" :salon="selectedSalon" :tags="this.salons" :isOwner="isOwner" @close-modal="closeSalonModal" />

		<Footer />
	</div>
</template>

<script>
import FrontendHeader from '../components/Header.vue';
import Footer from '../components/Footer.vue';
import OfferSection from '../components/profile/OfferSection.vue';
import EssentialsSection from '../components/profile/EssentialsSection.vue';
import DescriptionSection from '../components/profile/DescriptionSection.vue';
import Tags from '../components/profile/Tags.vue';
import Gallery from '../components/profile/Gallery.vue';
import Categories from '../components/profile/Categories.vue';
import ContactForm from '../components/profile/ContactForm.vue';
import Suggestions from '../components/profile/Suggestions.vue';
import SalonModal from '../components/salon/SalonModal.vue';
import SalonCard from '../components/salon/SalonCard.vue';
import FoodMenuCard from '../components/menu/FoodMenuCard.vue';
import FoodMenuModal from '../components/menu/FoodMenuModal.vue';

export default {
	name: "BusinessProfile",
	components: {
		FrontendHeader,
		Footer,
		OfferSection,
		EssentialsSection,
		DescriptionSection,
		Tags,
		Gallery,
		Categories,
		ContactForm,
		Suggestions,
		SalonModal,
		SalonCard,
		FoodMenuCard,
		FoodMenuModal
	},
	created() {
		// console.log(this.$page.props.business.id);
	},
	props: {
		business: Object,
		offers: Array,
		categories: Array,
		tags: Array,
		recommendations: Array,
		salons: Array,
		foodMenus: Array,
		isOwner: Boolean,
		images: Array
	},
	data() {
		return {
			activeTab: 'profil-companie',
			selectedSalon: null,
			selectedFoodMenu: null,
			isSalonModalOpen: false,
			isFoodMenuModalOpen: false,
			editingSection: null,
		};
	},
	methods: {
		handleImageDeleted(deletedImageId) {
			const index = this.images.findIndex(img => img.id === deletedImageId);
			if (index !== -1) {
				this.$set(this.images, index, { ...this.images[index], deleted: true });
			}
		},
		openSalonModal(salon) {
			this.selectedSalon = salon;
			this.isSalonModalOpen = true;
		},
		closeSalonModal() {
			this.isSalonModalOpen = false;
			this.selectedSalon = null;
		},
		openFoodMenuModal(foodMenu) {
			this.selectedFoodMenu = foodMenu;
			this.isFoodMenuModalOpen = true;
		},
		closeFoodMenuModal() {
			this.isFoodMenuModalOpen = false;
			this.selectedFoodMenu = null;
		},
		editSection(section) {
			this.editingSection = section;
		},
		saveSection(section) {
			// Logic to save the section data to the server
			this.editingSection = null;
		},
		cancelEdit(section) {
			this.editingSection = null;
		}
	}
};
</script>


<style scoped>
/* Add specific styles if necessary */
</style>
