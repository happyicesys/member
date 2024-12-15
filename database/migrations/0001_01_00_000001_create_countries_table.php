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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('abbreviation');
            $table->unsignedTinyInteger('currency_exponent');
            $table->string('currency_name');
            $table->string('currency_symbol');
            $table->string('name');
            $table->string('phone_code');
            $table->boolean('is_currency_exponent_hidden');
            $table->boolean('is_active');
            $table->boolean('is_default')->default(false);
            $table->string('timezone');
            $table->integer('sequence');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
