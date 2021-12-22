<template>
    <div class="state-app">
        <transition mode="out-in" enter-active-class="animate__animated animate__fadeIn animate__faster">
            <div :class="{ 'content-window': authenticated }">
                <router-view />
            </div>
        </transition>

        <BottomNav v-if="authenticated"></BottomNav>
        <notifications-list-app />
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import BottomNav from "./components/BottomNav/BottomNav";
import NotificationsListApp from "../_components/NotificationsListApp/NotificationsListApp";

export default {
    name: "App",
    components: {
        BottomNav,
        NotificationsListApp
    },
    computed: {
        ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user",
        }),
    },
};
</script>
