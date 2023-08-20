<template>
    <AuthenticatedLayoutVue title="Inbox" icon="mdi-inbox">
        <!-- <v-navigation-drawer>
            <div class="pa-5">
                <v-btn block prepend-icon="mdi-square-edit-outline" class="font-weight-medium text-capitalize" size="large" color="blue">Composed</v-btn>
            </div>
            <v-list>
                <v-list-item @click="" prepend-icon="mdi-inbox" active title="Inbox" class="border-e-lg" style="border-right-color: #2196f3 !important;"></v-list-item>
            </v-list>
        </v-navigation-drawer> -->
        <v-navigation-drawer width="350" id="attendee-list" v-model="example">
            <div>

                <div class="pa-3">
                    <v-text-field variant="underlined" hide-details single-line density="compact" label="Search" prepend-inner-icon="mdi-magnify"></v-text-field>
                </div>
                <div class="d-flex align-center">
                    <v-spacer></v-spacer>
                </div>
                <v-card class="pa-2 pb-5 border-b rounded-0" @click="$inertia.visit($route($route().current(), {attendee_id: attendee.id}))" :variant="props.attendee && attendee.id == props.attendee.id ? 'tonal' : 'text'" :color="props.attendee && attendee.id == props.attendee.id ? 'blue' : 'black'" flat v-for="attendee in attendees.data">
                    <v-card-title class="text-subtitle-1 font-weight-bold">
                        {{ attendee.name }}
                    </v-card-title>
                    <v-card-subtitle>
                        {{attendee.email}}
                    </v-card-subtitle>
                </v-card>
                <div class="d-flex py-5">
                    <v-progress-circular indeterminate class="mx-auto"></v-progress-circular>
                </div>
            </div>
        </v-navigation-drawer>
        <v-app-bar v-if="selected" flat class="border-b px-5">
            <v-avatar size="45">
                <v-img :src="'https://ui-avatars.com/api/?name=' + attendee.name + '&background=0D8ABC&color=fff'"></v-img>
            </v-avatar>
            <v-app-bar-title class="font-weight-medium">
                {{attendee.name}}
            </v-app-bar-title>
        </v-app-bar>
        <div v-if="selected">
            <v-banner>
                A new attendee has registered for the <mark>{{ attendee.event.title }}</mark> event. Attendee Name: <strong>{{ attendee.name }}</strong>
            </v-banner>
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
        <div v-else class="h-100 w-100 d-flex align-center justify-center">
            <h2 class="text-grey-darken-1">No selected attendee</h2>
        </div>
        <v-navigation-drawer v-if="selected" width="320" class="pa-5" location="right">

            <span>Name</span>
            <v-card flat class="pa-5 mb-3 bg-grey-lighten-4 rounded-lg">
                {{ attendee.name }}
            </v-card>
            <span>Email</span>
            <v-card flat class="pa-5 mb-3 bg-grey-lighten-4 rounded-lg">
                {{ attendee.email }}
            </v-card>
            <span>Mobile</span>
            <v-card flat class="pa-5 mb-3 bg-grey-lighten-4 rounded-lg">
                {{ attendee.mobile }}
            </v-card>
            <span>Address</span>
            <v-card flat class="pa-5 mb-3 bg-grey-lighten-4 rounded-lg">
                {{ attendee.address }}
            </v-card>
        </v-navigation-drawer>
        <v-footer app class="bg-transparent" v-if="selected">
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
import { router } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { ref } from 'vue';
const example = ref(null)
const props = defineProps(['attendees', 'attendee'])
const selected = ref(props.attendee || null)
const {form, showMessageDialog, submit} = useMessageForm()
onMounted(() => {
    if(props.attendees.length > 0 && !selected.value){
        console.log('triggiered',  !selected.value);
        router.visit(route(route().current(), {attendee_id: props.attendees[0].id}))
    }


    let attendeeList = document.getElementById('attendee-list')
    if(attendeeList){
        attendeeList.addEventListener('scroll', () => {
            console.log('triggered');
        })
    }
})

const scroll = (e) => {
    console.log(e);
}



</script>

<style lang="scss" scoped>

</style>
