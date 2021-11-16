<template>
    <div class="state-app">
        <router-view />
        <BottomNav v-if="authenticated"></BottomNav>
        <LoadingScreen></LoadingScreen>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import BottomNav from "./components/BottomNav/BottomNav";
import LoadingScreen from "./components/LoadingScreen/LoadingScreen";

export default {
    name: "App",
    components: {
        BottomNav,
        LoadingScreen
    },
    computed: {
        ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user",
        }),
    },
};
</script>
