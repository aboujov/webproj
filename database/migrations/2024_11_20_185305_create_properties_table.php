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
    Schema::create('properties', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->unsignedBigInteger('host_id');
        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        $table->timestamps();

        $table->foreign('host_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
