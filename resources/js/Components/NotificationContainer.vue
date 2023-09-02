<template>
    <v-card class="rounded-xl pa-5 mt-4" width="400" height="650" style="overflow-y: hidden;">
        <h3>
            <v-icon>mdi-bell</v-icon>
            Notifications</h3>
        <!-- <div v-if="notifications.length > 0" class="mt-2">
            <v-chip variant="tonal" class="mr-2" color="black">All</v-chip>
            <v-chip variant="tonal" class="mr-2" color="black">Unread</v-chip>
        </div>
        <div v-if="notifications.length > 0" class="d-flex">
            <v-spacer></v-spacer>
            <v-chip @click="" variant="text" color="blue" class="font-weight-medium">See All</v-chip>
        </div> -->
        <v-list style="overflow-y: auto;" class="h-100 mt-2" id="list">
            <NotificationListItem v-for="notification in notifications" :key="notification.id" :notification="notification"></NotificationListItem>
            <v-spacer></v-spacer>
            <v-list-item class="mt-5 text-center rounded-lg bg-grey-lighten-2 " @click="$inertia.visit(route('notifications.index'))" variant="elevated">Show more</v-list-item>
        </v-list>
        <span class="font-weight-medium text-h5" v-if="notifications < 1" style="position: absolute;top: 50%; left: 50%;transform: translate(-50%, -50%);">No notifications</span>

    </v-card>
</template>

<script setup>
import NotificationListItem from './NotificationListItem.vue';
const props = defineProps(['notifications'])

</script>

<style lang="scss" scoped>

</style>
