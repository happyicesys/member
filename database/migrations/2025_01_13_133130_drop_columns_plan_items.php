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
        Schema::table('plan_items', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->integer('cycle')->default(1);
            $table->datetime('datetime_from')->nullable()->index();
            $table->datetime('datetime_to')->nullable()->index();
            $table->string('frequency')->default('monthly')->nullable();
            $table->boolean('is_base')->default(false);
            $table->integer('max_count')->nullable();
            $table->string('promo_type')->default('percent');
            $table->integer('promo_value')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plan_items', function (Blueprint $table) {
            //
        });
    }
};
