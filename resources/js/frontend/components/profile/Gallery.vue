<template>
    <div class="bg-white p-6 shadow rounded-lg">
        <h2 class="text-gray-800 font-semibold mb-4">Galerie</h2>

        <!-- Edit mode buttons -->
        <div v-if="isOwner && editingMode">
            <div class="grid grid-cols-3">
                <div v-for="(image, index) in images['thumbnail']" :key="image.id" class="col relative m-1">
                    <img :src="image.url" class="w-full h-24 object-cover rounded-lg" />
                    <button @click="confirmDelete(image.id)"
                        class="absolute -top-5 -right-4 m-2 py-0 px-2 bg-red-600 text-white rounded-full">
                        <small><font-awesome-icon icon="times" /></small>
                    </button>
                </div>
            </div>
            <div class="flex w-full justify-between">
                <button @click="cancelEdit" class="btn btn-secondary mt-2">Cancel</button>
                <input type="file" ref="fileInput" multiple style="display: none" @change="handleFileChange">
                <button @click="openFileInput" class="btn btn-primary mt-2">Add Image</button>
            </div>
        </div>

        <!-- Normal view -->
        <div v-else>
            <div class="grid grid-cols-3">
                <div v-for="(image, index) in images['thumbnail']" :key="image.id" class="col m-1">
                    <img :src="image.url" @click="showLargeImage(images['large'][index].url)"
                        class="w-full h-24 object-cover rounded-lg cursor-pointer" />
                </div>
            </div>
            <button v-if="isOwner" @click="editMode" class="btn btn-primary mt-2">Edit Gallery</button>
        </div>

        <!-- Modal for large image -->
        <div v-if="showModal" class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full md:max-w-3xl">
                    <img :src="largeImageUrl" class="w-full" />
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button @click="closeModal" type="button"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import notification from '@/utils/notifications';

export default {
    props: {
        images: Object,
        isOwner: Boolean,
        business: Object
    },
    data() {
        return {
            editingMode: false,
            deleteInProgress: false,
            showModal: false,
            largeImageUrl: ''
        };
    },
    methods: {
        editMode() {
            this.editingMode = true;
        },
        cancelEdit() {
            this.editingMode = false;
        },
        confirmDelete(imageId) {
            if (window.confirm('Are you sure you want to delete this image? This action cannot be undone.')) {
                this.deleteImage(imageId);
            }
        },
        deleteImage(imageId) {
            if (this.deleteInProgress) {
                return;
            }
            this.deleteInProgress = true;

            axios.delete(`/business/${this.business.slug}/sterge-imagine/${imageId}`)
                .then(response => {
                    notification.success(response.data.message);
                    // Find the index of the image to delete
                    const indexToDelete = this.images['thumbnail'].findIndex(img => img.id === imageId);
                    if (indexToDelete !== -1) {
                        // Use splice to remove the image from the array
                        this.images['thumbnail'].splice(indexToDelete, 1);
                        this.images['large'].splice(indexToDelete, 1); // Assuming corresponding large image has the same index
                    }
                    this.deleteInProgress = false;
                })
                .catch(error => {
                    console.error('Error deleting image:', error.response.data.message);
                    notification.error('Unable to delete image: ' + error.response.data.message);
                    this.deleteInProgress = false;
                });
        },

        openFileInput() {
            this.$refs.fileInput.click();
        },

        handleFileChange(event) {
            const files = event.target.files;
            if (!files.length) return;

            const formData = new FormData();
            for (let i = 0; i < files.length; i++) {
                formData.append('images[]', files[i]);
            }

            axios.post(`/business/${this.business.slug}/incarca-imagini`, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(response => {
                notification.success(response.data.message);
                const newImages = response.data.images;
                Object.keys(newImages).forEach(size => {
                    if (!this.images[size]) {
                        this.images[size] = [];
                    }
                    this.images[size] = [...this.images[size], ...newImages[size]];
                });
            })
            .catch(error => {
                console.error('Error uploading images:', error.response.data.message);
                notification.error('Unable to upload images: ' + error.response.data.message);
            });
        },
        showLargeImage(url) {
            this.largeImageUrl = url;
            this.showModal = true;
        },

        closeModal() {
            this.showModal = false;
            this.largeImageUrl = '';
        },

    }
};
</script>

<style scoped>
/* Add specific styles if necessary */
</style>
