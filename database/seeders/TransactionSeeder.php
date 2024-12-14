<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Booking;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = ['completed', 'pending', 'refunded', 'disputed'];

        // Get all bookings
        $bookings = Booking::all();

        foreach ($bookings as $booking) {
            $host = $booking->property->host; // Get the host of the property
            $guest = $booking->guest; // Get the guest of the booking

            // Create a payout transaction for the host
            Transaction::create([
                'booking_id' => $booking->id,
                'user_id' => $host->id,
                'type' => 'payout',
                'amount' => random_int(100, 1000), // Random amount for demo
                'status' => $statuses[array_rand($statuses)], // Random status
            ]);

            // Create a payment transaction for the guest
            Transaction::create([
                'booking_id' => $booking->id,
                'user_id' => $guest->id,
                'type' => 'payment',
                'amount' => random_int(100, 1000), // Random amount for demo
                'status' => $statuses[array_rand($statuses)], // Random status
            ]);
        }
    }
}
