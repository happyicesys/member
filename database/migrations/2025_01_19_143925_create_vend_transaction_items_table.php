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
        Schema::create('vend_transaction_items', function (Blueprint $table) {
            $table->id();
            $table->string('product_id')->index();
            $table->string('product_name');
            $table->string('product_thumbnail_url')->nullable();
            $table->integer('qty')->default(1);
            $table->string('vend_channel_code')->nullable()->index();
            $table->string('vend_channel_id')->nullable();
            $table->string('vend_channel_error_code')->nullable();
            $table->string('vend_channel_error_name')->nullable();
            $table->string('vend_channel_error_id')->nullable();
            $table->foreignId('vend_transaction_id')->constrained('vend_transactions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vend_transaction_items');
    }
};
