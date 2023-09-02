<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use App\Models\Event;
use App\Models\EventAttendee;
use App\Models\Message;
use App\Repositories\EventRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class InboxController extends Controller
{
    public $eventRepository;

    public function __construct()
    {
        $this->eventRepository = new EventRepository()    ;
    }

    public function index(Request $request){

        return Inertia::render('Inbox', [
            'attendees' => EventAttendee::join('attendees', 'attendees.id', '=', 'event_attendees.id')
                           ->select(DB::raw('event_attendees.*, attendees.name as name, attendees.email as email, attendees.address as address, attendees.mobile as mobile'))
                           ->orderBy('event_attendees.created_at', 'desc')
                           ->cursorPaginate(10),
            'attendee' => EventAttendee::with(['event' => fn($query) => $query->with('date_time', 'location'), 'messages'])->join('attendees', 'attendees.id', '=', 'event_attendees.id')
            ->select(DB::raw('event_attendees.*, attendees.name as name, attendees.email as email, attendees.address as address, attendees.mobile as mobile'))
            ->where('event_attendees.id', $request->attendee_id)
            ->first(),
        ]);

    }

    public function sendMessage(Request $request, Attendee $attendee){
        $request->validate(['message' => ['required', 'string'], 'subject' => ['required', 'string']]);

        $attendee->messages()->create($request->only(['message', 'subject']));

        return back();
    }
}
