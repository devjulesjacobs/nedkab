<template>
    <div class="state-app">
        <Navbar></Navbar>
            <router-view />
        <BottomNav></BottomNav>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import Navbar from "./components/Navbar.vue";
import BottomNav from "./components/BottomNav/BottomNav";

export default {
    components: {
        Navbar,
        BottomNav
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
