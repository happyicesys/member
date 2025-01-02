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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Plan name
            $table->text('desc')->nullable(); // Plan description
            $table->integer('price')->default(0); // Price in cents
            $table->integer('base_discount_percent')->default(0); // Base discount percentage
            $table->boolean('is_active')->default(true); // Active status
            $table->boolean('is_stackable')->default(false); // Stackable benefits
            $table->integer('level')->default(1); // Plan level (for hierarchy)

            // External system integration
            $table->string('external_ref_id')->nullable(); // Stripe or other external reference

            // Monthly discount vouchers
            $table->boolean('is_monthly_discount_voucher')->default(false);
            $table->integer('monthly_discount_voucher_count')->default(0);
            $table->integer('monthly_discount_voucher_percent')->default(0);

            // Monthly free items
            $table->boolean('is_monthly_free_item')->default(false);
            $table->integer('monthly_free_item_count')->default(0);
            $table->string('monthly_free_item_label')->nullable();
            $table->string('monthly_free_item_ref_id')->nullable();

            $table->timestamps();

            // Indexes
            $table->index('is_active');
            $table->index('level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
