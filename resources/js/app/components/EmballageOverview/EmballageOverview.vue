<template>
    <div class="">
        <h1 class="text-md font-medium mb-3">Mijn emballage</h1>

        <p v-if="!emballages.length" class="text-sm text-gray-700">{{ emptyText }}</p>

        <a v-for="e in emballages" :key="e.id" class="block border bg-white shadow-md border-gray-100 rounded-md mb-3 p-4">
            <div>
                <h5 class="uppercase font-medium text-gray-500 text-xs">
                    Emballage
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 -mt-1 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <p class="float-right font-normal text-theme-blue">{{ e.created_at | moment('DD MMM YYYY') }}</p>
                </h5>
                <h1 class="font-medium text-md">{{ user.company }}
                </h1>
                <p class="font-normal text-xs text-green-600 mt-3">Ingediend</p>
            </div>
        </a>
    </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: "EmballageOverview",
    data() {
        return {
            emballages: [],
            emptyText: '',
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
    },
    computed: {
        ...mapGetters({
            user: "auth/user",
        }),
    }
}
</script>

<style scoped>

</style>
