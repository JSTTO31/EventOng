<script setup>
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import EventListItem from '@/Components/EventListItem.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { computed } from 'vue';
import { ref } from 'vue';
import useEventFilter from '@/Composables/useEventFilter';
const props = defineProps(['events', 'events_count', 'courses'])
const {form, status, mode, submit} = useEventFilter()
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
    <AuthenticatedLayout title="Event" icon="mdi-calendar">
        <v-container fluid>
            <div class="d-flex align-center rounded-0" style="overflow: visible;" flat>
                <div class="d-flex align-center mb-5">
                    <h1 class="mr-5">Event List</h1>
                    <v-btn class="text-capitalize" @click="$inertia.visit($route('events.create'))" prepend-icon="mdi-plus" variant="outlined" color="blue-darken-1" rounded>Add event</v-btn>
                </div>
                <!-- <input placeholder="Search..." @keyup.enter="$event => $inertia.get($route('events.index', {...$route().params, search: $event.target.value}))" class="border w-25 px-3 pa-2 rounded-md text-subtitle-2 bg-white"/> -->
                <v-spacer></v-spacer>
                <v-menu :close-on-content-click="false">
                    <template #activator="{props}">
                        <v-btn v-bind="props" icon="mdi-filter-variant" flat class="rounded-lg font-weight-medium text-grey-darken-2" variant="text" size="large"></v-btn>
                    </template>
                    <v-card class="pa-10 rounded-xl mb-5" style="overflow: visible;" width="550">
                        <h2 class="mb-2">Filter events</h2>
                        <span>Event Search</span>
                        <v-text-field class="mt-2" density="compact" variant="outlined" single-line label="Search..."></v-text-field>
                        <div>
                            <span class="">Date range</span>
                            <VueDatePicker class="mt-2" range placeholder="Date range" v-model="form.range"></VueDatePicker>
                        </div>
                        <div class="mt-5">
                            <span class="">Course</span>
                            <v-select class="mt-2" density="compact" variant="outlined" label="Select course" single-line :items="courses" item-title="name" item-value="id"></v-select>
                        </div>
                        <div class="">
                            <span class="">Status</span>
                            <div class="d-flex flex-wrap">
                            <VCheckbox density="compact" color="blue-darken-2" hide-details direction="horizontal" class="" v-model="form.status" v-for="stat in status" :label="stat.label" :value="stat.value"></VCheckbox>
                            </div>
                        </div>
                        <div class="pa-0 d-flex mt-5">
                            <v-btn variant="elevated" flat color="blue-darken-1" class="mr-2" @click="submit">Search</v-btn>
                            <v-btn class="bg-grey-lighten-4" @click="form.reset()" flat>Clear</v-btn>
                        </div>
                    </v-card>
                </v-menu>
            </div>
            <div class="mt-5">
                <v-tabs :model-value="$route().params.event_status" density="compact">
                    <v-tab value="all" size="small" @click="$inertia.get($route('events.index', {event_status: ''}))" class="text-capitalize" prepend-icon="mdi-calendar-multiple">
                        All events
                        <v-chip class="ml-3" color="black" flat variant="elevated" size="small">{{ events_count }}</v-chip>
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
                <div flat class="border mt-5" v-if="events.total > 0">
                    <div class="d-flex rounded-0 pa-0 bg-grey-lighten-4">
                        <v-col cols="3" class="py-0 d-flex align-center">
                            <span>
                                <v-checkbox :disabled="events.total < 1" :indeterminate="hasSomeSelected && !isSelectedAll" :model-value="isSelectedAll && events.total > 0" hide-details density="compact" @click="selectedAll"></v-checkbox>
                            </span>
                            <span class="ml-4 text-caption font-weight-regular">Name</span>
                        </v-col>
                        <v-col cols="2" class="py-0 d-flex align-center">
                            <span class="ml-4 text-caption font-weight-regular">Location</span>
                        </v-col>
                        <v-col cols="2" class="py-0 d-flex align-center">
                            <span class="ml-4 text-caption font-weight-regular">Organizer</span>
                        </v-col>
                        <v-col cols="2" class="py-0 d-flex align-center">
                            <span class="ml-4 text-caption font-weight-regular">Date</span>
                        </v-col>
                        <v-col cols="2" class="py-0 d-flex align-center">
                            <span class="ml-4 text-caption font-weight-regular">Mode</span>
                        </v-col>
                        <v-col cols="1" class="py-0 d-flex align-center">
                            <span class="ml-4 text-caption font-weight-regular">Status</span>
                        </v-col>
                    </div>
                    <EventListItem v-for="event in events.data" :event="event" v-model:selected="selected"></EventListItem>
                    <div class="d-flex rounded-0 pa-0 bg-grey-lighten-4">
                        <v-col cols="3" class="py-0 d-flex align-center">
                            <span>
                                <v-checkbox :disabled="events.total < 1" :indeterminate="hasSomeSelected && !isSelectedAll" :model-value="isSelectedAll && events.total > 0" hide-details density="compact" @click="selectedAll"></v-checkbox>
                            </span>
                            <span class="ml-4 text-caption font-weight-regular">Name</span>
                        </v-col>
                        <v-col cols="2" class="py-0 d-flex align-center">
                            <span class="ml-4 text-caption font-weight-regular">Location</span>
                        </v-col>
                        <v-col cols="2" class="py-0 d-flex align-center">
                            <span class="ml-4 text-caption font-weight-regular">Organizer</span>
                        </v-col>
                        <v-col cols="2" class="py-0 d-flex align-center">
                            <span class="ml-4 text-caption font-weight-regular">Date</span>
                        </v-col>
                        <v-col cols="2" class="py-0 d-flex align-center">
                            <span class="ml-4 text-caption font-weight-regular">Mode</span>
                        </v-col>
                        <v-col cols="1" class="py-0 d-flex align-center">
                            <span class="ml-4 text-caption font-weight-regular">Status</span>
                        </v-col>
                    </div>
                </div>
                <div v-else class="">
                    <h2 class="text-center pt-15 text-grey-darken-3">No events</h2>
                </div>
                <div class="bg-transparent pt-2 d-flex align-center" flat v-if="events.last_page > 1">
                    <span>
                        Page {{ events.current_page }} / {{ events.last_page }}
                    </span>
                    <v-spacer></v-spacer>
                    <v-pagination :model-value="1" :length="events.last_page" :total-visible="3"></v-pagination>
                </div>
            </div>
        </v-container>
        <v-footer elevation="5" app v-show="hasSomeSelected">
            <div class="bg-transparent py-2  d-flex align-center text-subtitle-2" flat>
                <span>
                    <span>
                        Selected events ({{ selected.length }})
                    </span>
                    <v-btn :disabled="!hasSomeSelected" variant="text" color="error" size="small" prepend-icon="mdi-delete-outline">Delete all</v-btn>
                </span>
            </div>
        </v-footer>
    </AuthenticatedLayout>
</template>


