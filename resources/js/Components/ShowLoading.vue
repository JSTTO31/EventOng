<template>
    <v-dialog :model-value="showDialog" width="250" persistent>
        <v-card height="120" class="d-flex align-center justify-center pa-5 flex-column">
            <span class="mb-2 text-capitalize text-caption rounded-lg">Processing</span>
            <VProgressLinear indeterminate color="primary"></VProgressLinear>
        </v-card>
    </v-dialog>
</template>

<script setup>
defineProps(['showDialog'])
</script>

<style lang="scss" scoped>

</style>
