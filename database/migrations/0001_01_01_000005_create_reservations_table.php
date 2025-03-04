<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('passenger_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('route_id')->constrained('travel_routes')->onDelete('cascade');
            $table->enum('status', ['en attent', 'confirmer', 'annuler'])->default('en attent');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservation');
    }
};
