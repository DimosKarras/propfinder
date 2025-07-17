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
        Schema::create('physiotherapies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('municipality_id')->references('id')->on('municipalities');
            $table->string('name')->nullable();
            $table->string('category')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('site')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('physiotherapies');
    }
};
