<template>
    <div aria-live="assertive" class="flex items-end pb-4 pointer-events-none">
        <div class="w-full flex flex-col items-center space-y-4 sm:items-end">
            <div
                class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <!-- Heroicon name: outline/check-circle -->
                            <svg v-if="notificationType.icon === 'success'" class="h-5 w-5 text-green-400"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <svg v-if="notificationType.icon === 'error'" class="h-5 w-5 text-red-400"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                 aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <svg v-if="notificationType.icon === 'warning'" class="h-5 w-5 text-yellow-400"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                 aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <svg v-if="notificationType.icon === 'info'" class="h-5 w-5 text-blue-400"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                 aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                      clip-rule="evenodd"/>
                            </svg>

                        </div>
                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p v-if="notification.title" class="text-sm font-medium text-gray-900">
                                {{ notification.title }}
                            </p>
                            <p v-if="notification.message" class="mt-1 text-sm text-gray-500">
                                {{ notification.message }}
                            </p>
                        </div>
                        <div class="ml-4 flex-shrink-0 flex">
                            <button
                                class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <span class="sr-only">Close</span>
                                <!-- Heroicon name: solid/x -->
                                <svg @click="removeNotification(notification)" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                     fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions} from 'vuex';

export default {
    name: "NotificationMessage",
    props: ['notification'],

    data() {
        return {
            timeout: null
        }
    },

    created() {
        let timer = (this.notification.timer) ? this.notification.timer : 3000;

        this.timeout = setTimeout(() => {
            this.removeNotification(this.notification);
        }, timer)
    },

    beforeDestroy() {
        clearTimeout(this.timeout);
    },

    computed: {
        notificationType() {
            switch (this.notification.type) {
                case 'success':
                    return {
                        bg: 'bg-green-50',
                        colorTitle: 'text-green-800',
                        colorMessage: 'text-green-700',
                        icon: this.notification.type
                    };
                case 'error':
                    return {
                        bg: 'bg-red-50',
                        colorTitle: 'text-red-800',
                        colorMessage: 'text-red-700',
                        icon: this.notification.type
                    };
                case 'warning':
                    return {
                        bg: 'bg-yellow-50',
                        colorTitle: 'text-yellow-800',
                        colorMessage: 'text-yellow-700',
                        icon: this.notification.type
                    };
                case 'info':
                    return {
                        bg: 'bg-blue-50',
                        colorTitle: 'text-blue-800',
                        colorMessage: 'text-blue-700',
                        icon: this.notification.type
                    };
            }
        },
    },

    methods: {
        ...mapActions({
            removeNotification: 'cms/removeNotification'
        })
    }

}
</script>

<style scoped>

</style>
