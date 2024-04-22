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
        Schema::create('garde_robes', function (Blueprint $table) {
            $table->id();
            $table->string('couleur_ garde_robes');
            $table->binary('image');
            $table->unsignedBigInteger('type_garde_robe_id');

            $table->foreign('type_garde_robe_id')->references('id')->on('type_garde_robes')
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
        Schema::dropIfExists('garde_robes');
    }
};
