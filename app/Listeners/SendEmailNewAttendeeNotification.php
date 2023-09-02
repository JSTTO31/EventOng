<?php

namespace App\Listeners;

use App\Events\AttendeeRegistered;
use App\Mail\AttendeeRegistered as MailAttendeeRegistered;
use App\Mail\NewAttendeeRegistered;
use App\Models\User;
use App\Notifications\AttendeeRegisteredNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SendEmailNewAttendeeNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AttendeeRegistered $event): void
    {
        $user = User::find(1);
        Notification::send($user, new AttendeeRegisteredNotification($event->event, $event->attendee));
        Mail::to($event->attendee->email)->send(new NewAttendeeRegistered($event->event, $event->attendee));
    }
}
