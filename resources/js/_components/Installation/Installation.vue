<template>
    <transition name="slide-fade">
        <div v-if="installation.show" class="state-install">
            <div class="pre-installation">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">

                        <div class="wrapper w-full h-full pb-20">

                            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                            <transition name="slide-fade-up">
                                <div v-show="installation.screens.popup" class="popup w-full px-4">
                                    <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all">
                                        <div>
                                            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-100">
                                                <!-- Heroicon name: outline/check -->
                                                <img src="/img/pwa/icon-192x192.png" alt="icon" class="shadow-xl rounded-md border border-gray-200">
                                            </div>
                                            <div v-if="!installation.android.installed" class="mt-3 text-center sm:mt-5">
                                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                                    Wilt u de app installeren?
                                                </h3>
                                                <div class="mt-2">
                                                    <p class="text-sm text-gray-500">
                                                        Voeg deze app makkelijk aan je beginscherm toe! Druk op de knop <span class="text-blue-800" @click="setDeviceType">Installeren</span> en volg de stappen.
                                                    </p>
                                                </div>
                                            </div>
                                            <div v-if="installation.android.installed" class="mt-3 text-center sm:mt-5">
                                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                                    De app is succesvol geïnstalleerd!
                                                </h3>
                                                <div class="mt-2">
                                                    <p class="text-sm text-gray-500">
                                                        De app staat nu geïnstalleerd tussen uw andere apps.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense flex-right">
                                            <button v-if="!installation.android.installed" @click="hideInstallation" type="button" class="mt-3 w-50 inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm">
                                                Later
                                            </button>
                                            <button v-if="!installation.android.installed" @click="setDeviceType" type="button" class="w-50 inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-theme text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-2 sm:text-sm">
                                                Installeren
                                            </button>
                                            <button v-if="installation.android.installed" @click="hideInstallation" type="button" class="w-50 inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-theme text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-2 sm:text-sm">
                                                Dit venster sluiten
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </transition>

                            <transition name="slide-fade-up">
                                <div v-show="installation.screens.iOS">
                                    <div class="installation iOS">
                                        <div class="installation-box bg-white rounded-lg shadow-lg">
                                            <div class="header-box p-4">
                                                <h1 class="font-bold">Installatie</h1>
                                                <p class="text-xs text-gray-700">
                                                    Om deze app te installeren dien je deze website te bezoeken via Safari.
                                                </p>
                                            </div>
                                            <div class="footer-box p-4 bg-gray-700 rounded-b-lg text-white text-sm">Klik op
                                                <img src="/img/installation/apple-share-button.png" class="inline-block" alt=""> en dan 'Zet op beginscherm'</div>
                                        </div>
                                    </div>
                                </div>
                            </transition>

                        </div>

                    </div>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    name: "Installation",
    data() {
        return {
            installation: {
                show: true,
                screens: {
                    popup: true,
                    iOS: false,
                    Android: false,
                    Windows: false,
                },
                android: {
                    installed: false
                },
                installPromptEvent: undefined
            },
        }
    },

    created() {
        window.addEventListener('beforeinstallprompt', (event) => {
            event.preventDefault();
            this.installPromptEvent = event;
        });
    },

    methods: {
        hideInstallation() { this.installation.show = false },

        installAndroid() {
            this.installPromptEvent.prompt();

            let app = this;

            this.installPromptEvent.userChoice
                .then((choiceResult) => {
                    if (choiceResult.outcome === 'accepted') {
                        console.log('accepted')
                        app.installation.android.installed = true;
                    } else {
                        console.log('User dismissed the install prompt');
                        app.hideInstallation();
                    }
                })
        },

        setDeviceType() {
            const userAgent = navigator.userAgent.toLowerCase();

            if (userAgent.search("iphone") > -1 || userAgent.search("ipad") > -1 || userAgent.search("ipod") > -1) {
                this.installation.screens.popup = false;
                this.installation.screens.iOS = true;
                return "iOS";
            } else {
                this.installAndroid();
                return "Android";
            }
        },
    }
}
</script>

<style scoped>

</style>
