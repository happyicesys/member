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
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->string('desc')->nullable();
            $table->string('full_url');
            $table->boolean('is_active')->default(true);
            $table->string('local_url')->nullable();
            $table->morphs('modelable');
            $table->string('name')->nullable();
            $table->integer('sequence')->default(1);
            $table->string('type')->nullable()->index();
            $table->timestamps();
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
