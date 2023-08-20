<template>
    <v-hover v-slot="{isHovering, props}">
        <v-card v-bind="props">
            <v-card height="200" class="w-100 rounded-0" flat>
                <img class="w-100" style="transition: .2s ease" :style="isHovering ? 'transform: scale(1.1)' : ''" src="https://images.pexels.com/photos/4498362/pexels-photo-4498362.jpeg?cs=srgb&dl=pexels-karolina-grabowska-4498362.jpg&fm=jpg"/>
            </v-card>
            <v-card-text>
                <h1 style="line-height: 1.2;font-family: serif;" class="font-weight-regular text-blue-grey-darken-3">{{ event.title }}</h1>
                <div class="d-flex align-center">
                    <div class="mt-2 text-grey-darken-1">
                    <v-icon>mdi-calendar</v-icon>
                    {{ calendar }}
                </div>
                <div class="mt-2 ml-2 text-grey-darken-1">
                    <v-icon>mdi-clock</v-icon>
                    {{ time }}
                </div>
                </div>
                <p class="text-capitalize text-grey-darken-1 mt-5">{{ description }}</p>
                <v-divider></v-divider>
                <v-card-actions class="px-0">
                    <v-btn @click="$inertia.get($route('guest.events.show', {event: event.id}))" variant="elevated" color="grey-lighten-2" flat>learn more</v-btn>
                </v-card-actions>
            </v-card-text>
            <span class="pa-2" style="position: absolute;top: 0;left: 0">
                <v-chip variant="elevated" class="rounded-lg" :color="mode.color">{{ mode.label }}</v-chip>
            </span>

        </v-card>
    </v-hover>
</template>

<script setup>
import useEvent from '@/Composables/useEvent';

const props = defineProps(['event'])
const {mode, time, calendar, description} = useEvent(props.event);

</script>

<style lang="scss" scoped>

</style>
