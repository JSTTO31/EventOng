<template>
    <div class="h-100 pb-5" >
        <div class="d-flex align-end">
            <v-tabs>
                <v-tab class="text-capitalize" size="small">All attendee</v-tab>
                <v-tab class="text-capitalize" size="small">Paid</v-tab>
                <v-tab class="text-capitalize" size="small">unpaid</v-tab>
            </v-tabs>
            <v-spacer></v-spacer>
            <div class="w-33">
                <v-text-field @keyup.enter="$event => $inertia.visit($route($route().current()), {data: {...$route().params, attendees_search: $event.target.value}})" prepend-inner-icon="mdi-magnify" hide-details density="compact" variant="solo-inverted"></v-text-field>
            </div>
        </div>
        <v-divider class="mb-4"></v-divider>
        <div class="container" >
            <v-card v-if="event.event_attendees.length" flat color="grey-lighten-4" class="d-flex bg-transparent font-weight-medium">
                <v-col class="text-center py-0 d-flex align-center" cols="3">
                    <span class="px-3">
                        <v-checkbox hide-details></v-checkbox>
                    </span>
                    Person
                </v-col>
                <v-col cols="2" class="text-center">
                    Status
                </v-col>
                <v-col class="text-center" cols="2">
                    Mobile
                </v-col>
                <v-col class="text-center" cols="3">
                    Address
                </v-col>
                <v-col class="text-center d-flex align-center" cols="2">
                </v-col>
            </v-card>
            <v-hover v-for="(attendee, index) in event.event_attendees" v-slot="{props, isHovering}">
                <v-card :id="'attendee-'+attendee.id" @click="$inertia.visit($route('inboxes.index', {attendee_id: attendee.id}))" class="rounded-0 pa-5 d-flex" :style="'z-index:' + (100 - index)+';scroll-margin-top: 50px !important;'" style="cursor: pointer;" v-bind="props" :elevation="isHovering ? 5 : 0" :variant="route().params.attendee == attendee.id ? 'tonal' : 'elevated'" :color="route().params.attendee == attendee.id ? 'blue' : 'white'">
                    <v-col class="text-center" cols="3">
                        <div class="d-flex align-center">
                            <span class="mr-5">
                                <v-checkbox hide-details density="compact"></v-checkbox>
                            </span>
                            <div class="d-flex flex-column align-start">
                                <h4 class="text-capitalize text-left">
                                    {{ attendee.name }}
                                </h4>
                                <h6 class="font-weight-regular">{{ attendee.email }}</h6>
                            </div>
                        </div>
                    </v-col>
                    <v-col cols="2" class="text-center">
                        <v-chip class="text-capalize px-5" variant="elevated">Unpaid</v-chip>
                    </v-col>
                    <v-col class="text-center pt-3" cols="2">
                        {{ attendee.mobile }}
                    </v-col>
                    <v-col class="text-center text-capitalize" cols="3">
                        {{ attendee.address }}
                    </v-col>
                    <v-col class="text-center" cols="2">
                        <v-btn flat class="rounded-0" color="black" v-if="!attendee.verified" @click.stop="$inertia.post(route('event_attendees.notify', {event_attendee: attendee.id}))">Notify</v-btn>
                        <v-btn flat class="rounded-0" color="black" v-else>Send payment</v-btn>
                    </v-col>
                </v-card>
            </v-hover>
            <v-card v-if="event.event_attendees.length > 0" flat color="grey-lighten-4" class="d-flex bg-transparent font-weight-medium">
                <v-col class="text-center py-0 d-flex align-center" cols="3">
                    <span class="px-3">
                        <v-checkbox hide-details></v-checkbox>
                    </span>
                    Person
                </v-col>
                <v-col cols="2" class="text-center">
                    Status
                </v-col>
                <v-col class="text-center" cols="2">
                    Mobile
                </v-col>
                <v-col class="text-center" cols="3">
                    Address
                </v-col>
                <v-col class="text-center d-flex align-center" cols="2">
                </v-col>
            </v-card>
            <div v-else>
                <h2 class="text-center pt-15 mt-15">No attendees</h2>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted } from 'vue';

const props = defineProps(['event'])


onMounted(( ) => {
    setTimeout(() => {
        let attendee = document.getElementById('attendee-' + route().params.attendee)
        if(attendee){
            console.log(attendee.getBoundingClientRect(), scrollY, document.body.offsetHeight);
            attendee.scrollIntoView({behavior: 'smooth', block: 'start', 'inline': 'nearest'})
        }
    }, 1000)

})
</script>

<style scoped>
body{
    scroll-behavior: smooth;
}
</style>
