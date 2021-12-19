<template>
    <div class="state-news-feed">
            <!-- News Feed -->
        <div class="news-feed mb-5 py-5 pl-5">
            <div class="news-feed-scroll">

                <div v-if="!posts.length" class="skeleton-NewsFeed">

                    <div class="news-item">
                        <div class="image-overlay"></div>
                        <div class="news-header">
                            <h1 class="news-title">{{ post.title }}</h1>
                            <div class="details-row space-y-3 jj-animate-pulse">
                                <div class="grid grid-cols-3 gap-3">
                                    <div class="h-2 bg-gray-300 rounded col-span-2"></div>
                                    <div class="h-2 bg-gray-300 rounded col-span-1"></div>
                                </div>
                                <div class="h-2 w-1/3 bg-gray-300 rounded"></div>

                                <div class="h-2 w-3/5 bg-gray-300 rounded"></div>
                            </div>
                        </div>
                    </div>

                </div>
                <div v-else v-for="post in posts" :key="post.id" class="news-item" @click="showPost(post)">
                    <img :src="'/img/posts/'+post.image" :alt="post.title">
                    <div class="image-overlay"></div>
                    <div class="news-header">
                        <h1 class="news-title">{{ post.title }}</h1>
                        <div class="details-row">
                            <span class="details-icon material-icons-outlined">calendar_today</span>
                            <span class="details-text">{{ post.created_at }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <post-slide :show="views.SlidePost"
                    :post="post"
                    @hide="hidePost" />
    </div>
</template>

<script>
import PostSlide from "../PostSlide/PostSlide";

export default {
    name: "NewsFeed",
    data() {
        return {
            posts: [],
            post: [],
            views: {
                SlidePost: false,
            }
        }
    },

    mounted() {
        this.fetchPosts()
    },

    methods: {
        fetchPosts() {
            axios.get('/api/posts/latest')
                .then((res) => { this.posts = res.data })
                .catch((e) => { console.log('Error:', e) })
        },

        showPost(post) {
            this.post = post;
            this.views.SlidePost = true
        },

        hidePost() {
            this.views.SlidePost = false
        }
    },
    components: {
        PostSlide
    }
}
</script>

<style scoped>

</style>
