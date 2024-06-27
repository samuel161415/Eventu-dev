<template>
  <div>
    <form @submit.prevent="applyFilters">
      <!-- Capacity Range Slider -->
      <div class="mb-4">
        <h4 class="font-semibold text-gray-700">Capacitate: <span class="text-purple-600 font-bold">{{ form.capacity }}</span></h4>
        <input type="range" min="0" max="600" step="10" v-model="form.capacity" @input="debouncedApplyFilters" class="slider w-full mt-2" />
      </div>

      <!-- Sort By Dropdown -->
      <div class="mb-4">
        <h4 class="font-semibold text-gray-700">Ordoneaza dupa:</h4>
        <select v-model="form.sortBy" @change="applyFilters" class="border-0 border-b-2 border-gray-400 w-full mt-2 p-2 rounded-0">
          <option value="recent">Ultimele</option>
          <option value="popular">Populare</option>
        </select>
      </div>

      <!-- Location Input -->
      <div class="mb-4 grayscale">
        <h4 class="font-semibold text-gray-700">Locatie</h4>
        <input readonly type="text" v-model="form.location" @input="debouncedApplyFilters" class="w-full border-0 border-b-2 border-gray-400 mt-2 p-2 rounded-0" placeholder="Introduceți locația" />
      </div>

      <!-- Tags Section -->
      <div class="mb-4 p-3 bg-lightpurple rounded-lg shadow-md">
        <h4 class="font-semibold text-gray-700 mb-3">Tag-uri</h4>
        <div class="space-y-2 max-h-60 overflow-y-auto" @scroll="onScroll">
          <label class="flex items-center" v-for="tag in displayedTags" :key="tag.id">
            <input type="checkbox" class="hidden-checkbox" v-model="form.tags" :value="tag.name" @change="applyFilters" />
            <span class="custom-checkbox"></span>
            <span class="ml-2">{{ tag.name }}</span>
          </label>
          <div v-if="loading" class="text-center py-2">
            <div class="loader"></div>
          </div>
          <div v-if="allTagsLoaded && !loading" class="text-center py-2"><font-awesome-icon icon="check" class="text-custompurple" /></div>
        </div>
      </div>

      <!-- Event Types Section -->
      <div class="mb-4 p-3 bg-lightpurple rounded-lg shadow-md">
        <h4 class="font-semibold text-gray-700 mb-3">Tip Eveniment</h4>
        <div class="space-y-2">
          <label class="flex items-center" v-for="eventType in eventTypes" :key="eventType.id">
            <input type="checkbox" class="hidden-checkbox" v-model="form.eventType" :value="eventType.name" @change="applyFilters" />
            <span class="custom-checkbox"></span>
            <span class="ml-2">{{ eventType.name }}</span>
          </label>
        </div>
      </div>

      <!-- Search and Reset Buttons -->
      <button type="submit" class="bg-customPurple text-white px-4 py-2 rounded-full w-full">Caută</button>
      <button type="button" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-full w-full mt-2" @click="resetFilters">Resetează filtre</button>
    </form>
  </div>
</template>

<script>
import { debounce } from 'lodash';

export default {
  name: 'Filters',
  props: {
    form: {
      type: Object,
      required: true
    },
    tags: {
      type: Array,
      required: true
    },
    eventTypes: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      displayedTags: [],
      itemsToLoad: 10,
      loading: false,
      allTagsLoaded: false
    };
  },
  mounted() {
    this.loadMoreTags();
  },
  methods: {
    applyFilters() {
      this.$emit('applyFilters');
    },
    debouncedApplyFilters: debounce(function () {
      this.applyFilters();
    }, 300),
    resetFilters() {
      this.form.capacity = '';
      this.form.sortBy = 'recent';
      this.form.location = '';
      this.form.tags = [];
      this.form.eventType = [];
      this.applyFilters();
    },
    loadMoreTags() {
      if (this.allTagsLoaded || this.loading) return;
      this.loading = true;
      const nextTags = this.tags.slice(this.displayedTags.length, this.displayedTags.length + this.itemsToLoad);
      if (nextTags.length > 0) {
        this.displayedTags = [...this.displayedTags, ...nextTags];
        this.loading = false;
      } else {
        this.allTagsLoaded = true;
        this.loading = false;
      }
    },
    onScroll(event) {
      const container = event.target;
      if (container.scrollTop + container.clientHeight >= container.scrollHeight - 10) {
        this.loadMoreTags();
      }
    }
  },
  watch: {
    tags(newTags) {
      this.resetTagLoad();
      this.loadMoreTags();
    }
  },
  methods: {
    resetTagLoad() {
      this.displayedTags = [];
      this.allTagsLoaded = false;
      this.loading = false;
    },
    applyFilters() {
      this.$emit('applyFilters');
    },
    debouncedApplyFilters: debounce(function () {
      this.applyFilters();
    }, 300),
    resetFilters() {
      this.form.capacity = '';
      this.form.sortBy = 'recent';
      this.form.location = '';
      this.form.tags = [];
      this.form.eventType = [];
      this.applyFilters();
    },
    loadMoreTags() {
      if (this.allTagsLoaded || this.loading) return;
      this.loading = true;
      const nextTags = this.tags.slice(this.displayedTags.length, this.displayedTags.length + this.itemsToLoad);
      if (nextTags.length > 0) {
        this.displayedTags = [...this.displayedTags, ...nextTags];
        this.loading = false;
      } else {
        this.allTagsLoaded = true;
        this.loading = false;
      }
    },
    onScroll(event) {
      const container = event.target;
      if (container.scrollTop + container.clientHeight >= container.scrollHeight - 10) {
        this.loadMoreTags();
      }
    }
  }
};
</script>

<style scoped>
.bg-lightpurple {
  background-color: #f8f2ff;
}

.bg-customPurple {
  background-color: #8224E3;
}

.text-custompurple {
  color: #8224E3;
}

.slider {
  -webkit-appearance: none;
  appearance: none;
  width: 100%;
  height: 8px;
  background: #ddd;
  outline: none;
  opacity: 0.7;
  transition: opacity .2s;
}

.slider:hover {
  opacity: 1;
}

.slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background: #8224E3 !important;
  cursor: pointer;
}

.slider::-moz-range-thumb {
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background: #8224E3 !important;
  cursor: pointer;
}

.max-h-60::-webkit-scrollbar {
  width: 8px;
  background-color: #f1f1f1;
}

.max-h-60::-webkit-scrollbar-thumb {
  background-color: #8224E3;
  border-radius: 10px;
}

.max-h-60::-webkit-scrollbar-thumb:hover {
  background-color: #6a1bb1;
}

.max-h-60 {
  scrollbar-width: thin;
  scrollbar-color: #8224E3 #f1f1f1;
}

.loader {
  border: 4px solid #f3f3f3;
  border-top: 4px solid #8224E3;
  border-radius: 50%;
  width: 24px;
  height: 24px;
  animation: spin 1s linear infinite;
  margin: auto;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

.hidden-checkbox {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

.custom-checkbox {
  position: relative;
  display: inline-block;
  width: 20px;
  height: 20px;
  background-color: #fff;
  border: 2px solid #ccc;
  border-radius: 5px;
  transition: background-color 0.2s, border-color 0.2s;
}

.custom-checkbox::after {
  content: "";
  position: absolute;
  display: none;
  left: 5px;
  top: 2px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 2px 2px 0;
  transform: rotate(45deg);
}

.hidden-checkbox:checked + .custom-checkbox {
  background-color: #8224E3;
  border-color: #8224E3;
}

.hidden-checkbox:checked + .custom-checkbox::after {
  display: block;
}
</style>
