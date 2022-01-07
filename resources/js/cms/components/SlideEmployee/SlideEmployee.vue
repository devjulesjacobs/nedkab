<template>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <transition name="slide-fade">
        <div v-if="show" class="fixed inset-0 overflow-hidden z-50" aria-labelledby="slide-over-title" role="dialog"
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
                                            Medewerker aanmaken
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
                                    <form @submit.prevent="createUser" method="post">
                                        <div class="mb-3">
                                            <label for="name">Naam</label>
                                            <input v-model="form.create.name"
                                                   type="text"
                                                   id="name"
                                                   required
                                                   class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        </div>
                                        <div class="mb-3">
                                            <label for="email">Emailadres</label>
                                            <input v-model="form.create.email"
                                                   type="text"
                                                   id="email"
                                                   required
                                                   class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        </div>
                                        <div>
                                            <button type="submit" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Aanmaken
                                            </button>
                                        </div>
                                    </form>
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
    name: "SlideEmployee",
    data() {
        return {
            form: {
                create: {
                    name: '',
                    email: ''
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

        createUser() {
            axios.post('/api/cms/employee', this.form.create)
                .then(res => {
                    this.$store.dispatch('cms/addNotification', {
                        type: 'success',
                        title: 'Admin gebruiker aangemaakt',
                    });
                })
                .catch(err => {
                    this.$store.dispatch('cms/addNotification', {
                        type: 'error',
                        title: 'Kon gebruiker niet aanmaken',
                    });
                })
        }
    },
    props: ['show']
}
</script>
