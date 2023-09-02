import { computed } from "vue"
import { getMonth } from "./useUtilities"


export default (event) => {
    const mode = computed(() => {
        return {
            label: event.mode == 'physical' ? 'Physical Class' : event.mode == 'online' ? 'Online Class' : 'Physical and Online Class',
            color: event.mode == 'physical' ? 'red' : event.mode == 'online' ? 'green' : 'blue'
        }
    })

    const calendar = computed(() => {
        const start_date = new Date(event.date_time.event_date_start)
        const end_date = new Date(event.date_time.event_date_end)
        console.log(event.date_time.event_date_start);

        const month = getMonth(start_date.getMonth())

        return  month + ' ' + start_date.getDate()  + ', 2023' + ' | 4 Days'
    })

    const time = computed(() => {

        const start_date = new Date(event.date_time.event_date_start)
        const end_date = new Date(event.date_time.event_date_end)
        const month = getMonth(start_date.getMonth())

        return  '7 AM to 9 PM'
    })

    const description = computed(() => {
        return event.subtitle.length > 200 ? event.subtitle.substring(0, 200) + '...' : event.subtitle
    })

    return {mode, calendar, time, description};
}
