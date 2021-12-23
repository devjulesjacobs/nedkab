<template>
    <div class="state-home">
        <h1 class="page-title text-3xl font-bold px-5 pt-5">Home</h1>
        <p class="px-5 text-gray-400">Welcome, {{ user.name }}</p>

        <news-feed></news-feed>

        <submitted-emballages class="px-5"></submitted-emballages>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import NewsFeed from "../../components/NewsFeed/NewsFeed";
import SubmittedEmballages from "../../components/SubmittedEmballages/SubmittedEmballages";

export default {
    name: 'Home',

    components:{SubmittedEmballages, NewsFeed},

    mounted() {
        window.LoadingScreen('hide');
    },

    computed: {
        ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user",
        }),
    }
};
</script>
