import { useForm } from "@inertiajs/vue3"
import { ref } from "vue"

function convertTwoDigits(number){
    return number.toLocaleString('en-US', {minimumIntegerDigits: 2, 'useGrouping' : false})
}

export default (event) => {
    const now = new Date()
    const date = `${now.getFullYear()}-${convertTwoDigits(now.getDate())}-${convertTwoDigits(now.getMonth())}`
    const time = `${convertTwoDigits(now.getHours())}:${convertTwoDigits(now.getMinutes())}`

    const form = useForm(Object.assign({}, event))

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
        form.put(route('events.update', {event: event.id}))
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
