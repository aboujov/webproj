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
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('property_id'); // The property being booked
        $table->unsignedBigInteger('guest_id');   // The user who made the booking
        $table->date('start_date');
        $table->date('end_date');
        $table->enum('status', ['pending', 'approved', 'cancelled'])->default('pending');
        $table->timestamps();

        $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
        $table->foreign('guest_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
