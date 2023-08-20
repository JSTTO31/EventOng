<template>
    <div>
        <v-switch label="Enable health guidelines for this event" @change="changeProperties('enable')" density="compact" :model-value="health_guideline.enable" color="blue" hide-details inset class="text-caption"></v-switch>
        <v-card class="bg-grey-lighten-4 pa-3 mt-3 rounded-lg" flat v-show="health_guideline.enable">
            <div class="w-25">
                <v-switch label="Face mask required." @change="changeProperties('face_mask')" density="compact" :model-value="health_guideline.face_mask" color="blue" hide-details inset class="w-auto mb-5 text-caption"></v-switch>
            </div>
            <div class="w-25">
                <v-switch label="Temperature will be checked at entrance." @change="changeProperties('temperature')" density="compact" :model-value="health_guideline.temperature" color="blue" hide-details inset class="w-auto mb-5 text-caption"></v-switch>
            </div>
            <div class="w-25">
                <v-switch label="Physical distance maintained event" @change="changeProperties('physical_distance')" density="compact" :model-value="health_guideline.physical_distance" color="blue" hide-details inset class="w-auto mb-5 text-caption"></v-switch>
            </div>
            <div class="w-25">
                <v-switch label="Event area sanitized before event" @change="changeProperties('sanitize_before_event')" density="compact" :model-value="health_guideline.sanitize_before_event" color="blue" hide-details inset class="w-auto mb-5 text-caption"></v-switch>
            </div>
            <div class="w-25">
                <v-switch label="Event is held outside" @change="changeProperties('held_outside')" density="compact" :model-value="health_guideline.held_outside" color="blue" hide-details inset class="w-auto mb-5 text-caption"></v-switch>
            </div>
            <div class="w-25">
                <v-switch label="Vaccination Required" @change="changeProperties('vaccination')" density="compact" :model-value="health_guideline.vaccination" color="blue" hide-details inset class="w-auto mb-5 text-caption"></v-switch>
            </div>
            <div class="d-flex">
                <v-col>
                    Other additional health guidelines
                </v-col>
                <v-col>
                    <v-textarea @change="$event => emits('update:health_guideline', { ...health_guideline, other: $event.target.value})" variant="solo-inverted" density="compact" single-line hide-details rows="1" auto-grow></v-textarea>
                </v-col>
            </div>
        </v-card>
    </div>
</template>

<script setup>
const emits = defineEmits(['update:health_guideline'])
const props = defineProps(['health_guideline'])
const changeProperties = (propName) => {
    //@ts-ignore
    const dummyDateTime = Object.assign({}, props.health_guideline)
    dummyDateTime[propName] = !dummyDateTime[propName]
    emits('update:health_guideline', dummyDateTime)
}

</script>

<style lang="scss" scoped>

</style>
