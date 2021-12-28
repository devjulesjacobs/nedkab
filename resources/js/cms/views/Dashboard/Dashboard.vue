<template>
    <div>
        <h1 class="text-3xl page-title leading-8 font-bold tracking-tight text-gray-900">Dashboard</h1>

        <!-- This example requires Tailwind CSS v2.0+ -->
        <div>
            <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                <div class="relative bg-white pt-5 px-4 pb-12 sm:pt-6 sm:px-6 shadow rounded-lg overflow-hidden">
                    <dt>
                        <div class="absolute bg-indigo-500 rounded-md p-3">
                            <!-- Heroicon name: outline/users -->
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <p class="ml-16 text-sm font-medium text-gray-500 truncate">Gebruikers aantal</p>
                    </dt>
                    <dd class="ml-16 pb-6 flex items-baseline sm:pb-7">
                        <p class="text-2xl font-semibold text-gray-900">
                            {{ stats.totalUsers }}
                        </p>
                        <div class="absolute bottom-0 inset-x-0 bg-gray-50 px-4 py-4 sm:px-6">
                            <div class="text-sm">
                                <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500"> View all<span class="sr-only"> Total Subscribers stats</span></a>
                            </div>
                        </div>
                    </dd>
                </div>

                <div class="relative bg-white pt-5 px-4 pb-12 sm:pt-6 sm:px-6 shadow rounded-lg overflow-hidden">
                    <dt>
                        <div class="absolute bg-indigo-500 rounded-md p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <p class="ml-16 text-sm font-medium text-gray-500 truncate">Emballage aantal</p>
                    </dt>
                    <dd class="ml-16 pb-6 flex items-baseline sm:pb-7">
                        <p class="text-2xl font-semibold text-gray-900">
                            {{ stats.totalEmballage }}
                        </p>
                        <div class="absolute bottom-0 inset-x-0 bg-gray-50 px-4 py-4 sm:px-6">
                            <div class="text-sm">
                                <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500"> View all<span class="sr-only"> Avg. Open Rate stats</span></a>
                            </div>
                        </div>
                    </dd>
                </div>
            </dl>
        </div>

        <h1 class="text-2xl font-bold mt-5 mb-3">App users</h1>

        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 mt-4">
            <div v-for="user in users" :key="user.id" class="relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full object-position-center object-cover" :src="'/img/user/' + (user.avatar ? user.avatar : 'empty-profile-picture.jpg')" alt="Profile pic">
                </div>
                <div class="flex-1 min-w-0">
                    <a href="#" class="focus:outline-none">
                        <span class="absolute inset-0" aria-hidden="true"></span>
                        <p class="text-sm font-medium text-gray-900">
                            {{ user.name }}
                        </p>
                        <p class="text-sm text-gray-500 truncate">
                            {{ user.company }}
                        </p>
                    </a>
                </div>
            </div>

            <!-- More people... -->
        </div>

    </div>
</template>

<script>
import {mapActions} from "vuex";

export default {
    name: "Dashboard",
    data() {
        return {
            stats: {
                totalUsers: 0,
                totalEmballage: 0,
            },
            users: []
        }
    },

    mounted() {
        this.getStats();
        this.getUsers();
        // this.$store.dispatch('cms/addNotification', {
        //     type: 'success',
        //     title: 'Succesfully did shit!',
        //     message: 'This is just some simple message put under the title element!',
        // });

        // this.$store.dispatch('cms/addNotification', {
        //     type: 'error',
        //     title: 'Error something!',
        //     message: 'This is just some simple message put under the title element!',
        // });

        // this.$store.dispatch('cms/addNotification', {
        //     type: 'warning',
        //     title: 'Warning something really dangerous!',
        //     message: 'This is just some simple message put under the title element!',
        // });

        // this.$store.dispatch('cms/addNotification', {
        //     type: 'info',
        //     title: 'Just some information that can get to you ...',
        //     message: 'This is just some simple message put under the title element!',
        // });
    },

    methods: {
        ...mapActions({
            logout: "cms/logout",
        }),

        async signOut() {
            await this.logout();
            await this.$store.dispatch('cms/addNotification', {
                type: 'success',
                title: 'Logged out successfully.',
            });
            this.$router.replace({ name: "Signin" });
        },

        getStats() {
            // Total Users
            axios.get('/api/cms/users/count').then(res => { this.stats.totalUsers = res.data })

            // Total Emballage
            axios.get('/api/cms/emballage/count').then(res => { this.stats.totalEmballage = res.data });
        },

        getUsers() {
            axios.get('/api/users/all').then(res => { this.users = res.data })
        }
    },
}
</script>

<style scoped>

</style>
