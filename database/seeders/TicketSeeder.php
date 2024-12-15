<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run()
    {
        // Fetch all non-admin users
        $users = User::where('role', '!=', 'admin')->get();

        if ($users->isEmpty()) {
            $this->command->error('No eligible users found. Please seed non-admin users first.');
            return;
        }

        // Create tickets for multiple users
        foreach ($users as $user) {
            Ticket::factory(rand(1, 5))->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
