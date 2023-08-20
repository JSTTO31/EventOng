<template>
    <div>
        <v-btn rounded variant="elevated" class="font-weight-bold mr-2" flat color="black" @click="showLocationList = true">Select a location from list</v-btn>
        <v-btn rounded variant="elevated" class="font-weight-bold mr-2" @click="showLocationCreateDialog = true" flat color="black">Create a new location</v-btn>
        <v-dialog v-model="showLocationCreateDialog" width="850" style="overflow-y: scroll;" class="d-flex align-center justify-center">
            <v-card class="pa-5 rounded-xl" :disabled="form.processing">
                <div class="d-flex align-center">
                    <h2 class="px-5">Create a new Location</h2>
                    <v-spacer></v-spacer>
                    <v-btn icon="mdi-close" variant="outlined" size="small" @click="showLocationCreateDialog = false"></v-btn>
                </div>
                <v-form class="py-5" @submit.prevent="submit">
                    <v-text-field density="compact" v-model="form.name" :error-messages="form.errors.name" prepend-icon="mdi-text" label="Location name" variant="solo-filled" flat></v-text-field>
                    <v-textarea density="compact" v-model="form.description" prepend-icon="mdi-script" auto-grow rows="1" variant="solo-filled" flat label="Location description"></v-textarea>
                    <v-text-field density="compact" v-model="form.address" :error-messages="form.errors.address" prepend-icon="mdi-map-marker" variant="solo-filled" flat label="Location address"></v-text-field>
                    <v-text-field density="compact" v-model="form.city" prepend-icon="mdi-city" variant="solo-filled" flat label="Location city (optional)"></v-text-field>
                    <v-text-field density="compact" v-model="form.state" prepend-icon="mdi-home-group" variant="solo-filled" flat label="Location state (optional)"></v-text-field>
                    <v-text-field density="compact" v-model="form.country" prepend-icon="mdi-flag" variant="solo-filled" flat label="Location country (optional)"></v-text-field>
                    <v-text-field density="compact" v-model="form.link" prepend-icon="mdi-link" variant="solo-filled" flat label="Link location"></v-text-field>
                    <v-file-input accept=".png,.jpg,jpeg" density="compact" v-model="form.image" variant="solo-filled" flat label="Input image"></v-file-input>
                    <v-switch v-model="form.open_new_tab" inset color="blue" label="Location open new tab"></v-switch>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn variant="elevated" :loading="form.processing" type="submit" color="black" rounded class="px-5 mt-4 font-weight-bold">Save taxonomy changes</v-btn>
                    </v-card-actions>
                </v-form>
            </v-card>
        </v-dialog>
        <v-overlay v-model="showLocationList" width="850" style="overflow-y: scroll;"  class="d-flex align-center justify-center">
            <v-card class="rounded-xl pa-5 pb-15" :disabled="form.processing">
                <div class="d-flex align-center">
                    <h2 class="px-5">Select location from list</h2>
                    <v-spacer></v-spacer>
                    <v-btn icon="mdi-close" variant="outlined" size="small" @click="showLocationList = false"></v-btn>
                </div>
                <v-list>
                    <v-list-item @click="emits('update:location', loc.id == location ? null : loc.id)" :title="loc.name" class="text-capitalize" :key="loc.id" v-for="loc in locations">
                        <template #prepend>
                            <v-radio @click="emits('update:location', loc.id == location ? null : loc.id)" :value="loc.id" :model-value="location" hide-details></v-radio>
                        </template>
                    </v-list-item>
                </v-list>
            </v-card>
        </v-overlay>
    </div>
</template>

<script setup>
import useLocationCreate from '@/Composables/useLocationCreate';
import { ref } from 'vue';
const {form, submit, showLocationCreateDialog} = useLocationCreate()
const showLocationList = ref(false)
const props = defineProps(['locations', 'location'])
const emits = defineEmits(['update:location'])
</script>

<style lang="scss" scoped>

</style>
