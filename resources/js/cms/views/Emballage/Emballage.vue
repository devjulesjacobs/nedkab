<template>
    <div id="Emballage">
        <h1 class="text-3xl page-title leading-8 font-bold tracking-tight text-gray-900 mb-8">Emballage</h1>

        <div class="grid grid-cols-2 gap-4">
            <div class="">
                <h1 class="text-xl font-medium mb-3">Ingediend</h1>
                <a v-for="emballage in emballages" @click="getEmballage(emballage.id)" :key="emballage.id" class="bg-white p-5 rounded-md shadow-md block mb-2 cursor-pointer">
                    <h1 class="font-bold text-2xl">Emballage #{{ emballage.id }}</h1>
                </a>
            </div>
            <div class="">
                <h1 class="text-xl font-medium mb-3">Afgerond</h1>
            </div>
        </div>

        <emballage-slide :show="slide.show"
                         :emballage="emballage"
                         @hide="hideSlide" />

    </div>
</template>

<script>
import EmballageSlide from "../../components/EmballageSlide/EmballageSlide";
export default {
    name: "Emballage",
    components: {EmballageSlide},
    data() {
        return {
            emballages: [],
            emballage: undefined,
            slide: {
                show: false
            },
        }
    },

    mounted() {
        this.getEmballages();
    },

    methods: {
        getEmballages() {
            axios.get('/api/cms/emballage')
            .then((res) => {
                console.log(res)
                this.emballages = res.data
            })
            .catch((err) => { console.log(err) })
        },

        getEmballage(id) {
            this.slide.show = true;
            axios.get('/api/app/emballage/'+id)
                .then(res => {
                    this.emballage = res.data
                })
                .catch(err => console.log(err.response.data))
        },

        hideSlide() {

        }
    }
}
</script>

<style scoped>

</style>
