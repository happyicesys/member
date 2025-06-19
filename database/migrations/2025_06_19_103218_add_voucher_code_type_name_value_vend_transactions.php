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
        Schema::table('vend_transactions', function (Blueprint $table) {
            $table->string('voucher_code')->nullable()->after('vend_prefix_name');
            $table->string('voucher_type')->nullable()->after('vend_prefix_name');
            $table->string('voucher_name')->nullable()->after('vend_prefix_name');
            $table->integer('voucher_value')->nullable()->after('vend_prefix_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vend_transactions', function (Blueprint $table) {
            $table->dropColumn(['voucher_code', 'voucher_type', 'voucher_name', 'voucher_value']);
        });
    }
};
