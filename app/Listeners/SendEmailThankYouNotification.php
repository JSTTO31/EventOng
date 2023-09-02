<?php

namespace App\Listeners;

use App\Events\AttendeeRegistered;
use App\Mail\GratitudeMessage;
use App\Mail\SendGratitudeToAttendee;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailThankYouNotification
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
        Mail::to($event->attendee->email)->send(new GratitudeMessage($event->event, $event->attendee));
    }
}
