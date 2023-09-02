<template>
    <v-hover v-slot="{props, isHovering}" >
        <v-card flat class="rounded-0 d-flex border-b py-2" v-bind="props" >
            <v-col cols="3" class="py-0 d-flex align-center">
                <span>
                    <v-checkbox :model-value="isSelected" @click="select"  hide-details density="compact"></v-checkbox>
                </span>
                <div class="d-flex ml-4 w-100">
                    <v-avatar size="80" class="bg-blue-lighten-4 rounded-lg"></v-avatar>
                    <span  :class="isHovering ? 'text-decoration-underline' : ''" class=" font-weight-bold ml-3 text-blue-darken-3" style="cursor: pointer;">
                        <span @click="$inertia.visit($route('events.show', {event: event.id}))">{{ event.title }}</span>
                        <br>
                        <span v-if="isHovering" class="text-caption font-weight-regular">
                            <Link as="button" class="text-blue text-decoration-underline" :href="$route('events.edit', {event: event.id})">Edit</Link>
                            <span class="mx-2">|</span>
                            <Link :href="$route('events.destroy', {event: event.id})" method="delete" as="button" class="text-red text-decoration-underline">Remove</Link>
                        </span>
                    </span>
                </div>
            </v-col>
            <v-col cols="2" class="py-0 d-flex align-center">
                <span class="ml-4 text-caption font-weight-regular">{{ event.location ? event.location.name : 'NULL' }}</span>
            </v-col>
            <v-col cols="2" class="py-0 d-flex align-center">
                <span class="ml-4 text-caption font-weight-regular">{{ event.organizer ? event.organizer.name : 'NULL' }}</span>
            </v-col>
            <v-col cols="2" class="py-0 d-flex align-center">
                <span class="ml-4 text-caption font-weight-regular">{{ calendar }}</span>
            </v-col>
            <v-col cols="2" class="py-0 d-flex align-center">
                <v-chip size="small" :color="mode.color" class="rounded-lg" variant="elevated" flat>{{ mode.label }}</v-chip>
            </v-col>
            <v-col cols="1" class="py-0 d-flex align-center">
                <v-chip size="small" class="rounded-lg" variant="elevated" flat>{{ event.status }}</v-chip>
            </v-col>
        </v-card>
    </v-hover>
</template>

<script setup>
import useEvent from '@/Composables/useEvent';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';
const props = defineProps(['event', 'selected'])
const emits = defineEmits(['update:selected'])
const {mode, time, calendar, description} = useEvent(props.event);
const isSelected = computed(() => props.selected.some(item => item == props.event.id))
const select = () => {
    if(!isSelected.value){
        let selected = props.selected.slice()
        selected.push(props.event.id)
        emits('update:selected', selected)
    }else{
        let selected = props.selected.slice().filter(item => item != props.event.id)
        emits('update:selected', selected)
    }
}
</script>

<style lang="scss" scoped>

</style>
