<template>
    <v-dialog width="850" :model-value="image != null" @click:outside="emits('update:image', null)">
        <v-card class="pa-5 rounded-lg">
            <v-row>
                <v-col>
                    <v-card height="450" flat class="d-flex bg-grey-lighten-4">
                        <v-img :src="image.location"  class="w-100" />
                    </v-card>
                </v-col>
                <v-col>
                    <div class="h-100 d-flex flex-column">
                        <h3 class="mt-2">File details</h3>
                        <div class="mt-2">
                            <v-text-field density="compact" label="Name" single-line variant="outlined" v-model="image.name"></v-text-field>
                            <v-textarea readonly density="compact" label="Location" single-line variant="outlined" v-model="image.location"></v-textarea>
                        </div>
                        <v-spacer></v-spacer>
                        <div class="d-flex align-center">
                            <v-btn color="error" variant="outlined" prepend-icon="mdi-trash-can">Delete</v-btn>
                            <v-spacer></v-spacer>
                            <v-btn flat>Cancel</v-btn>
                            <v-btn flat class="ml-2" color="success">Updte</v-btn>
                        </div>
                    </div>
                </v-col>
            </v-row>
        </v-card>
    </v-dialog>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { onMounted } from 'vue';
const props = defineProps(['image'])
const emits = defineEmits(['update:image'])
</script>

<style lang="scss" scoped>

</style>
