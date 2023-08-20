import { useForm } from "@inertiajs/vue3"
import { ref } from "vue"

function convertTwoDigits(number){
    return number.toLocaleString('en-US', {minimumIntegerDigits: 2, 'useGrouping' : false})
}

export default () => {
    const now = new Date()
    const date = `${now.getFullYear()}-${convertTwoDigits(now.getDate())}-${convertTwoDigits(now.getMonth())}`
    const time = `${convertTwoDigits(now.getHours())}:${convertTwoDigits(now.getMinutes())}`
    const form = useForm({
        title: '',
        subtitle: '',
        status: 'scheduled',
        mode: 'physical',
        date_time: {
            event_date_start: route().params.event_date_start || date,
            event_date_end: route().params.event_date_start || date,
            event_time_start: time,
            event_time_end: time,
            hide_end: false,
            month_long: false,
            year_long: false,
            progress_bar: false,
            all_day: false
        },
        health_guideline: {
            enable: false,
            face_mask: false,
            temperature: false,
            physical_distance: false,
            sanitize_before_event: false,
            held_outside: false,
            vaccination: false,
            other: '',
        },
        location_id: null,
        organizer_id: null,
        link: ''
    })

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

    const submit = () => {
        form.post(route('event.store'))
    }

    const flat = ref(true)

    window.addEventListener('scroll', () => {
        if(scrollY > 0){
            flat.value = false
        }else{
            flat.value = true
        }
    })



    return {status, mode, flat, form, submit}
}
