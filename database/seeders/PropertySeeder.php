<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    public function run()
    {
        // Fetch all users with the "host" role
        $hosts = User::where('role', 'host')->get();

        if ($hosts->isEmpty()) {
            $this->command->error('No users with the "host" role found. Please seed users first.');
            return;
        }

        // Create properties for multiple hosts
        foreach ($hosts as $host) {
            Property::factory(rand(1, 5))->create([
                'host_id' => $host->id,
            ]);
        }
    }
}
