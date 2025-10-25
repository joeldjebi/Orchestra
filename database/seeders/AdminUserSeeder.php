<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer un utilisateur admin par défaut
        User::create([
            'nom' => 'Admin',
            'prenoms' => 'Super',
            'email' => 'admin@orchestra.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);

        // Créer quelques utilisateurs de test
        User::create([
            'nom' => 'Dupont',
            'prenoms' => 'Jean',
            'email' => 'jean.dupont@example.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
            'email_verified_at' => now(),
        ]);

        User::create([
            'nom' => 'Martin',
            'prenoms' => 'Marie',
            'email' => 'marie.martin@example.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
            'email_verified_at' => now(),
        ]);
    }
}
