<template>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <transition name="slide-fade">
        <div v-if="show" class="fixed inset-0 overflow-hidden z-50" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
            <div class="absolute inset-0 overflow-hidden bg-gray-500 bg-opacity-75 transition-opacity">
                <!-- Background overlay, show/hide based on slide-over state. -->
                <div class="absolute inset-0" aria-hidden="true">
                    <div class="fixed inset-y-0 right-0 max-w-full flex sm:pl-16">
                        <div v-if="show" class="w-screen max-w-2xl sx:max-w-full">
                            <div class="h-full flex flex-col py-6 bg-white shadow-xl overflow-y-scroll">
                                <div class="px-6 mb-6">
                                    <div class="flex items-start justify-between">
                                        <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">
                                            {{ (views.create) ? 'Nieuwe Post ' : 'Post Bewerken' }}
                                        </h2>
                                        <div class="ml-3 h-7 flex items-center">
                                            <button @click="hideSlide" type="button"
                                                    class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                <span class="sr-only">Close panel</span>
                                                <!-- Heroicon name: outline/x -->
                                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <form v-if="views.create" method="post" enctype="multipart/form-data">
                                    <div class="px-6 mb-6">
                                        <div class="sm:col-span-3">
                                            <label class="block text-sm font-medium text-gray-700">
                                                Titel <span class="rs">*</span>
                                            </label>
                                            <div class="my-1">
                                                <input v-model="form.create.title" type="text" required
                                                       class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            </div>
                                            <p v-if="errors.title" v-for="error in errors.title" class="text-xs text-red-700 mt-1" >{{ error }}</p>
                                        </div>
                                    </div>
                                    <div class="px-6 mb-6">
                                        <label class="block text-sm font-medium text-gray-700">
                                            Body <span class="rs">*</span>
                                        </label>
                                        <div class="mt-1">
                                        <textarea v-model="form.create.body" rows="6"
                                                  class="shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border border-gray-300 rounded-md px-3 py-2"></textarea>
                                        </div>
                                        <p v-if="errors.body" v-for="error in errors.body" class="text-xs text-red-700 mt-1" >{{ error }}</p>
                                    </div>
                                    <div class="px-6 mb-6">
                                        <div class="sm:col-span-3">
                                            <label class="block text-sm font-medium text-gray-700">
                                                Image <span class="rs">*</span>
                                            </label>
                                            <div class="mt-1">
                                                <input type="file" id="image_create" name="image" accept="image/png, image/jpeg" />
                                            </div>
                                            <p v-if="errors.image" v-for="error in errors.image" class="text-xs text-red-700 mt-1" >{{ error }}</p>
                                        </div>
                                    </div>
                                    <div class="px-6">
                                        <button @click.prevent="createPost" type="button"
                                                class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Aanmaken
                                        </button>
                                    </div>
                                </form>
                                <form v-if="views.edit" method="post" enctype="multipart/form-data">
                                    <div class="px-6 mb-6">
                                        <div class="sm:col-span-3">
                                            <label class="block text-sm font-medium text-gray-700">
                                                Titel
                                            </label>
                                            <div class="mt-1">
                                                <input v-model="editPost.title" type="text" required
                                                       class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            </div>
                                        <p v-for="error in errors.title" class="text-xs text-red-700 mt-1" >{{ error }}</p>
                                        </div>
                                    </div>
                                    <div class="px-6 mb-6">
                                        <label class="block text-sm font-medium text-gray-700">
                                            Body
                                        </label>
                                        <div class="mt-1">
                                        <textarea v-model="editPost.body" rows="6"
                                                  class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border border-gray-300 rounded-md px-3 py-2"></textarea>
                                        </div>
                                        <p v-for="error in errors.body" class="text-xs text-red-700 mt-1" >{{ error }}</p>
                                    </div>
                                    <div class="px-6 mb-6">
                                        <div class="sm:col-span-3">
                                            <label class="block text-sm font-medium text-gray-700">
                                                Image
                                            </label>
                                            <div class="mt-1">
                                                <input type="file" name="image_edit" accept="image/png, image/jpeg" id="image_edit" />
                                            </div>
                                        <p v-for="error in errors.image" class="text-xs text-red-700 mt-1" >{{ error }}</p>
                                        </div>
                                    </div>
                                    <div class="px-6">
                                        <button @click.prevent="updatePost(editPost.id)" type="button"
                                                class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Bijwerken
                                        </button>
                                        <button @click.prevent="deletePost(editPost.id)" type="button" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-sm shadow-sm font-medium rounded text-red-700 bg-red-100 hover:bg-red-200 border-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            Verwijderen
                                        </button>
                                    </div>
                                </form>
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
    name: "SlidePost",
    data() {
        return {
            form: {
                create: {
                    title: '',
                    body: '',
                    image: ''
                }
            },
            currentPost: [],
            errors: []
        }
    },
    mounted() {
    },
    methods: {

        createPost() {
            let imagefile = document.querySelector('#image_create')

            let formData = new FormData;
            formData.append('title', this.form.create.title)
            formData.append('body', this.form.create.body)
            formData.append("image", imagefile.files[0])

            axios.post('/api/posts', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then((res) => {
                    this.$emit('refresh');
                    this.$emit('hide');
                    this.$store.dispatch( 'cms/addNotification', {
                        type: 'success',
                        title: res.data.message
                    });
                }).catch((err) => {
                    this.errors = err.response.data
                    this.$store.dispatch('cms/addNotification', {
                        type: 'error',
                        title: 'Something went wrong ...',
                        message: 'Something went wrong uploading your files!',
                    })
                })
        },

        updatePost(id) {
            let imagefile = document.querySelector('#image_edit')

            let formData = new FormData;
            formData.append('title', this.editPost.title)
            formData.append('body', this.editPost.body)
            formData.append("image", imagefile.files[0])

            axios.post('/api/post/'+id, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then((res) => {
                    this.$emit('refresh')
                    this.$emit('hide')
                    this.$store.dispatch( 'cms/addNotification', {
                        type: 'success',
                        title: res.data.message
                    })
                }).catch((err) => {
                this.errors = err.response.data
                    this.$store.dispatch('cms/addNotification', {
                        type: 'error',
                        title: 'Failed to update',
                        message: 'Please check the form for errors!',
                    })
                })
        },

        deletePost(id) {
            axios.delete('/api/post/'+id)
            .then((res) => {
                this.$emit('refresh')
                this.$emit('hide')
                this.$store.dispatch( 'cms/addNotification', {
                    type: 'success',
                    title: res.data.message
                })
            })
        },

        hideSlide: function () {
            this.$emit('hide')
        },
    },
    props: {
        views: {
            create: false,
            edit: false
        },
        editPost: {
            title: '',
            body: '',
            image: ''
        },
        show: false
    }
}
</script>

<style scoped>

</style>
