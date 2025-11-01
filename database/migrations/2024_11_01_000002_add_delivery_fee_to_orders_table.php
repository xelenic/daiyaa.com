<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('delivery_fee', 10, 2)->default(0)->after('total_amount');
            $table->foreignId('delivery_zone_id')->nullable()->after('delivery_fee')->constrained()->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['delivery_zone_id']);
            $table->dropColumn(['delivery_fee', 'delivery_zone_id']);
        });
    }
};

