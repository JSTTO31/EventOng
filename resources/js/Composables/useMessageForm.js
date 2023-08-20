import { useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";



export default () => {
    const showMessageDialog = ref(false)
    const form = useForm({message: "", subject: ''})
    const submit = (attendee_id) => {
        form.post(route('inboxes.send-message', {
            attendee: attendee_id
        }), {onSuccess: () => {
            showMessageDialog.value = false
            form.reset()
        }})
    }


    watch(() => showMessageDialog.value, () => {
        form.reset()
    })

    return {form, submit, showMessageDialog}
}
