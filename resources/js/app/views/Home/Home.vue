<template>
    <div class="state-home">
        <h1 class="page-title text-3xl font-bold px-5 pt-5">Home</h1>
        <p class="px-5 text-gray-400">Welcome, {{ user.name }}</p>

        <news-feed></news-feed>

        <emballage-overview class="px-5" />
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import NewsFeed from "../../components/NewsFeed/NewsFeed";
import SubmittedEmballages from "../../components/SubmittedEmballages/SubmittedEmballages";
import EmballageOverview from "../../components/EmballageOverview/EmballageOverview";

export default {
    name: 'Home',

    components:{EmballageOverview, SubmittedEmballages, NewsFeed},

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
