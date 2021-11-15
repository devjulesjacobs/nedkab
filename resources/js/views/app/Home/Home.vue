<template>
    <div>
        <h1 class="page-title text-3xl font-bold px-5 pt-5">Home</h1>
        <p class="px-5 text-gray-400 pb-20">Welcome, {{ user.name }}</p>


        <div class="px-5">
            <router-link :to="{ name: 'Dashboard' }" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Go to CMS
            </router-link>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
    name: 'Home',

    components:{},

    computed: {
        ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user",
        }),
    }
};
</script>
