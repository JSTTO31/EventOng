<template>
    <AuthenticatedLayout icon="mdi-bell" title="Notifications">
        <div style="padding-inline: 250px;" class="pt-10">
            <v-text-field variant="solo-inverted" prepend-inner-icon="mdi-magnify" single-line label="Search notifications"></v-text-field>
            <div class="d-flex align-center pb-2">
                <v-chip @click="$inertia.visit($route($route().current(), {status: null}))" class="mr-2" flat :color="status == 'all' ?  'black' :'grey-lighten-1'"  variant="elevated">All</v-chip>
                <v-chip @click="$inertia.visit($route($route().current(), {status: 'read'}))" class="mr-2" flat :color="status == 'read' ?  'black' :'grey-lighten-1'"  variant="elevated">Read</v-chip>
                <v-chip @click="$inertia.visit($route($route().current(), {status: 'unread'}))" class="mr-2" flat :color="status == 'unread' ?  'black' :'grey-lighten-1'"  variant="elevated">Unread</v-chip>
                <v-spacer></v-spacer>
                <v-btn class="mx-2" size="small" variant="outlined" @click.prevent="$inertia.post($route('notifications.mark-as-read-all'), null, {preserveScroll: true})" :disabled="!hasUnread">Mark as read all</v-btn>
                <v-btn class="mx-2" size="small" variant="outlined" :disabled="!hasRead" @click.prevent="$inertia.post($route('notifications.mark-as-unread-all'), null, {preserveScroll: true})">Mark as unread all</v-btn>
                <v-btn class="mx-2" size="small" variant="outlined" prepend-icon="mdi-trash-can" disabled>Clear</v-btn>
            </div>
            <div v-if="notifications">
                <v-card v-for="notification in notifications" class="mb-3 pa-5" @click="$inertia.visit($route('notifications.mark-as-read-and-visit', {notification: notification.id}))">
                    <h1>{{ notification.data.event.title }}</h1>
                    <div class="d-flex">
                        <v-card class="w-25 pt-4" flat>
                            <v-img class="rounded-lg" src="https://images.pexels.com/photos/4498362/pexels-photo-4498362.jpeg?cs=srgb&dl=pexels-karolina-grabowska-4498362.jpg&fm=jpg"></v-img>
                        </v-card>
                        <div class="w-75">
                            <v-card-text>
                                <h3 class="mb-2">{{ notification.data.subject }}</h3>
                                <p class="text-subtitle-1">{{ notification.data.message }}</p>
                            </v-card-text>
                        </div>
                    </div>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn variant="outlined" size="small" class="text-capitalize" flat @click.stop="$inertia.post($route('notifications.mark-as-read', {notification: notification.id}), null, {preserveScroll: true})" :disabled="!!notification.read_at">Mark as read</v-btn>
                        <v-btn variant="outlined" size="small" class="text-capitalize" flat @click.stop="$inertia.post($route('notifications.mark-as-unread', {notification: notification.id}), null, {preserveScroll: true})" :disabled="!notification.read_at">Mark as unread</v-btn>
                        <v-btn variant="outlined" size="small" class="text-capitalize" flat color="error" prepend-icon="mdi-trash-can"  @click.stop="$inertia.delete($route('notifications.remove', {notification: notification.id}), {preserveScroll: true})">Remove</v-btn>
                    </v-card-actions>
                </v-card>
            </div>
            <div class="w-100 h-100 d-flex align-center justify-center" style="padding-block: 200px;" v-if="notifications.length < 1">
                <h3 class="text-grey-darken-2">No Notifications</h3>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
const props = defineProps(['notifications', 'hasUnread', 'hasRead'])
const status  = computed(() => route().params.status == 'unread' ? 'unread' : route().params.status == 'read' ? 'read' : 'all' )
</script>

<style lang="scss" scoped>

</style>
