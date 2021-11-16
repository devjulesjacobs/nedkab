<template>
    <div class="state-cms">
        <h1 class="px-5 py-5 text-3xl font-bold">CMS Loaded</h1>
        <router-view/>
    </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: "Cms",
    components: {},
    computed: {
        // ...mapGetters({
        //     authenticated: "auth/authenticated",
        //     user: "auth/user",
        // }),
    },
};
</script>
