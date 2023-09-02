<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GuestEventController extends Controller
{
    public function show(Request $request, Event $event){
        return Inertia::render('EventShow', [
            'event' => $event->load(['health_guideline', 'location', 'date_time', 'organizer']),
            'picture_welcome' => asset('storage/welcome.svg'),
            'picture_welcome_back' => asset('storage/welcome-back.svg'),
        ]);
    }
}
