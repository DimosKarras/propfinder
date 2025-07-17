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
        Schema::create('metros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('municipality_id')->references('id')->on('municipalities');
            $table->string('name')->nullable();
            $table->string('line')->nullable();
            $table->string('road')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metros');
    }
};
