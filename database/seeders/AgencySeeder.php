<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Agency;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Agency::truncate(); // Clear existing records

        $agencies = [
            [
                'name' => 'Orchestra CIV',
                'location' => 'Côte d\'Ivoire',
                'image' => 'images/agencies/orchestra-civ.jpg',
                'description' => 'Leading digital transformation agency in West Africa',
                'services' => ['Digital Strategy', 'Web Development', 'Mobile Apps', 'E-commerce'],
                'color' => '#1e3a8a',
                'url' => 'https://orchestra-civ.com',
                'order' => 1,
                'is_active' => true
            ],
            [
                'name' => 'Phoenix',
                'location' => 'Nigeria',
                'image' => 'images/agencies/phoenix.jpg',
                'description' => 'Innovation hub driving technological advancement',
                'services' => ['AI Solutions', 'Cloud Computing', 'Data Analytics', 'IoT'],
                'color' => '#dc2626',
                'url' => 'https://phoenix-nigeria.com',
                'order' => 2,
                'is_active' => true
            ],
            [
                'name' => 'Caméléon',
                'location' => 'Benin-Burkina Faso',
                'image' => 'images/agencies/cameleon.jpg',
                'description' => 'Adaptive solutions for diverse African markets',
                'services' => ['Market Research', 'Localization', 'Cultural Adaptation', 'Regional Expansion'],
                'color' => '#059669',
                'url' => 'https://cameleon-africa.com',
                'order' => 3,
                'is_active' => true
            ],
            [
                'name' => 'Harmonies',
                'location' => 'Benin-Togo-Congo',
                'image' => 'images/agencies/harmonies.jpg',
                'description' => 'Unifying technology across multiple countries',
                'services' => ['Cross-border Solutions', 'Regional Integration', 'Multi-language Support', 'Compliance'],
                'color' => '#7c3aed',
                'url' => 'https://harmonies-africa.com',
                'order' => 4,
                'is_active' => true
            ],
            [
                'name' => 'Matin Libre',
                'location' => 'Cameroon',
                'image' => 'images/agencies/matin-libre.jpg',
                'description' => 'Media and communication solutions',
                'services' => ['Content Management', 'Digital Marketing', 'Social Media', 'Branding'],
                'color' => '#ea580c',
                'url' => 'https://matinlibre-cameroon.com',
                'order' => 5,
                'is_active' => true
            ],
            [
                'name' => 'Blue Diamond',
                'location' => 'South Africa',
                'image' => 'images/agencies/blue-diamond.jpg',
                'description' => 'Premium technology consulting services',
                'services' => ['Enterprise Solutions', 'Digital Transformation', 'Consulting', 'Training'],
                'color' => '#0ea5e9',
                'url' => 'https://bluediamond-sa.com',
                'order' => 6,
                'is_active' => true
            ]
        ];

        foreach ($agencies as $agency) {
            Agency::create($agency);
        }
    }
}
