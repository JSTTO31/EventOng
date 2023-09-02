<script setup>
import EventCalendarBoxDay from '@/Components/EventCalendarBoxDay.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import EventCard from '@/Components/EventCard.vue';
import { getMonth, getDay, getAllDayInMonth } from '@/Composables/useUtilities';
import { computed } from 'vue';
import { ref } from 'vue';
const props = defineProps(['icon', 'events', 'statuses', 'attendees'])
const currentMonth = ref(new Date().getMonth())
const dates = computed(() => getAllDayInMonth(currentMonth.value));
const statuses = [
    {
        label: 'Scheduled',
        icon: 'mdi-calendar-clock',
        value: 'scheduled',
    },
    {
        label: 'Cancelled',
        icon: 'mdi-calendar-remove',
        value: 'cancelled',
    },
    {
        label: 'Moved to online',
        icon: 'mdi-calendar-cursor',
        value: 'moved',
    },
    {
        label: 'Rescheduled',
        icon: 'mdi-calendar-multiple',
        value: 'rescheduled',
    },
]

</script>

<template>
    <Head title="Dashboard | Welome home" />
    <AuthenticatedLayout title="Dashboard" icon="mdi-view-dashboard">
        <v-row class=" py-0">
            <v-col cols="12">
                <v-row class="pb-5">
                    <v-col cols="9">
                        <v-row >
                            <v-col v-for="status in statuses">
                                <v-card class="d-flex align-center pa-5 rounded-lg" >
                                    <template #prepend >
                                        <v-icon size="45">{{ status.icon }}</v-icon>
                                    </template>
                                    <div>
                                        <h5>{{ status.label }}</h5>
                                        <h2>{{ props.statuses.find(item => item.label == status.value)?.number || 0 }}</h2>
                                    </div>
                                </v-card>
                            </v-col>
                        </v-row>
                        <v-card class="pa-5 mt-5 rounded-lg">
                            <h3>
                                <v-icon class="mr-3">mdi-account-plus</v-icon>
                                New Attendees</h3>
                            <v-table class="mt-5 text-center" hover>
                                <thead class="bg-grey-lighten-4">
                                    <tr>
                                        <td>Name</td>
                                        <td>Email</td>
                                        <td>Mobile</td>
                                        <td>Address</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="attendee in attendees" class="py-2">
                                        <!-- <td>
                                            <h4 class="font-weight-regular">{{ attendee.name }}</h4>
                                            <h6 class="font-weight-regular">{{ attendee.email }}</h6>
                                        </td> -->
                                        <td class="text-subtitle-2">{{ attendee.name }}</td>
                                        <td class="text-subtitle-2">{{ attendee.email }}</td>
                                        <td class="text-subtitle-2">{{ attendee.mobile }}</td>
                                        <td class="text-subtitle-2">{{ attendee.address }}</td>
                                        <td class="text-subtitle-2">
                                            <v-btn size="small" class="text-capitalize" variant="text" flat @click="$inertia.visit(route('inboxes.index', {attendee_id: attendee.id}))">View details</v-btn>
                                        </td>
                                    </tr>
                                </tbody>
                            </v-table>
                        </v-card>
                    </v-col>
                    <v-col cols="3">
                        <v-card class="rounded-lg pa-5 h-100">
                            <h3 class="text-grey-darken-3 mb-5 text-capitalize">Upcoming events</h3>
                            <EventCard class="mb-3" :key="event.id" v-for="event in events" :event="event"></EventCard>
                        </v-card>
                    </v-col>
                </v-row>
                <v-card class="rounded-lg pa-5">
                    <h3 class="d-flex align-center font-weight-bold">
                        {{ getMonth(currentMonth) }} {{ new Date().getFullYear() }}
                        <v-spacer></v-spacer>
                        <v-btn @click="currentMonth--" :disabled="currentMonth == 0" class="rounded-lg border ml-2" flat size="small" icon="mdi-chevron-left"></v-btn>
                        <v-btn @click="currentMonth++" :disabled="currentMonth == 11" class="rounded-lg border ml-2" flat size="small" icon="mdi-chevron-right"></v-btn>
                    </h3>
                    <v-card color="grey-darken-4" flat class="d-flex rounded-b-0 mt-2">
                        <v-col v-for="n in 7" class="text-center text-caption font-weight-bold border">{{ getDay(n - 1) }}</v-col>
                    </v-card>
                    <v-card flat class="d-flex flex-wrap rounded-0">
                        <EventCalendarBoxDay v-for="(date, index) in dates" :events="events" :date="date" :currentMonth="currentMonth"></EventCalendarBoxDay>
                    </v-card>
                </v-card>
            </v-col>
        </v-row>
    </AuthenticatedLayout>
</template>
