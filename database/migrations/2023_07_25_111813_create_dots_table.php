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
        Schema::create('dots', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('board_id');
            $table->integer('x');
            $table->integer('y');
            $table->string('color');
            $table->string('ip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dots');
    }
};
