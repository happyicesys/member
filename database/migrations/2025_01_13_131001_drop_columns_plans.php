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
        Schema::table('plans', function (Blueprint $table) {
            $table->dropColumn('base_discount_percent');
            $table->dropColumn('is_monthly_discount_voucher');
            $table->dropColumn('monthly_discount_voucher_count');
            $table->dropColumn('monthly_discount_voucher_percent');
            $table->dropColumn('is_monthly_free_item');
            $table->dropColumn('monthly_free_item_count');
            $table->dropColumn('monthly_free_item_label');
            $table->dropColumn('monthly_free_item_ref_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            //
        });
    }
};
