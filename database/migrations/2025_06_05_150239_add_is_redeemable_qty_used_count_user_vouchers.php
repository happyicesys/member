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
        Schema::table('user_vouchers', function (Blueprint $table) {
            $table->boolean('is_redeemable')->default(true)->after('date_to');
            $table->integer('qty')->default(1)->after('is_redeemed');
            $table->integer('used_count')->default(0)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_vouchers', function (Blueprint $table) {
            $table->dropColumn(['is_redeemable', 'qty', 'used_count']);
        });
    }
};
