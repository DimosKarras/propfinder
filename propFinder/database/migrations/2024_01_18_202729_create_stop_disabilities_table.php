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
        Schema::create('stop_disabilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('municipality_id')->references('id')->on('municipalities');
            $table->string('stop_code')->nullable();
            $table->string('stop_name')->nullable();
            $table->string('stop_street')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('stop_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stop_disabilities');
    }
};
