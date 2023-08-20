<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function event_attendee(){
        return $this->hasMany(EventAttendee::class);
    }

    public function isAlumni(){
        return  EventAttendee::where('attendee_id', $this->id)->count() > 0;
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }
}
