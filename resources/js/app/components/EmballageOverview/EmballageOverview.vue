<template>
    <div class="">
        <h1 class="text-md font-medium mb-3">Mijn emballage</h1>

        <p v-if="!emballages.length" class="text-sm text-gray-700">{{ emptyText }}</p>

        <a v-for="e in emballages" :key="e.id" @click="getEmballage(e.id)" class="block border bg-white shadow-md border-gray-100 rounded-md mb-3 p-4" :class="e.status === 'geaccepteerd' ? ['border', 'border-green-600'] : []">
            <div>
                <h5 class="uppercase font-medium text-gray-500 text-xs">
                    Emballage
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 -mt-1 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <p class="float-right font-normal text-theme-blue">{{ e.created_at | moment('DD MMM YYYY') }}</p>
                </h5>
                <h1 class="font-medium text-md mb-3">{{ e.user.company }}</h1>
                <p class="text-xs text-gray-500">{{ e.street }} {{ e.house_number }}. {{ e.postcode }} {{ e.city }}</p>
                <p :class="{ 'text-blue-600': e.status === 'ingediend', 'text-green-600': e.status === 'geaccepteerd', 'text-red-600': e.status === 'afgewezen' }" class="font-normal text-xs">
                    {{ e.status }}</p>
            </div>
        </a>

        <transition name="slide-fade">
            <emballage-slide v-if="slide.show" :emballage="emballage" @hide="slide.show = false; emballage = null" />
        </transition>
    </div>
</template>

<script>
import {mapGetters} from "vuex";
import EmballageSlide from "../EmballageSlide/EmballageSlide";

export default {
    name: "EmballageOverview",
    data() {
        return {
            emballages: [],
            emptyText: '',
            slide: {
                show: false
            },
            emballage: null
        }
    },
    mounted() {
        this.getEmballages();
    },
    methods: {
        getEmballages() {
            axios.get('/api/app/emballage')
                .then(res => {
                    this.emballages = res.data
                    if(!this.emballages.length) this.emptyText = 'Nog geen emballage.';
                })
                .catch(err => {
                    console.log(err)
                })
        },

        getEmballage(id) {
            axios.get('/api/app/emballage/'+id)
                .then(res => {
                    this.emballage = res.data
                    this.slide.show = true;
                })
                .catch(err => {
                    console.log(err)
                })
        },
    },
    components: {
        EmballageSlide
    }
}
</script>

<style scoped>

</style>
