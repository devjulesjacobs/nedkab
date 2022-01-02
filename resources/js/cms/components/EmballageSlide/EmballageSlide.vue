<template>
    <transition name="slide-fade">
        <div v-if="show" class="fixed inset-0 z-50 overflow-hidden state-slide-post" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute inset-0" aria-hidden="true">
                    <div class="fixed inset-y-0 right-0 max-w-full flex">
                        <div class="w-screen max-w-md">
                            <div class="h-full flex flex-col py-6 bg-white shadow-xl overflow-y-scroll">
                                <div class="px-4 sm:px-6">
                                    <div class="flex items-start justify-between">
                                        <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">
                                            Emballage
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                              #{{ emballage.id }}
                                            </span>
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
                                <div class="mt-6 relative flex-1">
                                    <div class="absolute inset-0 px-4 sm:px-6">

                                        <div class="mb-4 -mx-6">
                                            <img v-if="emballage.picture" :src="'/img/emballage/'+emballage.picture" alt="Picture">
                                        </div>

                                        <div class="mb-4">
                                            <h1 class="font-bold">Geselecteerde haspels</h1>
                                            <div class="text-sm">
                                                <p v-if="emballage.diameter_60"><span class="font-bold">{{  emballage.diameter_60 }}x</span> haspel <span class="text-gray-400">Ø</span>60cm </p>
                                                <p v-if="emballage.diameter_80"><span class="font-bold">{{  emballage.diameter_80 }}x</span> haspel <span class="text-gray-400">Ø</span>80cm </p>
                                                <p v-if="emballage.diameter_100"><span class="font-bold">{{  emballage.diameter_100 }}x</span> haspel <span class="text-gray-400">Ø</span>100cm </p>
                                                <p v-if="emballage.diameter_120"><span class="font-bold">{{  emballage.diameter_120 }}x</span> haspel <span class="text-gray-400">Ø</span>120cm </p>
                                                <p v-if="emballage.diameter_140"><span class="font-bold">{{  emballage.diameter_140 }}x</span> haspel <span class="text-gray-400">Ø</span>140cm </p>
                                                <p v-if="emballage.diameter_160"><span class="font-bold">{{  emballage.diameter_160 }}x</span> haspel <span class="text-gray-400">Ø</span>160cm </p>
                                                <p v-if="emballage.diameter_180"><span class="font-bold">{{  emballage.diameter_180 }}x</span> haspel <span class="text-gray-400">Ø</span>280cm </p>
                                                <p v-if="emballage.diameter_200"><span class="font-bold">{{  emballage.diameter_200 }}x</span> haspel <span class="text-gray-400">Ø</span>200cm </p>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <h1 class="font-bold">Ophaaladres</h1>
                                            <p class="text-sm">{{ emballage.user.company }}</p>
                                            <p class="text-sm">{{ emballage.street + ' ' + emballage.house_number}}</p>
                                            <p class="text-sm -mb-1"><span class="uppercase">{{ emballage.postcode }}</span> {{ emballage.city }}</p>
                                            <a @click.prevent="copyAdres" class="text-xs text-gray-500 cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 -mt-1 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                </svg>
                                                kopiëren
                                            </a>
                                            <input type="text" class="opacity-0 h-0.5 w-0.5" v-on:focus="$event.target.select()" ref="adres" :value="emballage.street+' '+emballage.house_number+', '+emballage.postcode+' '+emballage.city">
                                        </div>

                                        <div class="mb-4">
                                            <h1 class="font-bold">Informatie</h1>
                                            <p class="text-sm">Vanaf: <span class="font-bold">{{ emballage.pickup }}</span></p>
                                            <p class="text-sm">Hefinstallatie: <span class="font-bold">{{ emballage.lifting_equipment ? 'Ja' : 'Nee' }}</span></p>
                                        </div>

                                        <div class="mb-4">
                                            <h1 class="font-bold">Opmerkingen</h1>
                                            <p v-if="emballage.comments" class=" text-sm">{{ emballage.comments }}</p>
                                            <p v-else class=" text-sm text-gray-500 italic">Geen opmerkingen</p>
                                        </div>

                                        <hr>

                                        <div class="rounded-md bg-gray-100 shadow-md p-5 mt-4">
                                            <h1 class="text-xl font-bold mb-4">Beheer</h1>
                                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                            <select id="status" class="cursor-pointer mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                                <option value="" disabled>Selecteer een status</option>
                                                <option value="ingediend">Ingediend</option>
                                                <option value="geaccepteerd">Geaccepteerd</option>
                                            </select>
                                            <button @click="saveEmballage" type="button" class="mt-2 inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Opslaan
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    name: "EmballageSlide",
    data() {
        return {
            form: {

            }
        }
    },
    methods: {
        copyAdres() {
            this.$refs.adres.focus();
            document.execCommand('copy');
            this.$store.dispatch('cms/addNotification', {
                type: 'info',
                title: 'Adres gekopieerd',
            });
        },

        saveEmballage() {
            this.$store.dispatch('cms/addNotification', {
                type: 'info',
                title: 'Functie niet beschikbaar',
                message: 'Deze functie is nog niet beschikbaar.',
            });
        }
    },
    props: ['emballage', 'show']
}
</script>

<style scoped>
.post-body {

}
</style>
