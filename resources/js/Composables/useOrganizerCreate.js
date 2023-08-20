import { useForm } from "@inertiajs/vue3"
import { ref } from "vue"



export default () => {
    const showCreateOrganizerDialog = ref(false)
    const form = useForm({
        name: 'Practical Skills Training',
        description: 'SkillsHub Training Center specializes in providing hands-on training in various industries. Our state-of-the-art facility is designed to offer practical learning experiences that prepare participants for real-world challenges.',
        general_contact_details: '+1 (555) 123-4567',
        email_address: 'info@skillshubtraining.com',
        physical_address: '123 Learning Avenue, Suite 456, San Francisco, California, United States',
        twitter_link: 'https://twitter.com/organizer_handle',
        instagram_link: 'https://www.instagram.com/organizer_username',
        youtube_link: 'https://www.youtube.com/c/OrganizerChannel',
        whats_app_link: 'https://wa.me/1234567890',
        tiktok_link: 'https://www.tiktok.com/@organizer_account',
        facebook_link: 'https://www.facebook.com/organizer.page',
        linkedin_link: 'https://www.linkedin.com/in/organizer-profile',
        organizer_link: 'https://www.organizerwebsite.com',
        open_new_tab: false,
        image: '',
    })

    const submit = () => {
        form
        .transform((data) => ({
            ...data, image: data.image ? data.image[0] : ''
        }))
        .post(route('organizers.store'), {
            onSuccess: () => {
                form.reset()
                showCreateOrganizerDialog.value = false
            }
        })
    }

    return {
        form, submit, showCreateOrganizerDialog
    }
}
