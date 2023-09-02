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
const props = defineProps(['locations', 'organizers', 'courses'])
const $page = usePage()


// document.addEventListener('inertia:before', (e) => {
//     if(!form.isDirty) return

//     return confirm('You have just started to create event, do you want to discard it?')
// }, {once: true})

onMounted(() => {
    if(form.hasErrors){
        window.scrollTo(0, 0)
    }
})

</script>
<style lang="scss" scoped>

</style>
<template>
    <AuthenticatedLayout :show-app-bar="false" title="Create event" class="px-0 pt-0">
        <ShowLoading :showDialog="form.processing"></ShowLoading>
        <v-navigation-drawer location="right" class="pa-5" width="350">
            <div class="mb-5">
                <h4 class="mb-2">Image</h4>
                <v-card @click="">
                    <v-img src="https://images.pexels.com/photos/4498362/pexels-photo-4498362.jpeg?cs=srgb&dl=pexels-karolina-grabowska-4498362.jpg&fm=jpg"></v-img>
                </v-card>
            </div>
            <div>
                <h4 class="mb-2">Select Course</h4>
                <v-autocomplete
                    variant="outlined"
                    single-line
                    label="HTML, photoshop, premier, and etc."
                    item-value="id"
                    item-title="name"
                    :items="courses"
                ></v-autocomplete>
            </div>
            <div>
                <h4>Select Color</h4>
                <v-color-picker hide-canvas elevation="0" class="w-100"></v-color-picker>
            </div>
            <div>
                <h4 class="mb-2">Learn more about event click.</h4>
                <v-text-field v-model="form.link" label="https://" variant="solo-filled" hide-details flat single-line></v-text-field>
            </div>
        </v-navigation-drawer>
        <v-app-bar class="px-5 border-b" :flat="flat">
            <h1>Create Event</h1>
            <v-spacer></v-spacer>
            <v-btn color="blue" class="text-capitalize mr-2 rounded-lg" variant="elevated" flat @click="submit" :disabled="!form.isDirty || form.processing" :loading="form.processing">Publish</v-btn>
            <v-btn color="red" class="text-capitalize rounded-lg" variant="elevated" flat @click="$inertia.visit($route('events.index'))">Exit</v-btn>
        </v-app-bar>
        <div class="pa-5"  v-if="form.hasErrors">
            <v-alert density="compact" variant="tonal" border class="rounded-lg mb-5" color="error" >
                <v-list lines class="bg-transparent">
                    <v-list-item v-for="error in form.errors">
                        {{ error }}
                    </v-list-item>
                </v-list>
            </v-alert>
        </div>

        <v-card class="rounded-0" flat>
            <v-container>
            <input v-model="form.title" type="text" placeholder="Event Title" style="outline:none;font-size: 45px;" class="w-100 ">
           <textarea v-model="form.subtitle" placeholder="Event Description" class="w-100  pt-5" style="outline:none;font-size: 20px;" ></textarea>
        </v-container>
            <v-divider class="mb-5"></v-divider>
            <h3 class="font-weight-regular mb-5 px-5">Event details</h3>
            <v-card class="" flat>
                <ExpansionPanel>
                    <template #header>
                        <v-icon class="ml-3" size="18">mdi-cogs</v-icon>
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
                        <v-icon class="ml-3" size="18">mdi-archive</v-icon>
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
                        <v-icon class="ml-3" size="18">mdi-clock</v-icon>
                        <h5 class="ml-5 font-weight-regular">Time and Date</h5>
                    </template>
                    <EventDateTime v-model:date_time="form.date_time"></EventDateTime>
                </ExpansionPanel>
                <ExpansionPanel>
                    <template #header>
                        <v-icon class="ml-3" size="18">mdi-heart-pulse</v-icon>
                        <h5 class="ml-5 font-weight-regular">Health Guidlines</h5>
                    </template>
                    <EventHealthGuidlines v-model:health_guideline="form.health_guideline"></EventHealthGuidlines>
                </ExpansionPanel>
                <ExpansionPanel>
                    <template #header>
                        <v-icon class="ml-3" size="18">mdi-map-marker</v-icon>
                        <h5 class="ml-5 font-weight-regular">Location and Venue</h5>
                    </template>
                    <EventLocation v-model:location="form.location_id" :locations="locations"></EventLocation>
                </ExpansionPanel>
                <ExpansionPanel>
                    <template #header>
                        <v-icon class="ml-3" size="18">mdi-microphone</v-icon>
                        <h5 class="ml-5 font-weight-regular">Organizer</h5>
                    </template>
                    <EventOrganizer v-model:organizer_id="form.organizer_id" :organizers="organizers"></EventOrganizer>
                </ExpansionPanel>
            </v-card>
        </v-card>
    </AuthenticatedLayout>
</template>

