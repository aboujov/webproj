<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = \App\Models\Booking::class;

    public function definition(): array
    {
        return [
            'guest_id' => User::inRandomOrder()->first()->id,
            'property_id' => Property::inRandomOrder()->first()->id,
            'status' => fake()->randomElement(['pending', 'approved', 'cancelled']),
            'start_date' => fake()->dateTimeBetween('+1 week', '+2 months'),
            'end_date' => fake()->dateTimeBetween('+2 months', '+3 months'),
        ];
    }
}

