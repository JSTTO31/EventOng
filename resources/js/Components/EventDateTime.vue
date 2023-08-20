<template>
    <div>
        <div class="mb-5">
            <v-switch label="All Day" @change="$event => changeProperties($event, 'all_day')" density="compact" color="blue" hide-details inset></v-switch>
        </div>
        <v-card variant="elevated" color="amber" flat class="pa-5 rounded-xl">
            <v-row>
                <v-col cols="4">
                        <h4 class="font-weight-regular mb-2">Event Start Date</h4>
                        <div class="d-flex">
                            <input @change="$event => changeDateTime($event, 'event_date_start')" :value="date_time.event_date_start" class="bg-white text-center py-2 px-15 rounded-pill" hide-details type="date">
                        </div>
                </v-col>
                <v-col cols="4">
                        <h4 class="font-weight-regular mb-2">Event Time Start</h4>
                        <div class="d-flex">
                            <input  :disabled="date_time.all_day" @change="$event => changeDateTime($event, 'event_time_start')"  :value="date_time.event_time_start" :class="date_time.all_day ? 'bg-grey-lighten-4 text-grey-lighten-1' : 'bg-white'" class=" text-center py-2 px-15 rounded-pill" hide-details type="time">
                        </div>
                </v-col>
            </v-row>
            <v-card class="bg-transparent mt-5" flat :disabled="date_time.hide_end">
                <v-row>
                    <v-col cols="4">
                            <h4 class="font-weight-regular mb-2">Event Date End</h4>
                            <div class="d-flex">
                                <input @change="$event => changeDateTime($event, 'event_date_end')" :value="date_time.event_date_end" class="bg-white text-center py-2 px-15 rounded-pill" hide-details type="date">
                            </div>
                    </v-col>
                    <v-col cols="4">
                            <h4 class="font-weight-regular mb-2">Event Time End</h4>
                            <div class="d-flex">
                                <input  :disabled="date_time.all_day" @change="$event => changeDateTime($event, 'event_time_end')"  :value="date_time.event_time_end"  :class="date_time.all_day ? 'bg-grey-lighten-4 text-grey-lighten-1' : 'bg-white'" class=" text-center py-2 px-15 rounded-pill" hide-details type="time">
                            </div>
                    </v-col>
                </v-row>
            </v-card>
        </v-card>
        <div class="my-5">
            <v-switch @change="$event => changeProperties($event, 'hide_end')" label="Hide End Time from calendar" density="compact" color="blue" hide-details inset class="text-caption"></v-switch>
        </div>
        <div class="my-5">
            <v-switch @change="$event => changeProperties($event, 'month_long')"  label="Month Long Event - Show this event for the entire start event Month" density="compact" color="blue" hide-details inset class="text-caption"></v-switch>
        </div>
        <div class="my-5">
            <v-switch @change="$event => changeProperties($event, 'year_long')"  label="Year Long Event - Show this event for the entire start event Year" density="compact" color="blue" hide-details inset class="text-caption"></v-switch>
        </div>
        <div class="my-5">
            <v-switch @change="$event => changeProperties($event, 'progress_bar')"  label="Hide live event progress bar" density="compact" color="blue" hide-details inset class="text-caption"></v-switch>
        </div>
    </div>
</template>

<script setup lang="ts">
const props = defineProps(['date_time'])
const emits = defineEmits(['update:date_time'])
const changeDateTime = (e, propName) => {
    //@ts-ignore
    const dummyDateTime = Object.assign({}, props.date_time)
    dummyDateTime[propName] = e.target.value
    emits('update:date_time', dummyDateTime)
}
const changeProperties = (e, propName) => {
    //@ts-ignore
    const dummyDateTime = Object.assign({}, props.date_time)
    dummyDateTime[propName] = !dummyDateTime[propName]
    emits('update:date_time', dummyDateTime)
}



</script>

<style scoped>

</style>
