<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventStoreRequest;
use App\Models\Attendee;
use App\Models\Event;
use App\Models\Location;
use App\Models\Organizer;
use App\Repositories\EventRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{
    public $eventRepository;

    public function __construct()
    {
        $this->eventRepository = new EventRepository();
    }

    public function index(Request $request)
    {
        return Inertia::render('Event', [
            'events' => $this->eventRepository->getEvents(['date_time']),
            'event' => $this->eventRepository->getEvent($request->event),
        ]);

    }

    public function create()
    {
        return Inertia::render('Event/Create', [
            'locations' => Location::latest()->get(),
            'organizers' => Organizer::latest()->get()
        ]);
    }

    public function show(Request $request, Event $event){
        return Inertia::render('Event/Show', [
            'event' => $event->load(['date_time', 'location', 'event_attendees' => function($query){
                $query->join('attendees', 'attendees.id', '=', 'event_attendees.id');
            }]),
        ]);
    }

    public function store(EventStoreRequest $request)
    {
        $this->eventRepository->storeEvent();
        return redirect()->route('events.index');
    }

    public function edit(Request $request, Event $event)
    {
        return Inertia::render('Event/Edit', [
            'event' => $event->load(['health_guideline', 'date_time']),
            'locations' => Location::latest()->get(),
            'organizers' => Organizer::latest()->get()
        ]);
    }

    public function update(EventStoreRequest $request, Event $event)
    {
        $this->eventRepository->updateEvent($event);

        return redirect()->route('events.index');
    }

    public function destroy(Request $request, Event $event)
    {
        $event->delete();

        return back();
    }
}
