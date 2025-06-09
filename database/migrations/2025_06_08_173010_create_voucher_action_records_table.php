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
        Schema::create('voucher_action_records', function (Blueprint $table) {
            $table->id();
            $table->string('action');
            $table->integer('dcvend_member_type')->nullable();
            $table->integer('dcvend_qty_per_member')->default(1);
            $table->boolean('is_dcvend')->default(false);
            $table->boolean('is_recurring')->default(false);
            $table->integer('valid_duration')->nullable(); // Duration in days
            $table->string('valid_unit')->nullable(); // Unit of time, e.g., 'days', 'months'
            $table->json('voucher_json')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voucher_action_records');
    }
};
