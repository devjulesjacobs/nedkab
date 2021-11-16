<template>
    <div class="state-app">
        <router-view />
        <BottomNav v-if="authenticated"></BottomNav>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import BottomNav from "../components/BottomNav/BottomNav";

export default {
    name: "App",
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
