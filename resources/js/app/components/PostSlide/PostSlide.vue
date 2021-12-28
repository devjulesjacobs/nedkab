<template>
    <transition name="slide-fade">
        <div v-if="show" class="fixed inset-0 z-50 overflow-hidden state-slide-post" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute inset-0" aria-hidden="true">
                    <div class="fixed inset-y-0 right-0 max-w-full flex">
                        <div class="w-screen max-w-md">
                            <div class="h-full flex flex-col py-6 bg-white shadow-xl overflow-y-scroll">
                                <div class="px-4 sm:px-6">
                                    <div class="flex items-start justify-between">
                                        <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">
                                            Nieuws
                                        </h2>
                                        <div class="ml-3 h-7 flex items-center">
                                            <button @click="$emit('hide')" type="button" class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                <span class="sr-only">Close panel</span>
                                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-6 relative flex-1">
                                    <div class="absolute inset-0 px-4 sm:px-6">
                                        <div class="content">
                                            <div class="header">
                                                <img :src="'/img/posts/'+post.image" :alt="post.title" class="rounded-lg shadow-lg">
                                                <div class="background-overlay mb-5"></div>
                                            </div>
                                        </div>
                                        <div class="body">
                                            <h1 class="text-2xl font-bold pb-4 mb-4 border-b border-gray-100">{{ post.title }}</h1>
                                            <p v-html="post.body" class="whitespace-pre-line post-body"></p>
                                        </div>
                                        <div class="footer mt-6 py-3 border-t border-gray-100 text-xs text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-gray-500 inline-block mr-1 -mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg> Gepost op {{ post.created_at | moment('D MMMM YYYY') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    name: "PostSlide",
    data() {
        return {

        }
    },
    props: ['post', 'show']
}
</script>

<style scoped>
.post-body {

}
</style>
