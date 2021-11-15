<template>
    <div class="state-cms">
        <router-view/>
    </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: "Cms",
    components: {},
    computed: {
        ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user",
        }),
    },
};
</script>
