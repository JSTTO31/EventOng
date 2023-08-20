<script setup>
import useEventForm from '@/Composables/useEventCreateForm'
import EventHealthGuidlines from '@/Components/EventHealthGuidlines.vue';
import EventDateTime from '@/Components/EventDateTime.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ExpansionPanel from '@/Components/ExpansionPanel.vue';
import ShowLoading from '@/Components/ShowLoading.vue'
import EventLocation from '@/Components/EventLocation.vue'
import { usePage } from '@inertiajs/vue3';
import EventOrganizer from '@/Components/EventOrganizer.vue';
import { onMounted } from 'vue';
const {status, flat, mode, form, submit} = useEventForm()
const props = defineProps(['locations', 'organizers'])
const $page = usePage()


document.addEventListener('inertia:before', () => {
    if(!form.isDirty) return

    return confirm('You have just started to create event, do you want to discard it?')
}, {once: true})

onMounted(() => {
    console.log('triggered');
    if(form.hasErrors){
        window.scrollTo(0, 0)
    }
})

</script>
<style lang="scss" scoped>

</style>
<template>
    <AuthenticatedLayout :show-app-bar="false" title="Create event">
        <ShowLoading :showDialog="form.processing"></ShowLoading>
        <v-app-bar class="px-5" :flat="flat">
            <h1>Create Event</h1>
            <v-spacer></v-spacer>
            <v-btn color="blue" class="text-capitalize mr-2 rounded-lg" variant="elevated" flat @click="submit" :disabled="!form.isDirty || form.processing" :loading="form.processing">Publish</v-btn>
            <v-btn color="red" class="text-capitalize rounded-lg" variant="elevated" flat @click="$inertia.visit($route('events.index'))">Exit</v-btn>
        </v-app-bar>
        <v-alert v-if="form.hasErrors" density="compact" variant="tonal" border class="rounded-lg mb-5" color="error" >
            <v-list lines class="bg-transparent">
                <v-list-item v-for="error in form.errors">
                    {{ error }}
                </v-list-item>
            </v-list>
        </v-alert>
        <v-card class="rounded-xl pa-5">
            <input v-model="form.title" type="text" placeholder="Event Title" style="outline:none;font-size: 45px;" class="w-100 ">
            <textarea v-model="form.subtitle" placeholder="Event Description" class="w-100  pt-5" style="outline:none;font-size: 20px;" ></textarea>
            <v-divider class="mb-5"></v-divider>
            <h3 class="font-weight-regular mb-5">Event details</h3>
            <v-card class="border" flat>
                <ExpansionPanel>
                    <template #header>
                        <v-icon size="18">mdi-cogs</v-icon>
                        <h5 class="ml-5 font-weight-regular">Event Status</h5>
                    </template>
                    <div class="w-auto d-flex justify-start">
                        <div class="d-flex rounded-pill pa-2 bg-grey-lighten-4">
                            <v-btn size="small" v-for="item in status" @click="form.status = item.value" :variant="form.status != item.value ? 'text' : 'elevated'" color="black" flat class="text-capitalize rounded-pill">{{item.label}}</v-btn>
                        </div>
                    </div>
                </ExpansionPanel>
                <ExpansionPanel>
                    <template #header>
                        <v-icon size="18">mdi-archive</v-icon>
                        <h5 class="ml-5 font-weight-regular">Event Attendance Mode</h5>
                    </template>
                    <div class="w-auto d-flex justify-start">
                        <div class="d-flex rounded-pill pa-2 bg-grey-lighten-4">
                            <v-btn @click="form.mode = item.value"  size="small" color="black" :variant="form.mode == item.value ? 'elevated' : 'text'" flat class="text-capitalize rounded-pill" v-for="item in mode">{{ item.label }}</v-btn>
                        </div>
                    </div>
                </ExpansionPanel>
                <ExpansionPanel>
                    <template #header>
                        <v-icon size="18">mdi-clock</v-icon>
                        <h5 class="ml-5 font-weight-regular">Time and Date</h5>
                    </template>
                    <EventDateTime v-model:date_time="form.date_time"></EventDateTime>
                </ExpansionPanel>
                <ExpansionPanel>
                    <template #header>
                        <v-icon size="18">mdi-heart-pulse</v-icon>
                        <h5 class="ml-5 font-weight-regular">Health Guidlines</h5>
                    </template>
                    <EventHealthGuidlines v-model:health_guideline="form.health_guideline"></EventHealthGuidlines>
                </ExpansionPanel>
                <ExpansionPanel>
                    <template #header>
                        <v-icon size="18">mdi-map-marker</v-icon>
                        <h5 class="ml-5 font-weight-regular">Location and Venue</h5>
                    </template>
                    <EventLocation v-model:location="form.location_id" :locations="locations"></EventLocation>
                </ExpansionPanel>
                <ExpansionPanel>
                    <template #header>
                        <v-icon size="18">mdi-microphone</v-icon>
                        <h5 class="ml-5 font-weight-regular">Organizer</h5>
                    </template>
                    <EventOrganizer v-model:organizer_id="form.organizer_id" :organizers="organizers"></EventOrganizer>
                </ExpansionPanel>
                <!-- <ExpansionPanel>
                    <template #header>
                        <v-icon size="18">mdi-animation</v-icon>
                        <h5 class="ml-5 font-weight-regular">User Interaction for event click</h5>
                    </template>
                </ExpansionPanel> -->
                <ExpansionPanel>
                    <template #header>
                        <v-icon size="18">mdi-link</v-icon>
                        <h5 class="ml-5 font-weight-regular">Learn more about event click.</h5>
                    </template>
                    <v-text-field v-model="form.link" label="https://" variant="solo-filled" hide-details flat single-line></v-text-field>
                </ExpansionPanel>
            </v-card>
        </v-card>

    </AuthenticatedLayout>
</template>

