<template>
  <div>
    <FrontendHeader :isHomepage="true" />
    <Hero :locations="locations" :eventCategories="eventCategories" />
    <Features :companies="companies" />
    <Blog :posts="posts" />
    <CallToAction />
    <Footer />
  </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';

import FrontendHeader from '../components/Header.vue';
import Hero from '../components/Hero.vue';
import Features from '../components/Features.vue';
import Blog from '../components/Blog.vue';
import PopularListings from '../components/PopularListings.vue';
import Testimonials from '../components/Testimonials.vue';
import CallToAction from '../components/CallToAction.vue';
import Footer from '../components/Footer.vue';

export default {
  name: "Homepage",
  components: {
    FrontendHeader,
    Hero,
    Features,
    Blog,
    PopularListings,
    Testimonials,
    CallToAction,
    Footer,
    Link,
  },
  props: {
    companies: Object,
    posts: Object,
    listings: Array,
    testimonials: Array
  }
};
</script>

<style scoped>
/* Add general styles here */
</style>
