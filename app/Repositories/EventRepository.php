<?php

namespace App\Repositories;

use App\Models\DateTime;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EventRepository
{

    public function getEvents($with = []){
        $request = request();
        return Event::with($with)->
               whereRaw("status LIKE '%$request->event_status%'")
               ->whereRaw("title LIKE '%$request->search%'")
               ->latest()
               ->paginate(10);
    }

    public function getEvent($event_id){
        $request = request();
        return Event::with(['event_attendees' => function($query) use ($request){
            $query->join('attendees', 'attendees.id', '=', 'event_attendees.attendee_id')
            ->select()
            ->whereRaw("attendees.name LIKE '%$request->attendees_search%'");

        }, 'health_guideline', 'date_time', 'location', 'organizer'])->where('id', $event_id)->first();
    }

    public function storeEvent(){
        $request = request();
        $event = Event::create($request->only([
            'title', 'subtitle', 'mode', 'status', 'location_id', 'organizer_id', 'link'
        ]));
        $event->date_time()->create($request->date_time);
        $event->health_guideline()->create($request->health_guideline);
    }

    public function updateEvent(Event $event){
        $request = request();

        $event->date_time()->update([
                'event_date_start' => Carbon::parse($request->date_time['event_date_start']),
                'event_time_start' => Carbon::parse($request->date_time['event_time_start']),
                'event_date_end' => Carbon::parse($request->date_time['event_date_end']),
                'event_time_end' => Carbon::parse($request->date_time['event_time_end']),
                'hide_end' => $request->date_time['hide_end'],
                'month_long' => $request->date_time['month_long'],
                'year_long' => $request->date_time['year_long'],
                'progress_bar' => $request->date_time['progress_bar'],
                'all_day' => $request->date_time['all_day'],
            ]
        );
        $event->health_guideline()->update([
            'enable' => $request->health_guideline['enable'],
            'face_mask' => $request->health_guideline['face_mask'],
            'temperature' => $request->health_guideline['temperature'],
            'physical_distance' => $request->health_guideline['physical_distance'],
            'sanitize_before_event' => $request->health_guideline['sanitize_before_event'],
            'held_outside' => $request->health_guideline['held_outside'],
            'vaccination' => $request->health_guideline['vaccination'],
            'other' => $request->health_guideline['other'],
        ]);
        $event = $event->update($request->only(['title', 'subtitle', 'mode', 'status', 'location_id', 'organizer_id', 'link']));
    }

    public function getStatuses(){
        return Event::select(DB::raw('COUNT(id) as number, status as label'))->groupBy('status')->get();
    }
}
