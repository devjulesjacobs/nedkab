<template>
    <div id="Emballage">
        <h1 class="text-3xl page-title leading-8 font-bold tracking-tight text-gray-900 mb-8">Emballage</h1>

            <div>
                <h1 class="text-xl inline-block font-medium mb-3 capitalize bg-gray-100 rounded-md px-5 py-2">{{ form.status }}</h1>

                <div class="grid md:grid-cols-12 sm:grid-cols-1 gap-3">

                    <div class="md:col-span-9 sm:col-span-12">
                        <label for="location" class="block text-sm font-medium text-gray-700">Zoeken</label>
                        <input v-model="form.search" type="text"
                               @keyup="search"
                               required
                               placeholder="Zoeken op plaatsnaam..."
                               class="appearance-none mb-3 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    <div class="md:col-span-3 sm:col-span-12">
                        <label for="location" class="block text-sm font-medium text-gray-700">Filter status</label>
                        <select @change="getEmballages" v-model="form.status" id="location" name="location" class="cursor-pointer pr-10 mb-3 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="ingediend">Ingediend</option>
                            <option value="geaccepteerd">Geaccepteerd</option>
                            <option value="afgewezen">Afgewezen</option>
                        </select>
                    </div>
                </div>


                <div>
                    <div class="flex flex-col">
                        <div class="w-full">
                            <div>
                                <table class="divide-y divide-gray-300 m-0 border-b border-gray-200 shadow w-full">
                                    <thead class="bg-gray-50">
                                    <tr class="align-left">
                                        <th class="px-6 py-2 text-xs text-gray-500 text-left">
                                            ID
                                        </th>
                                        <th class="px-6 py-2 text-xs text-gray-500 text-left">
                                            Bedrijf
                                        </th>
                                        <th class="px-6 py-2 text-xs text-gray-500 text-left">
                                            Haspels
                                        </th>
                                        <th class="px-6 py-2 text-xs text-gray-500 text-left">
                                            Adres
                                        </th>
                                        <th class="px-6 py-2 text-xs text-gray-500 text-left">
                                            Ingediend op
                                        </th>
                                    </tr>
                                    </thead>
                                    <transition-group v-if="emballages.length > 0" name="slide-fade" tag="tbody" class="bg-white divide-y divide-gray-300">
                                        <tr v-for="e in emballages" class="whitespace-nowrap cursor-pointer hover:bg-gray-50" @click="getEmballage(e.id)" :key="e.id">
                                            <td class="px-6 py-4 text-sm text-gray-500 font-bold">#{{ e.id }}</td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-900">{{ e.user.company }}</div>
                                            </td>
                                            <td class="px-6 py-4 text-xs">
                                                <p v-if="e.diameter_60"><span class="font-bold">{{  e.diameter_60 }}x</span> haspel <span class="text-gray-400">Ø</span>60cm </p>
                                                <p v-if="e.diameter_80"><span class="font-bold">{{  e.diameter_80 }}x</span> haspel <span class="text-gray-400">Ø</span>80cm </p>
                                                <p v-if="e.diameter_100"><span class="font-bold">{{  e.diameter_100 }}x</span> haspel <span class="text-gray-400">Ø</span>100cm </p>
                                                <p v-if="e.diameter_120"><span class="font-bold">{{  e.diameter_120 }}x</span> haspel <span class="text-gray-400">Ø</span>120cm </p>
                                                <p v-if="e.diameter_140"><span class="font-bold">{{  e.diameter_140 }}x</span> haspel <span class="text-gray-400">Ø</span>140cm </p>
                                                <p v-if="e.diameter_160"><span class="font-bold">{{  e.diameter_160 }}x</span> haspel <span class="text-gray-400">Ø</span>160cm </p>
                                                <p v-if="e.diameter_180"><span class="font-bold">{{  e.diameter_180 }}x</span> haspel <span class="text-gray-400">Ø</span>280cm </p>
                                                <p v-if="e.diameter_200"><span class="font-bold">{{  e.diameter_200 }}x</span> haspel <span class="text-gray-400">Ø</span>200cm </p>
                                            </td>
                                            <td class="px-6 py-4 text-xs">
                                                <!--                                                <p>{{ e.customer_fullname }}</p>-->
                                                <p>{{ e.street + ' ' + e.house_number }}</p>
                                                <p>{{ e.postcode + ' ' + e.city }}</p>
                                            </td>
                                            <td class="px-6 py-4 text-xs text-gray-500">
                                                <p>{{ e.created_at | moment('D MMMM YYYY') }}</p>
                                                <p>{{ e.created_at | moment('H:mm') }}</p>
                                            </td>
                                        </tr>
                                    </transition-group>
                                    <tbody v-if="emballages.length <= 0" class="bg-white divide-y divide-gray-300">
                                        <tr class="whitespace-nowrap hover:bg-gray-50">
                                            <td class="px-6 py-4 text-xs text-gray-500" colspan="5">
                                                Geen resultaten voor emballage met status `{{ form.status }}`
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <transition name="slide-fade">
            <emballage-slide v-if="slide.show"
                             :emballage="emballage"
                             @hide="hideSlide"
                             @refresh="refresh"
                             ref="emballageSlide"/>
        </transition>

    </div>
</template>

<script>
import EmballageSlide from "../../components/EmballageSlide/EmballageSlide";

export default {
    name: "Emballage",
    components: { EmballageSlide },
    data() {
        return {
            emballages: [],
            form: {
                status: 'ingediend',
                search: '',
            },
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
            if(this.form.search.length > 0) {
                this.search();
            } else {
                axios.get('/api/cms/emballage/'+this.form.status)
                    .then((res) => {
                        this.emballages = res.data
                    })
                    .catch((err) => { console.log(err) })
            }
        },

        search() {
            if(this.form.search.length > 0) {
                axios.get('/api/cms/emballage/search', {
                    params: {
                        status: this.form.status,
                        input: this.form.search
                    }
                })
                    .then(res => {
                        console.log(res);
                        this.emballages = res.data
                    })
                    .catch(err => {
                        console.log(err);
                    })
            } else {
                this.getEmballages()
            }
        },

        getEmballage(id) {
            axios.get('/api/app/emballage/'+id)
                .then(res => {
                    this.emballage = res.data
                    this.slide.show = true;
                })
                .catch(err => console.log(err.response.data))
        },

        refresh() {
            this.getEmballages();
        },

        hideSlide() {
            this.slide.show = false;
        }
    }
}
</script>

<style scoped>

</style>
