<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CarouselSlideSeeder::class,
            LeadershipMemberSeeder::class,
            ContactInfoSeeder::class,
            BlogArticleSeeder::class,
            ValueSeeder::class,
            WorkProjectSeeder::class,
            AgencySeeder::class,
        ]);

        // Créer un utilisateur admin s'il n'existe pas
        if (!User::where('email', 'admin@orchestra.com')->exists()) {
            User::create([
                'nom' => 'Admin',
                'prenoms' => 'Orchestra',
                'email' => 'admin@orchestra.com',
                'password' => bcrypt('password'),
                'is_admin' => true,
                'is_active' => true,
            ]);
        }
    }
}
