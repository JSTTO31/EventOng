<template>
    <div>
        <v-btn rounded variant="elevated" class="font-weight-bold mr-2" @click="showOrganizerList = true" flat color="black">Select a organizer from list</v-btn>
        <v-btn rounded variant="elevated" class="font-weight-bold mr-2" @click="showCreateOrganizerDialog = true" flat color="black">Create a new organizer</v-btn>
        <v-dialog v-model="showCreateOrganizerDialog" width="850" style="overflow-y: scroll;" class="d-flex align-center justify-center">
            <v-card class="pa-5 rounded-xl">
                <div class="d-flex align-center">
                    <h2 class="px-5">Create a new organizer</h2>
                    <v-spacer></v-spacer>
                    <v-btn icon="mdi-close" variant="outlined" size="small" @click="showCreateOrganizerDialog = false"></v-btn>
                </div>
                <v-form class="mt-5" @submit.prevent="submit">
                    <v-text-field label="Organizer name" prepend-icon="mdi-microphone" v-model="form.name" :error-messages="form.errors.name" density="compact" variant="solo-filled" flat>
                    </v-text-field>
                    <v-textarea label="Organizer description" rows="1" auto-grow prepend-icon="mdi-text" v-model="form.description" :error-messages="form.errors.description" density="compact" variant="solo-filled" flat>
                    </v-textarea>
                    <v-text-field label="General contact details" prepend-icon="mdi-phone" v-model="form.general_contact_details" :error-messages="form.errors.general_contact_details" density="compact" variant="solo-filled" flat>
                    </v-text-field>
                    <v-text-field label="Email address" prepend-icon="mdi-mail" v-model="form.email_address" :error-messages="form.errors.email_address" density="compact" variant="solo-filled" flat>
                    </v-text-field>
                    <v-text-field label="Physical address" prepend-icon="mdi-map-marker" v-model="form.physical_address" :error-messages="form.errors.physical_address" density="compact" variant="solo-filled" flat>
                    </v-text-field>
                    <v-file-input accept=".jpg,.png,.jpeg" label="Input image" v-model="form.image" :error-messages="form.errors.image" density="compact" variant="solo-filled" flat></v-file-input>
                    <v-text-field label="twitter url" prepend-icon="mdi-link" v-model="form.twitter_link" :error-messages="form.errors.twitter_link" density="compact" variant="solo-filled" flat>
                    </v-text-field>
                    <v-text-field label="instagram url" prepend-icon="mdi-link" v-model="form.instagram_link" :error-messages="form.errors.instagram_link" density="compact" variant="solo-filled" flat></v-text-field>
                    <v-text-field label="youtube url" prepend-icon="mdi-link" v-model="form.youtube_link" :error-messages="form.errors.youtube_link" density="compact" variant="solo-filled" flat></v-text-field>
                    <v-text-field label="youtube url" prepend-icon="mdi-link" v-model="form.youtube_link" :error-messages="form.errors.youtube_link" density="compact" variant="solo-filled" flat></v-text-field>
                    <v-text-field label="Whats app url" prepend-icon="mdi-link" v-model="form.whats_app_link_link" :error-messages="form.errors.whats_app_link_link" density="compact" variant="solo-filled" flat></v-text-field>
                    <v-text-field label="tiktok url" prepend-icon="mdi-link" v-model="form.tiktok_link" :error-messages="form.errors.tiktok_link" density="compact" variant="solo-filled" flat></v-text-field>
                    <v-text-field label="facebook url" prepend-icon="mdi-link" v-model="form.facebook_link" :error-messages="form.errors.facebook_link" density="compact" variant="solo-filled" flat></v-text-field>
                    <v-text-field label="linkedin url" prepend-icon="mdi-link" v-model="form.linkedin_link" :error-messages="form.errors.linkedin_link" density="compact" variant="solo-filled" flat></v-text-field>
                    <v-text-field label="organizer url" prepend-icon="mdi-link" v-model="form.organizer_link" :error-messages="form.errors.organizer_link" density="compact" variant="solo-filled" flat></v-text-field>
                    <v-switch v-model="form.open_new_tab" inset color="blue" label="Open link in new tab"></v-switch>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn type="submit" class="px-5" variant="elevated" color="black" rounded flat>Save changes</v-btn>
                    </v-card-actions>
                </v-form>
            </v-card>
        </v-dialog>
        <v-dialog v-model="showOrganizerList" width="850" style="overflow-y: scroll;" class="d-flex align-center justify-center">
            <v-card class="pa-5 rounded-xl">
                <div class="d-flex align-center">
                    <h2 class="px-5">Select a organizer from list</h2>
                    <v-spacer></v-spacer>
                    <v-btn icon="mdi-close" variant="outlined" size="small" @click="showOrganizerList = false"></v-btn>
                </div>
                <v-list>
                    <v-list-item @click="emits('update:organizer_id', organizer.id == organizer_id ? null : organizer.id)" :title="organizer.name" class="text-capitalize" :key="organizer.id" v-for="organizer in organizers">
                        <template #prepend>
                            <v-radio @click="emits('update:organizer_id', organizer.id == organizer_id ? null : organizer.id)" :value="organizer.id" :model-value="organizer_id" hide-details></v-radio>
                        </template>
                    </v-list-item>
                </v-list>
            </v-card>
        </v-dialog>
    </div>
</template>

<script setup>
import useOrganizerCreate from '@/Composables/useOrganizerCreate'
import { ref } from 'vue';
const props = defineProps(['organizers', 'organizer_id'])
const emits = defineEmits(['update:organizer_id'])
const {form, submit, showCreateOrganizerDialog} = useOrganizerCreate()
const showOrganizerList = ref(false)
</script>

<style lang="scss" scoped>

</style>
