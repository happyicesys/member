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
        Schema::create('plan_item_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('plan_item_id')->constrained();
            $table->dateTime('datetime_from')->nullable();
            $table->dateTime('datetime_to')->nullable();
            $table->integer('cycle_count')->default(0);
            $table->integer('used_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->unique(['user_id', 'plan_item_id']);
            $table->index(['user_id', 'plan_item_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_item_users');
    }
};
