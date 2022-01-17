<template>
    <div class="fixed inset-0 z-50 overflow-hidden state-slide-post" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute inset-0" aria-hidden="true">
                    <div class="fixed inset-y-0 right-0 max-w-full flex">
                        <div class="w-screen max-w-md">
                            <div class="h-full flex flex-col py-6 bg-white shadow-xl overflow-y-scroll">
                                <div class="px-4 sm:px-6">
                                    <div class="flex items-start justify-between">
                                        <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">
                                            Emballage (#{{ emballage.id }})
                                        </h2>
                                        <div class="ml-3 h-7 flex items-center">
                                            <button @click="$emit('hide')" type="button" class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                <span class="sr-only">Close panel</span>
                                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div v-if="emballage.status === 'geaccepteerd'" class="px-4 mt-6">
                                    <div class="rounded-md bg-green-50 p-4 border border-green-200">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <h3 class="text-sm font-medium text-green-800">
                                                    Emballage geaccepteerd
                                                </h3>
                                                <p class="text-xs text-green-800 font-medium">
                                                    Geaccepteerd op {{ emballage.updated_at | moment('D MMM YYYY | H:mm') }}
                                                </p>
                                                <div class="mt-2 text-sm text-green-700">
                                                    <p>
                                                        Bedankt voor uw aanvraag, wij komen zo snel mogelijk uw emballage ophalen.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div v-if="emballage.status === 'afgewezen'" class="px-4 mt-6">
                                    <div class="rounded-md bg-red-50 p-4 border border-red-200">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <h3 class="text-sm font-medium text-red-800">
                                                    Emballage afgewezen
                                                </h3>
                                                <p class="text-xs text-red-800 font-medium">
                                                    Afgewezen op {{ emballage.updated_at | moment('D MMM YYYY | H:mm') }}
                                                </p>
                                                <div class="mt-2 text-sm text-red-700">
                                                    <p>
                                                        Uw emballage is afgewezen.
                                                    </p>
                                                </div>
                                                <div class="mt-4">
                                                    <a :href="'mailto:info@nedkab.nl?subject=Betreft Emballage #'+emballage.id" class="bg-red-50 rounded-md text-sm font-medium text-red-800 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-red-50 focus:ring-red-600">
                                                        Contact opnemen
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-6 relative flex-1">
                                    <div class="absolute inset-0 px-4">
                                        <section class="p-5 rounded-md border border-gray-200">
                                            <div class="mb-3">
                                                <h1 class="text-xs font-medium uppercase text-gray-600">Emballage</h1>
                                                <h1 class="text-md font-bold">{{ user.company }}</h1>
                                            </div>

                                            <div v-if="emballage.picture" class="mb-4 -mx-5">
                                                <img :src="'/img/emballage/'+emballage.picture" alt="Picture">
                                            </div>

                                            <div>
                                                <h1 class="font-medium text-md">Retourneerbaar</h1>
                                                <div>
                                                    <ul>
                                                        <li v-if="parseInt(emballage.diameter_60) > 0" class="text-sm">
                                                            Haspel van <span class="text-gray-400">Ø</span>60cm
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mb-1 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                            </svg>
                                                            <span class="font-medium">{{ emballage.diameter_60 }}x</span>
                                                        </li>
                                                        <li v-if="parseInt(emballage.diameter_80) > 0" class="text-sm">
                                                            Haspel van <span class="text-gray-400">Ø</span>80cm
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mb-1 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                            </svg>
                                                            <span class="font-medium">{{ emballage.diameter_80 }}x</span>
                                                        </li>
                                                        <li v-if="parseInt(emballage.diameter_100) > 0" class="text-sm">
                                                            Haspel van <span class="text-gray-400">Ø</span>100cm
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mb-1 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                            </svg>
                                                            <span class="font-medium">{{ emballage.diameter_100 }}x</span>
                                                        </li>
                                                        <li v-if="parseInt(emballage.diameter_120) > 0" class="text-sm">
                                                            Haspel van <span class="text-gray-400">Ø</span>120cm
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mb-1 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                            </svg>
                                                            <span class="font-medium">{{ emballage.diameter_120 }}x</span>
                                                        </li>
                                                        <li v-if="parseInt(emballage.diameter_140) > 0" class="text-sm">
                                                            Haspel van <span class="text-gray-400">Ø</span>140cm
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mb-1 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                            </svg>
                                                            <span class="font-medium">{{ emballage.diameter_140 }}x</span>
                                                        </li>
                                                        <li v-if="parseInt(emballage.diameter_160) > 0" class="text-sm">
                                                            Haspel van <span class="text-gray-400">Ø</span>160cm
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mb-1 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                            </svg>
                                                            <span class="font-medium">{{ emballage.diameter_160 }}x</span>
                                                        </li>
                                                        <li v-if="parseInt(emballage.diameter_180) > 0" class="text-sm">
                                                            Haspel van <span class="text-gray-400">Ø</span>180cm
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mb-1 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                            </svg>
                                                            <span class="font-medium">{{ emballage.diameter_180 }}x</span>
                                                        </li>
                                                        <li v-if="parseInt(emballage.diameter_200) > 0" class="text-sm">
                                                            Haspel van <span class="text-gray-400">Ø</span>200cm
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mb-1 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                            </svg>
                                                            <span class="font-medium">{{ emballage.diameter_200 }}x</span>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <h1 class="font-medium text-md mt-5 ">Klantgegevens</h1>
                                                <div class="space-y-2">
                                                    <dl>
                                                        <div class="mb-1  flex justify-between text-sm font-medium">
                                                            <dt class="text-gray-500">Klantnaam</dt>
                                                            <dd class="text-gray-900">{{ emballage.customer_fullname }}</dd>
                                                        </div>

                                                        <div class="mb-1  flex justify-between text-sm font-medium">
                                                            <dt class="text-gray-500">Contactpersoon</dt>
                                                            <dd class="text-gray-900">{{ emballage.customer_contact }}</dd>
                                                        </div>

                                                        <div class="mb-1  flex justify-between text-sm font-medium">
                                                            <dt class="text-gray-500">Telefoonnummer</dt>
                                                            <dd class="text-gray-900">{{ emballage.customer_contact_phone }}</dd>
                                                        </div>
                                                    </dl>
                                                </div>

                                                <h1 class="font-medium text-md mt-5 ">Ophaaladres</h1>
                                                <div class="space-y-2">
                                                    <dl>
                                                        <div class="mb-1  flex justify-between text-sm font-medium">
                                                            <dt class="text-gray-500">Straat en huisnummer</dt>
                                                            <dd class="text-gray-900">{{ emballage.street + ' ' + emballage.house_number }}</dd>
                                                        </div>

                                                        <div class="mb-1  flex justify-between text-sm font-medium">
                                                            <dt class="text-gray-500">Plaats en postcode</dt>
                                                            <dd class="text-gray-900">{{ emballage.city  + ' ' + emballage.postcode }}</dd>
                                                        </div>

                                                        <div class="mb-1  flex justify-between text-sm font-medium">
                                                            <dt class="text-gray-500">Hefinstallatie benodigd</dt>
                                                            <dd class="text-gray-900">{{ parseInt(emballage.lifting_equipment) === 1 ? 'Ja' : 'Nee' }}</dd>
                                                        </div>
                                                    </dl>
                                                </div>

                                                <h1 class="font-medium text-md mt-5 ">Contact (op locatie)</h1>
                                                <div class="space-y-2">
                                                    <dl>
                                                        <div class="mb-1  flex justify-between text-sm font-medium">
                                                            <dt class="text-gray-500">Contactpersoon</dt>
                                                            <dd class="text-gray-900">{{ emballage.contact }}</dd>
                                                        </div>

                                                        <div class="mb-1  flex justify-between text-sm font-medium">
                                                            <dt class="text-gray-500">Telefoonnummer</dt>
                                                            <dd class="text-gray-900">{{ emballage.contact_phone }}</dd>
                                                        </div>

                                                        <div class="mb-1  flex justify-between text-sm font-medium">
                                                            <dt class="text-gray-500">Emailadres</dt>
                                                            <dd class="text-gray-900">{{ emballage.contact_email }}</dd>
                                                        </div>
                                                    </dl>
                                                </div>

                                                <h1 class="font-medium text-md mt-5 ">Opmerkingen</h1>
                                                <p v-if="emballage.comments" class=" text-sm">{{ emballage.comments }}</p>
                                                <p v-else class=" text-sm text-gray-500 italic">Geen opmerkingen</p>
                                            </div>
                                        </section>
                                        <div class="py-5">
                                            <a :href="'mailto:info@nedkab.nl?subject=Betreft Emballage #'+emballage.id" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-theme hover:bg-blue-theme focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                              Contact opnemen
                                                <svg class="ml-2 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: "EmballageSlide",
    data() {
        return {

        }
    },
    computed: {
        ...mapGetters({
            user: "auth/user",
        })
    },
    props: ['emballage']
}
</script>

<style scoped>

</style>
