<template>
    <div id="SignIn">
        <div class="min-h-screen flex bg-white">
            <div class="flex-1 flex flex-col justify-center py-6 px-6 sm:px-8 lg:flex-none lg:px-20 xl:px-">
                <div class="mx-auto w-full max-w-sm lg:w-96">
                    <div>
                        <a href="/cms">
                            <img class="h-12 w-auto" src="/img/system/company-logo.png" alt="Workflow"/>
                        </a>
                        <h2 v-if="state === 'login'" class="mt-6 text-3xl font-bold text-gray-900">Inloggen</h2>
                        <h2 v-if="state === 'register'" class="mt-6 text-3xl font-bold text-gray-900">Registreren</h2>
                        <p v-if="state === 'login'" class="mt-2 text-sm text-gray-600">Of <a @click="state = 'register'" class="font-medium text-blue-600 hover:text-blue-500">registreer je nu</a></p>
                        <p v-if="state === 'register'" class="mt-2 text-sm text-gray-600">Of <a @click="state = 'login'" class="font-medium text-blue-600 hover:text-blue-500">Log in met een bestaand account</a></p>
                    </div>
                    <div class="mt-8">
                        <div class="mt-6">
                            <login v-if="state === 'login'"
                                        :email="email" />
                            <register v-if="state === 'register'"
                                        @setState="setState"
                                        @setEmail="setEmail"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden lg:block relative w-0 flex-1">
                <img
                    class="absolute inset-0 h-full w-full object-cover"
                    src="/img/system/auth-background.jpg"
                    alt />
            </div>
            <div>
                <ResetPassword v-if="views.ResetPassword"></ResetPassword>
            </div>
        </div>

        <installation v-if="!installed" />
    </div>
</template>

<script>
import Login from "../../components/Auth/Login.vue";
import Register from "../../components/Auth/Register.vue";
import ResetPassword from "../../components/Auth/ResetPassword.vue";
import InstallationScreen from "../../components/InstallationScreen/InstallationScreen";
import Installation from "../../../_components/Installation/Installation";

import axios from "axios";
import {mapActions} from "vuex";

export default {
    name: "SignIn",
    data() {
        return {
            email: '',
            views: {
                Login: true,
                Register: false,
                ResetPassword: false,
            },
            installed: true,
            state: 'login'
        }
    },
    mounted() {
        this.checkInstallationState();
    },
    components: {
        Login,
        Register,
        ResetPassword,
        InstallationScreen,
        Installation
    },
    methods: {
        checkInstallationState() {
            window.matchMedia('(display-mode: standalone)').matches ? this.installed = true : this.installed = false;
        },
        setState(state) {
            this.state = state;
        },
        setEmail(email) {
            this.email = email;
        }
    }
};
</script>
