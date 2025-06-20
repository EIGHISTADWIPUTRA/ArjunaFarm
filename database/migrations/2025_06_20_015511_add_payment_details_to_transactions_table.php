<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('payment_type')->nullable()->after('status');
            $table->timestamp('payment_time')->nullable()->after('payment_type');
            // Update enum to include 'success' and 'failed' statuses
            $table->enum('status', ['pending', 'success', 'completed', 'failed', 'cancelled'])->default('pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['payment_type', 'payment_time']);
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending')->change();
        });
    }
};
