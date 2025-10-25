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
        Schema::create('blog_articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('headline');
            $table->json('content'); // Pour stocker les paragraphes
            $table->string('sidebar_title');
            $table->enum('layout', ['left', 'right'])->default('left'); // Layout du titre
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
        Schema::dropIfExists('blog_articles');
    }
};
