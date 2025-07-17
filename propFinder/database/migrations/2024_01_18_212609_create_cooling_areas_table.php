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
        Schema::create('cooling_areas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('municipality_id')->references('id')->on('municipalities');
            $table->string('building')->nullable();
            $table->string('address')->nullable();
            $table->text('phone')->nullable();
            $table->text('time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cooling_areas');
    }
};
