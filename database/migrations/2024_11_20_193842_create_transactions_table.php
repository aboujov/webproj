<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('booking_id'); // Reference to the booking
        $table->unsignedBigInteger('user_id');   // Guest or host
        $table->enum('type', ['payment', 'payout']); // Payment by guest or payout to host
        $table->decimal('amount', 10, 2);        // Transaction amount
        $table->enum('status', ['completed', 'pending', 'refunded', 'disputed'])->default('pending');
        $table->timestamps();

        $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
