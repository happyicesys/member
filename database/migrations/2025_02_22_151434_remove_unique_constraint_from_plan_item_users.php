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
            $table->dropUnique('plan_item_users_user_id_plan_item_id_unique'); // Drop the unique constraint
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plan_item_users', function (Blueprint $table) {
            $table->unique(['user_id', 'plan_item_id']); // Restore the unique constraint if needed
        });
    }
};
