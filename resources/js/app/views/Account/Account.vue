<template>
    <div style="max-height: calc(100vh - 85px);overflow-y: auto">
        <h1 class="page-title text-3xl font-bold px-5 py-5">Account</h1>

        <div class="px-5 mb-5">
            <div class="flex">
                <div class="flex-2">
                    <span class="inline-block relative">
                      <img class="h-16 w-16 rounded-full object-center object-cover"
                           :src="user.avatar ? '/img/user/'+user.avatar : '/img/user/empty-profile-picture.jpg'"
                           alt="">
                      <span class="absolute top-0 right-0 block h-4 w-4 rounded-full ring-2 ring-white bg-green-400"></span>
                    </span>
                </div>
                <div class="flex-auto">
                    <div>
                        <p class="px-4 text-2xl font-bold">{{ user.name }}</p>
                        <p class="px-4 text-gray-600 text-sm">{{ user.company }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-5 pb-6 mt-3">
            <button @click="signOut" type="button"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Logout
            </button>
        </div>

        <profile-slide :user="user"
                       @hide="hideProfileSlide"/>

    </div>
</template>

<script>
import {mapGetters, mapActions} from "vuex";
import ProfileSlide from "../../components/ProfileSlide/ProfileSlide";

export default {
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

        async signOut() {
            await this.logout();

            this.$router.replace({name: "Signin"});
        },

        hideProfileSlide() {

        }
    },
    components: {
        ProfileSlide
    }
};
</script>

<style>
</style>
