<template>
    <div>
        <h1 class="page-title text-3xl font-bold px-5 pt-5">Home</h1>
        <p class="px-5 text-gray-400">Welcome, {{ user.name }}</p>
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
