<template>
    <div class="state-cables">
        <h1 class="text-3xl page-title leading-8 font-bold tracking-tight text-gray-900 mb-8">Kabels</h1>

        <form method="post" @submit.prevent="createCable">
            <div class="p-4 border border-gray-300 rounded-md">
                <h1 class="text-xl font-bold mb-4">Kabel toevoegen</h1>
                <div class="grid md:grid-cols-12 sm:grid-cols-1 gap-3">
                    <div class="md:col-span-3 sm:col-span-12">
                        <label class="block text-sm font-medium text-gray-700">Artikel omschrijving<span class="text-red-600">*</span></label>
                        <input v-model="form.description" type="text"
                               required
                               placeholder=""
                               class="appearance-none mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    <div class="md:col-span-3 sm:col-span-12">
                        <label class="block text-sm font-medium text-gray-700">URL<span class="text-red-600">*</span></label>
                        <input v-model="form.url" type="text"
                               required
                               placeholder="https://nedkab.nl/producten/..."
                               class="appearance-none mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    <div class="md:col-span-3 sm:col-span-12">
                        <label class="block text-sm font-medium text-gray-700">Opmerking</label>
                        <input v-model="form.comment" type="text"
                               placeholder=""
                               class="appearance-none mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    <div class="md:col-span-3 sm:col-span-12">
                        <div class="flex justify-between gap-3">

                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-700">Groep<span class="text-red-600">*</span></label>
                                <select v-model="form.group" required name="location" class="cursor-pointer pr-10 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option value="" disabled selected>Selecteer een groep</option>
                                    <option value="Installatiekabel">Installatiekabel</option>
                                    <option value="Aluminium kabel">Aluminium kabel</option>
                                    <option value="Middenspanning">Middenspanning</option>
                                    <option value="Geharmoniseerde kabel">Geharmoniseerde kabel</option>
                                    <option value="Stuurstroomkabel">Stuurstroomkabel</option>
                                    <option value="Datakabel">Datakabel</option>
                                    <option value="Contact materiaal">Contact materiaal</option>
                                </select>
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-700">Afronden</label>
                                <button type="submit" class="inline-flex items-center w-full block px-3 mt-1 py-2.5 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-blue-theme hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Toevoegen
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="mt-6">

            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">Zoeken<span class="text-red-600">*</span></label>
                <input v-model="search" type="text"
                       @keyup="searchCable"
                       required
                       placeholder="Zoeken op artikel omschrijving ..."
                       class="appearance-none mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>

            <transition-group name="slide-fade">
                <div v-for="cable in cables" :key="cable.id" class="p-4 bg-white rounded-md shadow-sm border border-gray-200 mb-2">
                    <button type="button" @click="deleteCalbe(cable.id)" class="inline-flex float-right items-center mt-1.5 px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Verwijderen
                    </button>
                    <a class="font-medium" :href="cable.url" target="_blank">{{ cable.description }} <span class="text-xs font-normal">{{ cable.url }}</span> </a>
                    <p class="text-gray-500 text-xs">{{ cable.group }}</p>
                </div>
            </transition-group>

        </div>
    </div>
</template>

<script>
    export default {
        name: "Cables",
        data() {
            return {
                cables: [],
                form: {
                    description: '',
                    group: '',
                    url: '',
                    comment: '',
                },
                search: ''
            }
        },
        mounted() {
            this.getCables();
        },
        methods: {
            getCables() {
                axios.get('/api/cms/cables')
                    .then(res => this.cables = res.data)
                    .catch(err => console.log(err));
            },
            createCable() {
                axios.post('/api/cms/cables/create', this.form)
                    .then(res => {
                        this.getCables();
                        this.$store.dispatch('cms/addNotification', {
                            type: 'success',
                            title: 'Kabel aangemaakt',
                        });
                    })
                    .catch(err => { console.log(err) })

            },
            deleteCalbe(id) {
                if(confirm('Weet je zeker dat je deze kabel wilt verwijderen? Dit kan niet ongedaan gemaakt worden.')) {
                    axios.post('/api/cms/cables/delete', { id: id })
                        .then(res => {
                            this.getCables();

                            this.$store.dispatch('cms/addNotification', {
                                type: 'success',
                                title: 'Kabel verwijderd',
                            });
                        })
                        .catch(err => { console.log(err) })
                }
            },
            searchCable() {
                if(this.search.length) {
                    axios.get('/api/cables/search', {
                        params: { input: this.search }
                    }).then(res => {
                        this.cables = res.data
                    }).catch(err => {
                        console.log(err);
                    });
                } else {
                    this.getCables()
                }
            }
        }
    }
</script>

<style scoped>

</style>
