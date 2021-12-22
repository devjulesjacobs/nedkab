<template>
    <div class="notifications-list">
        <transition-group name="slide-fade">
            <notification-message-app v-for="notification in notifications"
                                  :key="notification.id"
                                  :notification="notification"
            />
        </transition-group>
    </div>
</template>

<script>
import NotificationMessageApp from "../NotificationMessageApp/NotificationMessageApp";
import { mapGetters } from "vuex"

export default {
    name: "NotificationsListApp",
    data() {
        return {
            errors: null
        }
    },

    components: {
        NotificationMessageApp
    },

    computed: mapGetters({
        notifications: 'auth/getNotifications'
    })

}
</script>

<style scoped>

</style>
