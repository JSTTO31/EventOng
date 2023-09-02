<template>
    <AuthenticatedLayout title="Image Library" icon="mdi-image-multiple">
       <v-card class=" h-100 d-flex flex-column">
            <div class="d-flex bg-grey-lighten-4 align-center" style="z-index: 200;">
                <v-breadcrumbs :items="breadcrumbs.items">
                    <template #divider>
                        <v-icon>mdi-chevron-right</v-icon>
                    </template>
                </v-breadcrumbs>
                <v-spacer></v-spacer>
            </div>
            <v-card flat class="d-flex align-end pa-5" style="z-index: 200;">
                <v-btn class="rounded-0" flat icon="mdi-grid-large" color="black"></v-btn>
                <v-btn class="rounded-0" flat icon="mdi-menu"></v-btn>
                <v-spacer></v-spacer>
                <v-btn class="text-capitalize ml-2" flat prepend-icon="mdi-upload" @click="showUploadDialog = true">Upload</v-btn>
                <v-btn class="text-capitalize ml-2" flat prepend-icon="mdi-folder-plus" @click="showCreateFolderDialog = true">New folder</v-btn>
            </v-card>
            <v-container fluid class="pt-0 px-5" style="overflow: auto;">
                <v-row>
                    <v-col cols="2" v-for="folder in folders">
                       <v-card @click="$inertia.visit($route('image-libraries.index', {folder: folder.id}))" flat class="rounded-lg border pt-0">
                            <v-card height="150" flat class="bg-grey-lighten-4 pt-0 w-100 d-flex align-center justify-center">
                                <v-icon size="120" color="blue">mdi-folder</v-icon>
                            </v-card>
                            <v-card-title class="text-caption">{{ folder.name }}</v-card-title>
                       </v-card>
                    </v-col>
                    <v-col cols="2" v-for="image in images" :key="image.id">
                       <v-card @click="selectedImage = image" flat class="rounded-lg border pt-0">
                            <v-card height="150" flat class="pt-0 rounded-0 w-100 d-flex align-center justify-center">
                                <img class="h-100 w-100" :src="image.location" />
                            </v-card>
                            <v-card-title class="text-caption">{{ image.name }}</v-card-title>
                       </v-card>
                    </v-col>
                </v-row>
            </v-container>
            <div v-if="folders.length < 1 && images.length < 1" style="position: absolute;z-index: 100;" class="w-100 h-100 d-flex align-center justify-center">
                    <h3>No files</h3>
            </div>
            <v-spacer></v-spacer>
       </v-card>
       <AddFolderDialog v-model:show-dialog="showCreateFolderDialog" :folder="folder"></AddFolderDialog>
       <UploadDialog v-model:show-dialog="showUploadDialog" :folder="folder"></UploadDialog>
       <ImageDialog :key="selectedImage" v-model:image="selectedImage"></ImageDialog>
    </AuthenticatedLayout>
</template>

<script setup>
import ImageDialog from '@/Components/ImageDialog.vue'
import UploadDialog from '@/Components/UploadDialog.vue'
import AddFolderDialog from '@/Components/AddFolderDialog.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { computed } from 'vue';
import { ref } from 'vue';
const props = defineProps(['folders', 'folder', 'images'])
const selectedImage = ref(null)
const showUploadDialog = ref(false)
const showCreateFolderDialog = ref(false)
const breadcrumbs = computed(() => {
    let items = [
    ]

    if(Object.keys(props.folder).length > 0){
        let folder = props.folder
        items.unshift({
            title: folder.name,
            href: route('image-libraries.index', {folder: folder.id})
        })


        while(folder.folder_id){
            folder = folder.folder
            console.log(folder);
            items.unshift({
                title: folder.name,
                href: route('image-libraries.index', {folder: folder.id})
            })

        }

        items.unshift({
            title: 'Home',
            href: route('image-libraries.index'),
        })
    }

    return {
        items
    }
})
</script>

<style lang="scss" scoped>

</style>
