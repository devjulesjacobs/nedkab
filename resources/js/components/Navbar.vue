<template>
    <div id="Navbar" v-if="authenticated">
        <router-link to="/">Home</router-link>
        <template v-if="!authenticated">
            <router-link to="/signin">Sign in</router-link>
        </template>
        <template v-else>
            <router-link to="/account">{{ user.name }}</router-link>
            <a href="#" @click.prevent="signOut">Sign out</a>
        </template>
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

<style scoped>
#Navbar {
    padding: 20px 0;
    border-bottom: 2px solid purple;
    margin-bottom: 20px;
}

#Navbar > a {
    padding: 10px 20px;
    border: 1px solid purple;
    border-radius: 7px;
    color: purple
}

a.router-link-exact-active {
    background: purple;
    color: #fff !important;
}
</style>