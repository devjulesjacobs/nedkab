<template>
    <div id="Emballage">
        <h1 class="text-3xl page-title leading-8 font-bold tracking-tight text-gray-900 mb-8">Emballage</h1>

        <div v-for="emballage in emballages" :key="emballage.id" class="bg-white p-5 rounded-md shadow-md block mb-2">
            <h1 class="font-bold text-2xl">Emballage #{{ emballage.id }}</h1>
            <pre>
                {{ emballage }}
            </pre>
        </div>

    </div>
</template>

<script>
export default {
    name: "Emballage",
    data() {
        return {
            emballages: []
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
        }
    }
}
</script>

<style scoped>

</style>
