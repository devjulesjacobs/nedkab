<template>
    <div id="Posts">
        <h1 class="text-3xl page-title leading-8 font-bold tracking-tight text-gray-900 mb-5">Posts</h1>

        <button @click="modals.showModalCreate = true" type="button" class="inline-flex items-center pr-4 pl-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 mb-5">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Nieuwe Post
        </button>

        <div class="sm:flex mb-3" v-for="post in posts" :key="post.id" @click="getPost(post.id)">
            <div class="mb-4 flex-shrink-0 sm:mb-0 sm:mr-4">
                <svg class="h-16 w-16 border border-gray-300 bg-white text-gray-300" preserveAspectRatio="none" stroke="currentColor" fill="none" viewBox="0 0 200 200" aria-hidden="true">
                    <path vector-effect="non-scaling-stroke" stroke-width="1" d="M0 0l200 200M0 200L200 0" />
                </svg>
            </div>
            <div>
                <h4 class="text-lg font-bold">{{ post.title }}</h4>
                <p class="mt-1" v-html="post.body"></p>
            </div>
        </div>

        <pre>
            {{ currentPost }}
        </pre>

        <ModalPostCreate v-show="modals.showModalCreate"
                         v-model="modals.showModalCreate"
                         @refreshPostsList="getPosts"
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
            currentPost: []
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
        },

        getPost(id) {
            axios.get('/api/post/'+id)
            .then((res) => { this.currentPost = res.data })
        }
    },
    components: {
        ModalPostCreate
    },
}
</script>

<style scoped>

</style>
