<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\SecurityLog;
use Illuminate\Database\Seeder;

class SecurityLogSeeder extends Seeder
{
    public function run()
    {
        // Fetch all users with the "admin" role (or adjust for other roles)
        $users = User::where('role', 'admin')->get();

        if ($users->isEmpty()) {
            $this->command->error('No users with the "admin" role found. Please seed users first.');
            return;
        }

        // Create security logs for each user
        foreach ($users as $user) {
            SecurityLog::factory(rand(1, 3))->create([  // Creating between 1 to 3 logs per user
                'user_id' => $user->id,  // Assuming the SecurityLog model has a user_id column
                'description' => 'Sample security log for user ' . $user->name,
                'status' => 'unresolved',
            ]);
        }
    }
}
