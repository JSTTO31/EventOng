<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventAttendee extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function event(){
        return $this->belongsTo(Event::class);
    }

    public function attendee(){
        return $this->belongsTo(Attendee::class);
    }

    public function messages(){
        return $this->hasMany(Message::class, 'attendee_id', 'attendee_id');
    }
}
