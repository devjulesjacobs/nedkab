<template>
    <div id="SignIn">
        <div class="min-h-screen flex bg-white">
            <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
                <div class="mx-auto w-full max-w-sm lg:w-96">
                    <div>
                        <img class="h-12 w-auto" src="/img/system/company-logo.png" alt="Workflow"/>
                        <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Sign in to your account</h2>
                        <p class="mt-2 text-sm text-gray-600">Or <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">sign up now!</a>
                        </p>
                    </div>
                    <div class="mt-8">
                        <div class="mt-6">
                            <Login></Login>
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
                <!-- <Login v-if="views.Login"></Login> -->
                <Register v-if="views.Register"></Register>
                <ResetPassword v-if="views.ResetPassword"></ResetPassword>
            </div>
        </div>

        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="p-6">
            <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6">
                <div>
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                        <!-- Heroicon name: outline/check -->
                        <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-5">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            App loaded succesfully
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur amet labore.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-6">
                    <a href="/cms" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
                        Go to dashboard
                    </a>
                </div>
            </div>
        </div>

        <installation v-if="!installation" />
        <!--        <installation-screen></installation-screen>-->
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
            form: {
                email: "jules@gmail.com",
                password: "password",
            },
            views: {
                Login: true,
                Register: false,
                ResetPassword: false,
            },
            installation: false
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
            window.matchMedia('(display-mode: standalone)').matches ? this.installation = true : this.installation = false;
        }
    }
};
</script>
