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
                                            Profiel bewerken
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
                                <div class="mt-2 relative flex-1">
                                    <div class="absolute inset-0">

                                        <div class="flex pt-4 pb-2">
                                            <div class="flex-2 pl-4">
                                                <span class="block relative mt-1">
                                                    <label for="avatar">
                                                        <img v-if="!avatar" class="h-20 w-20 rounded-full object-center object-cover border-2 border-dashed"
                                                           :src="user.avatar ? '/img/user/'+user.avatar : '/img/user/empty-profile-picture.jpg'">

                                                        <img v-if="avatar" class="h-20 w-20 rounded-full object-center object-cover border-2 border-dashed"
                                                           :src="avatar">
                                                        <div class="text-center text-xs text-blue-600 mt-\">wijzigen</div>
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="flex-auto">
                                                <div class="pt-5">
                                                    <p class="px-4 text-2xl font-bold">{{ user.name }}</p>
                                                    <p class="px-4 text-gray-600 text-sm">{{ form.company }}</p>
                                                </div>
                                            </div>

                                            <form method="post" enctype="multipart/form-data">
                                                <input @change="getImage($event)" type="file" id="avatar" name="image" class="hidden" accept="image/png, image/jpeg"/>
                                            </form>
                                        </div>

                                        <div class="bg-gray-100 p-4 mb-4 font-medium">Persoonlijke gegevens</div>

                                        <div class="space-y-3 px-4">
                                            <div>
                                                <h3 class="text-sm font-medium mb-1">Emailadres <span class="text-xs text-gray-600 font-thin">niet aanpasbaar</span></h3>
                                                <input v-model="form.email" type="text" disabled class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            </div>
                                            <div>
                                                <h3 class="text-sm font-medium mb-1">Telefoonnummer</h3>
                                                <input v-model="form.phone" type="number" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            </div>
                                            <div>
                                                <h3 class="text-sm font-medium mb-1">Bedrijf</h3>
                                                <input v-model="form.company" type="text" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            </div>
                                        </div>

                                        <div class="bg-gray-100 p-4 mt-6 mb-4 font-medium">Emballage gegevens</div>

                                        <p class="text-xs text-gray-600 px-4 mb-4">Onderstaande gegevens worden automatisch ingevuld bij het aanmaken van een Emballage.</p>

                                        <div class="space-y-3 px-4">
                                            <div>
                                                <h3 class="text-sm font-medium mb-1">Klantnaam</h3>
                                                <input v-model="form.customer_fullname" type="text" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            </div>
                                            <div>
                                                <h3 class="text-sm font-medium mb-1">Contactpersoon klant</h3>
                                                <input v-model="form.customer_contact" type="text" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            </div>
                                            <div>
                                                <h3 class="text-sm font-medium mb-1">Telefoonnummer contactpersoon</h3>
                                                <input v-model="form.customer_contact_phone" type="text" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            </div>
                                            <div>
                                                <h3 class="text-sm font-medium mb-1">Straatnaam</h3>
                                                <input v-model="form.street" type="text" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            </div>
                                            <div>
                                                <h3 class="text-sm font-medium mb-1">Huisnummer</h3>
                                                <input v-model="form.house_number" type="number" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            </div>
                                            <div>
                                                <h3 class="text-sm font-medium mb-1">Postcode</h3>
                                                <input v-model="form.postcode" type="text" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            </div>
                                            <div>
                                                <h3 class="text-sm font-medium mb-1">Plaats</h3>
                                                <input v-model="form.city" type="text" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            </div>
                                            <div>
                                                <h3 class="text-sm font-medium mb-1">Contactpersoon</h3>
                                                <input v-model="form.contact" type="text" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            </div>
                                            <div>
                                                <h3 class="text-sm font-medium mb-1">Telefoonnummer contactpersoon</h3>
                                                <input v-model="form.contact_phone" type="text" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            </div>
                                            <div>
                                                <h3 class="text-sm font-medium mb-1">Emailadres contactpersoon</h3>
                                                <input v-model="form.contact_email" type="text" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            </div>
                                            <div class="pt-1 h-20">
                                                <button type="button" @click="saveAccountDetails" class="float-right inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-theme hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-200">
                                                    Gegevens opslaan
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
        </div>
    </transition>
</template>

<script>
export default {
    name: "ProfileSlide",
    data() {
        return {
            form: {},
            avatar: null,
        }
    },
    mounted() {
        this.form = this.user;
    },
    methods: {
        saveAccountDetails() {
            axios.post('/api/user/'+this.form.id, this.form)
            .then(res => {
                this.$emit('hide');
                this.$store.dispatch('auth/addNotification', {
                    type: 'success',
                    title: res.data.message,
                });
            })
            .catch(err => {
                console.log(err);
            })
        },

        getImage(e) {
            let image = e.target.files[0],
                reader = new FileReader();
            reader.readAsDataURL(image);
            reader.onload = e => {
                this.avatar = e.target.result
            }

            this.changeAvatar();
        },

        changeAvatar() {
            let imagefile = document.querySelector('#avatar');

            let formData = new FormData;
            formData.append("image", imagefile.files[0])

            let config = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }

            axios.post('/api/user/avatar/'+this.user.id, formData, config)
                .then((res) => {
                    this.$emit('refresh', res.data.image)
                    this.$store.dispatch('auth/addNotification', {
                        type: 'success',
                        title: res.data.message
                    });
                }).catch((err) => {
                this.errors = err.response.data
                this.$store.dispatch('auth/addNotification', {
                    type: 'error',
                    title: 'Something went wrong ...',
                    message: 'Something went wrong uploading your files!',
                })
            })
        }
    },
    props: ['user', 'show']
}
</script>

<style scoped>

</style>
