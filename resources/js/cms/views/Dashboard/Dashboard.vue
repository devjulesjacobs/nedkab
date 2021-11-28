<template>
    <div>
        <h1 class="text-3xl page-title leading-8 font-bold tracking-tight text-gray-900">Dashboard</h1>

        <button @click="signOut" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Logout
        </button>

        <router-link :to="{ name: 'Signin' }" class="mt-3 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Login page
        </router-link>
    </div>
</template>

<script>
import {mapActions} from "vuex";

export default {
    name: "Dashboard",

    mounted() {
        // this.$store.dispatch('cms/addNotification', {
        //     type: 'success',
        //     title: 'Succesfully did shit!',
        //     message: 'This is just some simple message put under the title element!',
        // });
        //
        // this.$store.dispatch('cms/addNotification', {
        //     type: 'error',
        //     title: 'Error something!',
        //     message: 'This is just some simple message put under the title element!',
        // });
        //
        // this.$store.dispatch('cms/addNotification', {
        //     type: 'warning',
        //     title: 'Warning something really dangerous!',
        //     message: 'This is just some simple message put under the title element!',
        // });
        //
        // this.$store.dispatch('cms/addNotification', {
        //     type: 'info',
        //     title: 'Just some information that can get to you ...',
        //     message: 'This is just some simple message put under the title element!',
        // });
    },

    methods: {
        ...mapActions({
            logout: "cms/logout",
        }),

        async signOut() {
            await this.logout();
            await this.$store.dispatch('cms/addNotification', {
                type: 'success',
                title: 'Logged out successfully.',
            });
            this.$router.replace({ name: "Signin" });
        },
    },
}
</script>

<style scoped>

</style>
