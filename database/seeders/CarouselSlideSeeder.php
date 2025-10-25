<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CarouselSlide;

class CarouselSlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $slides = [
            [
                'title' => 'Proposition des parties pour le site internet du groupe Orchestra',
                'items' => [
                    'Orchestra CIV',
                    'Phoenix',
                    'Caméléon (Benin-Burkina Faso)',
                    'Harmonies (Benin-Togo_Congo)',
                    'Matin Libre - Kw',
                    'New',
                    'Blue Diamond'
                ],
                'image' => 'images/carousel/slide1.jpg',
                'alt' => 'Femme souriante avec un ordinateur portable',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Nos services et solutions pour votre entreprise',
                'items' => [
                    'Développement web',
                    'Applications mobiles',
                    'Solutions cloud',
                    'Consulting IT',
                    'Formation',
                    'Support technique'
                ],
                'image' => 'images/carousel/slide2.jpg',
                'alt' => 'Équipe de développement',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Innovation et technologie au service de votre croissance',
                'items' => [
                    'Intelligence artificielle',
                    'Machine Learning',
                    'Blockchain',
                    'IoT (Internet of Things)',
                    'Cybersécurité',
                    'Transformation digitale'
                ],
                'image' => 'images/carousel/slide3.jpg',
                'alt' => 'Technologies émergentes',
                'order' => 3,
                'is_active' => true,
            ]
        ];

        foreach ($slides as $slide) {
            CarouselSlide::create($slide);
        }
    }
}
