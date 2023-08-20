<template>
    <div class="w-100">
        <v-card flat color="grey-lighten-3 pa-2 d-flex rounded-0 border-b align-center" @click="show = !show" class="rounded-0">
            <slot name='header'></slot>
            <v-spacer></v-spacer>
            <v-icon v-if="show">mdi-chevron-down</v-icon>
            <v-icon v-else>mdi-chevron-up</v-icon>
        </v-card>
        <div v-if="show" class="pa-5">
            <slot></slot>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
const show = ref(true)
</script>

<style scoped>

</style>
