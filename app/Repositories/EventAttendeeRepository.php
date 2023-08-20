<?php

namespace App\Repositories;

use App\Models\Attendee;

class EventAttendeeRepository
{
    public function storeAttendee(){
        $request = request();

        if(!Attendee::where('email', $request->email)->first()){
            $attendee = Attendee::create($request->only(['name','email','address', 'mobile']));
        }
    }
}
