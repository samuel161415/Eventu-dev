<template>
  <swiper
    :slides-per-view="1"
    :space-between="10"
    :pagination="true"
    :navigation="true"
    :modules="modules"
    :breakpoints="breakpoints"
    class="mySwiper py-8"
  >
    <swiper-slide v-for="(feature, index) in features" :key="index" class="feature-sub-item text-center">
      <h2 class="text-2xl font-bold mb-4">{{ feature.title }}</h2>
      <p class="text-lg mb-4">{{ feature.description }}</p>
      <img :src="feature.image" :alt="feature.title" class="slider-image mx-auto">
    </swiper-slide>
  </swiper>
</template>

<script>
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/swiper-bundle.css';
import { Pagination, Navigation } from 'swiper/modules';

// Register modules


export default {
  components: {
    Swiper,
    SwiperSlide,
  },
  props: {
    features: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      modules: [Pagination, Navigation],
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        640: {
          slidesPerView: 1,
          spaceBetween: 10,
        },
        768: {
          slidesPerView: 1,
          spaceBetween: 10,
        },
        1024: {
          slidesPerView: 1,
          spaceBetween: 10,
        },
      },
    };
  },
};
</script>

<style scoped>
.slider-image {
  max-width: 100%;
}
.mySwiper{
  padding:3rem 0;
}
.swiper-pagination-bullet {
  background-color: #8224e3 !important;
}

.swiper-button-next,
.swiper-button-prev {
  color: #8224e3!important;
}
.swiper-button-prev, .swiper-button-next {
    color: #8224e3!important;
}
.swiper-pagination-bullet-active {
    /* opacity: var(--swiper-pagination-bullet-opacity, 1); */
    background: #8224e3!important;
}
</style>