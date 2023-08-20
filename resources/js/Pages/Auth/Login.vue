<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <v-card class="mx-auto pa-5 rounded-lg" :disabled="form.processing" width="520">
            <h2 class="mb-5">Login Now</h2>
            <v-form @submit.prevent="submit">
                <v-text-field v-model="form.email" class="mb-2" label="email" :error-messages="form.errors.email" prepend-inner-icon="mdi-mail"></v-text-field>
                <v-text-field type="password" v-model="form.password" class="mb-2" label="password" :error-messages="form.errors.password" prepend-inner-icon="mdi-lock"></v-text-field>
                <v-btn type="submit" block class="mt-5" color="primary" :loading="form.processing">Login</v-btn>
            </v-form>
        </v-card>
    </GuestLayout>
</template>
