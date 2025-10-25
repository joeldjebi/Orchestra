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
        Schema::create('work_projects', function (Blueprint $table) {
            $table->id();
            $table->string('client');
            $table->string('image');
            $table->text('description')->nullable();
            $table->string('category')->nullable();
            $table->string('url')->nullable();
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
        Schema::dropIfExists('work_projects');
    }
};
