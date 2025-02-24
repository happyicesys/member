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
        Schema::table('plan_item_users', function (Blueprint $table) {
            $table->foreignId('plan_id')->onDelete('cascade');
            $table->dropForeign(['plan_item_id']);
            $table->dropColumn('plan_item_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['plan_id']);
            $table->dropColumn('plan_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plan_item_users', function (Blueprint $table) {
            $table->dropColumn('plan_id');
        });
    }
};
