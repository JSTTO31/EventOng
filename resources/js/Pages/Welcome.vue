<script setup>
import WelcomeEventCard from '@/Components/WelcomeEventCard.vue';
import { Head, Link } from '@inertiajs/vue3';
const props = defineProps(['background', 'events']);
window.Echo.private('App.Models.User.' + 1).notification((notification) => {
    console.log(notification)
});
</script>

<template>
    <Head title="Welcome" />
    <v-app>
        <v-main id="main" class="d-flex flex-column"  >
            <v-card width="100%" class=" h-screen w-full rounded-0" flat :style="`background: url(${background});background-size: cover;`">
            </v-card>
            <v-card class=" bg-white pb-15">
                <v-container fluid class="px-15 pt-15">
                    <h1 class="text-center px-15 text-h3 text-grey-darken-1">Discover your potential through our thoughtfully curated courses catering to various interests.</h1>
                    <h3 class="text-center text-h5 text-grey-darken-1 mt-4 font-weight-medium">
                         26 courses | 892 attendees | 13 trainees
                    </h3>
                    <h2 class="text-h4 text-grey-darken-2 font-weight-bold mt-15 mb-5">
                         Courses list
                         <v-btn variant="outlined" size="small" class="ml-5 mx-1" icon="mdi-chevron-left"></v-btn>
                         <v-btn variant="outlined" size="small" class="mx-1" icon="mdi-chevron-right"></v-btn>
                    </h2>
                    <v-row>
                        <v-col cols="4" v-for="event in events.data">
                            <WelcomeEventCard :event="event"></WelcomeEventCard>
                        </v-col>
                    </v-row>
                </v-container>
            </v-card>
        </v-main>
    </v-app>
</template>

<style>
</style>
