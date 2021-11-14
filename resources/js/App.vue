<template>
    <div class="state-app">
        <div :class="{'container': authenticated}">
            <Navbar></Navbar>
            <router-view />
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import Navbar from "./components/Navbar.vue";

export default {
    components: {
        Navbar,
    },
    computed: {
        ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user",
        }),
    },
};
</script>

<style></style>