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
        Schema::table('users', function (Blueprint $table) {
            // Supprimer la colonne name existante
            $table->dropColumn('name');

            // Ajouter nos colonnes personnalisées
            $table->string('nom')->after('id');
            $table->string('prenoms')->after('nom');
            $table->boolean('is_admin')->default(false)->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Restaurer la colonne name
            $table->string('name')->after('id');

            // Supprimer nos colonnes personnalisées
            $table->dropColumn(['nom', 'prenoms', 'is_admin']);
        });
    }
};
