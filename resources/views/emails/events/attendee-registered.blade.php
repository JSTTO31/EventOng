@component('mail::message')
{{-- @slot('header')
    @component('mail::header')
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis dicta ipsum voluptatem. Illum, rerum aliquid. Voluptate eius, iusto eveniet repellendus beatae natus nemo quam odio hic, sunt sint excepturi expedita!
    @endcomponent
@endslot --}}

# New Attendee Registration Notification

Hello Admin,

A new attendee has registered for an event on our platform. Here are the details:

- **Event Name:** {{ $event->title }}
- **Event Date:** {{ $event->date_time->event_date_start }}
- **Event Time:** {{ $event->date_time->event_time_start }} to {{ $event->date_time->event_time_end }}
- **Event Location:** {{ $event->location->address }}
- **Event Organizer:** {{ $event->organizer->name }}
- **Attendee Name:** {{ $attendee->name }}
- **Attendee Email:** {{ $attendee->email }}

Please review the details and ensure they are accurate. You might want to reach out to the attendee if necessary and provide any relevant event information.

If you have any questions or need further assistance, feel free to reach out.

Best regards,
Joshua Sotto
IT Support
joshuasotto@example.example

@component('mail::button', ['url' => route('inboxes.index', ['attendee_id' => $attendee->id])])
Message Attendee
@endcomponent

@slot('footer')
    @component('mail::footer')
        &copy; 2023 Inventive Media. All rights reserved.
    @endcomponent
@endslot

@endcomponent
