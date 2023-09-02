<template>
   <v-list-item  @click="$inertia.visit($route('notifications.mark-as-read-and-visit', {notification: notification.id}))" class="rounded-lg py-2 mb-3" :active="!notification.read_at">
        <template #prepend>
            <v-avatar class="rounded-lg" size="100">
                <v-img src="https://images.pexels.com/photos/4498362/pexels-photo-4498362.jpeg?cs=srgb&dl=pexels-karolina-grabowska-4498362.jpg&fm=jpg"></v-img>
            </v-avatar>
        </template>
        <!-- <v-list-item-title class="font-weight-medium">{{ notification.data.event.title }}</v-list-item-title> -->
        <v-list-item-title>
            <span class="text-subtitle-1">{{ notification.data.subject }}</span>
        </v-list-item-title>
        <v-list-item-subtitle>
            <span class="text-subtitle-1">{{ notification.data.message }}</span>
        </v-list-item-subtitle>
        <span class="text-caption"><v-icon>mdi-account</v-icon> {{ notification.data.attendee.email }}</span>

    </v-list-item>
</template>

<script setup>
const props = defineProps(['notification'])
</script>

<style lang="scss" scoped>

</style>
