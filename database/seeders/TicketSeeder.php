<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run()
    {
        // Fetch a user (can be a user with a specific role or any user)
        $user = User::first();  // You can modify this logic to select a specific user

        if ($user) {
            Ticket::factory(10)->create([
                'user_id' => $user->id,
            ]);
        } else {
            $this->command->error('No user found. Please seed users first.');
        }
    }
}
