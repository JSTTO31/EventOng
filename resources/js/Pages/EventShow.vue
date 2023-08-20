<template>
    <v-app>
        <v-app-bar class="px-5 border-b" flat>
            <h2 @click="$inertia.get(route('welcome'))">Logo name</h2>
            <v-spacer></v-spacer>
            <span>Menu</span>
        </v-app-bar>
        <v-main>
            <v-container fluid class="px-5">
                <v-row>
                    <v-col cols="8" class="pb-15">
                        <v-card flat height="550" class="d-flex align-center justify-center">
                            <img class="w-100"
                                src="https://images.pexels.com/photos/4498362/pexels-photo-4498362.jpeg?cs=srgb&dl=pexels-karolina-grabowska-4498362.jpg&fm=jpg" />
                        </v-card>
                        <v-chip :color="mode.color" variant="elevated" flat size="large" class="rounded-lg mt-5">{{
                            mode.label }}</v-chip>
                        <h1 style="line-height: 1.2;font-family: serif !important;"
                            class="font-weight-medium text-blue-grey-darken-3 text-h2">{{ event.title }}</h1>
                        <p class="text-capitalize text-subtitle-1 text-grey-darken-1 mt-3">{{ event.subtitle }}</p>
                        <v-container fluid class="px-0">
                            <v-row class="py-5">
                                <v-col cols="6">
                                    <v-card class="h-100 text-grey-darken-1 d-flex bg-grey-lighten-4 rounded-xl pa-5" flat>
                                        <div class="w-20 px-2">
                                            <v-icon size="35">mdi-calendar</v-icon>
                                        </div>
                                        <div>
                                            <h2 class="font-weight-black text-hoverable mr-2">
                                                DATE
                                            </h2>
                                            <p>
                                                September, 2023 <br>
                                                5 (Wednesday) to 6 (thursday)
                                            </p>
                                            <div class="d-flex">
                                                <h4 class="font-weight-black text-hoverable mr-2">
                                                    <v-icon>mdi-link</v-icon>
                                                    CALENDAR
                                                </h4>

                                                <h4 class="font-weight-black text-hoverable mr-2">
                                                    <v-icon>mdi-link</v-icon>
                                                    GOOGLECAL
                                                </h4>
                                            </div>
                                        </div>
                                    </v-card>
                                </v-col>
                                <v-col cols="6">
                                    <v-card class="h-100 text-grey-darken-1 d-flex bg-grey-lighten-4 rounded-xl pa-5" flat>
                                        <div class="w-20 px-2">
                                            <v-icon size="35">mdi-clock</v-icon>
                                        </div>
                                        <div>
                                            <h2 class="text-uppercase">
                                                Time
                                            </h2>
                                            <h4 class="font-weight-regular mt-2">
                                                4 (Friday) 9:00 am - 6 (Sunday) 7:00 pm
                                            </h4>
                                        </div>
                                    </v-card>
                                </v-col>
                                <v-col cols="6">
                                    <v-card class="h-100 text-grey-darken-1 d-flex bg-grey-lighten-4 rounded-xl pa-5" flat>
                                        <div class="w-20 px-2">
                                            <v-icon size="35">mdi-map-marker</v-icon>
                                        </div>
                                        <div>
                                            <h2 class="text-uppercase">
                                                Location
                                            </h2>
                                            <h4 class="font-weight-regular mt-2">
                                                <h4 class="font-weight-regular">{{ event.location.name }}</h4>
                                                <p>{{ event.location.address }}</p>
                                            </h4>
                                        </div>
                                    </v-card>
                                </v-col>
                                <v-col cols="6">
                                    <v-card class="h-100 text-grey-darken-1 d-flex bg-grey-lighten-4 rounded-xl pa-5" flat>
                                        <div class="w-20 px-2">
                                            <v-icon size="35">mdi-headphones</v-icon>
                                        </div>
                                        <div>
                                            <h2 class="text-uppercase">
                                                ORGANIZER
                                            </h2>
                                            <h4 class="font-weight-regular mt-2">
                                                <h4 class="font-weight-regular">{{ event.organizer.name }}</h4>
                                                <p>{{ event.organizer.general_contact_details }}</p>
                                                <p>{{ event.organizer.physical_address }}</p>
                                            </h4>
                                            <v-btn rounded color="blue" size="small" class="mt-3" flat>Learn more</v-btn>
                                        </div>
                                    </v-card>
                                </v-col>
                                <v-col>
                                    <v-card class="h-100 text-grey-darken-1 d-flex bg-grey-lighten-4 rounded-xl pa-5" flat>
                                        <div class="w-20 px-2">
                                            <v-icon size="35">mdi-heart-pulse</v-icon>
                                        </div>
                                        <div>
                                            <h2 class="text-uppercase">
                                                HEALTH GUIDLINES
                                            </h2>
                                            <div class="d-flex flex-wrap mt-3">
                                                <v-card flat
                                                    class="d-flex rounded-xl text-capitalize mr-2 mb-2 pa-5 bg-grey-lighten-3 text-grey-darken-1 align-center">
                                                    <v-icon size="40">mdi-face-mask</v-icon>
                                                    <h3 class="font-weight-regular ml-5">Face mask is required</h3>
                                                </v-card>
                                                <v-card flat
                                                    class="d-flex rounded-xl text-capitalize mr-2 mb-2 pa-5 bg-grey-lighten-3 text-grey-darken-1 align-center">
                                                    <v-icon size="40">mdi-thermometer</v-icon>
                                                    <h3 class="font-weight-regular ml-5">Temperature checked at entrance
                                                    </h3>
                                                </v-card>
                                                <v-card flat
                                                    class="d-flex rounded-xl text-capitalize mr-2 mb-2 pa-5 bg-grey-lighten-3 text-grey-darken-1 align-center">
                                                    <v-icon size="40">mdi-account-multiple-check</v-icon>
                                                    <h3 class="font-weight-regular ml-5">Physical Distance Maintained</h3>
                                                </v-card>
                                                <v-card flat
                                                    class="d-flex rounded-xl text-capitalize mr-2 mb-2 pa-5 bg-grey-lighten-3 text-grey-darken-1 align-center">
                                                    <v-icon size="40">mdi-home-plus</v-icon>
                                                    <h3 class="font-weight-regular ml-5">Event area santized</h3>
                                                </v-card>
                                                <v-card flat
                                                    class="d-flex rounded-xl text-capitalize mr-2 mb-2 pa-5 bg-grey-lighten-3 text-grey-darken-1 align-center">
                                                    <v-icon size="40">mdi-needle</v-icon>
                                                    <h3 class="font-weight-regular ml-5">Vaccination required</h3>
                                                </v-card>
                                            </div>
                                        </div>
                                    </v-card>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-col>
                    <v-col cols="4">
                        <v-form :disabled="form.processing" style="position: fixed;width: 480px;" @submit.prevent="submit">
                            <h1 class="mb-5">
                                <v-icon>mdi-square-edit-outline</v-icon>
                                Registration
                            </h1>
                            <v-text-field class="mb-2" v-model="form.name" :error-messages="form.errors.name" type="text" label="Full name" variant="outlined" rounded="0" single-line
                                density="comfortable"></v-text-field>
                            <v-text-field class="mb-2" v-model="form.mobile" :error-messages="form.errors.mobile" type="number" maxLength="5" label="Mobile" variant="outlined" rounded="0" single-line
                                density="comfortable">
                            <template #prepend-inner>
                                +63
                            </template>
                            </v-text-field>
                            <v-text-field class="mb-2" v-model="form.email" :error-messages="form.errors.email" type="email" label="Email Address" hint="Make sure your email is correct."
                                variant="outlined" rounded="0" single-line density="comfortable"></v-text-field>
                            <v-textarea class="mb-2" v-model="form.address" :error-messages="form.errors.address" label="Address" variant="outlined" rounded="0" single-line
                                density="comfortable"></v-textarea>
                            <v-btn :disabled="form.processing" :loading="form.processing" type="submit" class="rounded-0" size="large" color="grey-darken-2"
                                append-icon="mdi-send">Register</v-btn>
                        </v-form>
                    </v-col>
                </v-row>
            </v-container>
            <v-dialog width="550" @click:outside="$page.props.flash.random = null" :model-value="$page.props.flash.random && !$page.props.flash.random.already_registered">
                <v-card class="pa-5 py-15 rounded-xl">
                    <div v-if="$page.props.flash.random && !$page.props.flash.random.alumni" class="d-flex flex-column">
                        <v-avatar size="190" class="mx-auto">
                             <v-img :src="picture_welcome"></v-img>
                        </v-avatar>
                        <h1 class="text-center mt-5">Welcome to our training</h1>
                        <p class="text-center px-10">You have successfully register, please wait we are sending you an email</p>
                    </div>
                    <div class="d-flex flex-column" v-else>
                        <v-avatar size="190" class="mx-auto">
                             <v-img :src="picture_welcome_back"></v-img>
                        </v-avatar>
                        <h1 class="text-center mt-5">Welcome back Alumni!</h1>
                        <p class="text-center px-10">You have successfully register</p>

                    </div>
                    <span class="pa-5" style="position: absolute;top: 0;right: 0">
                        <v-btn icon="mdi-close" @click="$page.props.flash.random = null"></v-btn>
                    </span>
                </v-card>
            </v-dialog>
            <v-dialog width="550" :model-value="$page.props.flash.random && $page.props.flash.random.already_registered" @click:outside="$page.props.flash.random = null">
                <v-card class="pa-5 py-15 rounded-xl">
                    <v-icon size="190" class="mx-auto" color="red">
                        mdi-close-circle-outline
                    </v-icon>
                    <h1 class="text-center mt-5">Invalid Request!</h1>
                    <p class="text-center px-10">It's seems you already registered on this event, please check your email carefully.</p>
                    <span class="pa-5" style="position: absolute;top: 0;right: 0">
                        <v-btn icon="mdi-close" @click="$page.props.flash.random = null"></v-btn>
                    </span>
                </v-card>
            </v-dialog>
        </v-main>
        <v-footer class="bg-blue-grey-darken-3 text-center">
            <v-container fluid>
                <p class="text-center">
                <p>&copy; 2023 Inventive Media. All rights reserved.</p>

                </p>
            </v-container>
        </v-footer>
    </v-app>
</template>

<script setup>
import { computed } from 'vue';
import useEventRegister from '@/Composables/useEventRegister'
import { usePage } from '@inertiajs/vue3';
import useEvent from '@/Composables/useEvent';
const props = defineProps(['event', 'picture_welcome', 'picture_welcome_back'])
const {form, submit} = useEventRegister(props.event.id)
const $page = usePage()
const {mode} = useEvent(props.event)
</script>

<style  scoped>.text-hoverable {
    cursor: pointer;
    transition: .2s linear;
}

.text-hoverable:hover {
    color: #575757;
}</style>
