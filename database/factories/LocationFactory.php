<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'address' => $this->faker->address(),
            'description' => $this->faker->paragraph(),
            'state' => $this->faker->state(),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'link' => '#',
        ];
    }
}
