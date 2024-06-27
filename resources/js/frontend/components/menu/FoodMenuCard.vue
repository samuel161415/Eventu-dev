<template>
    <div class="relative group cursor-pointer" @click="$emit('open-modal', foodMenu)">
        <img src="/images/eventu-hero.jpg" class="w-full h-64 object-cover rounded-lg" />
        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <h3 class="text-white text-lg font-semibold">{{ foodMenu.menu_name }}</h3>
        </div>
    </div>
</template>

<script>
export default {
    name: 'FoodMenuCard',
    props: {
        foodMenu: Object
    }
};
</script>

<style scoped>
/* Add any custom styles if necessary */
</style>
