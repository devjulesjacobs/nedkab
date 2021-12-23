<template>
    <div>
        <h1 class="page-title text-3xl font-bold px-5 py-5">Kabels</h1>

        <div class="px-5">
            <label class="block text-sm font-medium text-gray-700">
                Kabel zoeken
            </label>
            <div class="mt-1">
                <input v-model="input" type="text" @keyup="search" ref="searchInput" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div class="mt-4">

                <div v-show="result.length">
                    <transition-group name="slide-fade">
                        <a v-for="cable in result" :key="cable.id" :href="cable.url" target="_blank" class="bg-white shadow-md mb-3 rounded-md p-3 block">
                            <h1 class="text-md font-medium">{{ cable.description }}</h1>
                            <p class="text-sm text-gray-600">{{ cable.group }}</p>
                        </a>
                    </transition-group>
                </div>

                <div v-show="!result.length">
                    <div class="bg-gray-200 p-4 rounded-md text-center text-gray-500 text-sm">
                        <p>Zoek een kabel op unieke code</p>
                    </div>
                </div>
            </div>

            <div class="absolute right-4 bottom-24 pb-2">
                <button @click="$refs.searchInput.focus()" type="button" class="inline-flex items-center px-4 py-2 border opacity-30 border-transparent shadow-sm text-sm font-medium rounded-full text-white bg-gray-700 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200">
                    Zoeken
                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 -mr-1 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Cables",
    data() {
        return {
            input: '',
            result: [],
            screen: 'info',
        }
    },
    methods: {
        search() {
            if(this.input.length) {
                axios.get('/api/cables/search', {
                    params: { input: this.input }
                }).then(res => {
                    this.result = res.data
                }).catch(err => {
                    console.log(err);
                });
            } else {
                this.result = [];
            }
        }
    }
}
</script>

<style scoped>

</style>
