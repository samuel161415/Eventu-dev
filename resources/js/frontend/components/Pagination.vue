<template>
  <div class="pagination" v-if="pagination && pagination.total > pagination.per_page">
    <Link as="button" v-for="link in pagination.links" :key="link.url" :href="link?.url" v-html="link.label" :class="link.active ? 'active' : ''" :disabled="!link.url"></Link>
  </div>
</template>

<script>
  import { Link } from '@inertiajs/vue3'

export default {
  name: "Pagination",
  props: {
    data: {
      type: Object,
      required: true,
      default: () => ({})
    }
  },
  components: {
		Link,
	},
  computed: {
    pagination() {
      return this.data || {};
    }
  },
  methods: {
    changePage(url) {
      if (url) {
        const page = new URL(url).searchParams.get('page');
        this.$emit('pagination-change-page', page);
      }
    }
  },
};
</script>

<style scoped>
.pagination {
  display: flex;
  justify-content: center;
  margin-top: 1rem;
}
.pagination button {
  margin: 0 0.25rem;
  padding: 0.5rem 1rem;
  border: 1px solid #ccc;
  background-color: white;
  cursor: pointer;
}
.pagination button.active {
  border-color: #8224E3;
  background-color: #8224E3;
  color: white;
}
.pagination button:disabled {
  cursor: not-allowed;
  opacity: 0.5;
}
</style>
