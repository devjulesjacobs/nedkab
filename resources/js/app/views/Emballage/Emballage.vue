<template>
    <div class="state-emballage">
        <h1 class="page-title text-3xl font-bold px-5 pt-5 mb-5">Emballage</h1>

        <div class="px-5">

            <div v-if="state === 'overview'">
                <button @click="state = 'create'" type="button" class="right-0 inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-theme hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Aanmaken
                </button>
            </div>

            <transition name="slide-fade">
                <div v-if="state === 'create'">
                    <form>
                        <div class="bg-white rounded-md shadow-md">
                            <h1 class="text-md font-medium px-5 pt-5 mb-2">{{ section }}</h1>
                            <p v-show="section === 'Klantgegevens' || section === 'Ophaaladres'" class="text-xs px-5 mb-5 text-gray-500">De ingevulde gegevens worden automatisch opgeslagen voor de volgende keer.</p>
                            <p v-show="section === 'Foto uploaden' || section === 'Ophaaladres'" class="text-xs px-5 mb-5 text-gray-500">Selecteer het aantal haspels per diameter type. Upload vervolgens bijbehorende duidelijke foto(s) van de haspel(s)</p>
                            <section v-show="section === 'Klantgegevens' || section === 'Overzicht'">
                                <div class="px-5">
                                    <div class="mb-3">
                                        <label class="text-sm font-medium text-gray-600 mb-1">Klantnaam</label>
                                        <input v-model="form.customer_fullname" type="text" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    </div>

                                    <div class="mb-3">
                                        <label class="text-sm font-medium text-gray-600 mb-1">Contactpersoon klant</label>
                                        <input v-model="form.customer_contact" type="text" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    </div>

                                    <div class="mb-3">
                                        <label class="text-sm font-medium text-gray-600 mb-1">Telefoonnummer contactpersoon</label>
                                        <input v-model="form.customer_contact_phone" type="text" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    </div>
                                </div>

                                <div class="bg-gray-100 px-5 py-4 mt-8">
                                    <button @click="section = 'Ophaaladres'" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Volgende
                                    </button>
                                </div>
                            </section>

                            <section v-show="section === 'Ophaaladres' || section === 'Overzicht'">
                                <div class="px-5">
                                    <div class="mb-3">
                                        <label class="text-md font-medium text-gray-600 mb-1">Straatnaam</label>
                                        <input v-model="form.street" type="text" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    </div>

                                    <div class="mb-3">
                                        <label class="text-md font-medium text-gray-600 mb-1">Huisnummer</label>
                                        <input v-model="form.house_number" type="text" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    </div>

                                    <div class="mb-3">
                                        <label class="text-md font-medium text-gray-600 mb-1">Postcode</label>
                                        <input v-model="form.postcode" type="text" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    </div>

                                    <div class="mb-3">
                                        <label class="text-md font-medium text-gray-600 mb-1">Plaats</label>
                                        <input v-model="form.city" type="text" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    </div>

                                    <div class="mb-3">
                                        <label class="text-md font-medium text-gray-600 mb-1">Contactpersoon</label>
                                        <input v-model="form.contact" type="text" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    </div>

                                    <div class="mb-3">
                                        <label class="text-md font-medium text-gray-600 mb-1">Telefoonnummer contactpersoon</label>
                                        <input v-model="form.contact_phone" type="text" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    </div>

                                    <div class="mb-3">
                                        <label class="text-md font-medium text-gray-600 mb-1">Emailadres contactpersoon</label>
                                        <input v-model="form.contact_email" type="text" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    </div>
                                </div>

                                <div class="bg-gray-100 px-5 py-4 mt-8">
                                    <button @click="section = 'Klantgegevens'" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Terug
                                    </button>
                                    <button @click="section = 'Haspels'" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Volgende
                                    </button>
                                </div>
                            </section>

                            <section v-show="section === 'Haspels' || section === 'Overzicht'">
                                <div class="px-5">
                                    <div class="mb-3">
                                        <label class="text-md font-medium text-gray-600 mb-1">Afhaaltijd</label>
                                        <input v-model="form.pickup" type="datetime-local" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    </div>

                                    <h1 class="text-md font-medium mb-2 mt-5">Haspels</h1>
                                    <div class="mb-3">


                                        <div class="relative flex items-start mb-2">
                                            <div class="flex items-center h-5">
                                                <input v-model="formMeta.haspels.diameter_60" id="diameter_60" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-3 w-3 text-indigo-600 border-gray-300 rounded">
                                            </div>
                                            <div class="ml-2 text-sm">
                                                <label for="diameter_60" class="font-medium text-gray-700">60<span class="text-xs text-gray-400">cm</span> Diameter</label>
                                            </div>
                                        </div>

                                        <div class="relative flex items-start mb-2">
                                            <div class="flex items-center h-5">
                                                <input v-model="formMeta.haspels.diameter_80" id="diameter_80" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-3 w-3 text-indigo-600 border-gray-300 rounded">
                                            </div>
                                            <div class="ml-2 text-sm">
                                                <label for="diameter_80" class="font-medium text-gray-700">80<span class="text-xs text-gray-400">cm</span> Diameter</label>
                                            </div>
                                        </div>

                                        <div class="relative flex items-start mb-2">
                                            <div class="flex items-center h-5">
                                                <input v-model="formMeta.haspels.diameter_100" id="diameter_100" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-3 w-3 text-indigo-600 border-gray-300 rounded">
                                            </div>
                                            <div class="ml-2 text-sm">
                                                <label for="diameter_100" class="font-medium text-gray-700">100<span class="text-xs text-gray-400">cm</span> Diameter</label>
                                            </div>
                                        </div>

                                        <div class="relative flex items-start mb-2">
                                            <div class="flex items-center h-5">
                                                <input v-model="formMeta.haspels.diameter_120" id="diameter_120" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-3 w-3 text-indigo-600 border-gray-300 rounded">
                                            </div>
                                            <div class="ml-2 text-sm">
                                                <label for="diameter_120" class="font-medium text-gray-700">120<span class="text-xs text-gray-400">cm</span> Diameter</label>
                                            </div>
                                        </div>

                                        <div class="relative flex items-start mb-2">
                                            <div class="flex items-center h-5">
                                                <input v-model="formMeta.haspels.diameter_140" id="diameter_140" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-3 w-3 text-indigo-600 border-gray-300 rounded">
                                            </div>
                                            <div class="ml-2 text-sm">
                                                <label for="diameter_140" class="font-medium text-gray-700">140<span class="text-xs text-gray-400">cm</span> Diameter</label>
                                            </div>
                                        </div>

                                        <div class="relative flex items-start mb-2">
                                            <div class="flex items-center h-5">
                                                <input v-model="formMeta.haspels.diameter_160" id="diameter_160" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-3 w-3 text-indigo-600 border-gray-300 rounded">
                                            </div>
                                            <div class="ml-2 text-sm">
                                                <label for="diameter_160" class="font-medium text-gray-700">160<span class="text-xs text-gray-400">cm</span> Diameter</label>
                                            </div>
                                        </div>

                                        <div class="relative flex items-start mb-2">
                                            <div class="flex items-center h-5">
                                                <input v-model="formMeta.haspels.diameter_180" id="diameter_180" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-3 w-3 text-indigo-600 border-gray-300 rounded">
                                            </div>
                                            <div class="ml-2 text-sm">
                                                <label for="diameter_180" class="font-medium text-gray-700">180<span class="text-xs text-gray-400">cm</span> Diameter</label>
                                            </div>
                                        </div>

                                        <div class="relative flex items-start mb-2">
                                            <div class="flex items-center h-5">
                                                <input v-model="formMeta.haspels.diameter_200" id="diameter_200" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-3 w-3 text-indigo-600 border-gray-300 rounded">
                                            </div>
                                            <div class="ml-2 text-sm">
                                                <label for="diameter_200" class="font-medium text-gray-700">200<span class="text-xs text-gray-400">cm</span> Diameter</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="bg-gray-100 px-5 py-4 mt-8">
                                    <button @click="section = 'Ophaaladres'" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Terug
                                    </button>
                                    <button @click="section = 'Foto uploaden'" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Volgende
                                    </button>
                                </div>
                            </section>

                            <section v-show="section === 'Foto uploaden' || section === 'Overzicht'">
                                <div>
                                    <div v-show="formMeta.haspels.diameter_60">
                                        <div class="bg-gray-100 px-5 py-3 font-medium text-gray-700 mb-4">Diameter <span class="text-gray-800">60cm</span></div>

                                        <div class="px-5">
                                            <label for="location" class="lock text-sm font-medium text-gray-700">Aantal haspels van <span class="font-bold">60cm</span> diameter</label>
                                            <select v-model="form.diameter_60" id="location" class="px-3 mb-5 appearance-none block w-full py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>

                                            <label for="location" class="lock text-sm font-medium text-gray-700">Foto's uploaden</label>
                                            <p class="text-xs text-gray-500">Upload duidelijke foto(s) van de betreffende haspel(s).</p>

                                            <input type="file" id="files_60" name="files_60" class="mt-2" multiple>

                                            <button @click="sendEmballage" type="button" class="mt-10 mb-5 inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Versturen
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!--                            <div class="bg-gray-100 px-5 py-4 mt-8">-->
                                <!--                                <button @click="section = 'Haspels'" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">-->
                                <!--                                    Terug-->
                                <!--                                </button>-->
                                <!--                                <button @click="section = '&#45;&#45;&#45;&#45;'" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">-->
                                <!--                                    Volgende-->
                                <!--                                </button>-->
                                <!--                            </div>-->
                            </section>
                        </div>
                    </form>
                </div>
            </transition>

        </div>
    </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: "Emballage",
    data() {
        return {
            state: 'overview',
            form: {
                customer_fullname: '',
                customer_contact: '',
                customer_contact_phone: '',
                street: '',
                house_number: '',
                postcode: '',
                city: '',
                contact: '',
                contact_phone: '',
                contact_email: '',
                lifting_equipment: 0,
                pickup: null,
                comments: '',
                diameter_60: 0,
                diameter_80: 0,
                diameter_100: 0,
                diameter_120: 0,
                diameter_140: 0,
                diameter_160: 0,
                diameter_180: 0,
                diameter_200: 0
            },
            formMeta: {
                haspels: {
                    diameter_60: true,
                    diameter_80: false,
                    diameter_100: false,
                    diameter_120: false,
                    diameter_140: false,
                    diameter_160: false,
                    diameter_180: false,
                    diameter_200: false,
                }
            },
            section: 'Klantgegevens'
        }
    },
    mounted() {
        this.fillForm()
    },
    methods: {
        sendEmballage() {

        },

        fillForm: function () {
            this.form.customer_fullname = this.user.name;
            this.form.customer_contact = this.user.name;
            this.form.contact = this.user.name;
            this.form.contact_email = this.user.email;
        }
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
