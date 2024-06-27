<template>
    <div class="bg-white p-6 shadow rounded-lg relative tag-wrapper">
        <h2 class="text-gray-800 font-semibold mb-4 flex items-center">
            Taguri
            <button @click="toggleEdit" v-if="isOwner" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900">
                <font-awesome-icon icon="pencil" />
            </button>
        </h2>

        <form v-if="editing" @submit.prevent="saveTags">
            <div class="flex flex-wrap gap-2 mb-4">
                <div v-for="tag in formData.tags" :key="tag.id"
                    class="bg-gray-200 text-gray-700 px-4 py-2 rounded-full flex items-center">
                    <div v-html="getSvgIcon(tag.name)" class="w-6 h-6 mr-2 relative"></div>
                    {{ tag.name }}
                    <button @click.prevent="removeTag(tag)" class="text-red-500 ml-2">&times;</button>
                </div>
            </div>
            <div class="mb-4">
                <label for="new-tag" class="block text-gray-700">Adaugă tag-uri</label>
                <div class="relative">
                    <select id="new-tag" v-model="newTag" class="border p-2 rounded w-full h-24 overflow-y-scroll" @scroll="loadMoreTags">
                        <option v-for="(icon, name) in availableTags" :key="icon" :value="icon">{{ icon }}</option>
                    </select>
                </div>
                <button @click.prevent="addTag" class="mt-2 bg-purple-500 text-white px-4 py-2 rounded-md">Add</button>
            </div>
            <div class="flex justify-end space-x-4">
                <button type="button" @click="cancelEdit"
                    class="border border-gray-300 text-gray-600 px-4 py-2 rounded-md mr-2">Anulează</button>
                <button type="submit" class="bg-purple-500 text-white px-4 py-2 rounded-md">Salvează</button>
            </div>
        </form>

        <div v-else class="flex flex-wrap gap-2">
            <div v-for="tag in salon.tags" :key="tag.id"
                class="bg-gray-200 text-gray-700 px-4 py-2 rounded-full flex items-center">
                <div v-html="getSvgIcon(tag.name)" class="w-6 h-6 mr-2 relative"></div>
                {{ tag.name }}
            </div>
        </div>
    </div>
</template>

<script>
import aerConditionat from '../../../../../public/storage/tags/aer-conditionat.svg';
import artificiiExterior from '../../../../../public/storage/tags/artificii-exterior.svg';
import autorizatieDsp from '../../../../../public/storage/tags/autorizatie-dsp.svg';
import autorizatieIsu from '../../../../../public/storage/tags/autorizatie-isu.svg';
import bucatarieProprie from '../../../../../public/storage/tags/bucatarie-proprie.svg';
import acceptaCatering from '../../../../../public/storage/tags/oferta-catering.svg';
import ofertaCatering from '../../../../../public/storage/tags/oferta-catering.svg';
import cazareInvitati from '../../../../../public/storage/tags/cazare-invitati.svg';
import cazareMiri from '../../../../../public/storage/tags/cazare-miri.svg';
import locCununie from '../../../../../public/storage/tags/loc-cununie.svg';
import curent380v from '../../../../../public/storage/tags/curent-380v.svg';
import faraTaxeSuplimentare from '../../../../../public/storage/tags/fara-taxe-suplimentare.svg';
import garderoba from '../../../../../public/storage/tags/wardrobe.svg';
import generatorCurent from '../../../../../public/storage/tags/generator-curent.svg';
import gradina from '../../../../../public/storage/tags/gradina.svg';
import hostess from '../../../../../public/storage/tags/hostess.svg';
import lac from '../../../../../public/storage/tags/lac.svg';
import zonaFumat from '../../../../../public/storage/tags/zona-fumat.svg';
import locDeJoaca from '../../../../../public/storage/tags/loc-de-joaca.svg';
import locPhotoCorner from '../../../../../public/storage/tags/loc-photo-corner.svg';
import padure from '../../../../../public/storage/tags/padure.svg';
import parcareProprie from '../../../../../public/storage/tags/parcare-proprie.svg';
import permiteBauturiDinAfaraLocatiei from '../../../../../public/storage/tags/permite-bauturi-din-afara-locatiei.svg';
import piscina from '../../../../../public/storage/tags/piscina.svg';
import plataCard from '../../../../../public/storage/tags/plata-card.svg';
import plataCash from '../../../../../public/storage/tags/plata-cash.svg';
import availableBarbeque from '../../../../../public/storage/tags/available-barbeque.svg';
import ringDeDansDedicat from '../../../../../public/storage/tags/ring-de-dans-dedicat.svg';
import sistemAudio from '../../../../../public/storage/tags/sistem-audio.svg';
import taxiRidesharing from '../../../../../public/storage/tags/taxi-ridesharing.svg';
import transportLaLocatie from '../../../../../public/storage/tags/transport-la-locatie.svg';
import wireless from '../../../../../public/storage/tags/wireless.svg';
import zonaCocktail from '../../../../../public/storage/tags/zona-cocktail.svg';
import aranjamenteMeseStandard from '../../../../../public/storage/tags/aranjamente-mese-standard.svg';
import ringDeDans from '../../../../../public/storage/tags/ring-de-dans.svg';
import spatiuAcoperit from '../../../../../public/storage/tags/spatiu-acoperit.svg';
import terasa from '../../../../../public/storage/tags/terasa.svg';
import ballroom from '../../../../../public/storage/tags/ballroom.svg';
import candyBar from '../../../../../public/storage/tags/candy-bar.svg';
import liveCooking from '../../../../../public/storage/tags/live-cooking.svg';
import serviciuBbq from '../../../../../public/storage/tags/serviciu-bbq.svg';
import protap from '../../../../../public/storage/tags/protap.svg';
import livrareMancare from '../../../../../public/storage/tags/livrare-mancare.svg';
import outdoorWeddingOption from '../../../../../public/storage/tags/loc-cununie.svg';
import notification from '@/utils/notifications';

export default {
    props: {
        salon: {
            type: Object,
            required: true
        },
        isOwner: {
            type: Boolean,
            required: true
        }
    },
    data() {
        return {
            editing: false,
            formData: {
                tags: [...this.salon.tags]
            },
            newTag: '',
            tagIcons: {
                'Aer Conditionat': aerConditionat,
                'Artificii Exterior': artificiiExterior,
                'Autorizatie DSP': autorizatieDsp,
                'Autorizatie ISU': autorizatieIsu,
                'Bucatarie Proprie': bucatarieProprie,
                'Accepta Catering': acceptaCatering,
                'Ofera Catering': ofertaCatering,
                'Cazare Invitati': cazareInvitati,
                'Cazare Miri': cazareMiri,
                'Loc Cununie': locCununie,
                'Curent 380 V': curent380v,
                'Fara Taxe Suplimentare': faraTaxeSuplimentare,
                'Garderoba': garderoba,
                'Generator': generatorCurent,
                'Gradina': gradina,
                'Hostess': hostess,
                'Lac': lac,
                'Loc De Fumat': zonaFumat,
                'Loc De Joaca': locDeJoaca,
                'Loc Photo Corner': locPhotoCorner,
                'Padure': padure,
                'Parcare Proprie': parcareProprie,
                'Permite bautura din afara locatiei': permiteBauturiDinAfaraLocatiei,
                'Piscina': piscina,
                'Plata Card': plataCard,
                'Plata Cash': plataCash,
                'Posibilitate Barbeque': availableBarbeque,
                'Ring De Dans Dedicat': ringDeDansDedicat,
                'Sistem Audio': sistemAudio,
                'Taxi/Ridesharing': taxiRidesharing,
                'Transport Invitati': transportLaLocatie,
                'Wireless': wireless,
                'Zona Cocktail': zonaCocktail,
                'Aranjamente Mese Standard': aranjamenteMeseStandard,
                'Ring De Dans': ringDeDans,
                'Spatiu Acoperit': spatiuAcoperit,
                'Terasa': terasa,
                'Ballroom': ballroom,
                'Candy Bar': candyBar,
                'Live Cooking': liveCooking,
                'Serviciu BBQ': serviciuBbq,
                'Protap': protap,
                'Livrare Mancare': livrareMancare,
                'Outdoor wedding option': outdoorWeddingOption,
            },
        };
    },
    computed: {
        availableTags() {
            const allTags = Object.keys(this.tagIcons);
            const selectedTags = this.formData.tags.map(tag => tag.name);
            return allTags.filter(tag => !selectedTags.includes(tag));
        }
    },
    methods: {
        toggleEdit() {
            this.editing = !this.editing;
            if (this.editing) {
                this.formData.tags = [...this.salon.tags];
            }
        },
        cancelEdit() {
            this.editing = false;
            this.formData.tags = [...this.salon.tags];
        },
        saveTags() {
            axios.put(`/salon/${this.salon.id}/schimba-taguri`, { tags: this.formData.tags.map(tag => tag.name) })
                .then(response => {
                    notification.success(response.data.message);
                    this.salon.tags = this.formData.tags;
                    this.editing = false;
                })
                .catch(error => {
                    notification.error('Nu s-a putut face actualizarea: ' + error.response.data.message);
                });
        },
        addTag() {
            const tag = this.newTag;
            if (tag && !this.formData.tags.some(t => t.name === tag)) {
                this.formData.tags.push({ name: tag });
            }
            this.newTag = '';
        },
        removeTag(tagToRemove) {
            this.formData.tags = this.formData.tags.filter(tag => tag.name !== tagToRemove.name);
        },
        getSvgIcon(tagName) {
            return this.tagIcons[tagName];
        }
    }
};
</script>

<style scoped>
.tag-wrapper {
    max-height: 15rem;
    overflow: auto;
}

.tag-wrapper::-webkit-scrollbar {
    width: 8px;
    background-color: #f1f1f1;
}

.tag-wrapper::-webkit-scrollbar-thumb {
    background-color: #8224E3;
    border-radius: 10px;
    box-shadow: 0 0 10px #8224E3;
}

.tag-wrapper::-webkit-scrollbar-thumb:hover {
    background-color: #6a1bb1;
    box-shadow: 0 0 10px #6a1bb1;
}

.tag-wrapper::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #8224E3;
    cursor: pointer;
}

.tag-wrapper::-moz-range-thumb {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #8224E3;
    cursor: pointer;
}

/* For Firefox */
.tag-wrapper {
    scrollbar-width: thin;
    scrollbar-color: #8224E3 #f1f1f1;
}

/* For Internet Explorer and Edge */
.tag-wrapper {
    -ms-overflow-style: -ms-autohiding-scrollbar;
}

/* Add specific styles if necessary */
</style>