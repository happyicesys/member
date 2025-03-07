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
            $table->unsignedBigInteger('scheduled_downgrade_plan_id')->nullable()->after('plan_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plan_item_users', function (Blueprint $table) {
            $table->dropColumn('scheduled_downgrade_plan_id');
        });
    }
};
