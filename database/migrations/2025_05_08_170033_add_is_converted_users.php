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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_converted')->default(false)->after('is_one_time_voucher_used');
            $table->boolean('is_converted_voucher_used')->default(false)->after('is_one_time_voucher_used');
            $table->datetime('converted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_converted');
            $table->dropColumn('is_converted_voucher_used');
            $table->dropColumn('converted_at');
        });
    }
};
