<template>
    <div style="max-height: calc(100vh - 85px);overflow-y: auto">
        <h1 class="page-title text-3xl font-bold px-5 py-5">Account</h1>

        <div class="px-5 mb-5">
            <div class="flex bg-white px-5 py-4 rounded-md shadow-md cursor-pointer" @click="slide.show = true">
                <div class="flex-2">
                    <span class="inline-block relative mt-1">
                      <img v-if="tempAvatar" class="h-16 w-16 rounded-full object-center object-cover shadow-md"
                           :src="'/img/user/'+tempAvatar"
                           alt="">
                      <img v-else class="h-16 w-16 rounded-full object-center object-cover shadow-md"
                           :src="user.avatar ? '/img/user/'+user.avatar : '/img/user/empty-profile-picture.jpg'"
                           alt="">
                      <span class="absolute top-0 right-0 block h-4 w-4 rounded-full ring-2 ring-white bg-green-400"></span>
                    </span>
                </div>
                <div class="flex-auto">
                    <div class="pt-2">
                        <p class="px-4 text-2xl font-bold">{{ user.name }}</p>
                        <p class="px-4 text-gray-600 text-sm">{{ user.company }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-5 my-4">
            <div class="bg-white rounded-md shadow-md p-5">
                <h1 class="text-md font-medium mb-3">Mijn gegevens</h1>

                <div>
                    <div class="space-y-6">
                        <div>
                            <dl class="mt-2 border-t border-b border-gray-200 divide-y divide-gray-200">
                                <div class="py-3 flex justify-between text-sm font-medium">
                                    <dt class="text-gray-500">Emailadres</dt>
                                    <dd class="text-gray-900">{{ user.email }}</dd>
                                </div>

                                <div class="py-3 flex justify-between text-sm font-medium">
                                    <dt class="text-gray-500">Telefoonnummer</dt>
                                    <dd class="text-gray-900">{{ user.phone }}</dd>
                                </div>

                                <div class="py-3 flex justify-between text-sm font-medium">
                                    <dt class="text-gray-500">Bedrijf</dt>
                                    <dd class="text-gray-900">{{ user.company }}</dd>
                                </div>
                            </dl>

                            <div class="mt-2">
                                <a @click="slide.show = true;" class="text-blue-600 text-sm">Gegevens wijzigen</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-5 pb-6 mt-3">
            <button @click="signOut" type="button"
                    class="inline-block items-center px-3 py-1 border border-gray-300 shadow-sm text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Uitloggen
            </button>
        </div>

        <profile-slide :user="user"
                       :show="slide.show"
                       @refresh="setAvatar"
                       @hide="hideProfileSlide"/>

    </div>
</template>

<script>
import {mapGetters, mapActions} from "vuex";
import ProfileSlide from "../../components/ProfileSlide/ProfileSlide";

export default {
    data() {
        return {
            slide: {
                show: false,
            },
            tempAvatar: null,
        }
    },
    computed: {
        ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user",
        }),
    },
    methods: {
        ...mapActions({
            logout: "auth/logout",
        }),

        sendMail() {
            axios.post('/api/mail/test')
        },

        async signOut() {
            await this.logout();

            this.$router.replace({name: "Signin"});
        },

        setAvatar(filename) {
            this.tempAvatar = filename;
            this.$store.dispatch('auth/setValuesUser');
        },

        hideProfileSlide() {
            this.slide.show = false;
        },
    },
    components: {
        ProfileSlide
    }
};
</script>

<style>
</style>
