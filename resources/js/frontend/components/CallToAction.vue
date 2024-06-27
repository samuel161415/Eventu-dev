<template>
  <section class="bg-customPurple py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-8 text-white">
      <div class="col-span-1 lg:col-span-1 flex items-center justify-center text-center">
        <h2 class="text-2xl sm:text-4xl font-bold">
          Află despre toate beneficiile platformei noastre
        </h2>
      </div>
      <div class="col-span-1 lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-8">
        <div class="bg-white text-gray-800 text-center py-8 px-12 rounded-2xl shadow-lg flex flex-col justify-between">
          <div>
            <img src="path/to/award-icon.png" alt="Award Icon" class="mx-auto mb-4" />
            <h3 class="text-xl font-semibold mb-2">Premiile "Furnizori de top"</h3>
            <p class="text-gray-600">Pe baza recenziilor vom alege cei mai buni furnizori</p>
          </div>
          <button class="bg-customPurple text-white px-4 py-2 rounded-full mt-3">Află mai multe</button>
        </div>
        <div class="bg-white text-gray-800 text-center py-8 px-12 rounded-2xl shadow-lg flex flex-col justify-between">
          <div>
            <img src="images/eventu-business.png" alt="Business Icon" class="max-w-48 mx-auto  mb-4" />
            <h3 class="text-3xl font-bold mb-2 text-gray-600">Ai un business în domeniul evenimentelor?</h3>
            <p class="text-gray-600 font-semibold my-2">Devino partenerul nostru și promovează-ți afacerea</p>
          </div>
          <Link as="button" href="/b2b" class="bg-customPurple text-white px-4 py-2 rounded-full mt-4">Află mai multe</Link>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
  name: "CallToAction",
  components: {
		Link,
	},
};
</script>

<style scoped>
.bg-customPurple {
  background-color: #8224E3;
}
</style>
