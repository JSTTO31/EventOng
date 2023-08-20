<template>
    <AuthenticatedLayoutVue title="Events" icon="mdi-calendar">
       <EventAppBar :flat="flat" v-if="selected" :event="selected" :scrolledUp="scrolledUp"></EventAppBar>
        <!-- <v-navigation-drawer width="350" floating v-if="selected">
            <div class="d-flex flex-column">
                <v-img src="https://images.pexels.com/photos/4498362/pexels-photo-4498362.jpeg?cs=srgb&dl=pexels-karolina-grabowska-4498362.jpg&fm=jpg"></v-img>

                <div class="pa-5">
                    <h3 class="d-flex text-blue-grey-darken-3 mb-2">{{ selected.title }}
                    <v-btn size="x-small" variant="plain"  icon="mdi-pencil" flat></v-btn>
                    </h3>

                    <div class="mb-5">
                        <h4 class="mb-1 font-weight-normal text-grey-darken-4">Time remaining</h4>
                        <VProgressLinear :model-value="50" height="20"></VProgressLinear>
                    </div>
                    <div class="mb-5">
                        <h4 class="mb-1 font-weight-normal text-grey-darken-4">Progress</h4>
                        <VProgressLinear :model-value="50" height="20"></VProgressLinear>
                    </div>
                    <div class="d-flex align-center justify-center pt-2">
                        <v-btn prepend-icon="mdi-plus" color="success" class="mt-5 mx-auto rounded-0">Invite attendee</v-btn>
                    </div>
                </div>
            </div>
        </v-navigation-drawer> -->
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
