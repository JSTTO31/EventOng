<template>
    <v-card style="overflow: visible;">
        <v-card flat height="80" class="w-100 df-lex align-center justify-center">
            <img :src="url" class="h-100 w-100" />
        </v-card>
        <v-card-title class="text-caption font-weight-medium">{{ image.name }}</v-card-title>
        <!-- <v-spacer></v-spacer>
        <span>{{ image.size }}</span> -->
        <span style="position: absolute;top: -10px;right: -10px">
            <v-btn icon="mdi-close" size="x-small" @click="remove"></v-btn>
        </span>
    </v-card>
</template>

<script setup>
import { ref } from 'vue';
import { onMounted } from 'vue';
const props = defineProps(['image', 'index', 'images'])
const emits = defineEmits(['update:images'])
const url = ref('')
onMounted(() => {
    const reader = new FileReader()
    reader.onload = () => {
        url.value = reader.result;
    }
    reader.readAsDataURL(props.image)
})
const remove = () => {
    let images = props.images;
    images.splice(props.index, 1)
    emits('update:images', images)
}
</script>

<style lang="scss" scoped>

</style>
