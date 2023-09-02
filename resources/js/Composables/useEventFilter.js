import { useForm } from "@inertiajs/vue3"


export default () => {
    const status = [
        {
            label: 'scheduled',
            value: 'scheduled'
        },
        {
            label: 'cancelled',
            value: 'cancelled'
        },
        {
            label: 'moved online',
            value: 'moved'
        },
        {
            label: 'postponed',
            value: 'postponed'
        },
        {
            label: 'rescheduled',
            value: 'rescheduled'
        }
    ]

    const mode= [
        {
            value: 'physical',
            label: 'Physical Event',
        },
        {
            value: 'online',
            label: 'Online Event',
        },
        {
            value: 'both',
            label: 'Online and Physical Event',
        }
    ]

    const form = useForm({
        search: '',
        range: [],
        mode: [],
        status: []
    })

    const submit = () => {
        form.get(route('events.index'))
    }

    return {mode, status, form, submit}
}
