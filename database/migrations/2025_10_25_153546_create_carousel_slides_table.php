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
        Schema::create('carousel_slides', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->json('items'); // Pour stocker la liste des items
            $table->string('image');
            $table->string('alt')->nullable();
            $table->integer('order')->default(0); // Pour l'ordre d'affichage
            $table->boolean('is_active')->default(true); // Pour activer/désactiver
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carousel_slides');
    }
};
