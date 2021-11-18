<template>
    <div>
        <!-- News Feed -->
        <div class="news-feed mb-5 p-5">
            <div class="news-feed-scroll">
                <div class="news-item" @click="showDetail">
                    <img src="https://images.pexels.com/photos/3183197/pexels-photo-3183197.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" alt="News-1">
                    <div class="image-overlay"></div>
                    <div class="news-header">
                        <h1 class="news-title">Voorbeeld titel voor een news post!</h1>
                        <div class="details-row">
                            <span class="details-icon material-icons-outlined">calendar_today</span>
                            <span class="details-text">24 november</span>
                        </div>
                    </div>
                </div>

                <div class="news-item" @click="showDetail">
                    <img src="https://images.pexels.com/photos/955405/pexels-photo-955405.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" alt="News-2">
                    <div class="image-overlay"></div>
                    <div class="news-header">
                        <h1 class="news-title">Voorbeeld titel</h1>
                        <div class="details-row">
                            <span class="details-icon material-icons-outlined">calendar_today</span>
                            <span class="details-text">24 november</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- News Feed Details Page -->
        <div class="news-feed-detail">

            <div class="detail-header mb-4">
                <span class="font-bold text-blue-800">News</span>
                <span class="float-right" @click="closeNewsDetail">
                    <span class="material-icons-outlined">close</span>
                </span>
            </div>

            <h1 class="text-3xl font-bold">Voorbeeld titel voor een news post!</h1>

        </div>
    </div>
</template>

<script>
export default {
    name: "NewsFeed",

    mounted() {
    },

    methods: {
      showDetail() {
          $('.news-feed-detail').addClass('show');
      },

      closeNewsDetail() {
          $('.news-feed-detail').removeClass('show');
      }
    }
}
</script>

<style scoped>

</style>
