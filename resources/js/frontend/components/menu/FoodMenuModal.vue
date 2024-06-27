<template>
    <div v-if="isOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg overflow-hidden w-3/4 lg:w-1/2">
            <div class="relative">
                <img src="/images/eventu-hero.jpg" class="w-full h-64 object-cover" />
                <button @click="closeModal" class="absolute top-4 right-4 bg-white rounded-full p-2">✕</button>
            </div>
            <div class="p-6 space-y-4">
                <h2 class="text-2xl font-bold">{{ foodMenu.menu_name }}</h2>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="bg-white p-2 shadow rounded-lg mb-4">
                        <h5 class="h5 font-semibold">Sumar</h5>
                        <ul>
                            <li class="h6">Preț: {{ foodMenu.price }}</li>
                            <li class="h6">Alergeni: {{ foodMenu.allergens }}</li>
                        </ul>
                    </div>
                    <div class="bg-white p-2 shadow rounded-lg mb-4">
                        <h5 class="h5 font-semibold">Descriere:</h5>
                        <p>{{ foodMenu.short_description }}</p>
                    </div>
                    <div class="bg-white p-2 shadow rounded-lg">
                        <h5 class="h5 font-semibold">Descarcă Meniu:</h5>
                        <a :href="foodMenu.pdf_url" target="_blank" class="text-blue-500">Descarcă PDF</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'FoodMenuModal',
    props: {
        isOpen: Boolean,
        foodMenu: Object
    },
    methods: {
        closeModal() {
            this.$emit('close-modal');
        }
    }
};
</script>

<style scoped>
/* Add any custom styles if necessary */
</style>
