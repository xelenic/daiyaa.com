<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('delivery_zones', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Kathmandu Central", "Lalitpur"
            $table->text('cities')->nullable(); // Comma-separated cities or JSON array
            $table->text('postal_codes')->nullable(); // Comma-separated postal codes
            $table->decimal('delivery_fee', 10, 2)->default(0); // Fee for this zone
            $table->integer('min_order_amount')->default(0); // Minimum order amount for delivery
            $table->integer('estimated_time')->default(45); // Estimated delivery time in minutes
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_zones');
    }
};

