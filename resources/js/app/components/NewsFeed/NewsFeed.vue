<template>
    <div class="state-news-feed">
            <!-- News Feed -->
        <div class="news-feed mb-5 py-5 pl-5">
            <div class="news-feed-scroll">

                <div v-for="post in posts" :key="post.id" class="news-item" @click="showPost(post)">
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
