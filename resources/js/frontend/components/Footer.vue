<template>
  <footer :class="isHomepage ? 'bg-gray-200' : 'bg-gray-900 text-white'">
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col md:flex-row md:justify-between">
        <!-- Logo and copyright section -->
        <div class="flex items-center mb-4 md:mb-0">
          <Link href="/" class="max-h-full mb-4">
          <img :src="logoUrl" class="w-auto logo" alt="Logo">
          </Link>
        </div>

        <!-- Links sections -->
        <div class="flex flex-wrap md:flex-nowrap justify-between md:space-x-8">
          <!-- Column 1 -->
          <div class="mb-8 md:mb-0">
            <h3 class="text-sm font-semibold">Caută după evenimente</h3>
            <ul class="mt-4 space-y-2">
              <li><a href="#" class="hover:text-gray-400">Nuntă</a></li>
              <li><a href="#" class="hover:text-gray-400">Botez</a></li>
              <li><a href="#" class="hover:text-gray-400">Aniversare</a></li>
              <li><a href="#" class="hover:text-gray-400">Petrecere tematică</a></li>
              <li><a href="#" class="hover:text-gray-400">Eveniment corporate</a></li>
            </ul>
          </div>

          <!-- Column 2 -->
          <div class="mb-8 md:mb-0">
            <h3 class="text-sm font-semibold">Pentru furnizori</h3>
            <ul class="mt-4 space-y-2">
              <li><a href="#" class="hover:text-gray-400">Înregistrează-ți afacerea</a></li>
              <li><a href="#" class="hover:text-gray-400">Eventhub PRO</a></li>
              <li><a href="#" class="hover:text-gray-400">Premiile "Furnizori de top"</a></li>
            </ul>
          </div>

          <!-- Column 3 -->
          <div class="mb-8 md:mb-0">
            <h3 class="text-sm font-semibold">Termeni și politici</h3>
            <ul class="mt-4 space-y-2">
              <li><a href="#" class="hover:text-gray-400">Termeni și condiții</a></li>
              <li><a href="#" class="hover:text-gray-400">Politica de confidențialitate</a></li>
              <li><a href="#" class="hover:text-gray-400">Politica privind cookie-urile</a></li>
            </ul>
          </div>

          <!-- Column 4 -->
          <div>
            <h3 class="text-sm font-semibold">Eventhub</h3>
            <ul class="mt-4 space-y-2">
              <li><a href="#" class="hover:text-gray-400">Despre noi</a></li>
              <li><a href="#" class="hover:text-gray-400">Contactează-ne</a></li>
              <li><a href="#" class="hover:text-gray-400">Întrebări frecvente</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="flex justify-center">
      <p class="text-sm">&copy; 2023 Eventu</p>
    </div>
  </footer>
</template>

<script>
import { Link } from '@inertiajs/vue3'

export default {
  name: "Footer",
  components: {
    Link,
  },
  props: {
    isHomepage: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      logoUrl: 'images/white.png'
    };
  }
};
</script>

<style scoped>
.logo {
  max-width: 11rem;
  margin-top: -0.2rem;
}
</style>
