<template>
    <v-dialog width="650" :model-value="showDialog" @click:outside="emits('update:showDialog', false)">
        <v-card class="pa-5 rounded-lg" height="500" :disabled="form.processing">
            <h3 class="d-flex align-center">
                <v-icon  class="mr-2">mdi-upload</v-icon>
                Upload
            </h3>
            <v-divider class="my-2"></v-divider>
            <input id="file" @change="imageSelect" type="file" ref="files" multiple hidden accept=".png,.jpg,.jpeg">
            <div flat v-if="images.length > 0" style="overflow-y: auto;overflow-x: hidden;" class="h-100 d-flex flex-column">
                <div class="d-flex flex-wrap">
                    <v-col class="pa-2" cols="3" v-for="image, index in images">
                        <UploadImageList :index="index" :key="image.name + index" v-model:images="images" :image="image"></UploadImageList>
                    </v-col>
                    <v-col class="pa-2" cols="3" >
                        <v-card height="125" @click="files.click()" flat style="border: 2px dashed #1765ec" class="d-flex align-center justify-center">
                            <v-icon color="#1765ec">mdi-plus</v-icon>
                        </v-card>
                    </v-col>
                </div>
            </div>
            <div v-else class="d-flex align-center justify-center w-100 h-100">
                <v-btn color="blue-darken-2" flat @click="files.click()">Browse images</v-btn>
            </div>
            <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn variant="elevated" color="blue-darken-2" @click="submit">Upload</v-btn>
                    <v-btn variant="elevated" flat @click="emits('update:showDialog', false)">Cancel</v-btn>
                </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script setup>
import UploadImageList from './UploadImageList.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
const props = defineProps(['showDialog', 'folder'])
const emits = defineEmits(['update:showDialog'])
const files = ref()
const form = useForm({})
const images = ref([])
const imageSelect = (e) => {
    const files = e.target.files;
    images.value.push(...files)
    document.getElementById('file').value = null
}
const submit = () => {
    form
    .transform((data) => ({images: images.value, folder_id: props.folder ? props.folder.id : null}))
    .post(route('images.store'), {
        forceFormData: true,
        onSuccess: () => {
            emits('update:showDialog', false)
            form.reset()
        }
    })
}
</script>

<style lang="scss" scoped>

</style>
