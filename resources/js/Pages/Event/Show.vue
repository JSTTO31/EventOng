<template>
    <AuthenticatedLayoutVue title="Events" icon="mdi-calendar">
       <EventAppBar :flat="flat" v-if="selected" :event="selected" :scrolledUp="scrolledUp"></EventAppBar>
        <div :class="scrolledUp ? 'pt-10' : 'pt-15'" v-if="selected">
            <EventBoxVue :event="selected"></EventBoxVue>
        </div>
        <div v-else class="w-100 h-100 d-flex align-center justify-center">
            <h3 class="font-weight-regular">
                <v-icon class="mr-2">mdi-selection-off</v-icon>
                No Selected Event
            </h3>
        </div>
    </AuthenticatedLayoutVue>
</template>

<script setup>
import EventAppBar from '@/Components/EventAppBar.vue';
import EventBoxVue from '@/Components/EventBox.vue';
import AuthenticatedLayoutVue from '@/Layouts/AuthenticatedLayout.vue';
import { router } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { computed } from 'vue';
import { ref } from 'vue';
const props = defineProps(['event'])
const selected = ref(props.event || null)

const prevScroll = ref(window.scrollY)
const currentScroll = ref(window.scrollY)
const scrolledUp = ref(true)
const flat = ref(true)

window.addEventListener('scroll', function(){
    prevScroll.value = currentScroll.value
    currentScroll.value = window.scrollY


    if(prevScroll.value < currentScroll.value && scrollY > 200){
        scrolledUp.value = false
    }else{
        scrolledUp.value = true
    }

    if(scrollY > 0){
        flat.value = false
    }else{
        flat.value = true
        scrolledUp.value = true
    }


})


onMounted(() => {
    if(props.events && !props.event){
        router.visit(route('events.index', {
            event: props.events[0].id
        }))
    }
})
</script>

<style scoped>
body::-webkit-scrollbar{
    width: 0px;
}
</style>
