<template>
    <div>
        <h1 class="page-title text-3xl font-bold px-5 py-5">Account</h1>

        <div class="px-5 mb-10">
            <div class="text-1xl font-bold">Email</div>
            <div class="text-blue-600">{{ user.email }}</div>
        </div>

        <div class="px-5">
            <button @click="signOut" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Logout
            </button>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
    computed: {
        ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user",
        }),
    },
    methods: {
        ...mapActions({
            signOutAction: "auth/signOut",
        }),

        async signOut() {
            await this.signOutAction();

            this.$router.replace({ name: "Signin" });
        },
    },
};
</script>

<style>
</style>
