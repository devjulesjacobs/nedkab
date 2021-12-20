<template>
    <form @submit.prevent="submit" method="POST" class="space-y-6">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Volledige naam</label>
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
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Bedrijf</label>
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
            <label for="email" class="block text-sm font-medium text-gray-700">Telefoonnummer</label>
            <div class="mt-1">
                <input
                    v-model="form.phone"
                    id="phone"
                    name="phone"
                    type="number"
                    autocomplete="phone"
                    required
                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                />
            </div>
        </div>

        <div class="space-y-1">
            <label for="password" class="block text-sm font-medium text-gray-700">Wachtwoord</label>
            <div class="mt-1">
                <input
                    v-model="form.password"
                    id="password"
                    name="password"
                    type="password"
                    required
                    :class="{ 'border-green-600': formMeta.password_match }"
                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                />
            </div>
        </div>

        <div class="space-y-1">
            <label for="password" class="block text-sm font-medium text-gray-700">Nogmaals ter controle</label>
            <div class="mt-1">
                <input
                    v-model="form.password"
                    id="password-check"
                    name="password-check"
                    type="password-check"
                    required
                    :class="{ 'border-green-600': formMeta.password_match }"
                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                />
            </div>
        </div>

        <div>
            <button
                @click="register"
                type="submit"
                class="mb-10 w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-theme hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            >Registreren
            </button>
        </div>
    </form>
</template>

<script>
import {mapGetters} from "vuex";

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
                password_match: true,
            }
        }
    },
    methods: {
        register() {
            axios.post('/api/register', this.form)
                .then(res => {
                    console.log(res) })
                .catch(err => {
                console.log(err)})
        }
    }
}
</script>

<style>

</style>
