<template>
    <div>
        <h1 class="text-3xl page-title leading-8 font-bold tracking-tight text-gray-900">Dashboard</h1>
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
