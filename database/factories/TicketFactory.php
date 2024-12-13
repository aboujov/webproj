<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    protected $model = \App\Models\Ticket::class;

    public function definition()
    {
        return [
            'subject' => $this->faker->sentence(5),
            'message' => $this->faker->paragraph,
            'status' => fake()->randomElement(['open', 'in_progress', 'resolved']),
            'created_at' => now(),
        ];
    }
}
