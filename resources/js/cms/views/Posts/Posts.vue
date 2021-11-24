<template>
    <div id="Posts">
        <h1 class="text-3xl page-title leading-8 font-bold tracking-tight text-gray-900 mb-5">Posts</h1>

        <button @click="modals.showModalCreate = true" type="button" class="inline-flex items-center pr-4 pl-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 mb-5">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Nieuwe Post
        </button>

        <div>
            {{ posts }}
        </div>

        <ModalPostCreate v-show="modals.showModalCreate"
                         v-model="modals.showModalCreate"
                         @hideModal="hideModalCreate" />
    </div>
</template>

<script>
import ModalPostCreate from "../../components/ModalPostCreate/ModalPostCreate";

export default {
    name: "Posts",
    data() {
        return {
            modals: {
                showModalCreate: false
            },
            posts: [],
        }
    },
    mounted() {
        this.getPosts();
    },
    methods: {
        hideModalCreate() {
            this.modals.showModalCreate = false;
        },

        getPosts() {
            axios.get('/api/posts')
            .then((res) => { this.posts = res.data });
        }
    },
    components: {
        ModalPostCreate
    },
}
</script>

<style scoped>

</style>
