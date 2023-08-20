<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventStoreAttendeeRequest;
use App\Models\Attendee;
use App\Models\Event;
use App\Models\EventAttendee;
use App\Models\User;
use App\Notifications\AttendeeRegisteredNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Mail\AttendeeRegistered;

class EventAttendeeController extends Controller
{
    public function store(EventStoreAttendeeRequest $request, Event $event){
        $attendee = Attendee::where('email', $request->email)->first();
        $already_registered = true;

        if(!$attendee){
            $attendee = Attendee::create($request->only(['email', 'name', 'address', 'mobile']));
        }

        Mail::to(['joshuasotto@example.example'])->send(new AttendeeRegistered($event, $attendee));

        $alumni = $attendee->isAlumni();


        $event_attendee = EventAttendee::where('event_id', $event->id)->where('attendee_id', $attendee->id)->exists();

        if(!$event_attendee){
            $already_registered = false;
            $event->event_attendees()->create(['attendee_id' => $attendee->id]);

            $user = User::find(1);
            // Notification::send($user, new AttendeeRegisteredNotification($event, $attendee));
            // Mail::to($user)->send(new AttendeeRegistered($event, $attendee));
        }

        return back()->with(['random' => [
            'alumni' => $alumni,
            'already_registered' => $already_registered,
        ]]);
    }


}
