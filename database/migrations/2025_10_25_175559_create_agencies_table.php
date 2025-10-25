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
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->string('image');
            $table->text('description');
            $table->json('services'); // Pour stocker la liste des services
            $table->string('color'); // Couleur de la barre
            $table->string('url')->nullable(); // URL du site web
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
        Schema::dropIfExists('agencies');
    }
};
