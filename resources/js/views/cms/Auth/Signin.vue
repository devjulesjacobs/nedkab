<template>
    <div>
        Login page
    </div>
</template>

<script>
import axios from "axios";
import { mapActions } from "vuex";

export default {
    name: "SignIn",
    data() {
        return {
            form: {
                email: "jules@gmail.com",
                password: "password",
            }
        }
    },
    mounted() {},
    components: {},
    methods: {}
}
</script>
