<template>
    <div class="p-5">
        <span class="font-bold">Dashboard</span><br>

        <button @click="signOut" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Logout
        </button>

        <router-link :to="{ name: 'CmsSignin' }" class="mt-3 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Login page
        </router-link>
    </div>
</template>

<script>
import {mapActions} from "vuex";

export default {
    name: "Dashboard",

    methods: {
        ...mapActions({
            logout: "cms/logout",
        }),

        async signOut() {
            await this.logout();

            this.$router.replace({ name: "CmsSignin" });
        },
    },
}
</script>

<style scoped>

</style>
