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
            $table->boolean('is_required_email_retention')->default(false)->after('is_grace_period');
            $table->boolean('is_email_retention_sent')->default(false)->after('is_grace_period');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plan_item_users', function (Blueprint $table) {
            $table->dropColumn('is_required_email_retention');
            $table->dropColumn('is_email_retention_sent');
        });
    }
};
