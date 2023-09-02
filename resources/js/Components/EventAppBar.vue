<template>
     <v-app-bar density="prominent" id="app-bar" :height="!scrolledUp ? 25 : 80" class="px-3 py-5" v-if="event">
        <v-btn icon="mdi-arrow-left" class="mr-5 rounded-lg h-100" @click="$inertia.visit($route('events.index'))"></v-btn>
        <v-card width="250" v-if="scrolledUp">
            <v-img class="w-100" src="https://images.pexels.com/photos/4498362/pexels-photo-4498362.jpeg?cs=srgb&dl=pexels-karolina-grabowska-4498362.jpg&fm=jpg"></v-img>
        </v-card>
        <v-card class="px-5" :class="!scrolledUp ? 'd-flex w-100' : 'w-75'" flat>
            <h3 class="d-flex  text-blue-grey-darken-3 align-center" :class="!scrolledUp ? 'w-50 mb-5' : ' mb-2'">{{ event.title }}
                <v-btn size="x-small" variant="plain"  icon="mdi-pencil" @click="$inertia.visit($route('events.edit', {event: event.id}))" flat></v-btn>
            </h3>
            <div class="mb-5 d-flex align-center" v-if="scrolledUp">
                <v-chip color="black" variant="tonal" class="mr-2  pa-5 mr-2 rounded-lg" prepend-icon="mdi-calendar-start">{{  date_start(event) }}</v-chip>
                <v-chip v-if="date_start(event) != date_end(event)" color="black" variant="tonal" class=" pa-5 mr-2 rounded-lg" prepend-icon="mdi-calendar-end">{{ date_end(event) }}</v-chip>
                <v-chip color="black" variant="tonal" class=" pa-5 mr-2 rounded-lg" prepend-icon="mdi-clock">{{ event.date_time.event_time_start }}-{{ event.date_time.event_time_end }}</v-chip>
                <v-chip color="black" variant="tonal" class=" pa-5 mr-2 rounded-lg" prepend-icon="mdi-map-marker" v-if="event.location">{{ event.location.name }}</v-chip>
            </div>
            <div class="d-flex w-100">
            <div class="mb-5 w-50 pr-5">
                <h4 class="mb-1 font-weight-normal text-grey-darken-4">Time remaining</h4>
                <VProgressLinear :model-value="50" height="20" color="blue-darken-4">

                </VProgressLinear>
            </div>
            <div class="mb-5 w-50 pr-5">
                <h4 class="mb-1 font-weight-normal text-grey-darken-4">Progress</h4>
                <VProgressLinear :model-value="progress.value" height="20" :color="progress.color">
                </VProgressLinear>
            </div>

            </div>
        </v-card>
    </v-app-bar>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps(['event', 'scrolledUp'])
const date_start = computed(() => (event) => new Date(event.date_time.event_date_start).toDateString())
const date_end = computed(() => (event) => new Date(event.date_time.event_date_end).toDateString())
const progress = computed( () => ({
    value: props.event.event_attendees.length * 10,
    color: props.event.event_attendees.length * 10 >= 100 ? 'success' :  props.event.event_attendees.length * 10 >= 80 ? 'blue-darken-2' :   props.event.event_attendees.length * 10 >= 50 ? 'warning' : 'red'
 }))
</script>

<style lang="scss" scoped>

</style>
