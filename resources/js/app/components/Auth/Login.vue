<template>
    <form @submit.prevent="submit" method="POST" class="space-y-6">
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
            <div class="mt-1">
                <input
                    v-model="form.email"
                    id="email"
                    name="email"
                    type="email"
                    autocomplete="email"
                    required
                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                />
            </div>
        </div>

        <div class="space-y-1">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <div class="mt-1">
                <input
                    v-model="form.password"
                    id="password"
                    name="password"
                    type="password"
                    autocomplete="password"
                    required
                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                />
            </div>
        </div>

        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input
                    id="remember-me"
                    name="remember-me"
                    type="checkbox"
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                />
                <label for="remember-me" class="ml-2 block text-sm text-gray-900">Ingelogd blijven</label>
            </div>

<!--            <div class="text-sm">-->
<!--                <a-->
<!--                    href="#"-->
<!--                    class="font-medium text-blue-600 hover:text-blue-500"-->
<!--                >Wachtwoord vergeten?</a>-->
<!--            </div>-->
        </div>

        <div>
            <button
                type="submit"
                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-theme hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            >Inloggen
            </button>
        </div>
    </form>
</template>

<script>
import {mapActions} from "vuex";

export default {
    name: "Login",

    data() {
        return {
            form: {
                email: this.email,
                password: '',
            },
        };
    },

    methods: {
        ...mapActions({
            login: "auth/login",
        }),

        async submit() {
            await this.login(this.form).then(res => {
                this.$router.replace({name: "Home"});
            }).catch(err => {
                console.log(err);
            })


        },
    },

    props: ['email']
};
</script>
