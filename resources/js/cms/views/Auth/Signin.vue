<template>
    <div class="-m-6">
        <div class="min-h-screen flex bg-white">
            <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
                <div class="mx-auto w-full max-w-sm lg:w-96">
                    <div>
                        <a href="/">
                            <img class="h-12 w-auto" src="/img/system/company-logo.jpg" alt="Workflow">
                        </a>
                        <h2 class="mt-6 text-3xl font-bold text-gray-900">
                            Inloggen CMS
                        </h2>
                    </div>

                    <div class="mt-8">
                        <div class="mt-6">
                            <form @submit.prevent="submit" method="POST" class="space-y-6">
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">
                                        Email address
                                    </label>
                                    <div class="mt-1">
                                        <input v-model="form.email" id="email" name="email" type="email" autocomplete="email" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>
                                </div>

                                <div class="space-y-1">
                                    <label for="password" class="block text-sm font-medium text-gray-700">
                                        Password
                                    </label>
                                    <div class="mt-1">
                                        <input v-model="form.password" id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>
                                </div>

<!--                                <div class="flex items-center justify-between">-->
<!--                                    <div class="text-sm">-->
<!--                                        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">-->
<!--                                            Forgot your password?-->
<!--                                        </a>-->
<!--                                    </div>-->
<!--                                </div>-->

                                <div>
                                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Inloggen
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden lg:block relative w-0 flex-1">
                <img class="absolute inset-0 h-full w-full object-cover" src="https://images.unsplash.com/photo-1505904267569-f02eaeb45a4c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1908&q=80" alt="">
            </div>
        </div>

    </div>
</template>

<script>
import axios from "axios";
import {mapActions} from "vuex";

export default {
    name: "SignIn",
    data() {
        return {
            form: {
                email: "admin@email.com",
                password: "password",
            }
        }
    },
    mounted() {
    },
    components: {},

    methods: {
        ...mapActions({
            login: "cms/login",
        }),

        async submit() {
            await this.login(this.form);

            this.$store.dispatch('cms/addNotification', {
                type: 'success',
                title: 'Logged in successfully!',
                timer: 3000
            });

            this.$router.replace({ name: "Dashboard" });
        }
    }
}
</script>
