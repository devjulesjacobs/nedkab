<template>
    <div class="notifications-list">
        <transition-group name="slide-fade">
            <notification-message v-for="notification in notifications"
                                  :key="notification.id"
                                  :notification="notification"
            />
        </transition-group>
    </div>
</template>

<script>
import NotificationMessage from "../NotificationMessage/NotificationMessage";
import { mapGetters } from "vuex"

export default {
    name: "NotificationsList",
    data() {
        return {
            errors: null
        }
    },

    components: {
        NotificationMessage
    },

    computed: mapGetters({
            notifications: 'cms/getNotifications'
        })

}
</script>

<style scoped>

</style>
