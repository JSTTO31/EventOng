<template>
    <v-dialog width="450" :model-value="showDialog" @click:outside="emits('update:showDialog', false)">
        <v-card class="pa-5 rounded-lg" :disabled="form.processing">
            <v-form @submit.prevent="submit">
                <h3 class="mb-5">
                    <v-icon>mdi-folder-plus</v-icon>
                    Create folder</h3>
                <v-text-field v-model="form.name" :error-messages="form.errors.name"  label="Folder name" variant="outlined" single-line></v-text-field>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn type="submit" color="blue-darken-2" variant="elevated" flat :loading="form.processing" >Create</v-btn>
                </v-card-actions>
            </v-form>
        </v-card>
    </v-dialog>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
const props = defineProps(['showDialog', 'folder'])
const emits = defineEmits(['update:showDialog'])
const form = useForm({
    name: '',
    folder_id: props.folder ? props.folder.id : null
})
const submit = () => {
    form.post(route('folders.store'), {
        onSuccess: () => {
            form.reset()
            emits('update:showDialog', false)
        }
    })
}
</script>

<style lang="scss" scoped>

</style>
