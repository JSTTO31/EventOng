<?php

namespace App\Http\Controllers;

use App\Models\EventAttendee;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AttendeeVerificationController extends Controller
{
    public function verification(Request $request, EventAttendee $attendee){
        if($attendee->verify){
            return redirect()->route('welcome');
        }

        if (!$request->hasValidSignature()) {
            abort(401);
        }

        $attendee->verified = true;
        $attendee->save();

        return redirect()->route('attendees.verified');
    }

    public function verified(){
        return Inertia::render('Verified');
    }
}
