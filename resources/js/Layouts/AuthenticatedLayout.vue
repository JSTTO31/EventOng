<script setup>
import {  Head } from '@inertiajs/vue3';

defineProps({
    title: {
        default: 'App Title'
    },
    icon: null,
    showAppBar: true,
})

</script>

<template>
    <Head :title="title"></Head>
    <v-app>
        <v-navigation-drawer style="overflow-y: hidden;" class="pa-0 ma-0" color="grey-darken-4" width="70">
            <v-card class="h-100 d-flex flex-column pb-3 align-center" color="transparent">
                <div class="d-flex align-center justify-center mt-5 w-100">
                    <v-icon size="35" color="white">mdi-grid</v-icon>
                </div>
                <v-divider color="white" class="my-2"></v-divider>
                <v-spacer></v-spacer>
                <v-btn @click="$inertia.visit($route('dashboard.index'))" :variant="$route().current() == 'dashboard.index' ? 'elevated' : 'text'" icon="mdi-view-dashboard" variant="text" size="large" class="my-2 rounded-lg"></v-btn>
                <v-btn @click="$inertia.visit($route('events.index'))" :variant="$route().current() == 'events.index' ? 'elevated' : 'text'" icon="mdi-calendar" variant="text" size="large" class="my-2 rounded-lg"></v-btn>
                <v-btn @click="$inertia.visit($route('inboxes.index'))" :variant="$route().current() == 'inboxes.index' ? 'elevated' : 'text'" icon="mdi-inbox" variant="text" size="large" class="my-2 rounded-lg"></v-btn>
                <v-spacer></v-spacer>
                <v-btn icon="mdi-cog" variant="text" size="large" class="rounded-lg"></v-btn>
            </v-card>
        </v-navigation-drawer>
        <v-app-bar flat class="px-3 border-b" :model-value="showAppBar">
            <h1 class="text-blue-grey-darken-4">
                <v-icon v-if="icon">{{ icon }}</v-icon>
                {{ title }}</h1>
            <v-spacer></v-spacer>
            <v-btn prepend-icon="mdi-plus" variant="elevated" flat color="blue-darken-4" class="text-capitalize" @click="$inertia.visit($route('events.create'))">New Event</v-btn>
            <v-divider inset vertical class="mx-5"></v-divider>
            <v-badge dot color="red" class="">
                <v-btn icon="mdi-bell-outline" variant="elevated" class=""></v-btn>
            </v-badge>
            <v-menu>
                <template #activator="{props}">
                    <v-btn v-bind="props" icon="mdi-chevron-down" variant="elevated" class="ml-5 "></v-btn>
                </template>
                <v-card class="rounded-xl pa-5 mt-4" width="350">
                    <v-card class="d-flex pa-2 rounded-lg border-0" flat @click="">
                        <v-avatar size="65" class="bg-grey-lighten-5 border">
                            <v-img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSH4dcYWVFHFsz8M3Rsjpy2Hg6gQAmgbCIwWA&usqp=CAU"></v-img>
                        </v-avatar>
                        <div class="d-flex px-5 h-100 justify-center pt-2 flex-column">
                            <span class="text-subtitle-1 font-weight-bold text-grey-darken-4">Joshua Sotto</span>
                            <span class="text-subtitle-2 text-grey-darken-2">Admin</span>
                        </div>
                    </v-card>
                    <v-divider class="my-2"></v-divider>
                    <v-list>
                        <v-list-item prepend-icon="mdi-logout" class="rounded-lg" @click="$inertia.post($route('logout'))">Logout account</v-list-item>
                    </v-list>
                </v-card>
            </v-menu>
        </v-app-bar>
        <v-main class="bg-blue-grey-lighten-5">
            <v-container class="pa-5 h-100" fluid>
                <slot></slot>
            </v-container>
        </v-main>
        <v-dialog :model-value="$page.props.flash.success" width="450">
            <v-card color="success" class="rounded-xl d-flex align-center justify-center flex-column py-15 pa-5">
                <v-icon size="100">mdi-check-circle-outline</v-icon>
                <h2>{{ $page.props.flash.success.title }}</h2>
                <h4 class="font-weight-regular text-center">{{ $page.props.flash.success.subtitle }}</h4>
            </v-card>
        </v-dialog>
    </v-app>
</template>
