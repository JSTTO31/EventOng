<template>
    <v-card class="pa-5 rounded-lg border-s-xl" color="blue-lighten-1" @click="$inertia.visit($route('events.index', {event: event.id}))">
        <h4>{{ event.title }}
        </h4>
        <span class="text-caption">{{ new Date(event.date_time.event_date_start).toDateString() }}</span>
        <h5 class="mt-2 font-weight-normal">
            <v-icon>mdi-clock</v-icon>
            {{ event.date_time.event_time_start }}
            to
            {{ event.date_time.event_time_end }}
        </h5>
    </v-card>
</template>

<script setup>
const props = defineProps(['event'])
</script>

<style lang="scss" scoped>

</style>
