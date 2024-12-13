<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    public function run()
    {
        // Fetch a user with the "host" role
        $host = User::where('role', 'host')->first();

        if ($host) {
            Property::factory(10)->create([
                'host_id' => $host->id,
            ]);
        } else {
            $this->command->error('No user with the "host" role found. Please seed users first.');
        }
    }
}
