@component('mail::message')
# Verify Your Attendance for {{ $event_attendee->event->title }}

Thank you for registering for our event "{{ $event_attendee->event->title }}" happening on {{ $event_attendee->event->date_time->event_date_start  }}. To complete your registration and confirm your attendance, please click the button below to verify your email address:

@component('mail::button', ['url' => $link])
Verify Email Address
@endcomponent

If you did not sign up for this event, you can safely ignore this email.

We're excited to have you join us!

Sincerely,
The Inventive media team
@endcomponent
