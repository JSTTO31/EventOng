<?php

namespace App\Notifications;

use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AttendeeRegisteredNotification extends Notification
{
    use Queueable;
    public $attendee;
    public $event;

    public function __construct(Event $event, Attendee $attendee)
    {
        $this->event = $event;
        $this->attendee = $attendee;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'subject' => 'New Attendee Registration',
            'message' => "A new attendee has registered for the {$this->event->title} event.\nAttendee Name: {$this->attendee->name}",
            'url' => url('/attendees/' . $notifiable->id),
            'event' => $this->event,
            'attendee' => $this->attendee,
        ];
    }
}
