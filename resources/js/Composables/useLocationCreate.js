import { useForm } from "@inertiajs/vue3"
import { ref } from "vue"


export default () => {
    const form = useForm({
        'name': '',
        'description': '',
        'address': '',
        'city': '',
        'state': '',
        'country': '',
        'link': '',
        'image': null,
        'open_new_tab': false,
    })

    const showLocationCreateDialog = ref(false)

    const submit = () => {
        form
        .transform((data) => ({
            ...data, image: data.image ? data.image[0] : null
        }))
        .post(route('locations.store'), {
           onSuccess: () => {
            showLocationCreateDialog.value = false
            form.reset()
           },
        })

    }


    return {form, submit, showLocationCreateDialog}


}
