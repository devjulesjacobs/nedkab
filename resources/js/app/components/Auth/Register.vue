<template>
    <form @submit.prevent="register" method="post" class="space-y-4">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Volledige naam <span class="text-red-500">*</span></label>
            <div class="mt-1">
                <input
                    v-model="form.name"
                    id="name"
                    name="name"
                    type="name"
                    autocomplete="name"
                    required
                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                />
            </div>
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email address <span class="text-red-500">*</span></label>
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
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Bedrijf <span class="text-red-500">*</span></label>
            <div class="mt-1">
                <input
                    v-model="form.company"
                    id="company"
                    name="company"
                    type="text"
                    autocomplete="company"
                    required
                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                />
            </div>
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Telefoonnummer <span class="text-red-500">*</span></label>
            <div class="mt-1">
                <input
                    v-model="form.phone"
                    id="phone"
                    name="phone"
                    type="tel"
                    autocomplete="phone"
                    required
                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                />
            </div>
        </div>

        <hr>

        <div class="space-y-1">
            <label for="password" class="block text-sm font-medium text-gray-700">Wachtwoord <span class="text-red-500">*</span></label>
            <div class="mt-1">
                <input
                    v-model="form.password"
                    id="password"
                    name="password"
                    type="password"
                    required
                    @keyup="checkPassword"
                    :class="{ 'border-green-600': formMeta.password_match }"
                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                />
            </div>
        </div>

        <div class="space-y-1">
            <label for="password" class="block text-sm font-medium text-gray-700">Nogmaals ter controle <span class="text-red-500">*</span></label>
            <div class="mt-1">
                <input
                    v-model="formMeta.password_confirm"
                    id="password-check"
                    name="password-check"
                    type="password"
                    required
                    :class="{ 'border-green-600': formMeta.password_match }"
                    @keyup="checkPassword"
                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                />
            </div>
        </div>

        <div>
            <button
                type="submit"
                class="mb-10 w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-theme hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            >Registreren
            </button>
        </div>
    </form>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
    name: "Register",
    data() {
        return {
            form: {
                name: '',
                email: '',
                phone: '',
                company: '',
                password: '',
            },
            formMeta: {
                password_confirm: '',
                password_match: false,
            }
        }
    },
    methods: {
        ...mapActions({
            login: "auth/login",
        }),

        async signin(credentials) {
            await this.login(credentials);

            this.$router.replace({name: "Home"});
        },

        checkPassword() {
            this.formMeta.password_match = this.form.password === this.formMeta.password_confirm
        },

        register() {
            if(this.formMeta.password_match) {
                axios.post('/api/register', this.form)
                    .then(res => {
                        this.$store.dispatch('auth/addNotification', {
                            type: 'success',
                            title: 'Welkom '+this.form.name,
                            message: 'Uw account is succesvol geregistreerd!',
                            timer: 6000
                        });
                        console.log('1')
                        let credentials = {
                            email: this.form.email,
                            password: this.form.password
                        }

                        console.log('2')
                        this.signin(credentials);

                        console.log('3')
                    })
                    .catch(err => {
                        console.log(err)
                    })
            } else {
                this.$store.dispatch('auth/addNotification', {
                    type: 'warning',
                    title: 'Het wachtwoord wat je hebt ingevuld komt niet overeen.',
                    timer: 3000
                });
            }
        }
    }
}
</script>

<style>

</style>
