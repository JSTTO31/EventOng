<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use App\Models\Event;
use App\Repositories\EventRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public $eventRepository;

    public function __construct()
    {
        $this->eventRepository = new EventRepository();
    }

    public function index(Request $request){

        return Inertia::render('Dashboard', [
            'events' => Event::with(['date_time'])->get(),
            'statuses' => $this->eventRepository->getStatuses(),
            'attendees' => Attendee::latest()->limit(10)->get(),
        ]);
    }
}
