<template>
    <div>
        <FrontendHeader />
        <div class="bg-white py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-left">
                    <h1 class="text-4xl font-bold text-gray-900">Resurse</h1>
                    <p class="mt-2 text-lg text-gray-600">
                        Planning a wedding is a truly magical experience. We’re offering our expertise to help make the
                        planning process fun and stress-free for you from beginning to end.
                    </p>
                    <p class="mt-2 text-lg text-gray-600">
                        From decor inspiration to vow help, we've covered it all in our articles.
                    </p>
                </div>
                <div class="mt-10 max-w-3xl">
                    <div class="flex">
                        <input type="text" placeholder="Cauta in articolele Eventu"
                            class="w-3/5 p-3 border-gray-300 border rounded-l-full shadow-lg">
                        <button class="px-5 py-3 bg-purple-600 text-white rounded-r-full shadow-lg">Cauta</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-2">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-2 py-0">
                <div class="flex space-x-4 overflow-x-auto">
                    <CategoryButton text="Organizare Nunta" />
                    <CategoryButton text="Cununie Civila" />
                    <CategoryButton text="Botez" />
                    <CategoryButton text="Viata dupa casatorie" />
                    <CategoryButton text="Pregatiri" />
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <BlogPostCard v-for="(post, index) in posts.slice(0, 5)" :key="post.id" :post="post"
                    :large="index === 0" :class="{ 'lg:col-span-2 lg:row-span-2': index === 0 }" />
            </div>
        </div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <h2 class="text-2xl uppercase text-gray-700 text-center font-bold mb-12">Recent Adaugate</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-12">
                <BlogPostCard v-for="post in posts.slice(0, 4)" :recent="true" :key="post.id || post.slug" :post="post" />
            </div>
        </div>

        <Footer />
    </div>
</template>

<script>
import FrontendHeader from '../components/Header.vue';
import Footer from '../components/Footer.vue';
import CategoryButton from '../components/blog/CategoryButton.vue';
import BlogPostCard from '../components/blog/BlogPostCard.vue';
export default {
    name: 'Blog',
    components: {
        FrontendHeader,
        Footer,
        CategoryButton,
        BlogPostCard,
    },
    props: {
        posts: Array,
    }
};
</script>

<style scoped>
/* Add specific styles if necessary */
</style>