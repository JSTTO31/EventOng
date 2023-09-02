<template>
    <AuthenticatedLayoutVue title="Outbox" icon="mdi-inbox-arrow-down-outline">
        <!-- <v-navigation-drawer>
            <div class="pa-5">
                <v-btn block prepend-icon="mdi-square-edit-outline" class="font-weight-medium text-capitalize" size="large" color="blue">Composed</v-btn>
            </div>
            <v-list>
                <v-list-item @click="" prepend-icon="mdi-inbox" active title="Inbox" class="border-e-lg" style="border-right-color: #2196f3 !important;"></v-list-item>
            </v-list>
        </v-navigation-drawer> -->
        <v-navigation-drawer id="attendee-list" width="350">
            <div >
                <div class="pa-3">
                    <v-text-field variant="underlined" hide-details single-line density="compact" label="Search" prepend-inner-icon="mdi-magnify"></v-text-field>
                </div>
                <div class="d-flex align-center">
                    <v-spacer></v-spacer>
                </div>
                <v-card class="pa-2 pb-5 border-b rounded-0" @click="$inertia.visit($route($route().current(), {attendee_id: attendee.id}), {only: ['attendee'], preserveScroll: true, preserveState: true})" :variant="props.attendee && attendee.id == props.attendee.id ? 'tonal' : 'text'" :color="props.attendee && attendee.id == props.attendee.id ? 'blue' : 'black'" flat v-for="attendee in attendees_data">
                    <v-card-title class="text-subtitle-1 font-weight-bold">
                        {{ attendee.name }}
                    </v-card-title>
                    <v-card-subtitle>
                        {{attendee.email}}
                    </v-card-subtitle>
                </v-card>
                <div class="d-flex py-5 w-100" style="position: absolute;bottom: 0;left: 0;" v-if="loading">
                    <v-progress-circular indeterminate class="mx-auto"></v-progress-circular>
                </div>
                <div class="d-flex py-5 w-100 justify-center" v-if="!attendees.next_cursor">
                    <span class="text-subtitle-2 text-center text-grey-darken-2 font-weight-medium">No more attendees</span>
                </div>
            </div>
        </v-navigation-drawer>
        <v-navigation-drawer v-if="attendee" :model-value="showEventDetails && !!attendee" width="350" class="" location="right">
            <v-card height="250" class="d-flex align-center justify-content-center rounded-0">
                <img src="https://images.pexels.com/photos/4498362/pexels-photo-4498362.jpeg?cs=srgb&dl=pexels-karolina-grabowska-4498362.jpg&fm=jpg" class="h-100"/>
            </v-card>
            <v-expansion-panels :model-value="0">
                <v-expansion-panel
                    class="rounded-0"
                    title="Event Details"
                    :elevation="0"
                >
                <template #text>
                    <span class="text-caption">Title</span>
                    <v-card flat class="pa-2 mb-3 bg-grey-lighten-4 rounded-lg text-caption">
                        {{ attendee.event.title }}
                    </v-card>
                    <span class="text-caption">Subtitle</span>
                    <v-card flat class="pa-2 mb-3 bg-grey-lighten-4 rounded-lg text-caption">
                        {{ attendee.event.subtitle }}
                    </v-card>
                    <span class="text-caption">Mode</span>
                    <v-card flat class="pa-2 mb-3 bg-grey-lighten-4 rounded-lg text-caption">
                        {{ attendee.event.mode }}
                    </v-card>
                    <span class="text-caption">Status</span>
                    <v-card flat class="pa-2 mb-3 bg-grey-lighten-4 rounded-lg text-caption">
                        {{ attendee.event.status }}
                    </v-card>
                    <span class="text-caption">Date start</span>
                    <v-card flat class="pa-2 mb-3 bg-grey-lighten-4 rounded-lg text-caption">
                        {{ new Date(attendee.event.date_time.event_date_start).toDateString() }}
                    </v-card>
                    <span class="text-caption">Date end</span>
                    <v-card flat class="pa-2 mb-3 bg-grey-lighten-4 rounded-lg text-caption">
                        {{ new Date(attendee.event.date_time.event_date_end).toDateString() }}
                    </v-card>
                    <span class="text-caption">Time start</span>
                    <v-card flat class="pa-2 mb-3 bg-grey-lighten-4 rounded-lg text-caption">
                        {{ attendee.event.date_time.event_time_start }}
                    </v-card>
                    <span class="text-caption">Time end</span>
                    <v-card flat class="pa-2 mb-3 bg-grey-lighten-4 rounded-lg text-caption">
                        {{ attendee.event.date_time.event_time_end }}
                    </v-card>
                    <span class="text-caption">Location</span>
                    <v-card flat class="pa-2 mb-3 bg-grey-lighten-4 rounded-lg text-caption">
                        {{ attendee.event.location.name }}
                    </v-card>
                </template>
                </v-expansion-panel>
                <v-expansion-panel
                    class="rounded-0"
                    title="Person Details"
                    :elevation="0"
                >
                <template #text>
                    <span class="text-caption">Name</span>
                    <v-card flat class="pa-2 mb-3 bg-grey-lighten-4 rounded-lg text-caption">
                        {{ attendee.name }}
                    </v-card>
                    <span class="text-caption">Email</span>
                    <v-card flat class="pa-2 mb-3 bg-grey-lighten-4 rounded-lg text-caption">
                        {{ attendee.email }}
                    </v-card>
                    <span class="text-caption">Mobile</span>
                    <v-card flat class="pa-2 mb-3 bg-grey-lighten-4 rounded-lg text-caption">
                        {{ attendee.mobile }}
                    </v-card>
                    <span class="text-caption">Address</span>
                    <v-card flat class="pa-2 mb-3 bg-grey-lighten-4 rounded-lg text-caption">
                        {{ attendee.address }}
                    </v-card>
                </template>
                </v-expansion-panel>
            </v-expansion-panels>
        </v-navigation-drawer>
        <v-app-bar v-if="attendee" flat class="border-b pl-5">
            <v-avatar size="45">
                <v-img :src="'https://ui-avatars.com/api/?name=' + attendee.name + '&background=0D8ABC&color=fff'"></v-img>
            </v-avatar>
            <v-app-bar-title class="font-weight-medium">
                {{attendee.name}}
            </v-app-bar-title>
            <v-spacer></v-spacer>
            <v-btn icon="mdi-menu" @click="showEventDetails = !showEventDetails"></v-btn>
        </v-app-bar>
        <div v-if="attendee">
            <v-banner>
                A new attendee has registered for the <mark>{{ attendee.event.title }}</mark> event. Attendee Name: <strong>{{ attendee.name }}</strong>
            </v-banner>
            <div v-if="attendee && attendee.messages">
                <v-card v-for="message in attendee.messages" class="pa-5 my-5" :key="message.id">
                    <div class="d-flex align-center">
                        <v-spacer></v-spacer>
                        <span class="text-caption">{{ new Date(message.created_at).toDateString() }}</span>
                    </div>
                    <v-card-title>Subject: {{ message.subject }}</v-card-title>
                    <v-card-text style="white-space: pre-wrap;">
                            {{ message.message }}
                    </v-card-text>
                </v-card>
            </div>
        </div>
        <div v-else class="h-100 w-100 d-flex align-center justify-center">
            <h2 class="text-grey-darken-1">No selected attendee</h2>
        </div>
        <v-footer app class="bg-transparent" v-if="attendee">
            <!-- <v-text-field v-model="form.message" rounded label="Type your message here..." @keyup.enter="submit(attendee.attendee_id)" single-line density="comfortable" variant="solo-filled" append-inner-icon="mdi-send"></v-text-field> -->
            <v-card class="d-flex text-subtitle-1 w-100 pa-5 rounded-pill bg-grey-lighten-2" @click="showMessageDialog = true" variant="plain">
                <span>Type your message here...</span>
                <v-spacer></v-spacer>
                <v-icon>mdi-send</v-icon>
            </v-card>
        </v-footer>
        <v-dialog v-model="showMessageDialog" persistent width="650" transition="dialog-bottom-transition">
            <v-card class="pa-5" :disabled="form.processing">
                <v-card-text>
                    <h2 class="mb-5">New Message</h2>
                    <v-text-field density="compact" variant="underlined" :model-value="attendee.email" readonly>
                        <template #prepend>
                            <span class="mr-10">To</span>
                        </template>
                    </v-text-field>
                    <v-text-field density="compact" v-model="form.subject" variant="underlined">
                        <template #prepend>
                            Subject
                        </template>
                    </v-text-field>
                    <v-textarea label="Message..." v-model="form.message" variant="underlined" single-line></v-textarea>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn variant="elevated" @click="showMessageDialog = false" flat>Cancel</v-btn>
                        <v-btn append-icon="mdi-send" flat :loading="form.processing" variant="elevated" @click="submit(attendee.attendee_id)" color="blue-darken-4">Send</v-btn>
                    </v-card-actions>
                </v-card-text>
                <span style="position: absolute;top: 25px;right: 25px;">
                    <v-btn icon="mdi-close" @click="showMessageDialog = false"></v-btn>
                </span>
            </v-card>
        </v-dialog>
    </AuthenticatedLayoutVue>
</template>

<script setup>
import useMessageForm from '@/Composables/useMessageForm'
import AuthenticatedLayoutVue from '@/Layouts/AuthenticatedLayout.vue';
import { router, } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { ref } from 'vue';
const props = defineProps(['attendees', 'attendee'])
const {form, showMessageDialog, submit} = useMessageForm()
const attendees_data = ref([])
const showEventDetails = ref(true)
const loading = ref(false)
const loadMoreAttendees = () => {

    if(props.attendees && props.attendees.next_cursor && !loading.value){
        router.visit(route(route().current(), {
            // attendee: props.attendee.id || null,
            cursor: props.attendees.next_cursor,
        }), {
            onBefore: () => loading.value= true,
            onFinish: () => {
                loading.value = false
                if(props.attendees.data.length > 0){
                    console.log('triggered');
                    attendees_data.value.push(...props.attendees.data)
                }
            },
            preserveState: true,
            preserveScroll: true,
            only: ['attendees'],

        })
    }


}


onMounted(() => {
    if(props.attendees.data.length > 0 && !props.attendee){
        router.visit(route(route().current(), {attendee_id: props.attendees.data[0].id}))
    }

    let attendeeList = document.querySelector('#attendee-list .v-navigation-drawer__content')
    if(attendeeList){
        attendeeList.addEventListener('scroll', (e) => {
            if((e.target.scrollTop + e.target.offsetHeight) >= e.target.scrollHeight){
                loadMoreAttendees()
            }
        })
    }
})

if(props.attendees.data.length > 0){
    console.log('triggered');
    attendees_data.value.push(...props.attendees.data)
}


</script>

<style lang="scss" scoped>

</style>
