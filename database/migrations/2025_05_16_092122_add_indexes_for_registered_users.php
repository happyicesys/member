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
            $table->bigInteger('plan_id')->index()->change();
            $table->boolean('is_active')->index()->change();
        });
        Schema::table('vend_transactions', function (Blueprint $table) {
            $table->datetime('created_at')->index()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plan_item_users', function (Blueprint $table) {
            //
        });
    }
};
