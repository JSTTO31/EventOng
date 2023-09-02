@component('mail::message')
# Thank You for Registering on {{$event->title}}!

Dear {{ $attendee->name }},

We wanted to extend our heartfelt gratitude for registering for our event. Your participation is greatly appreciated, and we're excited to have you join us!

Event Details:
- Date: {{ $event->date_time->event_date_start }}
- Venue: {{$event->location->name}}

If you have any questions or need further information, please don't hesitate to reach out to us.

Thank you once again for your registration. We're looking forward to a fantastic event!

Best regards,
Your Inventive Media team
@endcomponent
