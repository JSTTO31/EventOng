import { useForm } from "@inertiajs/vue3"



export default (event_id) => {
    const form = useForm({
        name: 'Joshua Sotto',
        mobile: '0982312345',
        address: "malabon city",
        email: 'joshua@example.example'
    })


    const submit = () => {
        form.post(route('events.event_attendee.store', {event: event_id}), {
            onSuccess: () => {

            }
        })
    }

    return {submit, form}
}
