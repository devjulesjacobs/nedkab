<template>
    <div class="state-app">
        <router-view />
        <BottomNav></BottomNav>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import BottomNav from "./components/BottomNav/BottomNav";

export default {
    components: {
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
