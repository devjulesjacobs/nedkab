<template>
    <div class="fixed inset-0 overflow-hidden z-50" aria-labelledby="slide-over-title" role="dialog"
             aria-modal="true">
            <div class="absolute inset-0 overflow-hidden bg-gray-500 bg-opacity-75 transition-opacity">
                <!-- Background overlay, show/hide based on slide-over state. -->
                <div class="absolute inset-0" aria-hidden="true">
                    <div class="fixed inset-y-0 right-0 max-w-full flex sm:pl-16">
                        <div class="w-screen max-w-2xl sx:max-w-full">
                            <div class="h-full flex flex-col py-6 bg-white shadow-xl overflow-y-scroll">
                                <div class="px-6 mb-6">
                                    <div class="flex items-start justify-between">
                                        <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">
                                            Gebruiker overzicht
                                        </h2>
                                        <div class="ml-3 h-7 flex items-center">
                                            <button @click="hideSlide" type="button"
                                                    class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                <span class="sr-only">Close panel</span>
                                                <!-- Heroicon name: outline/x -->
                                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="px-6">

                                    <div class="flex">
                                        <div class="mr-4 flex-shrink-0">
                                            <img v-if="user.avatar" :src="'/img/user/'+user.avatar" alt="" class="h-16 w-16 rounded-md object-center object-cover">
                                            <img v-else src="/img/user/empty-profile-picture.jpg" alt="" class="h-16 w-16 rounded-md object-center object-cover">
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold">{{ user.name }}</h4>
                                            <p class="mt-1">
                                                {{ user.email }}
                                            </p>
                                        </div>
                                    </div>

                                    <hr class="my-5">

                                    <div class="mb-5">
                                        <h1 class="font-medium mb-3">Persoonsgegevens</h1>

                                        <div class="mb-3">
                                            <h3 class="text-xs text-gray-500">Bedrijf</h3>
                                            <p>{{ user.company }}</p>
                                        </div>

                                        <div class="mb-3">
                                            <h3 class="text-xs text-gray-500">Emailadres</h3>
                                            <a :href="'mailto:'+user.email" class="text-blue-600 hover:text-blue-400">{{ user.email }}</a>
                                        </div>

                                        <div class="mb-3">
                                            <h3 class="text-xs text-gray-500">Telefoonnummer</h3>
                                            <a :href="'tel:'+user.phone" class="text-blue-600 hover:text-blue-400">{{ user.phone }}</a>
                                        </div>
                                    </div>

                                    <hr class="my-5">

                                    <div class="mb-5">
                                        <h1 class="font-medium">Emballage gegevens</h1>
                                        <p class="text-xs text-gray-500 mb-6">De gegevens van de meest recent ingediende emballage worden altijd opgeslagen. Deze worden voor de gebruikers uiteindelijk weer ingevuld bij een nieuwe emballage.</p>


                                        <div>
                                            <h3 class="font-medium text-gray-900">Klant & Contactpersoon</h3>
                                            <dl class="mt-2 border-t border-b border-gray-200 divide-y divide-gray-200">
                                                <div class="py-3 flex justify-between text-sm font-medium">
                                                    <dt class="text-gray-500">Klantnaam</dt>
                                                    <dd class="text-gray-900">{{ user.customer_fullname }}</dd>
                                                </div>

                                                <div class="py-3 flex justify-between text-sm font-medium">
                                                    <dt class="text-gray-500">Contactpersoon</dt>
                                                    <dd class="text-gray-900">{{ user.customer_contact }}</dd>
                                                </div>

                                                <div class="py-3 flex justify-between text-sm font-medium">
                                                    <dt class="text-gray-500">Contactpersoon telefoonnummer</dt>
                                                    <a :href="'tel:'+user.customer_contact_phone" class="text-blue-600 hover:text-blue-400">{{ user.customer_contact_phone }}</a>
                                                </div>
                                            </dl>
                                        </div>

                                        <div class="mt-6 mb-4">
                                            <h3 class="font-medium text-gray-900">Adresgegevens & Contactpersoon</h3>
                                            <dl class="mt-2 border-t border-b border-gray-200 divide-y divide-gray-200">
                                                <div class="py-3 flex justify-between text-sm font-medium">
                                                    <dt class="text-gray-500">Adres</dt>
                                                    <dd class="text-gray-900">
                                                        <p>{{ user.street }} {{ user.house_number }}</p>
                                                        <p>{{ user.postcode }} {{ user.city }}</p>
                                                    </dd>
                                                </div>

                                                <div class="py-3 flex justify-between text-sm font-medium">
                                                    <dt class="text-gray-500">Contactpersoon</dt>
                                                    <dd class="text-gray-900">{{ user.contact }}</dd>
                                                </div>

                                                <div class="py-3 flex justify-between text-sm font-medium">
                                                    <dt class="text-gray-500">Contactpersoon telefoonnummer</dt>
                                                    <a :href="'tel:'+user.contact_phone" class="text-blue-600 hover:text-blue-400">{{ user.contact_phone }}</a>
                                                </div>

                                                <div class="py-3 flex justify-between text-sm font-medium">
                                                    <dt class="text-gray-500">Contactpersoon emailadres</dt>
                                                    <a :href="'mailto:'+user.contact_email" class="text-blue-600 hover:text-blue-400">{{ user.contact_email }}</a>
                                                </div>
                                            </dl>
                                        </div>

                                        <div>
                                            <button type="button" @click="deleteUser" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                Gebruiker verwijderen
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
</template>

<script>
export default {
    name: "SlideUser",
    data() {
        return {
            form: {
                create: {

                }
            },
            errors: []
        }
    },
    mounted() {

    },
    methods: {
        hideSlide: function () {
            this.$emit('hide');
            this.errors = [];
        },

        deleteUser() {
            if(confirm('Weet je zeker dat je de gebruiker '+this.user.name+' wilt verwijderen? Dit kan niet ongedaan gemaakt worden.'))
            axios.post('/api/cms/user/delete', { id: this.user.id})
                .then(res => {
                    this.$emit('hide');
                })
                .catch(err => {
                    console.log(err);
                })
        }
    },
    props: ['show', 'user']
}
</script>
