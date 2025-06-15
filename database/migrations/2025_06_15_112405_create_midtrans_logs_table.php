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
        Schema::create('midtrans_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained('transactions')->onDelete('cascade');
            $table->string('mt_status_code')->nullable();
            $table->string('mt_status_message')->nullable();
            $table->string('mt_transaction_id');
            $table->string('mt_order_id');
            $table->string('mt_gross_amount');
            $table->string('mt_payment_type');
            $table->string('mt_transaction_time');
            $table->string('mt_transaction_status');
            $table->string('mt_fraud_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('midtrans_logs');
    }
};
