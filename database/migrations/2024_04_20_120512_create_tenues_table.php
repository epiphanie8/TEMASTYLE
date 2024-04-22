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
        Schema::create('tenues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('avatar_id');
            $table->unsignedBigInteger('garde_robe_id');
            $table->binary('imagetenus_id');

            $table->foreign('avatar_id')->references('id')->on('avatars')
            ->onUptade('cascade')
            ->onDelete('cascade');
            
            $table->foreign('garde_robe_id')->references('id')->on('garde_robes')
            ->onUptade('cascade')
            ->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenues');
    }
};
