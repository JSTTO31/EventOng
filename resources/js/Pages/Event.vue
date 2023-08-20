<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import { ref } from 'vue';
const props = defineProps(['events'])
const selected = ref([])
const isSelectedAll = computed(() => {
    return props.events.data.every(event => selected.value.some(item => event.id == item))
})
const hasSomeSelected = computed(() => props.events.data.some(event => selected.value.some(item => item == event.id)))
const selectedAll = () => {
    if(isSelectedAll.value){
        selected.value = []
    }else{
        props.events.data.forEach(item => selected.value.some(event => event == item.id) ? '' : selected.value.push(item.id))
    }
}

</script>

<template>
    <AuthenticatedLayout title="Event List" icon="mdi-calendar">
        <v-container fluid>
            <div class="d-flex align-center">
                <div class="w-25 mr-2">
                    <v-text-field label="Search..." @keyup.enter="$event => $inertia.get($route('events.index', {...$route().params, search: $event.target.value}))" hide-details single-line variant="solo-inverted" prepend-inner-icon="mdi-magnify" density="compact" class="rounded-xl"></v-text-field>
                </div>
                <v-spacer></v-spacer>

                <v-btn class="rounded-xl ml-5" prepend-icon="mdi-plus" color="blue-darken-4" variant="outlined" @click="$inertia.visit($route('events.create'))">New Event</v-btn>

            </div>
            <div class=" mt-5">
                <v-tabs :model-value="$route().params.event_status" density="compact">
                    <v-tab value="all" size="small" @click="$inertia.get($route('events.index', {event_status: ''}))" class="text-capitalize" prepend-icon="mdi-calendar-multiple">
                        All events
                        <v-chip class="ml-3" color="black" flat variant="elevated" size="small">{{ events.total }}</v-chip>
                    </v-tab>
                    <v-tab value="scheduled" size="small" @click="$inertia.get($route('events.index', {event_status: 'scheduled'}))" class="text-capitalize" prepend-icon="mdi-calendar">Scheduled</v-tab>
                    <v-tab value="cancelled" size="small" @click="$inertia.get($route('events.index', {event_status: 'cancelled'}))" class="text-capitalize" prepend-icon="mdi-calendar-remove-outline">Cancelled</v-tab>
                    <v-tab value="moved" size="small" @click="$inertia.get($route('events.index', {event_status: 'moved'}))" class="text-capitalize" prepend-icon="mdi-calendar-sync-outline">Moved Online</v-tab>
                    <v-tab value="postponed" size="small" @click="$inertia.get($route('events.index', {event_status: 'postponed'}))" class="text-capitalize" prepend-icon="mdi-calendar-refresh-outline">Postponed</v-tab>
                    <v-tab value="rescheduled" size="small" @click="$inertia.get($route('events.index', {event_status: 'rescheduled'}))" class="text-capitalize" prepend-icon="mdi-calendar-arrow-right">Rescheduled</v-tab>
                    <v-spacer></v-spacer>

                    <v-tab size="small" flat color="error" class="pr-5 text-capitalize" prepend-icon="mdi-trash-can-outline">
                        Event Trash
                    </v-tab>

                </v-tabs>
                <v-divider></v-divider>
                <v-card flat class="border mt-5" v-if="events.total > 0">
                    <v-card class="d-flex rounded-0 pa-0 bg-grey-lighten-4">
                        <v-col cols="3" class="py-0 d-flex align-center">
                            <span>
                                <v-checkbox :disabled="events.total < 1" :indeterminate="hasSomeSelected && !isSelectedAll" :model-value="isSelectedAll && events.total > 0" hide-details density="compact" @click="selectedAll"></v-checkbox>
                            </span>
                            <span class="ml-4 text-caption font-weight-regular">Name</span>
                        </v-col>
                        <v-col cols="3" class="py-0 d-flex align-center">
                            <span class="ml-4 text-caption font-weight-regular">Location</span>
                        </v-col>
                        <v-col cols="2" class="py-0 d-flex align-center">
                            <span class="ml-4 text-caption font-weight-regular">Start date</span>
                        </v-col>
                        <v-col cols="2" class="py-0 d-flex align-center">
                            <span class="ml-4 text-caption font-weight-regular">End Date</span>
                        </v-col>
                        <v-col cols="2" class="py-0 d-flex align-center">
                            <span class="ml-4 text-caption font-weight-regular">Actions</span>
                        </v-col>
                    </v-card>

                    <v-card class="rounded-0 d-flex border-b py-2" v-for="event in events.data" :key="event.id">
                        <v-col cols="3" class="py-0 d-flex align-center">
                            <span>
                                <v-checkbox v-model="selected" :value="event.id" hide-details density="compact"></v-checkbox>
                            </span>
                            <div class="d-flex ml-4 w-100">
                                <v-avatar size="80" class="bg-blue-lighten-4 rounded-lg"></v-avatar>
                                <v-hover v-slot="{props, isHovering}">
                                    <span @click="$inertia.visit($route('events.show', {event: event.id}))" v-bind="props" :class="isHovering ? 'text-decoration-underline' : ''" class=" font-weight-bold ml-3 text-blue-darken-3" style="cursor: pointer;">{{ event.title }}</span>
                                </v-hover>
                            </div>
                        </v-col>
                        <v-col cols="3" class="py-0 d-flex align-center">
                            <span class="ml-4 text-caption font-weight-regular">{{ event.location ? event.location.name : 'NULL' }}</span>
                        </v-col>
                        <v-col cols="2" class="py-0 d-flex align-center">
                            <span class="ml-4 text-caption font-weight-regular">{{ event.date_time['event_date_start'] }}-{{ event.date_time['event_time_start'] }}</span>
                        </v-col>
                        <v-col cols="2" class="py-0 d-flex align-center">
                            <span class="ml-4 text-caption font-weight-regular">{{ event.date_time['event_date_end'] }}-{{event.date_time['event_time_end']}}</span>
                        </v-col>
                        <v-col cols="2" class="py-0 d-flex align-center">
                            <span class="ml-4 text-caption font-weight-regular">
                                <Link as="button" class="text-blue text-decoration-underline" :href="$route('events.edit', {event: event.id})">Edit</Link>
                                <span class="mx-2">|</span>
                                <Link :href="$route('events.destroy', {event: event.id})" method="delete" as="button" class="text-red text-decoration-underline">Remove</Link>
                            </span>
                        </v-col>
                    </v-card>
                    <v-card class="d-flex rounded-0 pa-0 bg-grey-lighten-4">
                        <v-col cols="3" class="py-0 d-flex align-center">
                            <span>
                                <v-checkbox :disabled="events.total < 1" :indeterminate="hasSomeSelected && !isSelectedAll" :model-value="isSelectedAll && events.total > 0" hide-details density="compact" @click="selectedAll"></v-checkbox>
                            </span>
                            <span class="ml-4 text-caption font-weight-regular">Name</span>
                        </v-col>
                        <v-col cols="3" class="py-0 d-flex align-center">
                            <span class="ml-4 text-caption font-weight-regular">Location</span>
                        </v-col>
                        <v-col cols="2" class="py-0 d-flex align-center">
                            <span class="ml-4 text-caption font-weight-regular">Start date</span>
                        </v-col>
                        <v-col cols="2" class="py-0 d-flex align-center">
                            <span class="ml-4 text-caption font-weight-regular">End Date</span>
                        </v-col>
                        <v-col cols="2" class="py-0 d-flex align-center">
                            <span class="ml-4 text-caption font-weight-regular">Actions</span>
                        </v-col>
                    </v-card>
                </v-card>
                <v-card class="bg-transparent pt-2 d-flex align-center" flat v-if="events.last_page > 1">
                    <span>
                        Page {{ events.current_page }} / {{ events.last_page }}
                    </span>
                    <v-spacer></v-spacer>
                    <v-pagination :model-value="1" :length="events.last_page" :total-visible="3"></v-pagination>
                </v-card>
            </div>
        </v-container>
        <v-footer elevation="5" app v-show="hasSomeSelected">
            <v-card class="bg-transparent py-2  d-flex align-center text-subtitle-2" flat>
                <span>
                    <span>
                        Selected events ({{ selected.length }})
                    </span>
                    <v-btn :disabled="!hasSomeSelected" variant="text" color="error" size="small" prepend-icon="mdi-delete-outline">Delete all</v-btn>
                </span>
            </v-card>
        </v-footer>
    </AuthenticatedLayout>
</template>


