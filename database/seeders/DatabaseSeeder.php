<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ensure the admin user is created only once
        User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin'),
                'role' => 'admin'
            ]
        );
    
        // Create random users and hosts
        User::factory(10)->create();

        // Seed other models
        $this->call([
            PropertySeeder::class,
            TicketSeeder::class,
            BookingSeeder::class,
            TransactionSeeder::class
        ]);
    }
}

