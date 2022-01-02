<template>
    <div>
        <button @click="createAdmin"  type="button" class="-mt-1 float-right mt-2 inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 bg-blue-theme">
            Admin aanmaken
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
            </svg>
        </button>
        <h1 class="text-3xl page-title leading-8 font-bold tracking-tight text-gray-900 mb-5">Medewerkers</h1>

        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            <ul role="list" class="divide-y divide-gray-200">
                <transition-group name="slide-fade">
                    <li v-for="user in users" :key="user.id">
                        <a href="#" class="block hover:bg-gray-50">
                            <div class="flex items-center px-4 py-4 sm:px-6">
                                <div class="min-w-0 flex-1 flex items-center">
                                    <div class="flex-shrink-0">
                                        <img class="h-12 w-12 rounded-full object-cover object-center" :src="user.avatar ? '/img/user/'+user.avatar : '/img/user/empty-profile-picture.jpg'" alt="Profile picture">
                                    </div>
                                    <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                        <div>
                                            <p class="text-sm font-medium text-indigo-600 truncate">{{ user.name }}</p>
                                            <p class="mt-2 flex items-center text-sm text-gray-500">
                                                <!-- Heroicon name: solid/mail -->
                                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                                </svg>
                                                <span class="truncate">{{ user.email }}</span>
                                            </p>
                                        </div>
                                        <div class="hidden md:block">
                                            <div>
                                                <p class="mb-2 flex items-center text-sm text-gray-500">
                                                    <!-- Heroicon name: solid/check-circle -->
                                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                    </svg>
                                                    Admin
                                                </p>
                                                <p class="text-sm text-gray-900">
                                                    <button @click="deleteUser(user.id)" type="button" class="inline-flex items-center px-2.5 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                        Delete
                                                    </button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <!-- Heroicon name: solid/chevron-right -->
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </li>
                </transition-group>
            </ul>
        </div>

        <slide-employee :show="slide.show" @hide="hideSlide" />
    </div>
</template>

<script>
import SlideEmployee from "../../components/SlideEmployee/SlideEmployee";
export default {
    name: "Users",
    components: { SlideEmployee },
    data() {
        return {
            users: [],
            slide: {
                show: false
            }
        }
    },
    mounted() {
        this.getUsers()
    },
    methods: {
        getUsers() {
            axios.get('/api/cms/employees')
                .then(res => this.users = res.data)
                .catch(err => console.log(err))
        },

        deleteUser(id) {
            if(confirm('Weet je zeker dat je deze administrator wilt verwijderen? Dit kan niet ongedaan gemaakt worden.')) {
                axios.post('/api/cms/employee/delete/'+id)
                    .then(res => {
                        this.getUsers();
                        this.$store.dispatch('cms/addNotification', {
                            type: 'success',
                            title: 'Account verwijderd',
                            message: 'Het administrator account is succesvol verwijderd.',
                        });
                    })
                    .catch(err => {
                        this.$store.dispatch('cms/addNotification', {
                            type: 'error',
                            title: 'Verwijderen mislukt',
                            message: err.response.data.message,
                        });
                    })
            }
        },

        createAdmin() {
            this.slide.show = true;
        },

        hideSlide() {
            this.slide.show = false;
        }
    },
}
</script>

<style scoped>

</style>
