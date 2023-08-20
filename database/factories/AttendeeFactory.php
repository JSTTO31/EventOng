<?php

namespace Database\Factories;

use App\Models\Attendee;
use App\Models\Event;
use App\Models\User;
use App\Notifications\AttendeeRegisteredNotification;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Notification;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendee>
 */
class AttendeeFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'mobile' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function(Attendee $attendee){
            $user = User::find(1);
            $event = Event::where('id', 4)->first();
            $attendee->event_attendee()->create(['event_id' => 4, 'attendee_id' => $attendee->id]);

            Notification::send($user, new AttendeeRegisteredNotification($event, $attendee));
        });
    }
}
