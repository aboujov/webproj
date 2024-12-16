<?php

namespace Database\Factories;

use App\Models\SecurityLog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SecurityLog>
 */
class SecurityLogFactory extends Factory
{
    protected $model = SecurityLog::class;

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id, // Randomly assign a user to the log
            'description' => $this->faker->sentence(6),  // Random description
            'status' => $this->faker->randomElement(['unresolved', 'resolved']), // Random status
            'type' => $this->faker->randomElement(['login', 'payment', 'fraud']), // Add type
            'created_at' => now(),
        ];
    }
}
