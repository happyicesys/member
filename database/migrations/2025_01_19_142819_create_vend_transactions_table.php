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
        Schema::create('vend_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('apk_ver')->nullable();
            $table->dateTime('datetime')->index();
            $table->string('firmware_ver')->nullable();
            $table->integer('total_amount')->default(0);
            $table->string('customer_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('payment_method_id')->nullable();
            $table->string('payment_method_name')->nullable();
            $table->string('ref_order_id');
            $table->integer('ref_transaction_id')->index();
            $table->integer('total_promo_amount')->default(0);
            $table->integer('total_qty')->default(1);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('vend_code')->index();
            $table->string('vend_id')->index();
            $table->string('vend_prefix_id')->index();
            $table->string('vend_prefix_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vend_transactions');
    }
};
