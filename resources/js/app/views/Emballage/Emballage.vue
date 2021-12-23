<template>
    <div class="state-emballage">
        <h1 class="page-title text-3xl font-bold px-5 pt-5 mb-5">Emballage</h1>

        <div class="px-5">

            <div v-if="state === 'overview'" class="absolute right-4 bottom-24 pb-2">
                <button @click="state = 'create'" type="button" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-full text-white bg-blue-theme hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-200">
                    Aanmaken
                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 -mr-1 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

<!--            <submitted-emballages v-if="state === 'overview'" class="mt-5"/>-->
            <emballage-overview v-if="state === 'overview'" />

            <transition name="slide-fade">
                <div v-if="state === 'create'">
                    <form>
                        <div class="bg-white rounded-md shadow-md">
                            <h1 class="text-md font-medium px-5 pt-5 mb-2">{{ section }}</h1>
                            <p v-show="section === 'Klantgegevens' || section === 'Ophaaladres'" class="text-xs px-5 mb-5 text-gray-500">De ingevulde gegevens worden automatisch opgeslagen voor de volgende keer.</p>
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
                                    <div class="flex mb-3">
                                        <div class="w-3/4">
                                            <label class="text-md font-medium text-gray-600 mb-1">Straatnaam</label>
                                            <input v-model="form.street" type="text" class="w-full appearance-none block px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        </div>
                                        <div class="w-1/4">
                                            <label class="text-md font-medium text-gray-600 mb-1 ml-2">Huisnr.</label>
                                            <input v-model="form.house_number" type="text" class="ml-2 text-center appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        </div>
                                    </div>

                                    <div class="flex mb-3">
                                        <div class="w-1/3">
                                            <label class="text-md font-medium text-gray-600 mb-1">Postcode</label>
                                            <input v-model="form.postcode" type="text" maxlength="6" class="text-center appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        </div>
                                        <div class="w-2/3">
                                            <label class="text-md font-medium text-gray-600 mb-1 ml-2">Plaats</label>
                                            <input v-model="form.city" type="text" class="ml-2 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        </div>
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
                                    <button @click="section = 'Haspels en afronden'" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Volgende
                                    </button>
                                </div>
                            </section>

                            <section v-show="section === 'Haspels en afronden' || section === 'Overzicht'">
                                <div class="px-5">
                                    <div class="mb-3">
                                        <h1 class="text-md font-medium mt-5 mb-1">Afhaaltijd</h1>
                                        <input v-model="form.pickup" type="time" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    </div>

                                    <h1 class="text-md font-medium mt-5 mb-1">Is er een hefinstallatie nodig?</h1>
                                    <div class="relative flex items-start">
                                        <div class="flex items-center h-5">
                                            <input v-model="form.lifting_equipment" id="lifting_equipment" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-3 w-3 text-indigo-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-1.5 text-sm">
                                            <label for="lifting_equipment" class="font-medium text-gray-700">Ja, <span id="comments-description" class="font-normal text-gray-500">er is een hefinstallatie nodig.</span></label>

                                        </div>
                                    </div>

                                    <h1 class="text-md font-medium mt-5">Haspels</h1>
                                    <p class="text-xs mb-3 text-gray-500">Selecteer de haspel(s) die u wilt retourneren.</p>

                                    <div class="mb-3">

                                        <div class="relative flex items-start mb-2">
                                            <div class="flex items-center h-5">
                                                <input v-model="formMeta.haspels.diameter_60" id="diameter_60" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-3 w-3 text-indigo-600 border-gray-300 rounded">
                                            </div>
                                            <div class="ml-2 text-sm">
                                                <label for="diameter_60" class="font-medium text-gray-700">60<span class="text-xs text-gray-400">cm</span> Diameter</label>
                                            </div>
                                        </div>
                                        <select v-if="formMeta.haspels.diameter_60" v-model="form.diameter_60" class="px-2 mb-5 text-xs appearance-none block w-full py-1 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            <option value="0" disabled>Selecteer aantal</option>
                                            <option value="1">1 haspel</option>
                                            <option value="2">2 haspels</option>
                                            <option value="3">3 haspels</option>
                                            <option value="4">4 haspels</option>
                                            <option value="5">5 haspels</option>
                                            <option value="6">6 haspels</option>
                                            <option value="7">7 haspels</option>
                                            <option value="8">8 haspels</option>
                                            <option value="9">9 haspels</option>
                                            <option value="10">10 haspels</option>
                                        </select>

                                        <div class="relative flex items-start mb-2">
                                            <div class="flex items-center h-5">
                                                <input v-model="formMeta.haspels.diameter_80" id="diameter_80" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-3 w-3 text-indigo-600 border-gray-300 rounded">
                                            </div>
                                            <div class="ml-2 text-sm">
                                                <label for="diameter_80" class="font-medium text-gray-700">80<span class="text-xs text-gray-400">cm</span> Diameter</label>
                                            </div>
                                        </div>
                                        <select v-if="formMeta.haspels.diameter_80" v-model="form.diameter_80" class="px-2 mb-5 text-xs appearance-none block w-full py-1 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            <option value="0" disabled>Selecteer aantal</option>
                                            <option value="1">1 haspel</option>
                                            <option value="2">2 haspels</option>
                                            <option value="3">3 haspels</option>
                                            <option value="4">4 haspels</option>
                                            <option value="5">5 haspels</option>
                                            <option value="6">6 haspels</option>
                                            <option value="7">7 haspels</option>
                                            <option value="8">8 haspels</option>
                                            <option value="9">9 haspels</option>
                                            <option value="10">10 haspels</option>
                                        </select>


                                        <div class="relative flex items-start mb-2">
                                            <div class="flex items-center h-5">
                                                <input v-model="formMeta.haspels.diameter_100" id="diameter_100" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-3 w-3 text-indigo-600 border-gray-300 rounded">
                                            </div>
                                            <div class="ml-2 text-sm">
                                                <label for="diameter_100" class="font-medium text-gray-700">100<span class="text-xs text-gray-400">cm</span> Diameter</label>
                                            </div>
                                        </div>
                                        <select v-if="formMeta.haspels.diameter_100" v-model="form.diameter_100" class="px-2 mb-5 text-xs appearance-none block w-full py-1 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            <option value="0" disabled>Selecteer aantal</option>
                                            <option value="1">1 haspel</option>
                                            <option value="2">2 haspels</option>
                                            <option value="3">3 haspels</option>
                                            <option value="4">4 haspels</option>
                                            <option value="5">5 haspels</option>
                                            <option value="6">6 haspels</option>
                                            <option value="7">7 haspels</option>
                                            <option value="8">8 haspels</option>
                                            <option value="9">9 haspels</option>
                                            <option value="10">10 haspels</option>
                                        </select>


                                        <div class="relative flex items-start mb-2">
                                            <div class="flex items-center h-5">
                                                <input v-model="formMeta.haspels.diameter_120" id="diameter_120" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-3 w-3 text-indigo-600 border-gray-300 rounded">
                                            </div>
                                            <div class="ml-2 text-sm">
                                                <label for="diameter_120" class="font-medium text-gray-700">120<span class="text-xs text-gray-400">cm</span> Diameter</label>
                                            </div>
                                        </div>
                                        <select v-if="formMeta.haspels.diameter_120" v-model="form.diameter_120" class="px-2 mb-5 text-xs appearance-none block w-full py-1 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            <option value="0" disabled>Selecteer aantal</option>
                                            <option value="1">1 haspel</option>
                                            <option value="2">2 haspels</option>
                                            <option value="3">3 haspels</option>
                                            <option value="4">4 haspels</option>
                                            <option value="5">5 haspels</option>
                                            <option value="6">6 haspels</option>
                                            <option value="7">7 haspels</option>
                                            <option value="8">8 haspels</option>
                                            <option value="9">9 haspels</option>
                                            <option value="10">10 haspels</option>
                                        </select>


                                        <div class="relative flex items-start mb-2">
                                            <div class="flex items-center h-5">
                                                <input v-model="formMeta.haspels.diameter_140" id="diameter_140" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-3 w-3 text-indigo-600 border-gray-300 rounded">
                                            </div>
                                            <div class="ml-2 text-sm">
                                                <label for="diameter_140" class="font-medium text-gray-700">140<span class="text-xs text-gray-400">cm</span> Diameter</label>
                                            </div>
                                        </div>
                                        <select v-if="formMeta.haspels.diameter_140" v-model="form.diameter_140" class="px-2 mb-5 text-xs appearance-none block w-full py-1 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            <option value="0" disabled>Selecteer aantal</option>
                                            <option value="1">1 haspel</option>
                                            <option value="2">2 haspels</option>
                                            <option value="3">3 haspels</option>
                                            <option value="4">4 haspels</option>
                                            <option value="5">5 haspels</option>
                                            <option value="6">6 haspels</option>
                                            <option value="7">7 haspels</option>
                                            <option value="8">8 haspels</option>
                                            <option value="9">9 haspels</option>
                                            <option value="10">10 haspels</option>
                                        </select>


                                        <div class="relative flex items-start mb-2">
                                            <div class="flex items-center h-5">
                                                <input v-model="formMeta.haspels.diameter_160" id="diameter_160" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-3 w-3 text-indigo-600 border-gray-300 rounded">
                                            </div>
                                            <div class="ml-2 text-sm">
                                                <label for="diameter_160" class="font-medium text-gray-700">160<span class="text-xs text-gray-400">cm</span> Diameter</label>
                                            </div>
                                        </div>
                                        <select v-if="formMeta.haspels.diameter_160" v-model="form.diameter_160" class="px-2 mb-5 text-xs appearance-none block w-full py-1 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            <option value="0" disabled>Selecteer aantal</option>
                                            <option value="1">1 haspel</option>
                                            <option value="2">2 haspels</option>
                                            <option value="3">3 haspels</option>
                                            <option value="4">4 haspels</option>
                                            <option value="5">5 haspels</option>
                                            <option value="6">6 haspels</option>
                                            <option value="7">7 haspels</option>
                                            <option value="8">8 haspels</option>
                                            <option value="9">9 haspels</option>
                                            <option value="10">10 haspels</option>
                                        </select>


                                        <div class="relative flex items-start mb-2">
                                            <div class="flex items-center h-5">
                                                <input v-model="formMeta.haspels.diameter_180" id="diameter_180" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-3 w-3 text-indigo-600 border-gray-300 rounded">
                                            </div>
                                            <div class="ml-2 text-sm">
                                                <label for="diameter_180" class="font-medium text-gray-700">180<span class="text-xs text-gray-400">cm</span> Diameter</label>
                                            </div>
                                        </div>
                                        <select v-if="formMeta.haspels.diameter_180" v-model="form.diameter_180" class="px-2 mb-5 text-xs appearance-none block w-full py-1 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            <option value="0" disabled>Selecteer aantal</option>
                                            <option value="1">1 haspel</option>
                                            <option value="2">2 haspels</option>
                                            <option value="3">3 haspels</option>
                                            <option value="4">4 haspels</option>
                                            <option value="5">5 haspels</option>
                                            <option value="6">6 haspels</option>
                                            <option value="7">7 haspels</option>
                                            <option value="8">8 haspels</option>
                                            <option value="9">9 haspels</option>
                                            <option value="10">10 haspels</option>
                                        </select>


                                        <div class="relative flex items-start mb-2">
                                            <div class="flex items-center h-5">
                                                <input v-model="formMeta.haspels.diameter_200" id="diameter_200" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-3 w-3 text-indigo-600 border-gray-300 rounded">
                                            </div>
                                            <div class="ml-2 text-sm">
                                                <label for="diameter_200" class="font-medium text-gray-700">200<span class="text-xs text-gray-400">cm</span> Diameter</label>
                                            </div>
                                        </div>
                                        <select v-if="formMeta.haspels.diameter_200" v-model="form.diameter_200" class="px-2 mb-5 text-xs appearance-none block w-full py-1 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            <option value="0" disabled>Selecteer aantal</option>
                                            <option value="1">1 haspel</option>
                                            <option value="2">2 haspels</option>
                                            <option value="3">3 haspels</option>
                                            <option value="4">4 haspels</option>
                                            <option value="5">5 haspels</option>
                                            <option value="6">6 haspels</option>
                                            <option value="7">7 haspels</option>
                                            <option value="8">8 haspels</option>
                                            <option value="9">9 haspels</option>
                                            <option value="10">10 haspels</option>
                                        </select>

                                    </div>

                                    <h1 class="text-md font-medium mt-5 mb-1">Opmerkingen</h1>
                                    <textarea v-model="form.comments" rows="6"
                                              class="shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border border-gray-300 rounded-md px-3 py-2"></textarea>

                                </div>

                                <div class="bg-gray-100 px-5 py-4 mt-8">
                                    <button @click="section = 'Ophaaladres'" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Terug
                                    </button>
                                    <button @click="section = 'Afronden'" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Volgende
                                    </button>
                                </div>
                            </section>

                            <section v-show="section === 'Afronden'" class="px-5">
                                <div>
                                    <h1 class="font-medium text-md mb-1">Uw gegevens</h1>
                                    <div>
                                        <h5 class="text-gray-900 font-medium">Naam</h5>
                                        <p class="text-gray-700 text-sm">{{ user.name }}</p>
                                    </div>
                                </div>

                                <div class="bg-gray-100 px-5 py-4 mt-8">
                                    <button @click="section = 'Haspels en afronden'" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Terug
                                    </button>
                                    <button @click="sendEmballage" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Indienen
                                    </button>
                                </div>
                            </section>

                        </div>
                    </form>
                </div>
            </transition>

        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import SubmittedEmballages from "../../components/SubmittedEmballages/SubmittedEmballages";
import EmballageOverview from "../../components/EmballageOverview/EmballageOverview";

export default {
    name: "Emballage",
    data() {
        return {
            state: 'create',
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
                diameter_200: 0,
                user: null,
                picture: ''
            },
            formMeta: {
                haspels: {
                    diameter_60: false,
                    diameter_80: false,
                    diameter_100: false,
                    diameter_120: false,
                    diameter_140: false,
                    diameter_160: false,
                    diameter_180: false,
                    diameter_200: false,
                }
            },
            section: 'Afronden'
        }
    },
    mounted() {
        this.fillForm()
    },
    methods: {
        ...mapActions({
            setValuesUser: 'auth/setValuesUser'
        }),
        sendEmballage() {
            axios.post('/api/emballage', this.form)
            .then(res => {
                this.state = 'overview'
                this.$store.dispatch('auth/addNotification', {
                    type: 'success',
                    title: 'Emballage ingediend',
                    message: res.data.message,
                });
                this.setValuesUser();
            })
            .catch(err => {
                this.$store.dispatch('auth/addNotification', {
                    type: 'error',
                    title: 'Emballage niet ingediend',
                    message: err.data.message,
                });
            })
        },

        fillForm: function () {
            let today = new Date(),
            time = today.getHours() + ":" + '00';

            this.form.customer_fullname         = this.user.customer_fullname;
            this.form.customer_contact          = this.user.customer_contact;
            this.form.customer_contact_phone    = this.user.customer_contact_phone;
            this.form.street                    = this.user.street;
            this.form.house_number              = this.user.house_number;
            this.form.postcode                  = this.user.postcode;
            this.form.city                      = this.user.city;
            this.form.contact                   = this.user.contact;
            this.form.contact_phone             = this.user.contact_phone;
            this.form.contact_email             = this.user.contact_email;
            this.form.pickup                    = time;
            this.form.user                      = this.user.id
        }
    },
    computed: {
        ...mapGetters({
            user: "auth/user",
        }),
    },
    components: {
        EmballageOverview,
        SubmittedEmballages
    }
}
</script>

<style scoped>

</style>
